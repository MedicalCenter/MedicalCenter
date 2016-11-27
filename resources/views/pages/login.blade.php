@extends('layouts.app')

@section('title')
    Logowanie
@stop

@section('header')
    @include('containers.loginHeader')
@stop

@section('content')
    @include('auth.login')
@stop

@section('footer')
    @include('containers.footer')
@stop