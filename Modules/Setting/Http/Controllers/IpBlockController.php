<?php

namespace Modules\Setting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Setting\Entities\IpBlock;

class IpBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $ips = IpBlock::latest()->get();
        return view('setting::ipBlock', compact('ips'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
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

        $validated = $request->validate([
            'ip_address' => 'required|ip|unique:ip_blocks'
        ]);

        $block = new IpBlock();
        $block->ip_address = $request->ip_address;
        $block->reason = $request->reason;
        $block->save();
        $this->storeInJsonFile();

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return redirect()->back();

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */


    public function destroy(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'id' => 'required'
        ]);

        try {
            $success = 'Unblock ip from system';

            $block = IpBlock::findOrFail($request->id);
            $block->delete();
            $this->storeInJsonFile();

            Toastr::success($success, 'Success');

            return redirect()->back();

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function storeInJsonFile()
    {
        $data = [];
        $rowData = IpBlock::select('ip_address')->get();
        foreach ($rowData as $single) {
            $data[] = $single['ip_address'];
        }
        Storage::disk()->put('ip.json', json_encode($data));

    }
}
