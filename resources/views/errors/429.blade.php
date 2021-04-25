@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')


@section('content')
    <div class="max-w-sm m-8">
        <div class="text-black text-5xl md:text-15xl font-black">
            <img src="{{url('public/backend/img/404.png')}}" alt="" class="img img-fluid"></div>

        <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

        <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal text-white">

            {{ __('Sorry, you are making too many requests to our servers.')}}
        </p>

        <a href="{{url('/')}}">
            <button
                class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg text-white">
                Go Home
            </button>
        </a>
        <a href="{{ URL::previous() }}">
            <button
                class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg text-white">
                Go Back
            </button>
        </a>
    </div>
@endsection
