<?php

namespace Modules\Blog\Http\Controllers;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\Blog\Entities\Blog;


class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {

        try {
            $user = Auth::user();
            $query = Blog::with('user');
            if ($user->role_id != 1) {
                $query->where('user_id', $user->id);
            }

            $blogs = $query->latest()->get();

            return view('blog::index', compact('blogs'));

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        //return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'description' => 'required',
            'image' => 'required',
        ]);
        try {
            $blog = new Blog;
            $blog->title = $request->title;
            $blog->slug = $request->slug ? $request->slug : (Str::slug($request->title) == "" ? str_replace(' ','-',$request->title) : Str::slug($request->title));
            $blog->description = $request->description;
            $blog->user_id = Auth::id();
            $blog->authored_date = date("F j, Y");

            if ($request->image) {

                $strpos = strpos($request->image, ';');
                $sub = substr($request->image, 0, $strpos);
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/blogs/';
                $img->save($upload_path . $name);
                $blog->image = 'public/uploads/blogs/' . $name;

                $strpos = strpos($request->image, ';');
                $sub = substr($request->image, 0, $strpos);
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/blogs/';
                $img->save($upload_path . $name);
                $blog->thumbnail = 'public/uploads/blogs/' . $name;


            }
            $blog->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $request->validate([
            'title' => 'required|unique:blogs,title,' . $request->id,
            'description' => 'required',
            'id' => 'required',

        ]);


        try {
            if (appMode()) {
                Toastr::success('In demo version you cant not change this!', 'Success');
                return redirect()->back();

            }

            $blog = Blog::findOrFail($request->id);
            $blog->title = $request->title;
            $blog->slug = $request->slug ? $request->slug : (Str::slug($request->title) == "" ? str_replace(' ','-',$request->title) : Str::slug($request->title));
            $blog->description = $request->description;
            $blog->user_id = Auth::id();
            $blog->authored_date = date("F j, Y");


            if ($request->image) {


                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/blogs/';
                $img->save($upload_path . $name);
                $blog->image = 'public/uploads/blogs/' . $name;


                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $upload_path = 'public/uploads/blogs/';
                $img->save($upload_path . $name);
                $blog->thumbnail = 'public/uploads/blogs/' . $name;


            }


            $blog->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'id' => 'required',
        ]);
        try {
            $blog = Blog::findOrFail($request->id);
            $blog->delete();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }
}
