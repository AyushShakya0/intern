@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('catagory') }}">Catagory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                {{-- <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Catagory</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($catagory as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->catagory }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a name="edit" id="" class="btn btn-primary"
                                        href="{{ url('/catagory/update/' . $item->id) }}" role="button">Edit</a>
                                    <a name="delete" id="" class="btn btn-danger"
                                        href="{{ url('/catagory/delete/' . $item->id) }}" role="button">Delete</a>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}

            </div>
        </div>
    </div>
@endsection
