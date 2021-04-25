<?php

namespace Modules\Appearance\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AppearanceController extends Controller
{

    public function index()
    {
        return view('appearance::index');
    }


    public function create()
    {
        return view('appearance::create');
    }


    public function store(Request $request)
    {
        //
    }





    public function destroy($id)
    {
        //
    }
}
