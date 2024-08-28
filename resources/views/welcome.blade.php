@extends('layouts.site-layout')
@section('title', 'home')
@section('content')


    <x-banner/>
    <x-category/>
    <x-mini-category/>
    @component('components.product', ['data' => $products]) @endcomponent
    <x-dealy/>
    <x-testimonial />

@endsection
