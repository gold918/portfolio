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
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($teamMember->id) && isset($teamMemberSocial->id))
                {{ Form::open(['route' => ['admin.team.item.update', $teamMember->id, $teamMemberSocial->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Название</label>
                            @if(isset($teamMemberSocial->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $teamMemberSocial->name }}">
                            @endif
                        </div>

                        @if(isset($teamMemberSocial->icon))
                        <div>
                            <i class="{{ $teamMemberSocial->icon }}"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($teamMemberSocial->icon))
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ $teamMemberSocial->icon }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('link', 'Сылка') }}
                            @if(isset($teamMemberSocial->link))
                                {{ Form::text('link', $teamMemberSocial->link, [ 'id' => 'link', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        @if(isset($elements))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($elements as $name)
                                <option
                                @if($name === $teamMember->name)
                                    selected="selected"
                                @endif
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
                                    @if($teamMemberSocial->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('admin.team.single', ['id' => $teamMember->id]) }}">Назад</a>
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
