<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(3);
            $table->string('name');
            $table->string('photo')->nullable()->default('public/demo/user/' . 'admin.jpg');
            $table->string('image')->nullable()->default('public/demo/user/' . 'admin.jpg');
            $table->string('avatar')->nullable()->default('public/demo/user/' . 'admin.jpg');
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('notification_preference')->default('mail');
            $table->boolean('is_active')->default(TRUE);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('email_verify')->default(0);
            $table->string('password');
            $table->string('headline')->nullable();
            $table->string('phone', 100)->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('city')->nullable()->default(1374);
            $table->string('country')->nullable()->default(19);
            $table->string('zip')->nullable();
            $table->string('dob')->nullable();
            $table->longText('about')->nullable();
            $table->longText('short_details')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('subscribe')->default(0);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('language_id')->default(19);
            $table->string('language_code')->default('en');
            $table->string('language_name')->default('English');
            $table->boolean('status')->default(1);
            $table->float('balance')->default(0.00);
            $table->unsignedInteger('currency_id')->default(112);
            $table->integer('special_commission')->default(1);
            $table->string('payout')->default('PayPal');
            $table->string('payout_icon')->default('public/uploads/payout/pay_1.png');
            $table->string('payout_email')->default('demo@paypal.com');
            $table->string('referral', 10)->nullable()->unique();
            $table->boolean('added_by')->default(0);
            $table->string('zoom_api_key_of_user')->nullable();
            $table->string('zoom_api_serect_of_user')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        $data = User::find(1);

        if (empty($data)) {
            $user = new User();
            $user->role_id = 1;
            $user->name = 'Admin';
            $user->email = 'support@spondonit.com';
            $user->username = 'support@spondonit.com';
            $user->phone = '01711223344';
            $user->headline = 'Administrator';
            $user->about = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
            $user->short_details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
            $user->email_verified_at = now();
            $user->password = Hash::make('12345678');
            $user->created_at = date('Y-m-d h:i:s');
            $user->referral = Str::random(10);
            $user->zoom_api_key_of_user = 'tLo47ogGRw-0v9RzbTUVew';
            $user->zoom_api_serect_of_user = 'EAo9SnJmYmewJ4dNSdv4yKptoffqPXndGvY0';
            $user->save();


        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
