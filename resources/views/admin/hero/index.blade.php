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
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('hero.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
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
                            <th>Связанные элементы</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($heroes) && is_object($heroes))
                            @foreach($heroes as $hero)
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
                                        {{ Str::limit($hero->text, 155) }}
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
                                <td class="text-center">
                                    @if(isset($hero->id))
                                        <a href="{{ route('hero.single', ['id' => $hero->id]) }}" class="fa fa-cubes"></a>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($hero->id))
                                    <a href="{{ route('hero.edit', ['id' => $hero->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['hero.delete', $hero->id], 'method'=>'delete', 'class' => 'delete']) }}
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
        <!-- /.content -->
    </div>
@endsection
