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
                            <th>Изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($feature) && is_object($feature))
                            <tr>
                                <td>
                                    @if(isset($feature->id))
                                        {{ $feature->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($feature->image))
                                        <img src="{{ asset('img/' . $feature->image) }}" alt="{{ $feature->image }}" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($feature->status))
                                        {{ $feature->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($feature->created_at))
                                        {{ $feature->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($feature->updated_at))
                                        {{ $feature->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($feature->id))
                                    <a href="{{ route('admin.feature.edit', ['id' => $feature->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.feature.delete', $feature->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.feature')) }}
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
                    @if(isset($feature->id))
                    <div class="form-group">
                        <a href="{{ route('admin.feature.item.create', ['singleId' => $feature->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Текст</th>
                            <th>Иконка</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($featureItems) && is_object($featureItems))
                            @foreach($featureItems as $item)
                            <tr>
                                <td>
                                    @if(isset($item->id))
                                        {{ $item->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->title))
                                        {{ $item->title }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->text))
                                        {{ Str::limit($item->text, 155) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->icon))
                                        <i class="feature__bx bx {{ $item->icon }}"></i>
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
                                    @if(isset($item->id) && isset($feature->id))
                                    <a href="{{ route('admin.feature.item.edit', ['singleId' => $feature->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['hero.item.delete', $feature->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.feature') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
