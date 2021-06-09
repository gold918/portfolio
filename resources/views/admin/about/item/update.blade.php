@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Обновить запись
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                {{ Form::open(['route' => ['about.item.update', $about->id, $aboutItem->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="list_item">Название</label>
                            @if(isset($aboutItem->list_item))
                            <input type="text" name="list_item" class="form-control" id="list_item" placeholder="" value="{{ $aboutItem->list_item }}">
                            @endif
                        </div>

                         @if(isset($mainElements))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($mainElements as $id => $title)
                                <option
                                @if($id === $about->id)
                                    selected="selected"
                                @endif
                                    >
                                    {{ $id . ' - ' . Str::limit($title, 40) }}
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
                                    @if($aboutItem->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('about.single', ['id' => $about->id]) }}">Назад</a>
                    <button class="btn btn-success pull-right">Изменить</button>
                </div>
                {{ Form::close() }}
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
