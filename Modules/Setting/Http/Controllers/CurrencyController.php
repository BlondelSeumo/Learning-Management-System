<?php

namespace Modules\Setting\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Modules\Setting\Model\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Setting\Repositories\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index()
    {
        $currencies = $this->currencyRepository->all();
        return view('setting::currencies.index', [
            "currencies" => $currencies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            $this->currencyRepository->create($request->except("_token"));
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $currency = $this->currencyRepository->update($request->except("_token"), $id);
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
        } catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $currency = $this->currencyRepository->delete($id);
            // return back()->with('message-success', __('setting.Currency has been deleted Successfully'));
            Toastr::success(__('setting.Currency has been deleted Successfully'), trans('common.Success'));
                    return redirect()->back();
        } catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }

    public function edit_modal(Request $request)
    {
        try {
            $currency = $this->currencyRepository->find($request->id);
            return view('setting::currencies.edit_modal', [
                "currency" => $currency
            ]);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }
}
