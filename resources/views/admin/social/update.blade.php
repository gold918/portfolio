@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить запись
            </h1>
        </section>

        <!-- Main content -->
        @if(isset($social) && is_object($social))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($social->id))
                {{ Form::open(['route' => ['admin.social.update', $social->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название социальной сети</label>
                            @if(isset($social->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $social->name }}">
                            @endif
                        </div>

                        @if(isset($social->icon))
                            <div>
                                <i class="bx socials__icon {{ $social->icon }}"></i>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($social->icon))
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ $social->icon }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('link', 'Ссылка') }}
                            @if(isset($social->link))
                            {{ Form::text('link', $social->link, [ 'id' => 'link', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{ date('m/d/Y') }}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                @if(isset($social->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($social->status === 'publish')
                                        {{ 'checked' }}
                                    @endif
                                >
                                @endif
                            </label>
                            <label>
                                Публиковать
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.social') }}">Назад</a>
                    <button class="btn btn-success pull-right">Изменить</button>
                </div>
                {{ Form::close() }}
                @endif
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        @endif
        <!-- /.content -->
    </div>
@endsection
