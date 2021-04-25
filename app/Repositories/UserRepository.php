<?php

namespace App\Repositories;


use App\User;
use App\Traits\ImageStore;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Model\BusinessSetting;
use Modules\Coupons\Entities\UserWiseCoupon;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserRepository implements  UserRepositoryInterface
{
    use ImageStore;



    public function create(array $data)
    {
        $user = User::create($data);

        $user->referral=Str::random(10);
        $user->save();

        if (session::get('referral')!=null) {
            $invited_by=User::where('referral',session::get('referral'))->first();
            $user_coupon=new UserWiseCoupon();
            $user_coupon->invite_by=$invited_by->id;
            $user_coupon->invite_accept_by=$user->id;
            $user_coupon->invite_code=session::get('referral');
            $user_coupon->save();
        }



        if(BusinessSetting::where('type', 'email_verification')->first()->status != 1){
            $user->email_verified_at = date('Y-m-d H:m:s');
            $user->save();
        }
        else {
            $user->sendEmailVerificationNotification();
        }


        return $user;
    }

    public function store(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->role_id = $data['role_id'];
        if (isset($data['photo'])) {
            $data = Arr::add($data, 'avatar', $this->saveAvatar($data['photo']));
            $user->image = $data['avatar'];
        }
        $user->password = Hash::make($data['password']);
        if(BusinessSetting::where('type', 'email_verification')->first()->status != 1){
            $user->email_verified_at = date('Y-m-d H:m:s');
            $user->save();
        }
        else {
            $user->sendEmailVerificationNotification();
        }
        return $user;
    }



    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        if (Hash::check($data['password'], Auth::user()->password)) {
            if (isset($data['photo'])) {
                $data = Arr::add($data, 'avatar', $this->saveAvatar($data['photo']));
                $user->image = $data['avatar'];
            }
            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->role_id = $data['role_id'];
            $user->password = Hash::make($data['password']);
            if($user->save()){
                $staff = $user->staff;
                $staff->user_id = $user->id;
                $staff->department_id = $data['department_id'];
                $staff->employee_id = $data['employee_id'];
                $staff->showroom_id = $data['showroom_id'];
                // $staff->warehouse_id = $data['warehouse_id'];
                $staff->phone = $data['phone'];
                if($staff->save()){
                    if(BusinessSetting::where('type', 'email_verification')->first()->status != 1){
                        $user->email_verified_at = date('Y-m-d H:m:s');
                        $user->save();
                    }
                    else {
                        $user->sendEmailVerificationNotification();
                    }
                }
                return $user;
            }
        }
    }

 


}
