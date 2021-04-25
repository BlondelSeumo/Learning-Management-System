@extends('backend.master')

@section('mainContent')
    @php
        if(\Session::has('footer_tab')){
            $footerTab = \Session::get('footer_tab');
        }else{
            $footerTab = 1;
        }
    @endphp
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>{{__('footer.Footer Settings')}} </h1>
                <div class="bc-pages">
                    <a href="#">{{__('footer.Dashboard')}}</a>
                    <a href="#">{{__('footer.Frontend CMS')}}</a>
                    <a href="#">{{__('footer.Footer Settings')}} </a>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-40 student-details up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs no-bottom-border justify-content-end mt-sm-md-20 mb-30" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $footerTab == 1?'active':'' }} show" href="#copyrightText" role="tab"
                               data-toggle="tab" id="1" onclick="sectionControl(this.id)"
                               aria-selected="true">{{__('footer.Copyright Text')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $footerTab == 2?'active':'' }} show" href="#footer_1" role="tab"
                               data-toggle="tab" id="2" onclick="sectionControl(this.id)"
                               aria-selected="false">{{__('footer.About Text')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $footerTab == 3?'active':'' }} show" href="#footer_2" role="tab"
                               data-toggle="tab" id="3" onclick="sectionControl(this.id)"
                               aria-selected="false">{{$FooterContent->footer_section_one_title}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $footerTab == 4?'active':'' }} show" href="#footer_3" role="tab"
                               data-toggle="tab" id="4" onclick="sectionControl(this.id)"
                               aria-selected="true">{{$FooterContent->footer_section_two_title}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $footerTab == 5?'active':'' }} show" href="#footer_4" role="tab"
                               data-toggle="tab" id="5" onclick="sectionControl(this.id)"
                               aria-selected="true">{{$FooterContent->footer_section_three_title}}</a>
                        </li>

                    </ul>
                    <div class="col-lg-12">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade {{ $footerTab == 1?'active show':'' }} "
                                 id="copyrightText">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h3 class="mb-30">
                                            {{__('common.Update')}} </h3>
                                    </div>

                                    <form method="POST" action="" id="copyright_form" accept-charset="UTF-8"
                                          class="form-horizontal" enctype="multipart/form-data">
                                        <div class="white-box">
                                            <div class="add-visitor">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="primary_input mb-35">
                                                            <input type="hidden" name="id"
                                                                   value="{{$FooterContent->id}}">

                                                            <textarea required name="copy_right"
                                                                      placeholder="copy_right" class="lms_summernote"
                                                                      id="copy_right">{!! $FooterContent->footer_copy_right !!}</textarea>
                                                        </div>
                                                        <span class="text-danger" id="error_copy_right"></span>
                                                    </div>
                                                </div>

                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                         data-original-title="" title="">
                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper " type="submit"
                                                                id="copyrightBtn">
                                                            <span class="ti-check"></span>
                                                            {{__('common.Update')}} </button>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane {{ $footerTab == 2?'active show':'' }} fade"
                                 id="footer_1">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="col-lg-12">
                                            <div class="main-title">
                                                <h3 class="mb-30">
                                                    {{__('common.Update')}} </h3>
                                            </div>

                                            <form method="POST" action="" id="aboutForm"
                                                  accept-charset="UTF-8" class="form-horizontal"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="{{$FooterContent->id}}">
                                                <div class="white-box">
                                                    <div class="add-visitor">
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="input-effect">
                                                                    <input
                                                                        class="primary-input form-control read-only-input"
                                                                        type="text" name="about_title"
                                                                        autocomplete="off" required
                                                                        value="{{$FooterContent->footer_about_title}}">
                                                                    <label>{{__('footer.Section name')}}
                                                                        <span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">

                                                            <div class="col-lg-12 text-center tooltip-wrapper"
                                                                 data-title=""
                                                                 data-original-title="" title="">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper " type="submit"
                                                                        id="aboutSectionBtn"
                                                                        data-original-title="" title="">
                                                                    <span class="ti-check"></span>
                                                                    {{__('common.Update')}} </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mt-50">
                                        <form method="POST" action=""
                                              accept-charset="UTF-8" class="form-horizontal"
                                              enctype="multipart/form-data"
                                              id="aboutDescriptionForm">
                                            <input type="hidden" name="id" value="{{$FooterContent->id}}">
                                            <div class="white-box">
                                                <div class="row justify-content-center mb-30 mt-40">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                                            <textarea class="primary-input form-control read-only-input"
                                                                      name="about_description" required
                                                                      id="about_description">{!! $FooterContent->footer_about_description !!}</textarea>
                                                            <label>{{__('footer.About Description')}}<span>*</span>
                                                            </label>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-30">

                                                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                                                         data-original-title="" title="">
                                                        <button class="primary-btn fix-gr-bg tooltip-wrapper " type=""
                                                                id="aboutDescriptionBtn"
                                                                data-original-title="" title="">
                                                            <span class="ti-check"></span>
                                                            {{__('common.Update')}} </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                            @include('footersetting::footer.components.widget_create')

                            <div role="tabpanel" class="tab-pane {{ $footerTab == 3?'active show':'' }} fade"
                                 id="footer_2">
                                <div class="row">
                                    <div class="col-lg-3 mt-30">
                                        <div class="col-lg-12">
                                            <div class="main-title">
                                                <h3 class="mb-30">
                                                    {{__('common.Update')}}
                                                </h3>
                                            </div>
                                            <form method="POST" action=""
                                                  accept-charset="UTF-8" class="form-horizontal"
                                                  enctype="multipart/form-data"
                                                  id="companyForm">
                                                <input type="hidden" name="id" value="{{$FooterContent->id}}">
                                                <div class="white-box">
                                                    <div class="add-visitor">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <input
                                                                        class="primary-input form-control read-only-input"
                                                                        required
                                                                        type="text" name="company_title"
                                                                        autocomplete="off"
                                                                        value="{{$FooterContent->footer_section_one_title}}">
                                                                    <label>{{__('footer.Section name')}}
                                                                        <span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">

                                                            <div class="col-lg-12 text-center tooltip-wrapper"
                                                                 data-title=""
                                                                 data-original-title="" title="">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper "
                                                                        data-original-title="" title="" id="companyBtn">
                                                                    <span class="ti-check"></span>
                                                                    {{__('common.Update')}} </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mt-50">

                                        <a href="#" data-type="1"
                                           class="primary-btn addWidget small fix-gr-bg mb-2">{{__('footer.Add New Page')}}</a>

                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table">
                                                <!-- table-responsive -->
                                                <div class="">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">{{ __('common.SL') }}</th>
                                                            <th scope="col">{{ __('common.Name') }}</th>
                                                            <th scope="col">{{ __('common.Status') }}</th>
                                                            <th scope="col">{{ __('common.Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($SectionOnePages as $key => $page)
                                                            <tr>
                                                                <td>{{$key +1}}</td>
                                                                <td>{{$page->name}}</td>
                                                                <td>
                                                                    <label class="switch_toggle"
                                                                           for="active_checkbox{{@$page->id }}">
                                                                        <input type="checkbox"
                                                                               onchange="statusChange({{$page}})"
                                                                               class=""
                                                                               id="active_checkbox{{@$page->id }}"
                                                                               @if (@$page->status == 1) checked
                                                                               @endif value="{{@$page->id }}">
                                                                        <i class="slider round"></i>
                                                                    </label>
                                                                </td>
                                                                <td>

                                                                    <div class="dropdown CRM_dropdown">
                                                                        <button
                                                                            class="btn btn-secondary dropdown-toggle"
                                                                            type="button" id="dropdownMenu2"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ __('common.Select') }}
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right"
                                                                             aria-labelledby="dropdownMenu2">

                                                                            <a href="javascript:void(0)"
                                                                               data-toggle="modal"
                                                                               data-target="#editModal"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showEditModal({{$page}})">{{ __('common.Edit') }}</a>

                                                                            <a href="javascript:void(0)"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showDeleteModal({{$page->id}})">{{ __('common.Delete') }}</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane {{ $footerTab == 4?'active show':'' }} fade"
                                 id="footer_3">
                                <div class="row">
                                    <div class="col-lg-3 mt-30">
                                        <div class="col-lg-12">
                                            <div class="main-title">
                                                <h3 class="mb-30">
                                                    {{ __('common.Update') }} </h3>
                                            </div>
                                            <form method="POST" action=""
                                                  accept-charset="UTF-8" class="form-horizontal"
                                                  enctype="multipart/form-data"
                                                  id="accountForm">
                                                <input type="hidden" name="id" value="{{$FooterContent->id}}">
                                                <div class="white-box">
                                                    <div class="add-visitor">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <input
                                                                        class="primary-input form-control read-only-input"
                                                                        required
                                                                        type="text" name="account_title"
                                                                        autocomplete="off"
                                                                        value="{{$FooterContent->footer_section_two_title}}">
                                                                    <label>{{__('footer.Section name')}}
                                                                        <span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">

                                                            <div class="col-lg-12 text-center tooltip-wrapper"
                                                                 data-title=""
                                                                 data-original-title="" title="">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper "
                                                                        id="accountBtn">
                                                                    <span class="ti-check"></span>
                                                                    {{ __('common.Update') }} </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-9 mt-50">

                                        <a href="#" data-type="2"
                                           class="primary-btn addWidget small fix-gr-bg mb-2">{{__('footer.Add New Page')}}</a>
                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table">
                                                <!-- table-responsive -->
                                                <div class="">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">{{ __('common.SL') }}</th>
                                                            <th scope="col">{{ __('common.Name') }}</th>
                                                            <th scope="col">{{ __('common.Status') }}</th>
                                                            <th scope="col">{{ __('common.Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($SectionTwoPages as $key => $page)
                                                            <tr>
                                                                <td>{{$key +1}}</td>
                                                                <td>{{$page->name}}</td>
                                                                <td>
                                                                    <label class="switch_toggle"
                                                                           for="active_checkbox{{@$page->id }}">
                                                                        <input type="checkbox"
                                                                               onchange="statusChange({{$page}})"
                                                                               class=""
                                                                               id="active_checkbox{{@$page->id }}"
                                                                               @if (@$page->status == 1) checked
                                                                               @endif value="{{@$page->id }}">
                                                                        <i class="slider round"></i>
                                                                    </label>
                                                                </td>
                                                                <td>

                                                                    <div class="dropdown CRM_dropdown">
                                                                        <button
                                                                            class="btn btn-secondary dropdown-toggle"
                                                                            type="button" id="dropdownMenu2"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ __('common.Select') }}
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right"
                                                                             aria-labelledby="dropdownMenu2">
                                                                            <a href="javascript:void(0)"
                                                                               data-toggle="modal"
                                                                               data-target="#editModal"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showEditModal({{$page}})">{{ __('common.Edit') }}</a>

                                                                            <a href="javascript:void(0)"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showDeleteModal({{$page->id}})">{{ __('common.Delete') }}</a>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane {{ $footerTab == 5?'active show':'' }} fade"
                                 id="footer_4">
                                <div class="row">
                                    <div class="col-lg-3 mt-30">
                                        <div class="col-lg-12">
                                            <div class="main-title">
                                                <h3 class="mb-30">
                                                    {{__('common.Update')}} </h3>
                                            </div>
                                            <form method="POST" action=""
                                                  accept-charset="UTF-8" class="form-horizontal"
                                                  enctype="multipart/form-data"
                                                  id="serviceForm">
                                                <input type="hidden" name="id" value="{{$FooterContent->id}}">
                                                <div class="white-box">
                                                    <div class="add-visitor">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <input
                                                                        class="primary-input form-control read-only-input"
                                                                        required
                                                                        type="text" name="service_title"
                                                                        autocomplete="off"
                                                                        value="{{$FooterContent->footer_section_three_title}}">
                                                                    <label>{{__('footer.Section name')}}
                                                                        <span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">

                                                            <div class="col-lg-12 text-center tooltip-wrapper"
                                                                 data-title=""
                                                                 data-original-title="" title="">
                                                                <button class="primary-btn fix-gr-bg tooltip-wrapper "
                                                                        id="serviceBtn">
                                                                    <span class="ti-check"></span>
                                                                    {{__('common.Update')}} </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 mt-50">

                                        <a href="#" data-type="3"
                                           class="primary-btn addWidget small fix-gr-bg mb-2">{{__('footer.Add New Page')}}</a>
                                        <div class="QA_section QA_section_heading_custom check_box_table">
                                            <div class="QA_table">
                                                <!-- table-responsive -->
                                                <div class="">
                                                    <table class="table Crm_table_active3">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">{{ __('common.SL') }}</th>
                                                            <th scope="col">{{ __('common.Name') }}</th>
                                                            <th scope="col">{{ __('common.Status') }}</th>
                                                            <th scope="col">{{ __('common.Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($SectionThreePages as $key=> $page)
                                                            <tr>
                                                                <td>{{$key +1}}</td>
                                                                <td>{{$page->name}}</td>
                                                                <td>
                                                                    <label class="switch_toggle"
                                                                           for="active_checkbox{{@$page->id }}">
                                                                        <input type="checkbox"
                                                                               onchange="statusChange({{$page}})"
                                                                               class=""
                                                                               id="active_checkbox{{@$page->id }}"
                                                                               @if (@$page->status == 1) checked
                                                                               @endif value="{{@$page->id }}">
                                                                        <i class="slider round"></i>
                                                                    </label>
                                                                </td>

                                                                <td>

                                                                    <div class="dropdown CRM_dropdown">
                                                                        <button
                                                                            class="btn btn-secondary dropdown-toggle"
                                                                            type="button" id="dropdownMenu2"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ __('common.Select') }}
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right"
                                                                             aria-labelledby="dropdownMenu2">


                                                                            <a href="javascript:void(0)"
                                                                               data-toggle="modal"
                                                                               data-target="#editModal"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showEditModal({{$page}})">{{ __('common.Edit') }}</a>

                                                                            <a href="javascript:void(0)"
                                                                               class="dropdown-item edit_brand"
                                                                               onclick="showDeleteModal({{$page->id}})">{{ __('common.Delete') }}</a>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
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
        </div>
        @include('footersetting::footer.components.widget_edit')
        @include('footersetting::footer.components.delete')
    </section>

@endsection

@include('footersetting::footer.components.scripts')
