<?php

namespace Modules\OfflinePayment\Http\Controllers;

use App\DepositRecord;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OfflinePayment\Entities\OfflinePayment;

class OfflinePaymentController extends Controller
{

    public function offlinePaymentView()
    {
        $instructor = User::with('offlinePayments', 'currency')->where('role_id', 2)->get();
        $student = User::with('offlinePayments', 'currency')->where('role_id', 3)->get();
        return view('offlinepayment::fund.add_fund', compact('student', 'instructor'));
    }

    public function FundHistory($id)
    {

        try {
            $user = User::with('currency')->where('id', $id)->first();
            $payments = OfflinePayment::latest()->where('user_id', $id)->with('user.role')->get();

            return view('offlinepayment::fund.funding_history', compact('payments', 'user'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function addBalance(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'amount' => 'required',
        ]);

        try {

            $user = User::where('id', $request->user_id)->first();
            $tran = new OfflinePayment();
            $new = $user->balance + $request->amount;
            $tran->user_id = $user->id;
            $tran->role_id = $user->role_id;
            $tran->amount = $request->amount;
            $tran->status = 1;
            $tran->after_bal = $new;
            $tran->save();
            $user->balance = $new;
            $user->save();

            $depositRecord = new DepositRecord();
            $depositRecord->user_id = $user->id;
            $depositRecord->method = 'Offline Payment';
            $depositRecord->amount = $request->amount;
            $depositRecord->save();
            if ($user->role_id == 3) {
                $isStudent = true;
            } else {
                $isStudent = false;
            }

            send_email($user, $type = 'OffLine_Payment', $shortcodes = [
                'amount' => $request->amount,
                'currency' => getSetting()->currency->code,
                'time' => now(),
            ]);

            Toastr::success('Fund Added !', 'Success');
            return back()->with('isStudent', $isStudent);
        } catch (\Exception $e) {
            dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return back();
        }

    }


    public function index()
    {
        return view('offlinepayment::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('offlinepayment::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('offlinepayment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('offlinepayment::edit');
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
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
