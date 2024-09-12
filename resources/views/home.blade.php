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
                                <a class="nav-link" href="{{ route('catagory') }}">Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rolesandpermission.index') }}">Roles and Permission</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    </div>
@endsection
