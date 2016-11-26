@extends('layout')

@section('head')
    @include('containers.head')
@stop

@section('title')
    Zaplanowane wizyty
@stop

@section('header')
    @include('containers.header')
@stop

@section('content')
    @include('content.pendingVisitContent')
@stop

@section('footer')
    @include('containers.footer')
@stop