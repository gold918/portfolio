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
                {{ Form::open(['route' => ['admin.count.item.update', $count->id, $countItem->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="main_word">Главные слова</label>
                            @if(isset($countItem->main_word))
                            <input type="text" name="main_word" class="form-control" id="main_word" placeholder="" value="{{ $countItem->main_word }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('number', 'Количество') }}
                            @if(isset($countItem->number))
                            {{ Form::number('number', $countItem->number, [ 'id' => 'number', 'class' => 'form-control']) }}
                            @endif
                        </div>
                        @if(isset($countItem->icon))
                        <div>
                            <i class="ri {{ $countItem->icon }}"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($countItem->icon))
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ $countItem->icon }}">
                            @endif
                        </div>
                        @if(isset($elements))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($elements as $id => $title)
                                <option
                                @if($id === $count->id)
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
                                    @if($countItem->status === 'publish')
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
                            @if(isset($countItem->text))
                                <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $countItem->text }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.count.single', ['id' => $count->id]) }}">Назад</a>
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
