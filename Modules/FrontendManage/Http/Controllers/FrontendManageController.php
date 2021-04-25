<?php

namespace Modules\FrontendManage\Http\Controllers;

use App\AboutPage;
use App\Subscription;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\FrontendManage\Entities\FrontPage;
use Modules\FrontendManage\Entities\HomeContent;
use Modules\FrontendManage\Entities\HomeSlider;
use Modules\FrontendManage\Entities\PrivacyPolicy;
use Modules\SystemSetting\Entities\FrontendSetting;
use Modules\SystemSetting\Entities\SocialLink;
use Modules\SystemSetting\Entities\Testimonial;
use Throwable;

class FrontendManageController extends Controller
{
    use ImageStore;

    /**
     * Display a listing of the resource.
     * @return string
     */
    public function index()
    {
        return 'Frontend Manage';
    }


    // HomeContent
    public function HomeContent()
    {
        try {
            $home_content = HomeContent::find(1);
            $pages = FrontPage::where('status', 1)->get();
            return view('frontendmanage::home_content', compact('home_content', 'pages'));
        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function HomeContentUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        try {
            $home_content = HomeContent::find($request->id);
            $home_content->slider_title = $request->slider_title;
            $home_content->slider_text = $request->slider_text;
            $home_content->testimonial_title = $request->testimonial_title;
            $home_content->category_title = $request->category_title;
            $home_content->category_sub_title = $request->category_sub_title;

            if ($request->instructor_banner != null) {

                if ($request->file('instructor_banner')->extension() == "svg") {
                    $file = $request->file('instructor_banner');
                    $fileName = md5(rand(0, 9999) . '_' . time()) . '.' . $file->clientExtension();
                    $url1 = 'public/uploads/settings/' . $fileName;
                    $file->move(public_path('uploads/settings'), $fileName);
                } else {
                    $url1 = $this->saveImage($request->instructor_banner);
                }
                $home_content->instructor_banner = $url1;
            }
            if ($request->best_category_banner != null) {

                if ($request->file('best_category_banner')->extension() == "svg") {
                    $file1 = $request->file('best_category_banner');
                    $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $file1->clientExtension();
                    $url2 = 'public/uploads/settings/' . $fileName1;
                    $file1->move(public_path('uploads/settings'), $fileName1);

                } else {
                    $url2 = $this->saveImage($request->best_category_banner);
                }

                $home_content->best_category_banner = $url2;
            }


            $home_content->instructor_title = $request->instructor_title;
            $home_content->instructor_sub_title = $request->instructor_sub_title;
            $home_content->course_title = $request->course_title;
            $home_content->course_sub_title = $request->course_sub_title;
            $home_content->best_category_title = $request->best_category_title;
            $home_content->best_category_sub_title = $request->best_category_sub_title;
            $home_content->quiz_title = $request->quiz_title;
            $home_content->testimonial_sub_title = $request->testimonial_sub_title;
            $home_content->article_title = $request->article_title;
            $home_content->article_sub_title = $request->article_sub_title;


            if ($request->subscribe_logo != null) {

                if ($request->file('subscribe_logo')->extension() == "svg") {
                    $file3 = $request->file('subscribe_logo');
                    $fileName3 = md5(rand(0, 9999) . '_' . time()) . '.' . $file3->clientExtension();
                    $url3 = 'public/uploads/settings/' . $fileName3;
                    $file3->move(public_path('uploads/settings'), $fileName3);

                } else {
                    $url3 = $this->saveImage($request->subscribe_logo);
                }

                $home_content->subscribe_logo = $url3;
            }

            $home_content->subscribe_title = $request->subscribe_title;
            $home_content->subscribe_sub_title = $request->subscribe_sub_title;


            if ($request->become_instructor_logo != null) {

                if ($request->file('become_instructor_logo')->extension() == "svg") {
                    $file4 = $request->file('become_instructor_logo');
                    $fileName4 = md5(rand(0, 9999) . '_' . time()) . '.' . $file4->clientExtension();
                    $url4 = 'public/uploads/settings/' . $fileName4;
                    $file4->move(public_path('uploads/settings'), $fileName4);

                } else {
                    $url4 = $this->saveImage($request->become_instructor_logo);
                }

                $home_content->become_instructor_logo = $url4;
            }
            if ($request->slider_banner != null) {

                if ($request->file('slider_banner')->extension() == "svg") {
                    $file5 = $request->file('slider_banner');
                    $fileName5 = md5(rand(0, 9999) . '_' . time()) . '.' . $file5->clientExtension();
                    $url5 = 'public/uploads/settings/' . $fileName5;
                    $file5->move(public_path('uploads/settings'), $fileName5);

                } else {
                    $url5 = $this->saveImage($request->slider_banner);
                }

                $home_content->slider_banner = $url5;
            }

            $home_content->become_instructor_title = $request->become_instructor_title;
            $home_content->become_instructor_sub_title = $request->become_instructor_sub_title;


            if ($request->key_feature_logo1 != null) {

                if ($request->file('key_feature_logo1')->extension() == "svg") {
                    $file6 = $request->file('key_feature_logo1');
                    $fileName6 = md5(rand(0, 9999) . '_' . time()) . '.' . $file6->clientExtension();
                    $url6 = 'public/uploads/settings/' . $fileName6;
                    $file6->move(public_path('uploads/settings'), $fileName6);

                } else {
                    $url6 = $this->saveImage($request->key_feature_logo1);
                }

                $home_content->key_feature_logo1 = $url6;
            }

            if ($request->key_feature_logo2 != null) {

                if ($request->file('key_feature_logo2')->extension() == "svg") {
                    $file7 = $request->file('key_feature_logo2');
                    $fileName7 = md5(rand(0, 9999) . '_' . time()) . '.' . $file7->clientExtension();
                    $url7 = 'public/uploads/settings/' . $fileName7;
                    $file7->move(public_path('uploads/settings'), $fileName7);

                } else {
                    $url7 = $this->saveImage($request->key_feature_logo2);
                }
                $home_content->key_feature_logo2 = $url7;
            }

            if ($request->key_feature_logo3 != null) {

                if ($request->file('key_feature_logo3')->extension() == "svg") {
                    $file8 = $request->file('key_feature_logo3');
                    $fileName8 = md5(rand(0, 9999) . '_' . time()) . '.' . $file8->clientExtension();
                    $url8 = 'public/uploads/settings/' . $fileName8;
                    $file8->move(public_path('uploads/settings'), $fileName8);

                } else {
                    $url8 = $this->saveImage($request->key_feature_logo3);
                }

                $home_content->key_feature_logo3 = $url8;
            }

            if ($request->show_key_feature == 1) {
                $home_content->show_key_feature = 1;
            } else {
                $home_content->show_key_feature = 0;

            }

            $home_content->key_feature_title1 = $request->key_feature_title1;
            $home_content->key_feature_subtitle1 = $request->key_feature_subtitle1;
            $home_content->key_feature_link1 = $request->key_feature_link1;
            $home_content->key_feature_title2 = $request->key_feature_title2;
            $home_content->key_feature_subtitle2 = $request->key_feature_subtitle2;
            $home_content->key_feature_link2 = $request->key_feature_link2;
            $home_content->key_feature_title3 = $request->key_feature_title3;
            $home_content->key_feature_subtitle3 = $request->key_feature_subtitle3;
            $home_content->key_feature_link3 = $request->key_feature_link3;


            $home_content->save();
            if ($home_content) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('frontend.homeContent');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }


        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function PageContent()
    {
        try {
            $page_content = HomeContent::first();
            return view('frontendmanage::page_content', compact('page_content'));
        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function PageContentUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }


        try {
            $home_content = HomeContent::find($request->id);
            $home_content->course_page_title = $request->course_page_title;
            $home_content->course_page_sub_title = $request->course_page_sub_title;
            $home_content->class_page_title = $request->class_page_title;
            $home_content->class_page_sub_title = $request->class_page_sub_title;
            $home_content->quiz_page_title = $request->quiz_page_title;
            $home_content->quiz_page_sub_title = $request->quiz_page_sub_title;
            $home_content->instructor_page_title = $request->instructor_page_title;
            $home_content->instructor_page_sub_title = $request->instructor_page_sub_title;

            $home_content->become_instructor_page_title = $request->become_instructor_page_title;
            $home_content->become_instructor_page_sub_title = $request->become_instructor_page_sub_title;

            $home_content->contact_page_title = $request->contact_page_title;
            $home_content->contact_sub_title = $request->contact_sub_title;

            $home_content->about_page_title = $request->about_page_title;
            $home_content->about_sub_title = $request->about_sub_title;


            if ($request->about_page_banner != null) {
                if ($request->file('about_page_banner')->extension() == "svg") {
                    $file1 = $request->file('about_page_banner');
                    $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $file1->clientExtension();
                    $url1 = 'public/uploads/settings/' . $fileName1;
                    $file1->move(public_path('uploads/settings'), $fileName1);
                } else {
                    $url1 = $this->saveImage($request->about_page_banner);
                }
                $home_content->about_page_banner = $url1;
            }
            if ($request->contact_page_banner != null) {
                if ($request->file('contact_page_banner')->extension() == "svg") {
                    $file2 = $request->file('contact_page_banner');
                    $fileName2 = md5(rand(0, 9999) . '_' . time()) . '.' . $file2->clientExtension();
                    $url2 = 'public/uploads/settings/' . $fileName2;
                    $file2->move(public_path('uploads/settings'), $fileName2);
                } else {
                    $url2 = $this->saveImage($request->contact_page_banner);
                }
                $home_content->contact_page_banner = $url2;
            }

            if ($request->instructor_page_banner != null) {
                if ($request->file('instructor_page_banner')->extension() == "svg") {
                    $file3 = $request->file('instructor_page_banner');
                    $fileName3 = md5(rand(0, 9999) . '_' . time()) . '.' . $file3->clientExtension();
                    $url3 = 'public/uploads/settings/' . $fileName3;
                    $file3->move(public_path('uploads/settings'), $fileName3);
                } else {
                    $url3 = $this->saveImage($request->instructor_page_banner);
                }
                $home_content->instructor_page_banner = $url3;
            }
            if ($request->become_instructor_page_banner != null) {
                if ($request->file('become_instructor_page_banner')->extension() == "svg") {
                    $file8 = $request->file('become_instructor_page_banner');
                    $fileName8 = md5(rand(0, 9999) . '_' . time()) . '.' . $file8->clientExtension();
                    $url8 = 'public/uploads/settings/' . $fileName8;
                    $file8->move(public_path('uploads/settings'), $fileName8);
                } else {
                    $url8 = $this->saveImage($request->become_instructor_page_banner);
                }
                $home_content->become_instructor_page_banner = $url8;
            }

            if ($request->quiz_page_banner != null) {
                if ($request->file('quiz_page_banner')->extension() == "svg") {
                    $file4 = $request->file('quiz_page_banner');
                    $fileName4 = md5(rand(0, 9999) . '_' . time()) . '.' . $file4->clientExtension();
                    $url4 = 'public/uploads/settings/' . $fileName4;
                    $file4->move(public_path('uploads/settings'), $fileName4);
                } else {
                    $url4 = $this->saveImage($request->quiz_page_banner);
                }
                $home_content->quiz_page_banner = $url4;
            }

            if ($request->class_page_banner != null) {
                if ($request->file('class_page_banner')->extension() == "svg") {
                    $file5 = $request->file('class_page_banner');
                    $fileName5 = md5(rand(0, 9999) . '_' . time()) . '.' . $file5->clientExtension();
                    $url5 = 'public/uploads/settings/' . $fileName5;
                    $file5->move(public_path('uploads/settings'), $fileName5);
                } else {
                    $url5 = $this->saveImage($request->class_page_banner);
                }
                $home_content->class_page_banner = $url5;
            }

            if ($request->course_page_banner != null) {
                if ($request->file('course_page_banner')->extension() == "svg") {
                    $file6 = $request->file('course_page_banner');
                    $fileName6 = md5(rand(0, 9999) . '_' . time()) . '.' . $file6->clientExtension();
                    $url6 = 'public/uploads/settings/' . $fileName6;
                    $file6->move(public_path('uploads/settings'), $fileName6);
                } else {
                    $url6 = $this->saveImage($request->course_page_banner);
                }
                $home_content->course_page_banner = $url6;
            }

            if (moduleStatusCheck('Subscription')) {
                $home_content->subscription_page_title = $request->subscription_page_title;
                $home_content->subscription_page_sub_title = $request->subscription_page_sub_title;
                if ($request->subscription_page_banner != null) {
                    if ($request->file('subscription_page_banner')->extension() == "svg") {
                        $file9 = $request->file('subscription_page_banner');
                        $fileName9 = md5(rand(0, 9999) . '_' . time()) . '.' . $file9->clientExtension();
                        $ur9 = 'public/uploads/settings/' . $fileName9;
                        $file9->move(public_path('uploads/settings'), $fileName9);
                    } else {
                        $url9 = $this->saveImage($request->subscription_page_banner);
                    }
                    $home_content->subscription_page_banner = $url9;
                }
            }


            $home_content->save();
            if ($home_content) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('frontend.pageContent');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }


        } catch (Throwable $th) {
            dd($th);
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    // PrivacyPolicy
    public function PrivacyPolicy()
    {
        try {
            $privacy_policy = PrivacyPolicy::find(1);
            return view('frontendmanage::privacy_policy', compact('privacy_policy'));
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function PrivacyPolicyUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        // return $request;
        $request->validate([
            'description' => 'required',
            'general' => 'required',
            'personal_data' => 'required',
            'voluntary_disclosure' => 'required',
            'children_privacy' => 'required',
            'information_about_cookies' => 'required',
            'thirt_party_adv' => 'required',
            'other_sites' => 'required',
            'teacher' => 'required',
            'student' => 'required',
            'business_transfer' => 'required',

        ]);
        try {
            $privacy_policy = PrivacyPolicy::find($request->id);
            $privacy_policy->description = $request->description;
            $privacy_policy->general = $request->general;
            $privacy_policy->personal_data = $request->personal_data;
            $privacy_policy->voluntary_disclosure = $request->voluntary_disclosure;
            $privacy_policy->children_privacy = $request->children_privacy;
            $privacy_policy->information_about_cookies = $request->information_about_cookies;
            $privacy_policy->thirt_party_adv = $request->thirt_party_adv;
            $privacy_policy->other_sites = $request->other_sites;
            $privacy_policy->teacher = $request->teacher;
            $privacy_policy->student = $request->student;
            $privacy_policy->business_transfer = $request->business_transfer;

            $privacy_policy->save();
            if ($privacy_policy) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('frontend.privacy_policy');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }

        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function testimonials()
    {
        try {
            $data['testimonials'] = Testimonial::latest()->get();
            return view('frontendmanage::testimonials', compact('data'));
        } catch (Throwable $th) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function testimonials_store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $request->validate([
            'body' => 'required',
            'author' => 'required|max:255',
            'profession' => 'required|max:255',
            'image' => 'required',
        ]);

        try {
            $testimonial = new Testimonial();
            $testimonial->body = $request->body;
            $testimonial->star = $request->star;
            $testimonial->author = $request->author;
            $testimonial->profession = $request->profession;

            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/testimonial/', $image);
                $image = 'public/uploads/testimonial/' . $image;
                $testimonial->image = $image;
            }

            $testimonial->status = $request->status;
            $testimonial->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.testimonials');
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
        }
    }

    public function testimonials_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'body' => 'required',
            'author' => 'required|max:255',
            'profession' => 'required|max:255',
        ]);
        try {
            $testimonial = Testimonial::find($request->id);
            $testimonial->body = $request->body;
            $testimonial->author = $request->author;
            $testimonial->profession = $request->profession;
            $testimonial->star = $request->star;

            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/testimonial/', $image);
                $image = 'public/uploads/testimonial/' . $image;
                $testimonial->image = $image;
            }

            $testimonial->status = $request->status;
            $testimonial->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.testimonials');
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
        }
    }

