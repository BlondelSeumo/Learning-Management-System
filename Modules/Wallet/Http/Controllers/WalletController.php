<?php

namespace Modules\Wallet\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Entities\Checkout;
use Modules\Subscription\Entities\SubscriptionCart;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('wallet::index');
    }

    public function payment($request)
    {


        try {

            $user = Auth::user();
            $checkout = Checkout::where('id', $request->id)->where('tracking', $request->tracking_id)->first();

            if ($user->balance < $checkout->purchase_price) {

                $response['type'] = 'error';
                $response['message'] = 'Insufficient balance';
                return $response;
            } else {
                $newBal = ($user->balance - $checkout->purchase_price);
                $user->balance = $newBal;
                $user->save();

                $response['type'] = 'success';
                $response['response'] = [];
                return $response;
            }


        } catch (Exception $e) {
            DB::rollBack();
            $response['type'] = 'error';
            $response['message'] = 'Operation Failed!';
            return $response;

        }
    }


    public function subscription($request)
    {


        try {

            $user = Auth::user();
            $plan = SubscriptionCart::where('user_id', $user->id)->first();


            if ($user->balance < $plan->price) {

                $response['type'] = 'error';
                $response['message'] = 'Insufficient balance';
                return $response;
            } else {
                $newBal = ($user->balance - $plan->price);
                $user->balance = $newBal;
                $user->save();

                $response['type'] = 'success';
                $response['response'] = [];
                return $response;
            }


        } catch (Exception $e) {
            DB::rollBack();
            $response['type'] = 'error';
            $response['message'] = 'Operation Failed!';
            return $response;

        }
    }

}
