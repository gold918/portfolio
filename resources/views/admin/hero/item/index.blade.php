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
                            <th>Текст</th>
                            <th>Фоновое изображение</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($hero) && is_object($hero))
                            <tr>
                                <td>
                                    @if(isset($hero->id))
                                        {{ $hero->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->title))
                                        {{ $hero->title }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->alias))
                                        {{ $hero->alias}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->text))
                                        {{ Str::limit($hero->text, 255) }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->background_image))
                                        <img src="{{ asset('img/' . $hero->background_image) }}" alt="" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->status))
                                        {{ $hero->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->created_at))
                                        {{ $hero->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->updated_at))
                                        {{ $hero->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->id))
                                    <a href="{{ route('hero.edit', ['id' => $hero->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['hero.delete', $hero->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.hero')) }}
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
                    @if(isset($hero->id))
                    <div class="form-group">
                        <a href="{{ route('hero.item.create', ['singleId' => $hero->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Псевдоним</th>
                            <th>Иконка</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($heroItems) && is_object($heroItems))
                            @foreach($heroItems as $item)
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
                                    @if(isset($item->alias))
                                        {{ $item->alias}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->icon))
                                        <i class="ri {{ $item->icon }}"></i>
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
                                    <a href="{{ route('hero.item.edit', ['singleId' => $hero->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['hero.item.delete', $hero->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.hero') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
