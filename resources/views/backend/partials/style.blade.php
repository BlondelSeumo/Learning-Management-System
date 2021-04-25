<!-- Bootstrap CSS -->
@if(isRtl())
    <link rel="stylesheet" href="{{ asset('public') }}/css/bootstrap.rtl.min.css">
@else
    <link rel="stylesheet" href="{{ asset('public') }}/css/bootstrap.min.css">
@endif
<link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/jquery.data-tables.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/rowReorder.dataTables.min.css/')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-datepicker.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-datetimepicker.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/themify-icons.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/flaticon.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/vendors/font_awesome/css/all.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/nice-select.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/magnific-popup.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/css/fastselect.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/backend/vendors/select2/select2.css')}}"/>
<link rel="stylesheet" href="{{asset('public/css/treeview.css/')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/loade.css')}}"/>

<link rel="stylesheet" href="{{asset('public/backend/vendors/calender_js/core/main.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/vendors/calender_js/daygrid/main.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/vendors/calender_js/timegrid/main.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/vendors/calender_js/list/main.css/')}}">
<link rel="stylesheet" href="{{asset('public/backend/vendors/color_picker/colorpicker.min.css/')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/metisMenu.css/')}}">

<link href="{{asset('public/backend/css/summernote-bs4.min.css/')}}" rel="stylesheet">


@if(isRtl())
    <link rel="stylesheet" href="{{asset('public/backend/css/rtl/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/backend/css/rtl/infix.css')}}"/>
@else
    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/backend/css/infix.css')}}"/>
@endif

<link rel="stylesheet" href="{{asset('public/backend/css/style_2.css')}}"/>
<link rel="stylesheet" href="{{asset('public/css/preloader.css')}}"/>

@stack('styles')




