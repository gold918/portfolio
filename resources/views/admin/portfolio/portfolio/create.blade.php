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
                {{ Form::open(['route' => ['admin.filter_portfolio.item.store', $singleId], 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            {{ Form::text('alias', old('alias'), [ 'id' => 'alias', 'class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <input type="file" id="exampleInputFile" name="image">
                        </div>
                        @if(isset($elements))
                            <div class="form-group">
                                <label>Связанный элемент</label>
                                <select class="form-control select2" name="elements[]" multiple="multiple" data-placeholder="Выберите элементы" style="width: 100%;">
                                    @foreach($elements as $name)
                                        <option
                                            @if(in_array($name, old('elements', [])) ) selected @endif
                                        >
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    @endif
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text">Полный текст</label>
                            <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ old('text') }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.filter_portfolio.single', ['id' => $singleId]) }}">Назад</a>
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
