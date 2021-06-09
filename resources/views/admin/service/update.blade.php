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
        @if(isset($service) && is_object($service))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($service->id))
                {{ Form::open(['route' => ['admin.service.update', $service->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($service->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $service->title }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            @if(isset($service->alias))
                            {{ Form::text('alias', $service->alias, [ 'id' => 'alias', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        @if(isset($service->icon))
                            <div>
                                <i class="services__bx bx {{ $service->icon }}"></i>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($service->icon))
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ $service->icon }}">
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
                                @if(isset($service->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($service->status === 'publish')
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text">Полный текст</label>
                            @if(isset($service->text))
                            <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $service->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.service') }}">Назад</a>
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
