<?php

namespace Modules\FrontendManage\Http\Controllers;

use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\FrontendManage\Entities\FrontPage;

class FrontPageController extends Controller
{
    use ImageStore;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $data['frontPages'] = FrontPage::where('is_static','=','0')->latest()->get();
        return view('frontendmanage::front_page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontendmanage::front_page.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'details' => 'required',
        ]);

        try {

            $data = [
                'name' => $request->title,
                'title' => $request->title,
                'slug' => $this->createSlug(empty($request->slug) ? $request->title : $request->slug),
                'sub_title' => $request->sub_title,
                'details' => $request->details,
                'is_static' => 0,
            ];
            $frontpage = FrontPage::create($data);

            if ($request->banner != null) {

                if ($request->file('banner')->extension() == "svg") {
                    $file = $request->file('banner');
                    $fileName = md5(rand(0, 9999) . '_' . time()) . '.' . $file->clientExtension();
                    $url1 = 'public/uploads/settings/' . $fileName;
                    $file->move(public_path('uploads/settings'), $fileName);
                } else {
                    $url1 = $this->saveImage($request->banner);
                }
                $frontpage->banner = $url1;
                $frontpage->is_static = 0;
                $frontpage->save();
            }

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.page.index');
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), 'Error');
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
        return view('frontendmanage::front_page.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['editData'] = FrontPage::findOrFail($id);
        return view('frontendmanage::front_page.create', $data);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $page = FrontPage::findOrFail($id);
        try {
            $request->validate([
                'title' => 'required',
            ]);


            $page->name = $request->title;
            $page->title = $request->title;
            $page->slug = $this->createSlug(empty($request->slug) ? $request->title : $request->slug);

            $page->sub_title = $request->sub_title;
            $page->details = $request->details;
            $page->is_static = 0;


            if ($request->banner != null) {

                if ($request->file('banner')->extension() == "svg") {
                    $file = $request->file('banner');
                    $fileName = md5(rand(0, 9999) . '_' . time()) . '.' . $file->clientExtension();
                    $url1 = 'public/uploads/settings/' . $fileName;
                    $file->move(public_path('uploads/settings'), $fileName);
                } else {
                    $url1 = $this->saveImage($request->banner);
                }
                $page->banner = $url1;
            }

            $page->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->route('frontend.page.index');
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), 'Error');
            return redirect()->back();
        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            FrontPage::where('id', $id)->delete();
            Toastr::success('Operation done successfully.', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    protected function createSlug(string $title): string
    {

        $slugsFound = $this->getSlugs($title);

        $counter = 0;
        $counter += $slugsFound;

        $slug = Str::slug($title) == "" ? str_replace(' ', '-', $title) : Str::slug($title);


        if ($counter) {
            $slug = $slug . '-' . $counter;
        }
        return $slug;
    }


    protected function getSlugs($title): int
    {
        return FrontPage::select()->where('title', 'like', $title)->count();
    }
}
