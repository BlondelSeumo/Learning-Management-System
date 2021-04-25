<?php

namespace Modules\StudentSetting\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Modules\StudentSetting\Entities\BookmarkCourse;
use Modules\SystemSetting\Entities\GeneralSettings;


class BookmarkController extends Controller
{


    public function bookmarkSave($id)
    {
        try {
            $bookmarked = BookmarkCourse::where('user_id', Auth::id())->where('course_id', $id)->first();
            if (empty($bookmarked)) {
                $bookmark = new BookmarkCourse;
                $bookmark->user_id = Auth::id();
                $bookmark->course_id = $id;
                $bookmark->date = date("jS F Y");
                $bookmark->save();

                Toastr::success('Bookmark Added Successfully', 'Success');
            } else {
                $bookmarked->delete();
                Toastr::success('Bookmark Remove Successfully', 'Success');

            }

            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update($lesson_id, $chapter_id, $course_id)
    {


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function bookmarksDelete($id)
    {


    }
}
