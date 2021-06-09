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
                            <th>Название</th>
                            <th>Подзаголовок</th>
                            <th>Текст</th>
                            <th>Изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($about) && is_object($about))
                            <tr>
                                <td>
                                    @if(isset($about->id))
                                        {{ $about->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->title))
                                        {{ $about->title }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->subtitle))
                                        {{ $about->subtitle }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->text))
                                        {{ Str::limit($about->text, 255) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->image))
                                        <img src="{{ asset('img/' . $about->image) }}" alt="{{ $about->image }}" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->status))
                                        {{ $about->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->created_at))
                                        {{ $about->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->updated_at))
                                        {{ $about->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($about->id))
                                    <a href="{{ route('about.edit', ['id' => $about->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['about.delete', $about->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.about')) }}
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
                    @if(isset($about->id))
                    <div class="form-group">
                        <a href="{{ route('about.item.create', ['singleId' => $about->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пункты списка</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($aboutItems) && is_object($aboutItems))
                            @foreach($aboutItems as $item)
                            <tr>
                                <td>
                                    @if(isset($item->id))
                                        {{ $item->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->list_item))
                                        {{ $item->list_item }}
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
                                    <a href="{{ route('about.item.edit', ['singleId' => $about->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['about.item.delete', $about->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.about') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
