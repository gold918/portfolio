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
                            <th>Имя</th>
                            <th>Должность</th>
                            <th>Фотография</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($teamMember) && is_object($teamMember))
                            <tr>
                                <td>
                                    @if(isset($teamMember->id))
                                        {{ $teamMember->id }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->name))
                                        {{ $teamMember->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->position))
                                        {{ $teamMember->position}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->photo))
                                        <img src="{{ asset('img/team/' . $teamMember->photo) }}" alt="@if(isset($teamMember->name)) {{ $teamMember->name }} @endif" width="100">
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->status))
                                        {{ $teamMember->status }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->created_at))
                                        {{ $teamMember->created_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->updated_at))
                                        {{ $teamMember->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($teamMember->id))
                                    <a href="{{ route('admin.team.edit', ['id' => $teamMember->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.team.delete', $teamMember->id], 'method'=>'delete', 'class' => 'delete']) }}
                                        <button onclick="return confirm('are you sure?')" type="submit" class="delete__submit">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    {{ Form::hidden('redirect', route('admin.team')) }}
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
                    @if(isset($teamMember->id))
                    <div class="form-group">
                        <a href="{{ route('admin.team.item.create', ['singleId' => $teamMember->id]) }}" class="btn btn-success">Добавить</a>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название социальной сети</th>
                            <th>Иконка</th>
                            <th>Ссылка</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($teamMemberSocials) && is_object($teamMemberSocials))
                            @foreach($teamMemberSocials as $item)
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
                                    @if(isset($item->icon))
                                        <i class="{{ $item->icon }}"></i>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->link))
                                        {{ $item->link}}
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
                                    <a href="{{ route('admin.team.item.edit', ['singleId' => $teamMember->id, 'id' => $item->id]) }}" class="fa fa-pencil"></a>
                                    {{ Form::open(['route' => ['admin.team.item.delete', $teamMember->id, $item->id], 'method'=>'delete', 'class' => 'delete']) }}
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
            <a class="btn btn-default" href="{{ route('admin.team') }}">Назад</a>
        </div>
        <!-- /.content -->
    </div>
@endsection
