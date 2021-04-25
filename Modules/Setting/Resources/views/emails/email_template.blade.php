@extends('backend.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0">{{__('setting.Footer Email Configuration')}} </h3>
                        </div>
                    </div>
                </div>


            </div>


            <!-- Billing_Shipping_Address  -->
            <div class="tab-pane fade show active" id="Billing_Shipping_Address" role="tabpanel"
                 aria-labelledby="Billing_Shipping_Address-tab">
                <div class="white_box_30px mb_30 box_shadow_white">
                    @if (permissionCheck('footerTemplateUpdate'))
                        <form action="{{route('footerTemplateUpdate')}}" method="post">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 mb_xs_15px">
                                    <div class="box_header">
                                        <div class="main-title d-md-flex">
                                            <h3 class="mb-0"> {{__('setting.Email Template')}} </h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label"
                                                       for="">{{__('setting.Email Body')}} </label>
                                                <textarea class='primary_textarea height_104 lms_summernote'
                                                          name="email_template"
                                                          placeholder="Email Description">{!!@$eTemplate->email_template!!}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="submit_button text-center">
                                <button class="primary-btn semi_large2  fix-gr-bg" data-toggle="tooltip"

                                        type="submit"><i
                                        class="ti-check"></i> {{__('common.Save')}} {{__('setting.Setup')}}
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>


@endsection
