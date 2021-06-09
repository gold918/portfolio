@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Главный элемент</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Фоновое изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($testimonial) && is_object($testimonial))
                            <tr>
                                <td>
                                    @if(isset($testimonial->id))
                                        {{ $testimonial->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($testimonial->background_image))
                                        <img src="{{ asset('img/' . $testimonial->background_image) }}" alt="" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($testimonial->status))
                                        {{ $testimonial->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($testimonial->created_at))
                                        {{ $testimonial->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($testimonial->updated_at))
                                        {{ $testimonial->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($testimonial->id))
                                    <a href="{{ route('admin.testimonial.edit', ['id' => $testimonial->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.testimonial.delete', $testimonial->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.testimonial')) }}
                                    {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tbody/>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Связанные элементы</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(isset($testimonial->id))
                    <div class="form-group">
                        <a href="{{ route('admin.testimonial.item.create', ['singleId' => $testimonial->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Должность</th>
                            <th>Фотография</th>
                            <th>Отзыв</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($testimonialItems) && is_object($testimonialItems))
                            @foreach($testimonialItems as $item)
                            <tr>
                                <td>
                                    @if(isset($item->id))
                                        {{ $item->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->name))
                                        {{ $item->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->position))
                                        {{ $item->position}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->photo))
                                        <img src="{{ asset('img/testimonials/' . $item->photo) }}" alt="" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->review))
                                        {{ Str::limit($item->review, 155) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->status))
                                        {{ $item->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->created_at))
                                        {{ $item->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->updated_at))
                                        {{ $item->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->id))
                                    <a href="{{ route('admin.testimonial.item.edit', ['singleId' => $testimonial->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.testimonial.item.delete', $testimonial->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        <tbody/>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('admin.testimonial') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
