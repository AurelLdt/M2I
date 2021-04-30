@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('image')
    <img class="w-full" src="/img/404.svg" alt="404">
@endsection
@section('message', __('Not Found'))
