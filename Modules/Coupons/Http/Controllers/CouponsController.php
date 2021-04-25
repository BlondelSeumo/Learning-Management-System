<?php

namespace Modules\Coupons\Http\Controllers;

use App\User;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Validator;
use App\InviteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Coupons\Entities\Coupon;
use Modules\RolePermission\Entities\Role;
use Illuminate\Contracts\Support\Renderable;
use Modules\Coupons\Entities\UserWiseCoupon;
use Modules\CourseSetting\Entities\Category;
use Modules\Coupons\Entities\UserWiseCouponSetting;

class CouponsController extends Controller
{

    public function invitebyCode()
    {
        $user_wise_coupons = UserWiseCoupon::all();
        $categories = Category::all();
        if (Auth::user()->role_id == 1) {
            $roles = Role::all();
        } elseif (Auth::user()->role_id == 2) {
            $roles = Role::where('id', '!=', 1)->get();
        } else {
            $roles = Role::where('id', 3)->get();
        }

        $inviteSettings = UserWiseCouponSetting::all();
        return view('coupons::invitebyCode', compact('inviteSettings', 'roles', 'user_wise_coupons', 'categories'));
    }

    public function inviteSettings()
    {

        if (Auth::user()->role_id == 1) {
            $roles = Role::all();
        } elseif (Auth::user()->role_id == 2) {
            $roles = Role::where('id', '!=', 1)->get();
        } else {
            $roles = Role::where('id', 3)->get();
        }

        $inviteSettings = UserWiseCouponSetting::all();
        return view('coupons::inviteSettings', compact('inviteSettings', 'roles'));
    }

    public function inviteSettingEdit($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        if (Auth::user()->role_id == 1) {
            $roles = Role::all();
        } elseif (Auth::user()->role_id == 2) {
            $roles = Role::where('id', '!=', 1)->get();
        } else {
            $roles = Role::where('id', 3)->get();
        }

        $edit = UserWiseCouponSetting::find($id);
        $inviteSettings = UserWiseCouponSetting::all();
        return view('coupons::inviteSettings', compact('inviteSettings', 'roles', 'edit'));
    }

    public function inviteSettingDelete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        try {
            $delete = UserWiseCouponSetting::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function inviteSettingStore(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'max_limit' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        try {
            $invite_setting = UserWiseCouponSetting::where('role_id', 3)->first();
            if ($invite_setting == null) {
                $invite_setting = new UserWiseCouponSetting();
            }
            $invite_setting->role_id = 3;
            $invite_setting->type = $request->type;
            $invite_setting->status = $request->status;
            $invite_setting->amount = $request->amount;
            $invite_setting->max_limit = $request->max_limit;
            $invite_setting->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function coupon_delete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $deleted = Coupon::find($id)->delete();
            if ($deleted) {
                $coupons = Coupon::latest()->get();
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);

        }
    }


    public function coupon_single(Request $request)
    {
        try {
            $categories = Category::all();
            $coupons = Coupon::where('category', 2)->latest()->get();
            $edit = Coupon::find($request->id);
            if (!empty($edit)) {
                $subcategories = SubCategory::where('category_id', $edit->category_id)->get();
                $edit->subcategories = $subcategories;

                $courses = Course::where('category_id', $edit->category_id)->where('subcategory_id', $edit->subcategory_id)->get();
                $edit->courses = $courses;

            }
            return view('coupons::single_coupons', compact('edit', 'coupons', 'categories'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);
        }
    }


    public function coupon_personalized(Request $request)
    {
        try {
            $users = User::where('role_id', 3)->get();
            $coupons = Coupon::where('category', 3)->latest()->get();
            $edit = Coupon::find($request->id);
            return view('coupons::personalized_coupons', compact('edit', 'coupons', 'users'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);
        }
    }


    public function index()
    {
        try {
            $coupons = Coupon::latest()->get();
            return view('coupons::coupons', compact('coupons'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);

        }
    }

    public function coupon_common()
    {
        try {
            $coupons = Coupon::where('category', 1)->latest()->get();
            return view('coupons::common_coupons', compact('coupons'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);

        }
    }

    public function saveCoupon(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => 'required|max:255',
            'code' => 'required|unique:coupons|max:255',
            'type' => 'required',
            'category' => 'required',
            'value' => 'required|numeric|min:0',
            'min_purchase' => 'required|numeric|min:0',
            'max_discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        try {
            $success = trans('lang.Coupon') . ' ' . trans('lang.Added') . ' ' . trans('lang.Successfully');

            $coupon = new Coupon();
            $coupon->user_id = Auth::id();
            if ($request->category) {
                $coupon->category = $request->category;
            }
            if ($request->category_id) {
                $coupon->category_id = $request->category_id;
            }
            if ($request->subcategory_id) {
                $coupon->subcategory_id = $request->subcategory_id;
            }
            if ($request->course_id) {
                $coupon->course_id = $request->course_id;
            }
            if ($request->coupon_user_id) {
                $coupon->coupon_user_id = $request->coupon_user_id;
            }
            $coupon->title = $request->title;
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->value = $request->value;

            $coupon->min_purchase = $request->min_purchase;
            $coupon->max_discount = $request->max_discount;
            $coupon->start_date = date('Y-m-d', strtotime($request->start_date));
            $coupon->end_date = date('Y-m-d', strtotime($request->end_date));
            $coupon->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {

            return response()->json(['error' => trans("lang.Operation Failed")]);

        }
    }


    public function editCoupon($id)
    {
        try {
            $edit = Coupon::find($id);
            $coupons = Coupon::latest()->get();
            return view('coupons::coupons', compact('coupons', 'edit'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);

        }
    }


    public function updateCoupon(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => 'required',
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'min_purchase' => 'required|numeric|min:0',
            'max_discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        try {

            $success = trans('lang.Coupon') . ' ' . trans('lang.Updated') . ' ' . trans('lang.Successfully');

            $coupon = Coupon::find($request->id);
            $coupon->user_id = Auth::id();
            $coupon->title = $request->title;
            $coupon->status = $request->status;

            if ($request->category) {
                $coupon->category = $request->category;
            }
            if ($request->category_id) {
                $coupon->category_id = $request->category_id;
            }
            if ($request->subcategory_id) {
                $coupon->subcategory_id = $request->subcategory_id;
            }
            if ($request->course_id) {
                $coupon->course_id = $request->course_id;
            }
            if ($request->coupon_user_id) {
                $coupon->coupon_user_id = $request->coupon_user_id;
            }

            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->value = $request->value;
            $coupon->min_purchase = $request->min_purchase;
            $coupon->max_discount = $request->max_discount;
            $coupon->start_date = date('Y-m-d', strtotime($request->start_date));
            $coupon->end_date = date('Y-m-d', strtotime($request->end_date));
            $coupon->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));

            if ($coupon->category == 3) {
                return redirect()->route('coupons.personalized');
            }
            if ($coupon->category == 2) {
                return redirect()->route('coupons.single');
            }
            return redirect()->route('coupons.manage');


        } catch (\Exception $e) {
            return response()->json(['error' => 'Operation Failed']);

        }
    }
}
