<?php

namespace Modules\FooterSetting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\FooterSetting\Http\Requests\FooterWidgetRequest;
use Modules\FooterSetting\Services\FooterSettingService;
use Modules\FooterSetting\Services\FooterWidgetService;
use Modules\FrontendManage\Entities\FrontPage;

class FooterSettingController extends Controller
{
    protected $footerService;
//    protected $staticPageService;
    protected $widgetService;

    public function __construct(FooterSettingService $footerService, FooterWidgetService $widgetService)
    {
        $this->footerService = $footerService;
//        $this->staticPageService = $staticPageService;
        $this->widgetService = $widgetService;
    }

    public function index()
    {
        // $SectionOnePages  = $this->widgetService->getAllCompany();
        // return $SectionOnePages;

        try {
            $FooterContent = $this->footerService->getAll();
            $staticPageList = FrontPage::where('status', 1)->get();
            $SectionOnePages = $this->widgetService->getAllCompany();
            $SectionTwoPages = $this->widgetService->getAllAccount();
            $SectionThreePages = $this->widgetService->getAllService();
            return view('footersetting::footer.index', compact('FooterContent', 'staticPageList', 'SectionOnePages', 'SectionTwoPages', 'SectionThreePages'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function widgetStore(FooterWidgetRequest $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $page = FrontPage::where('slug', $request->page)->first();


            $str = strtolower($request->name);

            if ($page) {
                $request->merge(['slug' => $page->slug]);
                $request->merge(['page_id' => $page->id]);
                $request->merge(['is_static' => $page->is_static]);
                $request->merge(['description' => $page->details]);


            } else {
                Toastr::error('Something went wrong', 'Error');
                return redirect()->back();
            }

            $this->widgetService->save($request->except('_token'));

            $notification = array(
                'messege' => 'Page Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function widgetStatus(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $data = [
                'status' => $request->status == 1 ? 0 : 1
            ];
            return $this->widgetService->statusUpdate($data, $request->id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function widgetUpdate(FooterWidgetRequest $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {

            $page = FrontPage::where('slug', $request->page)->first();


            $str = strtolower($request->name);

            if ($page) {
                $request->merge(['slug' => $page->slug]);
                $request->merge(['page_id' => $page->id]);
                $request->merge(['is_static' => $page->is_static]);
                $request->merge(['description' => $page->details]);


            } else {
                Toastr::error('Something went wrong', 'Error');
                return redirect()->back();
                /*  $slug = preg_replace('/\s+/', '-', $str);
                  $request->merge(['slug' => $slug]);*/
            }
            $request->merge(['user_id' => Auth::user()->id]);


            $this->widgetService->update($request->except('_token'), $request->id);

            $notification = array(
                'messege' => 'Page Updated Successfully.',
                'alert-type' => 'success'
            );
            Toastr::success('Saved Successfully');
            return redirect()->back()->with($notification);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function contentUpdate(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            return $this->footerService->update($request->except('_token'), $request->id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $this->widgetService->delete($id);
            $notification = array(
                'messege' => 'Page Deleted Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function tabSelect($id)
    {
        Session::put('footer_tab', $id);
        return 'done';
    }
}
