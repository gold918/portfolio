@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Создать запись
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем запись</h3>
                </div>
                @include('errors.errors')
                {{ Form::open(['route' => ['admin.user.update', 'id' => $user->id], 'files' => true]) }}
                @method('PUT')
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="" value="
                            @if(isset($user->name)) {{ $user->name }} @endif
                            ">
                        </div>

                        <div class="form-group">
                            @if(isset($user->photo))
                                <img src="{{ asset('img/users/' . $user->photo) }}" alt="{{ $user->photo }}" class="img-responsive" width="200">
                            @endif
                            <label for="exampleInputFile">Аватар</label>
                            <input type="file" id="exampleInputFile" name="photo">
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', $user->email, [ 'id' => 'email', 'class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Пароль') }}
                            {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
                        </div>

                        @if(isset($roles))
                            <div class="form-group">
                                <label for="role">Роль</label>
                                <select class="form-control select2" id="role" name="role" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option
                                            @if($role === $userRole)
                                            selected="selected"
                                            @endif
                                        >
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('admin.user') }}">Назад</a>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                {{ Form::close() }}
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
