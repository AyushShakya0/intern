@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-primary" role="alert">
            {{ session('delete') }}
        </div>
    @endif
    @if (session('update'))
        <div class="alert alert-primary" role="alert">
            {{ session('update') }}
        </div>
    @endif
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
                                <a class="nav-link" href="{{ route('catagory.index') }}">Create</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <table class="table">
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
                                        <button type="button" class="btn btn-danger delete-button">Delete</button>
                                        <form action='{{url('/catagory/delete/'.$item->id)}}' method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-button').on('click',function(){
                if(confirm("Do you Want to delete the data")){
                    $(this).next().submit();
                }
            })
        })
    </script>
@endsection
