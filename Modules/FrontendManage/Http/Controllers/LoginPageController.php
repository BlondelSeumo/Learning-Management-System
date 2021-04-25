<?php

namespace Modules\FrontendManage\Http\Controllers;

use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FrontendManage\Entities\LoginPage;

class LoginPageController extends Controller
{
    use ImageStore;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page = LoginPage::first();
        return view('frontendmanage::loginpage', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $page = LoginPage::first();
        $page->title = $request->title;
        if ($request->banner != null) {

            if ($request->file('banner')->extension() == "svg") {
                $file = $request->file('banner');
                $fileName = md5(rand(0, 9999) . '_' . time()) . '.' . $file->clientExtension();
                $url = 'public/uploads/settings/' . $fileName;
                $file->move(public_path('uploads/settings'), $fileName);
            } else {
                $url = $this->saveImage($request->banner);
            }

            $page->banner = $url;
        }

        $page->slogans1 = $request->slogan1;
        $page->slogans2 = $request->slogan2;
        $page->slogans3 = $request->slogan3;
        $page->save();

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return redirect()->back();
    }


}