    public function testimonials_edit($id)
    {
        try {
            $data['testimonials'] = Testimonial::all();
            $edit = Testimonial::find($id);
            return view('frontendmanage::testimonials', compact('data', 'edit'));
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
        }
    }

    public function testimonials_delete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $testimonial = Testimonial::find($id);
            $testimonial->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.testimonials');
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
        }
    }


    public function sectionSetting()
    {
        try {
            $data['frontends'] = FrontendSetting::whereNotIn('id', [1, 2])->latest()->get();
            return view('frontendmanage::sectionSetting', compact('data'));
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);

            Toastr::error($errorMessage, 'Failed');
            return redirect()->back();
        }
    }


    public function sectionSettingEdit($id)
    {
        try {
            $edit = FrontendSetting::find($id);
            $data['frontends'] = FrontendSetting::whereNotIn('id', [1, 2])->latest()->get();
            return view('frontendmanage::sectionSetting', compact('data', 'edit'));
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);

            Toastr::error($errorMessage, 'Failed');
            return redirect()->back();
        }
    }

    public function sectionSetting_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        try {
            $frontend = FrontendSetting::find($request->id);
            $frontend->title = $request->title;
            $frontend->description = $request->description;
            $frontend->btn_name = $request->btn_name;
            $frontend->btn_link = $request->btn_link;
            if ($request->icon) {
                $frontend->icon = $request->icon;
            }
            $frontend->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.sectionSetting');

        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);

            Toastr::error($errorMessage, 'Failed');
            return redirect()->back();
        }
    }

    public function socialSetting()
    {
        try {
            $data['social_links'] = SocialLink::latest()->get();
            return view('frontendmanage::socialSetting', compact('data'));
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);

            Toastr::error($errorMessage, 'Failed');
            return redirect()->back();
        }
    }

    public function socialSettingEdit($id)
    {
        try {
            $data['social_links'] = SocialLink::latest()->get();
            $edit = SocialLink::find($id);
            return view('frontendmanage::socialSetting', compact('data', 'edit'));
        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function socialSettingDelete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {

            $delete = SocialLink::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect('frontend/social-setting');
        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function AboutPage()
    {
        $about = AboutPage::first();
        return view('frontendmanage::about', compact('about'));
    }

    public function saveAboutPage(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $about = AboutPage::firstOrNew(array('id' => 1));

            $about->who_we_are = $request->who_we_are;
            $about->banner_title = $request->banner_title;
            $about->story_title = $request->story_title;
            $about->story_description = $request->story_description;
            $about->teacher_title = $request->teacher_title;
            $about->teacher_details = $request->teacher_details;
            $about->course_title = $request->course_title;
            $about->course_details = $request->course_details;
            $about->student_title = $request->student_title;
            $about->student_details = $request->student_details;


            if ($request->image1 != null) {

                if ($request->file('image1')->extension() == "svg") {
                    $file1 = $request->file('image1');
                    $fileName1 = md5(rand(0, 9999) . '_' . time()) . '.' . $file1->clientExtension();
                    $url1 = 'public/uploads/settings/' . $fileName1;
                    $file1->move(public_path('uploads/settings'), $fileName1);

                } else {
                    $url1 = $this->saveImage($request->image1);
                }

                $about->image1 = $url1;
            }

            if ($request->image2 != null) {

                if ($request->file('image2')->extension() == "svg") {
                    $file2 = $request->file('image2');
                    $fileName2 = md5(rand(0, 9999) . '_' . time()) . '.' . $file2->clientExtension();
                    $url2 = 'public/uploads/settings/' . $fileName2;
                    $file2->move(public_path('uploads/settings'), $fileName2);

                } else {
                    $url2 = $this->saveImage($request->image2);
                }

                $about->image2 = $url2;
            }


            if ($request->image3 != null) {

                if ($request->file('image3')->extension() == "svg") {
                    $file3 = $request->file('image3');
                    $fileName3 = md5(rand(0, 9999) . '_' . time()) . '.' . $file3->clientExtension();
                    $url3 = 'public/uploads/settings/' . $fileName3;
                    $file3->move(public_path('uploads/settings'), $fileName3);

                } else {
                    $url3 = $this->saveImage($request->image3);
                }

                $about->image3 = $url3;
            }

            if ($request->image4 != null) {

                if ($request->file('image4')->extension() == "svg") {
                    $file4 = $request->file('image4');
                    $fileName4 = md5(rand(0, 9999) . '_' . time()) . '.' . $file4->clientExtension();
                    $url4 = 'public/uploads/settings/' . $fileName4;
                    $file4->move(public_path('uploads/settings'), $fileName4);

                } else {
                    $url4 = $this->saveImage($request->image4);
                }

                $about->image4 = $url4;
            }

            $about->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function socialSettingSave(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        // return $request;

        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'btn_link' => 'required',
            'status' => 'required',
        ]);
        try {
            $social_link = new SocialLink();
            $social_link->icon = $request->icon;
            $social_link->name = $request->name;
            $social_link->link = $request->btn_link;
            $social_link->status = $request->status;
            $social_link->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function socialSettingUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'btn_link' => 'required',
            'status' => 'required',
        ]);
        try {
            $social_link = SocialLink::find($request->id);
            $social_link->icon = $request->icon;
            $social_link->name = $request->name;
            $social_link->link = $request->btn_link;
            $social_link->status = $request->status;
            $social_link->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect('frontend/social-setting');

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function subscriber()
    {
        $subscribers = Subscription::latest()->get();

        return view('frontendmanage::subscriber', compact('subscribers'));
    }

    public function subscriberDelete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $data = Subscription::find($id);
            $data->delete();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
