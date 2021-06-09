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
                {{ Form::open(['route' => ['hero.item.update', $hero->id, $heroItem->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($heroItem->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $heroItem->title }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('alias', 'Псевдоним') }}
                            @if(isset($heroItem->alias))
                            {{ Form::text('alias', $heroItem->alias, [ 'id' => 'alias', 'class' => 'form-control']) }}
                            @endif
                        </div>
                        @if(isset($heroItem->icon))
                        <div>
                            <i class="ri {{ $heroItem->icon }}"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($heroItem->icon))
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ $heroItem->icon }}">
                            @endif
                        </div>
                        @if(isset($aliases))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($aliases as $id => $alias)
                                <option
                                @if($alias === $hero->alias)
                                    selected="selected"
                                @endif
                                    >
                                    {{ $id . ' - ' . $alias }}
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
                                    @if($heroItem->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('hero.single', ['id' => $hero->id]) }}">Назад</a>
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
