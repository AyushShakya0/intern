@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('rolesandpermission.index') }}">Roles and Permissions</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('role.index') }}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('permission.index') }}">Permissions</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Assign roles to users -->
                <div class="card mt-4">
                    <div class="card-header">Assign Role to User</div>
                    <div class="card-body">
                        <form action="{{ route('assign.role') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">Select User:</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="role_id">Select Role:</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Assign Role</button>
                        </form>
                    </div>
                </div>

                <!-- Assign permissions to roles -->
                <div class="card mt-4">
                    <div class="card-header">Assign Permission to Role</div>
                    <div class="card-body">
                        <form action="{{ route('assign.permission') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="role_id">Select Role:</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="permission_id">Select Permission(s):</label>
                                <select name="permission_id[]" id="permission_id" class="form-control" multiple required>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Assign Permissions</button>
                        </form>
                    </div>
                </div>


                <div class="card mt-4">
                    <div class="card-header">Users and Their Roles</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Table of Roles and their Permissions -->
                <div class="card mt-4">
                    <div class="card-header">Roles and Their Permissions</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                {{ $permission->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>

            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif


        </div>
    </div>
@endsection
