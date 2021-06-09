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
        @if(isset($teamMember) && is_object($teamMember))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($teamMember->id))
                {{ Form::open(['route' => ['admin.team.update', $teamMember->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            @if(isset($teamMember->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $teamMember->name }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('position', 'Должность') }}
                            @if(isset($teamMember->position))
                            {{ Form::text('position', $teamMember->position, [ 'id' => 'position', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        <div class="form-group">
                            @if(isset($teamMember->photo))
                                <img src="{{ asset('img/team/' . $teamMember->photo) }}" alt="@if(isset($teamMember->name)) {{ $teamMember->name }} @endif" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Фотография</label>
                            <input type="file" id="exampleInputFile" name="photo">
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
                                @if(isset($teamMember->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($teamMember->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('admin.team') }}">Назад</a>
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
