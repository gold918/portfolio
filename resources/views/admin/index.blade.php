@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Привет! Это админка
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            @can('section-dashboard', $userRoles)
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Главная страница</h3>
                </div>
                <div class="box-body">
                    Текст инструкции по пользованию админкой
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    и здесь есть место для какого-нибудь текста
                </div>
                <!-- /.box-footer-->
            </div>
            @endcan

            @cannot('section-dashboard', $userRoles)
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="color: red">Спасибо за регистрацию. Пожалуйста, обратитесь к администратору для получения соответствующих прав.</h3>
                </div>
            </div>
            @endcannot
            <!-- /.box -->

        </section>
@endsection
