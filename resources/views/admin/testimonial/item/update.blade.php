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
                {{ Form::open(['route' => ['admin.testimonial.item.update', $testimonial->id, $testimonialItem->id], 'method'=>'put', 'files' => true]) }}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            @if(isset($testimonialItem->name))
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $testimonialItem->name }}">
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('position', 'Должность') }}
                            @if(isset($testimonialItem->position))
                            {{ Form::text('position', $testimonialItem->position, [ 'id' => 'position', 'class' => 'form-control']) }}
                            @endif
                        </div>
                        <div class="form-group">
                            @if(isset($testimonialItem->photo))
                                <img src="{{ asset('img/testimonials/' . $testimonialItem->photo) }}" alt="" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Аватарка</label>
                            <input type="file" id="exampleInputFile" name="photo">
                        </div>
                        @if(isset($elements))
                        <div class="form-group">
                            <label for="main">Главный элемент</label>
                            <select class="form-control select2" id="main" name="mainElement" style="width: 100%;">
                                @foreach($elements as $id)
                                <option
                                @if($id === $testimonial->id)
                                    selected="selected"
                                @endif
                                    >
                                    {{ 'Идентификатор главного элемента: ' . $id }}
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
                                    @if($testimonialItem->status === 'publish')
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
                            <label for="text">Отзыв</label>
                            @if(isset($testimonialItem->review))
                                <textarea name="text" id="text" cols="30" rows="10" class="form-control">{{ $testimonialItem->review }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.testimonial.single', ['id' => $testimonial->id]) }}">Назад</a>
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
