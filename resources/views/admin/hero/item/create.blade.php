@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Создать запись
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем запись</h3>
                </div>
                @include('errors.errors')
                {{ Form::open(['route' => ['hero.item.store', $singleId]]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            {{ Form::text('alias', old('alias'), [ 'id' => 'alias', 'class' => 'form-control']) }}
                        </div>
                        @if(old('icon'))
                        <div>
                            <i class="ri {{ old('icon') }}"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon') }}">
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{ old('date') }}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name="status"
                                    @if(old('status') === 'on')
                                        {{ 'checked' }}
                                    @endif
                                >
                            </label>
                            <label>
                                Публиковать
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('hero.single', ['id' => $singleId]) }}">Назад</a>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                {{ Form::close() }}
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
