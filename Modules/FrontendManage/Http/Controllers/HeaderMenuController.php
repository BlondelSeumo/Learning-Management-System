<?php

namespace Modules\FrontendManage\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\FrontendManage\Entities\FrontPage;
use Modules\FrontendManage\Entities\HeaderMenu;

class HeaderMenuController extends Controller
{

    public function index()
    {

        try {
            $pages = FrontPage::where('is_static', 0)->get();
            $static_pages = FrontPage::where('is_static', 1)->get();
            $courses = Course::whereType(1)->whereStatus('1')->get();
            $quizzes = Course::whereType(2)->whereStatus('1')->get();
            $classes = Course::whereType(3)->whereStatus('1')->get();
            $categories = Category::whereStatus('1')->get();
            $subCategories = SubCategory::whereStatus('1')->get();
            $menus = HeaderMenu::where('parent_id', NULL)->orderBy('position')->get();

            return view('frontendmanage::headermenu.index', compact('pages', 'static_pages',
                'courses', 'quizzes', 'classes', 'categories', 'subCategories', 'menus'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function addElement(Request $request)
    {
        try {
            if ($request->type == "Dynamic Page") {

                foreach ($request->element_id as $data) {
                    $dpage = FrontPage::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $dpage->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => \route('frontPage', [$dpage->id, $dpage->slug]),
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Static Page") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $spage = FrontPage::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $spage->title,
                        'type' => $request->type,
                        'link' => url($spage->slug),
                        'element_id' => $data,
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Category") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $item = Category::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $item->name,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => route('courses') . "?category=" . $data,
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Sub Category") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $item = SubCategory::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $item->name,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => route('courses') . "?category=" . $item->category_id,
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Course") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $item = Course::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $item->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => route('courseDetailsView', [$item->id, $item->slug]),
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Quiz") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $item = Course::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $item->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => route('quizDetailsView', [$item->id, $item->slug]),

                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Class") {
//                $data = $request->element_id;
                foreach ($request->element_id as $data) {
                    $item = Course::findOrFail($data);
                    HeaderMenu::create([
                        'title' => $item->title,
                        'type' => $request->type,
                        'element_id' => $data,
                        'link' => route('classDetails', [$item->id, $item->slug]),
                        'position' => 387437
                    ]);
                }
            } elseif ($request->type == "Custom Link") {
                HeaderMenu::create([
                    'title' => $request->title,
                    'link' => $request->link,
                    'type' => $request->type,
                    'position' => 387437
                ]);
            }
            return $this->reloadWithData();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return $this->reloadWithData();
        }
    }

    public function reordering(Request $request)
    {
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder, null);
        return true;
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $item) {

            $menuItem = HeaderMenu::findOrFail($item->id);
            $menuItem->update([
                'position' => $index + 1,
                'parent_id' => $parentId
            ]);
            if (isset($item->children)) {
                $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }

    public function deleteElement(Request $request)
    {
        try {
            $element = HeaderMenu::find($request->id);
            if (count($element->childs) > 0) {
                foreach ($element->childs as $child) {
                    $child->update(['parent_id' => $element->parent_id]);
                }
            }
            $element->delete();
            return $this->reloadWithData();
        } catch (\Exception $e) {
            return response('error');
        }
    }

    private function reloadWithData()
    {

        $pages = FrontPage::where('is_static', 0)->get();
        $static_pages = FrontPage::where('is_static', 1)->get();
        $courses = Course::whereType(1)->whereStatus('1')->get();
        $quizzes = Course::whereType(2)->whereStatus('1')->get();
        $classes = Course::whereType(3)->whereStatus('1')->get();
        $categories = Category::whereStatus('1')->get();
        $subCategories = SubCategory::whereStatus('1')->get();
        $menus = HeaderMenu::where('parent_id', NULL)->orderBy('position')->get();

        return view('frontendmanage::headermenu.submenu_list', compact('pages', 'static_pages',
            'courses', 'quizzes', 'classes', 'categories', 'subCategories', 'menus'));


    }

    public function editElement(Request $request)
    {
        $menu = HeaderMenu::find($request->get('id'));
        if ($menu) {
            $menu->title = $request->title;
            $menu->link = $request->link;
            $menu->link = $request->link;
            $menu->show = $request->from_bank_name;
            if (!isset($request->is_newtab)) {
                $menu->is_newtab = 0;
            } else {
                $menu->is_newtab = $request->is_newtab;
            }
            $menu->save();
        }
        return $this->reloadWithData();
    }
}
