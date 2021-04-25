<?php

namespace Modules\ImageGallery\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Modules\ImageGallery\Entities\ImageGallery;

class ImageGalleryController extends Controller
{

    public function saveImageIntoGallery($image, $height = null, $lenght = null)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        if (isset($image)) {

            $current_date = Carbon::now()->format('d-m-Y');

            if (!File::isDirectory('public/uploads/images/' . $current_date)) {
                File::makeDirectory('public/uploads/images/' . $current_date, 0777, true, true);
            }

            $image_extention = str_replace('image/', '', Image::make($image)->mime());

            if ($height != null && $lenght != null) {
                $img = Image::make($image)->resize($height, $lenght);
            } else {
                $img = Image::make($image);
            }

            $img_name = 'public/uploads/images/' . $current_date . '/' . uniqid() . '.' . $image_extention;
            $img->save($img_name);

            return $img_name;

        } else {

            return null;
        }

    }


    public function index()
    {
        $images = ImageGallery::get();
        return view('imagegallery::index', compact('images'));
    }


    public function edit($id)
    {
        $edit = ImageGallery::find($id);
        $images = ImageGallery::get();
        return view('imagegallery::index', compact('images', 'edit'));
    }


    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        try {
            $input['thumbnail'] = $this->saveImageIntoGallery($request->image, 370, 250);
            $input['image'] = $this->saveImageIntoGallery($request->image, null, null);
            $input['title'] = $request->title;
            $input['description'] = null;
            $input['status'] = $request->status;

            ImageGallery::create($input);
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('imagegallery.list');
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        try {
            DB::beginTransaction();
            $s = ImageGallery::find($request->id);
            $s->title = $request->title;
            $s->description = $request->description;
            $s->status = $request->status;
            if ($request->image != "") {
                $s->image = $this->saveImageIntoGallery($request->image);
            }
            $s->save();
            DB::commit();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('imagegallery.list');
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        ImageGallery::find($id)->delete();
        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return redirect()->route('imagegallery.list');
    }

}
