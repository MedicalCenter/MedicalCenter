@extends('layout')

@section('head')
    @include('containers.head')
@stop

@section('title')
    Testowy
@stop

@section('header')
    @include('containers.header')
@stop

@section('content')
    @include('content.patientInsertContent')
@stop

@section('footer')
    @include('containers.footer')
@stop