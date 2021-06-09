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
        @if(isset($filter) && is_object($filter))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($filter->id))
                {{ Form::open(['route' => ['admin.filter_portfolio.update', $filter->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Название</label>
                            @if(isset($filter->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $filter->name }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            @if(isset($filter->alias))
                            {{ Form::text('alias', $filter->alias, [ 'id' => 'alias', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        @if(isset($elements))
                            <div class="form-group">
                                <label>Связанный элемент</label>
                                <select class="form-control select2" name="elements[]" multiple="multiple" data-placeholder="Выберите элементы" style="width: 100%;">
                                    @foreach($elements as $id => $name)
                                        <option
                                        @if( in_array($id, $portfolioId) ) selected @endif
                                        >
                                            {{ $id . ' - ' . $name }}
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
                                <input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{ date('m/d/Y') }}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                @if(isset($filter->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($filter->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('admin.filter_portfolio') }}">Назад</a>
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
