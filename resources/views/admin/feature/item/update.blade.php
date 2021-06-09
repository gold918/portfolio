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
                @if(isset($feature->id) && isset($featureItem->id))
                {{ Form::open(['route' => ['admin.feature.item.update', $feature->id, $featureItem->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($featureItem->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $featureItem->title }}">
                            @endif
                        </div>

                        @if(isset($featureItem->icon))
                        <div>
                            <i class="feature__bx bx {{ $featureItem->icon }}"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($featureItem->icon))
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ $featureItem->icon }}">
                            @endif
                        </div>
                        @if(isset($mainElements))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($mainElements as $id)
                                <option
                                @if($id === $feature->id)
                                    selected="selected"
                                @endif
                                    >
                                    {{ 'Идентификатор главного элемента: ' . $id}}
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
                                    @if($featureItem->status === 'publish')
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
                            @if(isset($featureItem->text))
                                <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $featureItem->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.feature.single', ['id' => $feature->id]) }}">Назад</a>
                    <button class="btn btn-success pull-right">Изменить</button>
                </div>
                {{ Form::close() }}
                @endif
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
