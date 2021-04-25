@extends('backend.master')
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div  class="row justify-content-center">
   <div  class="col-md-10 col-xl-6">
      <div  class="payment_methord">
         <h3 >Payout Method</h3>
         <div  class="payment_mathord_content">
            <div  id="myTab" role="tablist" class="nav nav-tabs payment_methord_logo">
                <a  data-toggle="tab" href="#paypal" role="tab" class="nav-link single_logo_iner active" aria-selected="true">
                    <img  src="{{asset('/public/')}}/uploads/payout/pay_1.png" alt="#">
                </a>
                    <a data-toggle="tab" href="#profile" role="tab" class="nav-link single_logo_iner" aria-selected="false">
                        <img  src="{{asset('/public/')}}/uploads/payout/pay_4.png" alt="#">
                    </a>
                    <a  data-toggle="tab" href="#swift" role="tab" class="nav-link single_logo_iner" aria-selected="false">
                            <img  src="{{asset('/public/')}}/uploads/payout/stripe.png" alt="#">
                    </a>
                </div>
            <div  id="myTabContent" class="tab-content">
               <div  id="paypal" role="tabpanel" class="tab-pane fade active show">
                  <form  role="form" method="post" action="{{route('save.userPayoutInfo')}}">
                  @csrf
                     <h4 >Get Payment with your PayPal Account</h4>
                     <p >Get your month end revenue by choosing paypal payment gateway </p>
                     <div  class="form_group"><label  for="email_address"></label> <input  type="email" id="email_address" name="paypal_email" placeholder="Email Address"></div>
                     <button  type="submit" class="btn_1">Make Default With Paypal</button>
                  </form>
               </div>
               <div  id="profile" role="tabpanel" class="tab-pane fade">
                  <form  role="form" method="post" action="{{route('save.userPayoutInfo')}}">
                  @csrf
                     <h4 >Get Payment with your PayTm </h4>
                     <p >Get your month end revenue by choosing PayTm payment gateway </p>
                     <div  class="form_group"><label  for="email_address">Set paypal email address</label> <input  type="email" id="email_address" name="paytmEmail" placeholder="Email Address"></div>
                     <button  type="submit" class="btn_1">Make Default With PayTm</button>
                  </form>
               </div>
               <div  id="swift" role="tabpanel" class="tab-pane fade">
                  <form  role="form" method="post" action="{{route('save.userPayoutInfo')}}">
                  @csrf
                     <h4 >Get Payment with your Stripe </h4>
                     <p >Get your month end revenue by choosing Stripe payment gateway </p>
                     <div  class="form_group"><label  for="email_address">Set stripe email address</label> <input  type="email" id="email_address" name="stripeEmail" placeholder="Email Address"></div>
                     <button  type="submit" class="btn_1">Make Default With Stripe</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
    </div>
</section>

@endsection
