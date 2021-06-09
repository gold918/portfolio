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
        @if(isset($portfolio) && is_object($portfolio))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                {{ Form::open(['route' => ['admin.filter_portfolio.item.update', $filter->id, $portfolio->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Название</label>
                            @if(isset($portfolio->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $portfolio->name }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            @if(isset($portfolio->alias))
                            {{ Form::text('alias', $portfolio->alias, [ 'id' => 'alias', 'class' => 'form-control']) }}
                            @endif
                        </div>
                        <div class="form-group">
                            @if(isset($portfolio->image))
                                <img src="{{ asset('img/portfolio/' . $portfolio->image) }}" alt="" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Изображение</label>
                            <input type="file" id="exampleInputFile" name="image">
                        </div>
                        @if(isset($elements))
                            <div class="form-group">
                                <label>Связанный элемент</label>
                                <select class="form-control select2" name="elements[]" multiple="multiple" data-placeholder="Выберите элементы" style="width: 100%;">
                                    @foreach($elements as $name)
                                        <option
                                            @if( in_array($name, $filterId) ) selected @endif
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
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{  date('m/d/Y')  }}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name="status"
                                    @if($portfolio->status === 'publish')
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
                            @if(isset($portfolio->text))
                                <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $portfolio->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ back()->getTargetUrl() }}">Назад</a>
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
