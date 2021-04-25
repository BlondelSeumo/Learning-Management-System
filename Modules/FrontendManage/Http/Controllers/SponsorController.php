<?php

namespace Modules\FrontendManage\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\FrontendManage\Entities\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        try {
            $sponsors = Sponsor::all();
            return view('frontendmanage::sponsors', compact('sponsors'));
        } catch (Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    public function create()
    {
        return view('frontendmanage::create');
    }

    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required|unique:sponsors,title',
            'image' => 'required',
        ]);

        try {
            $sponsor = new Sponsor();
            $sponsor->title = $request->title;
            if ($request->file('image') != "") {
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $img->resize(100 * 100);
                $upload_path = 'public/uploads/sponsor/';
                $img->save($upload_path . $name);
                $sponsor->image = 'public/uploads/sponsor/' . $name;
            }
            $sponsor->save();
            Toastr::success(trans('sponsor.Sponsor Saved Successfully'));
            return back();
        } catch (Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'), trans('common.Success'));
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontendmanage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $sponsors = Sponsor::all();
            $sponsor = Sponsor::find($id);
            return view('frontendmanage::sponsors', compact('sponsors', 'sponsor'));
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required|unique:sponsors,title,' . $request->id,
        ]);

        try {
            $sponsor = Sponsor::find($request->id);
            $sponsor->title = $request->title;
            if ($request->file('image') != "") {
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $img->resize(100 * 100);
                $upload_path = 'public/uploads/sponsor/';
                $img->save($upload_path . $name);
                $sponsor->image = 'public/uploads/sponsor/' . $name;
            }
            $sponsor->save();
            Toastr::success(trans('sponsor.Sponsor Updated Successfully'));
            return redirect()->route('frontend.sponsors.index');
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            Sponsor::destroy($id);
            Toastr::success(trans('sponsor.Sponsor Deleted Successfully'));
            return redirect()->route('frontend.sponsors.index');
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }
}
