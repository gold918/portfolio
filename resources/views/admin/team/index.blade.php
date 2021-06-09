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
                        <a href="{{ route('admin.team.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Должность</th>
                            <th>Фотография</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Связанные элементы</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($teamMembers) && is_object($teamMembers))
                            @foreach($teamMembers as $row)
                            <tr>
                                <td>
                                    @if(isset($row->id))
                                        {{ $row->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->name))
                                        {{ $row->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->position))
                                        {{ $row->position }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->photo))
                                        <img src="{{ asset('img/team/' . $row->photo) }}" alt="@if(isset($row->name)){{ $row->name }} @endif" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->status))
                                        {{ $row->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->created_at))
                                        {{ $row->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->updated_at))
                                        {{ $row->updated_at }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(isset($row->id))
                                        <a href="{{ route('admin.team.single', ['id' => $row->id]) }}" class="fa fa-cubes"></a>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row->id))
                                    <a href="{{ route('admin.team.edit', ['id' => $row->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.team.delete', $row->id], 'method'=>'delete', 'class' => 'delete']) }}
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
