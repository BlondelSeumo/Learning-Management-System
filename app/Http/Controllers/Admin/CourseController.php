<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscribe;
use App\Traits\ImageStore;
use App\Traits\SendMail;
use App\Traits\SendSMS;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Coupons\Entities\Coupon;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\SystemSetting\Entities\Blog;
use Modules\SystemSetting\Entities\Company;
use Modules\SystemSetting\Entities\FrontendSetting;
use Modules\SystemSetting\Entities\GeneralSettings;
use Modules\SystemSetting\Entities\Page;

class CourseController extends Controller
{
    use ImageStore, SendSMS, SendMail;

    public function sub_category(Request $request)
    {
        try {
            $sub_categories = SubCategory::with('category')->orderBy('position_order', 'asc')->orderBy('category_id', 'asc')->get();

            $categories = Category::where('status', 1)->get();
            return view('backend.categories.subcategories', compact('sub_categories', 'categories'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function sub_category_delete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $result = SubCategory::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function sub_category_edit($id)
    {
        try {
            $edit = SubCategory::where('id', $id)->with('category')->first();
            $sub_categories = SubCategory::with('category')->orderBy('position_order', 'asc')->orderBy('category_id', 'asc')->get();
            $categories = Category::where('status', 1)->get();
            return view('backend.categories.subcategories', compact('sub_categories', 'categories', 'edit'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function sub_category_store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $is_exist = Subcategory::where('category_id', $request->category_id)->where('name', $request->name)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            DB::beginTransaction();
            $store = new Subcategory;
            $store->name = $request->name;
            $store->status = $request->status;
            $store->show_home = $request->show_home;
            $store->position_order = $request->position_order;
            $store->category_id = $request->category_id;
            $store->save();
            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function sub_category_status_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $store = Subcategory::find($request->id);
            $store->status = $request->status;
            $store->save();
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function sub_category_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'photo' => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000|dimensions:width=200,height=200'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $is_exist = Subcategory::where('category_id', $request->category_id)->where('name', $request->name)->where('id', '!=', $request->id)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            $store = Subcategory::find($request->id);
            $store->name = $request->name;
            $store->status = $request->status;
            $store->show_home = $request->show_home;
            $store->position_order = $request->position_order;
            $store->category_id = $request->category_id;
            $results = $store->save();
            if ($results) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            //  dd($e->getMessage());
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


// START CATEGORY SECTIONS
    public function ajaxGetSubCategoryList(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->id)->get();
        return response()->json([$subcategories]);
    }


    public function ajaxGetCourseList(Request $request)
    {
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        if (Auth::user()->role_id == 1) {
            $subcategories = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->get();
        } else {
            $subcategories = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->where('user_id', Auth::user()->id)->get();
        }
        return response()->json([$subcategories]);
    }


    public function category(Request $request)
    {
        try {
            $categories = Category::orderBy('position_order', 'ASC')->get();
            $max_id = Category::max('position_order') + 1;

            return view('backend.categories.index', compact('categories', 'max_id'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function category_delete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            Category::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function category_edit($id)
    {
        try {
            $edit = Category::find($id);
            $categories = Category::all();
            $max_id = Category::max('position_order') + 1;
            return view('backend.categories.index', compact('categories', 'edit', 'max_id'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function category_store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name',
            'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'thumbnail' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $is_exist = Subcategory::where('category_id', $request->category_id)->where('name', $request->name)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try {
            if ($request->photo != "") {
                $url1 = $this->saveImage($request->photo);
            } else {
                $url1 ='public/demo/category/image/1.png';
            }
            if ($request->thumbnail != "") {
                $url2 = $this->saveImage($request->thumbnail);
            } else {
                $url2 =  'public/demo/category/thumb/1.png';
            }
            DB::beginTransaction();

            $check_position = Category::where('position_order', $request->position_order)->first();

            if ($check_position != '') {
                $old_categories = Category::where('position_order', '>=', $request->position_order)->get();

                foreach ($old_categories as $old_category) {
                    $old_category->position_order = $old_category->position_order + 1;
                    $old_category->save();
                }
            }


            $store = new Category;
            $store->name = $request->name;
            $store->status = $request->status;

            $store->position_order = $request->position_order;
            if (@$url1) {
                $store->image = $url1;
            }
            if (@$url2) {
                $store->thumbnail = $url2;
            }
            $store->save();
            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function category_status_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $store = Category::find($request->id);
            $store->status = $request->status;
            $store->save();
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function category_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name,' . $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $is_exist = Category::where('name', $request->name)->where('id', '!=', $request->id)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            if ($request->photo != "") {
                $url1 = $this->saveImage($request->photo);
            }
            if ($request->thumbnail != "") {
                $url2 = $this->saveImage($request->thumbnail);
            }


            $check_position = Category::where('position_order', $request->position_order)->first();

            if ($check_position != '') {
                $old_categories = Category::where('position_order', '>=', $request->position_order)->get();

                foreach ($old_categories as $old_category) {
                    $old_category->position_order = $old_category->position_order + 1;
                    $old_category->save();
                }
            }


            $store = Category::find($request->id);
            $store->name = $request->name;
            $store->status = $request->status;
            $store->url = $request->url;
            $store->title = $request->title;
            $store->description = $request->description;
            $store->show_home = $request->show_home;
            $store->position_order = $request->position_order;
            // $store->category_id = $request->category_id;
            if (@$url1) {
                $store->image = $url1;
            }
            if (@$url2) {
                $store->thumbnail = $url2;
            }
            $results = $store->save();
            if ($results) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('course.category');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
// END CATEGORY SECTIONS


// START COUPONS SECTIONS


    public function coupon(Request $request)
    {
        try {
            $coupons = Coupon::all();
            return view('backend.courses.coupons', compact('coupons'));
        } catch (\Exception $e) {
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
            $result = Category::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function coupon_edit($id)
    {
        try {
            $edit = Category::find($id);
            $categories = Category::all();
            return view('backend.courses.coupons', compact('categories', 'edit'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function coupon_store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:coupons,title',
            'code' => 'required|max:255|unique:coupons,code',
            'min_purchase' => 'required',
            'max_discount' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $is_exist = Subcategory::where('category_id', $request->category_id)->where('name', $request->name)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try {
            if ($request->photo != "") {
                $url1 = $this->saveImage($request->photo);
            }
            if ($request->thumbnail != "") {
                $url2 = $this->saveImage($request->thumbnail);
            }
            DB::beginTransaction();
            $store = new Category;
            $store->name = $request->name;
            $store->status = $request->status;
            $store->show_home = $request->show_home;
            $store->position_order = $request->position_order;
            if ($url1) {
                $store->image = $url1;
            }
            if ($url2) {
                $store->thumbnail = $url2;
            }
            $store->save();
            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function coupon_status_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $store = Category::find($request->id);
            $store->status = $request->status;
            $store->save();
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function coupon_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name,' . $request->id,
            'photo' => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000',
            'thumbnail' => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $is_exist = Category::where('name', $request->name)->where('id', '!=', $request->id)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            if ($request->photo != "") {
                $url1 = $this->saveImage($request->photo);
            }
            if ($request->thumbnail != "") {
                $url2 = $this->saveImage($request->thumbnail);
            }
            $store = Category::find($request->id);
            $store->name = $request->name;
            $store->status = $request->status;
            $store->show_home = $request->show_home;
            $store->position_order = $request->position_order;
            $store->category_id = $request->category_id;
            if ($url1) {
                $store->image = $url1;
            }
            if ($url2) {
                $store->thumbnail = $url2;
            }
            $results = $store->save();
            if ($results) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

// END CATEGORY SECTIONS
    public function index()
    {
        try {
            $userEmail = '';
            if (Session::has('resetPassword')) {
                $userEmail = Session::get('resetPassword');
            }
            $data = [
                'website_setting' => GeneralSettings::latest()->first(),
                'banner' => FrontendSetting::where('section', 'banner')->first(),
                'cta' => FrontendSetting::where('section', 'cta_part')->first(),
                'companies' => Company::latest()->get(),
                'pages' => Page::where('status', 1)->latest()->get(),
                'seo' => GeneralSettings::first()

            ];
            return view('frontend.website.layout.master')->with($data);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }
}

