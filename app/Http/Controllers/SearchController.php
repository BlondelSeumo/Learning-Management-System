<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\RolePermission\Entities\Permission;

class SearchController extends Controller
{
    function search(Request $r)
    {

        try {
            if ($r->ajax()) {
                $output = '';
                $query = $r->get('search');
                if ($query != '') {
                    if (Auth::user()->role_id == 1) {
                        $data = Permission::where('name', 'LIKE', '%' . $query . '%')
                            ->orderBy('id', 'desc')
                            ->where(function ($query){
                                $query->where('route', 'NOT LIKE', '%destroy%')->orWhere('route', 'NOT LIKE', '%edit%')->orWhere('route', 'NOT LIKE', '%update%')
                                    ->where('route','NOT LIKE','%status%')->where('route','NOT LIKE','%view%')->where('route','NOT LIKE','%delete%')->where('route','NOT LIKE','%history%');
                            })->get();
                        if (count($data) > 0) {
                            foreach ($data as $row) {
                                if (Route::has($row->route))
                                    $output .= '<a href="' . route($row->route) . '"> ' . $row->name . ' </a>';
                            }
                        }
                        else
                        {
                            $no_result = trans('dashboard.No Results Found');
                            $output .= "<a href='#'>$no_result</a>";
                        }

                        return $output;
                    } else {
                        $data = DB::table('permissions')
                            ->join('role_permission', 'permissions.id', '=', 'role_permission.permission_id')
                            ->where('name', 'like', '%' . $query . '%')
                            ->where(function ($query){
                                $query->where('route', 'NOT LIKE', '%destroy%')->orWhere('route', 'NOT LIKE', '%edit%')->orWhere('route', 'NOT LIKE', '%update%')
                                    ->where('route','NOT LIKE','%status%')->where('route','NOT LIKE','%view%')->where('route','NOT LIKE','%delete%')->where('route','NOT LIKE','%history%');
                            })->where('role_id', Auth::user()->role_id)
                            ->orderBy('id', 'desc')
                            ->get();
                        if (count($data) > 0) {
                            foreach ($data as $row) {
                                if (Route::has($row->route))
                                    $output .= '<a href="' . route($row->route) . '"> ' . $row->name . ' </a>';
                            }
                        }
                        else
                        {
                            $no_result = trans('dashboard.No Results Found');
                            $output = "<a href='#'>$no_result</a>";
                        }
                        return $output;
                    }
                } else {
                    return response()->json(['not found' => 'Not Found'], 404);

                }

            }
        } catch (\Exception $e) {

        }
    }
}
