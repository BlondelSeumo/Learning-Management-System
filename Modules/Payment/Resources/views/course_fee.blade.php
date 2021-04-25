@extends('backend.master')

@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30" >Settings</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- myTab  -->
                                    <div class="white_box_30px mb_30">
                                        <ul class="nav custom_nav" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="General-tab" data-toggle="tab" href="#General" role="tab" aria-controls="home" aria-selected="true">Flat Commission</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="Company_Information-tab" data-toggle="tab" href="#Company_Information" role="tab" aria-controls="Company_Information" aria-selected="false">Specific Instructor Commission</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="SMTP-tab" data-toggle="tab" href="#SMTP" role="tab" aria-controls="contact" aria-selected="false">Specific Course Commission</a>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <!-- tab-content  -->
                                    <div class="tab-content " id="myTabContent">
                                        <!-- General -->
                                       @include('payment::page_components.flat_commission')
                                    </div>

                                        <!-- Company_Information  -->
                                        <div class="tab-pane fade white_box_30px" id="Company_Information" role="tabpanel" aria-labelledby="Company_Information-tab">
                                            @include('payment::page_components.instractor_commission')
                                        </div>

                                        <!-- SMTP  -->
                                        <div class="tab-pane fade white_box_30px" id="SMTP" role="tabpanel" aria-labelledby="SMTP-tab">
                                                @include('payment::page_components.course_commission')
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


{{-- @include('frontend.partials.footer_content') --}}
</section>
<!-- main content part end -->
@endsection
