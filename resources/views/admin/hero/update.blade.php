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
        @if(isset($hero) && is_object($hero))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($hero->id))
                {{ Form::open(['route' => ['hero.update', $hero->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($hero->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $hero->title }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            @if(isset($hero->alias))
                            {{ Form::text('alias', $hero->alias, [ 'id' => 'alias', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        <div class="form-group">
                            @if(isset($hero->background_image))
                                <img src="{{ asset('img/' . $hero->background_image) }}" alt="" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Фоновое изображение</label>
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
                                @if(isset($hero->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($hero->status === 'publish')
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
                            @if(isset($hero->text))
                            <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $hero->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.hero') }}">Назад</a>
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
