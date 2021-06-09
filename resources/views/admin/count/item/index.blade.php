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
                            <th>Текст</th>
                            <th>Изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($count) && is_object($count))
                            <tr>
                                <td>
                                    @if(isset($count->id))
                                        {{ $count->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->title))
                                        {{ $count->title }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->text))
                                        {{ Str::limit($hero->text, 255) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->image))
                                        <img src="{{ asset('img/' . $count->image) }}" alt="" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->status))
                                        {{ $count->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->created_at))
                                        {{ $count->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->updated_at))
                                        {{ $count->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($count->id))
                                    <a href="{{ route('admin.count.edit', ['id' => $count->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.count.delete', $count->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.count')) }}
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
                    @if(isset($count->id))
                    <div class="form-group">
                        <a href="{{ route('admin.count.item.create', ['singleId' => $count->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Главные слова</th>
                            <th>Текст</th>
                            <th>Иконка</th>
                            <th>Число</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($countItems) && is_object($countItems))
                            @foreach($countItems as $item)
                            <tr>
                                <td>
                                    @if(isset($item->id))
                                        {{ $item->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->main_word))
                                        {{ $item->main_word }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->text))
                                        {{ Str::limit($item->text, 155) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->icon))
                                        <i class="count__icon {{ $item->icon }}"></i>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->number))
                                        {{ $item->number }}
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
                                    <a href="{{ route('admin.count.item.edit', ['singleId' => $count->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.count.item.delete', $count->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.count') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
