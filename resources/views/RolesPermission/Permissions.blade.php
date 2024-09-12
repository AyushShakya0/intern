@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

                <div class="card">
                    <div class="card-header">Create a New Permission</div>

                    <div class="card-body">
                        <!-- Form to create a new permission -->
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="permission_name">Permission Name:</label>
                                <input type="text" name="permission_name" id="permission_name" class="form-control"
                                    placeholder="Enter Permission Name" required>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Create Permission</button>
                        </form>
                    </div>
                </div>

                <!-- List existing permissions -->
                <div class="card mt-4">
                    <div class="card-header">Existing Permissions</div>

                    <div class="card-body">
                        <ul>
                            @foreach ($permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
