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
        @if(isset($about) && is_object($about))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                {{ Form::open(['route' => ['about.update', $about->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($about->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $about->title }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('subtitle', 'Подзаголовок') }}
                            @if(isset($about->subtitle))
                            {{ Form::text('subtitle', $about->subtitle, [ 'id' => 'subtitle', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        <div class="form-group">
                            @if(isset($about->image))
                                <img src="{{ asset('img/' . $about->image) }}" alt="{{ $about->image }}" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Изображение</label>
                            <input type="file" id="exampleInputFile" name="image">
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
                                @if(isset($about->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($about->status === 'publish')
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
                            @if(isset($about->text))
                            <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $about->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.about') }}">Назад</a>
                    <button class="btn btn-success pull-right">Изменить</button>
                </div>
                {{ Form::close() }}
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        @endif
        <!-- /.content -->
    </div>
@endsection
