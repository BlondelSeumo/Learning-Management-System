@extends('backend.master')

@push('styles')
    <link rel="stylesheet" href="{{asset('public/backend/css/theme.css')}}"/>
@endpush
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex justify-content-between">
                            <h3 class="mb-0 mr-30">{{ __('setting.Themes') }}</h3>


                            <ul class="d-flex">
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg text-white"
                                       href="{{url('/appearance/themes/create')}}"><i
                                            class="ti-plus"></i>{{__('common.Add New')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <div style="position: relative;" class="col-md-4 item_section">
                            <div style="border:2px solid;" class="card">

                                <div style="padding: 0;" class="card-body screenshot">
                                    <div class="single_item_img_div">
                                        <img style="width: 100%" src="{{ asset($activeTheme->image) }}" alt="">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-5">
                                            <h4>{{$activeTheme->name}}</h4>
                                        </div>
                                        @if($activeTheme->is_active !=1 )
                                            <div class="col-7 footer_div">
                                                <div class="row btn_div">
                                                    <div class="col-md-5 col-sm-12">
                                                        <form action="{{route('appearance.themes.active')}}"
                                                              method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$activeTheme->id}}">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-secondary Active_btn">{{__('common.active')}}</button>
                                                        </form>

                                                    </div>
                                                    <div style="padding-left: 0;" class="col-md-7 col-sm-12">
                                                        <a class="btn btn-sm btn-outline-secondary Active_btn"
                                                           target="_blank"
                                                           href="{{$activeTheme->live_link}}">{{__('setting.live preview')}}</a>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-center detail_btn">
                                    <h4>
                                        <a href="{{route('appearance.themes.show',$activeTheme->id)}}">{{__('setting.Theme Details')}}</a>
                                    </h4>
                                </div>

                            </div>


                        </div>

                        @foreach($ThemeList as $key => $item)
                            <div style="position: relative;" class="col-md-4 item_section">
                                <div style="" class="card">

                                    <div style="padding: 0;" class="card-body screenshot">
                                        <div class="single_item_img_div">
                                            <img style="width: 100%" src="{{ asset($item->image) }}" alt="">
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-5">
                                                <h4>{{$item->name}}</h4>
                                            </div>
                                            {{-- @if($item->is_active !=1 ) --}}
                                            <div class="col-7 footer_div">
                                                <div class="row btn_div">
                                                    <div class="col-md-5 col-sm-12">
                                                        <form action="{{route('appearance.themes.active')}}"
                                                              method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-secondary Active_btn">
                                                                Active
                                                            </button>
                                                        </form>

                                                    </div>
                                                    <div style="padding-left: 0;" class="col-md-7 col-sm-12">
                                                        <a class="btn btn-sm btn-outline-secondary Active_btn"
                                                           target="_blank" href="{{$item->live_link}}">Live Preview</a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="text-center detail_btn">
                                        <h4>
                                            <a href="{{route('appearance.themes.show',$item->id)}}">{{__('setting.Theme Details')}}</a>
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        @endforeach


                        <div class="col-md-4">
                            <a href="{{url('/appearance/themes/create')}}">
                                <div id="add_new">
                                    <span id="plus"><i class="fas fa-plus"></i></span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
