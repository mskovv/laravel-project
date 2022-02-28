@extends('layout')
@section('title', 'Войти')

@section('stylesheet')
    <link rel="stylesheet" media="screen, print" href="/css/page-login-alt.css">
@endsection

@section('nav')
@endsection
@section('body')
        <div class="blankpage-form-field">
            <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                    <img src="/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">Учебный проект</span>
                    <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                </a>
            </div>
            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
                @if(Session::has('danger'))
                    <div class="alert alert-danger">
                        {{Session::get('danger')}}
                    </div>
                @elseif($errors->any())
                    <div class="alert alert-danger">
                        @if($errors->has('email'))
                            {{$errors->first()}}
                        @elseif($errors->has('password'))
                            {{$errors->first()}}
                        @endif
                    </div>
                @endif
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="username">Email</label>
                        <input type="email" id="username" class="form-control" placeholder="Эл. адрес" value="{{old('email')}}" name="email">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Пароль</label>
                        <input type="password" id="password" class="form-control" placeholder="" name="password" >
                    </div>
                    <div class="form-group text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label" for="rememberme">Запомнить меня</label>
                        </div>
                    </div>
                    <button class="btn btn-default float-right">Войти</button>
                </form>
            </div>
            <div class="blankpage-footer text-center">
                Нет аккаунта? <a href="/register"><strong>Зарегистрироваться</strong></a>
            </div>
        </div>
        <video poster="/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
            <source src="/media/video/cc.webm" type="video/webm">
            <source src="/media/video/cc.mp4" type="video/mp4">
        </video>
@endsection
