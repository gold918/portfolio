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
                            <th>Псевдоним</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($filter) && is_object($filter))
                            <tr>
                                <td>
                                    @if(isset($filter->id))
                                        {{ $filter->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->name))
                                        {{ $filter->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->alias))
                                        {{ $filter->alias}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->status))
                                        {{ $filter->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->created_at))
                                        {{ $filter->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->updated_at))
                                        {{ $filter->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($filter->id))
                                    <a href="{{ route('admin.filter_portfolio.edit', ['id' => $filter->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.filter_portfolio.delete', $filter->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.filter_portfolio')) }}
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
                    @if(isset($filter->id))
                    <div class="form-group">
                        <a href="{{ route('admin.filter_portfolio.item.create', ['singleId' => $filter->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Псевдоним</th>
                            <th>Текст</th>
                            <th>Изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Связанные элементы</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($portfolio) && is_object($portfolio))
                            @foreach($portfolio as $item)
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
                                    @if(isset($item->alias))
                                        {{ $item->alias}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->text))
                                        {{ Str::limit($item->text, 155) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->image))
                                        <img src="{{ asset('img/portfolio/' . $item->image) }}" alt="" width="100">
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
                                <td class="text-center">
                                    @if(isset($item->id))
                                        <a href="{{ route('admin.portfolio_filter.single', ['singleId' => $filter->id, 'id' => $item->id]) }}" class="fa fa-cubes"></a>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->id))
                                    <a href="{{ route('admin.filter_portfolio.item.edit', ['singleId' => $filter->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.filter_portfolio.item.delete', $filter->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.filter_portfolio') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
