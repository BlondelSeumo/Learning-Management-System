@extends('setting::layouts.master')

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30">Cron Job {{ __('setting.Settings') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        <div class="row">

                            <div class="col-lg-12">
                                <!-- tab-content  -->
                                <div class="tab-content " id="myTabContent">


                                <!-- SMS  -->
                                    <div class="tab-pane fade white_box_30px active show " id="SMS" role="tabpanel"
                                         aria-labelledby="SMS-tab">

                                        <input type="hidden" name="g_set" value="1">

                                        <div class="General_system_wrap_area d-block">
                                            <div class="single_system_wrap">
                                                <h5>To run cron jobs you should set this path in cPanel Cron Command field for email and Due Date Reminder.</h5>
                                                <div class="single_system_wrap_inner text-center">

                                                    <p>{{ 'cd ' . base_path() . '/ && php artisan schedule:run >> /dev/null 2>&1' }}</p>

                                                </div>
                                                <h6>In cPanel you should set time interval Once Per day (0 0 * * *).</h6>
                                            </div>

                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



