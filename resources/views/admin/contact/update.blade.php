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
        @if(isset($contact) && is_object($contact))
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем запись</h3>
                </div>
                @include('errors.errors')
                @if(isset($contact->id))
                {{ Form::open(['route' => ['admin.contact.update', $contact->id], 'method'=>'put']) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Название</label>
                            @if(isset($contact->title))
                            <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $contact->title }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('value', 'value') }}
                            @if(isset($contact->value))
                            {{ Form::text('value', $contact->value, [ 'id' => 'value', 'class' => 'form-control']) }}
                            @endif
                        </div>

                        @if(isset($contact->icon))
                            <div>
                                <i class="{{ $contact->icon }}"></i>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Иконка</label>
                            @if(isset($contact->icon))
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ $contact->icon }}">
                            @endif
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
                                @if(isset($contact->status))
                                <input type="checkbox" class="minimal" name="status"
                                    @if($contact->status === 'publish')
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
                    <a class="btn btn-default" href="{{ route('admin.contact') }}">Назад</a>
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
