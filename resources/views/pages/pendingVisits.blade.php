@extends('layout')

@section('head')
    @include('containers.head')
@stop

@section('title')
    Zaplanowane wizyty
@stop

@section('header')
    <?php $user = Auth::user()?>
    @if($user->role == '3')
        @include('containers.headerDoc')
    @elseif ($user->role == '2')
        @include('containers.header')
    @endif
@stop

@section('content')
    @include('content.pendingVisitContent')
@stop

@section('footer')
    @include('containers.footer')
@stop