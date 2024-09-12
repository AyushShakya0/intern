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
                                <a class="nav-link" href="#">Post</a>
                            </li>
                            @haspermission('create_posts') <!-- Show 'Create' button only for users with 'create_posts' permission -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#createModal">Create</a>
                                    {{-- <a class="nav-link" href="{{ route('post.create') }}">Create</a> --}}
                                </li>
                            @endhaspermission
                            @include('post.modal')
                        </ul>
                    </div>
                </nav>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Status</th>
                            <th scope="col">Catagory</th>
                            <th scope="col">Author</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->catagory->catagory }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if ($item->image)
                                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->title }}"
                                            width="100" height="100">
                                    @else
                                        <img src="" alt="" width="100" height="100">
                                    @endif
                                </td>
                                <td>
                                    @haspermission('update_posts') <!-- Show 'Edit' button only for users with 'update_posts' permission -->
                                        <a name="edit" id="{{ $item->id }}" class="btn btn-primary update-btn"
                                            role="button" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</a>
                                    @endhaspermission

                                    @haspermission('delete_posts') <!-- Show 'Delete' button only for users with 'delete_posts' permission -->
                                        <button type="button" class="btn btn-danger delete-button" id="{{ $item->id }}">Delete</button>
                                    @endhaspermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Create post
            $('.post_create').submit(function(e) {
                e.preventDefault();
                const formdata = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.store') }}",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success"
                            })
                            pageRelod(response.data)
                        }
                    },
                    error: function(xhr, error) {
                        Swal.fire({
                            title: "Failed!",
                            text: "Data Store failed",
                            icon: "error"
                        });
                        $('input').val('');
                    }
                });
            });

            function pageRelod(serverdata) {
                let i = 1;
                let data = serverdata.map((data) => {
                    return `<tr>
                                <td>${i++}</td>
                                <td>${data.title}</td>
                                <td>${data.content}</td>
                                <td>${data.status}</td>
                                <td>${data.catagory.catagory}</td>
                                <td>${data.user.name}</td>
                                <td><img src="/images/${data.image}" width="100" height="100"></td>
                                 <td>
                                    @can('update_posts')
                                        <a name="edit" class="btn btn-primary update-btn" id="${data.id}" role="button" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</a>
                                    @endcan
                                    @can('delete_posts')
                                        <button type="button" class="btn btn-danger delete-button" id="${data.id}">Delete</button>
                                    @endcan
                                </td>
                            </tr>`;
                });

                $('tbody').html(data);
                $('.modal').modal('hide');
                $('.post_create input').val('');
                $('.post_create textarea').val('');
            }

            // Delete post
            $('tbody').on('click', '.delete-button', function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const ref = $(this)
                        const id = parseInt($(this).attr('id'));
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('post.destroy', '') }}/" + id,
                            success: function(response) {
                                if (response.success) {
                                    ref.parent().parent().remove();
                                    Swal.fire({
                                        title: "Success!",
                                        text: response.message,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Failed!",
                                        text: response.message,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, status) {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Data Delete failed",
                                    icon: "error"
                                });
                                console.log('Error:', xhr.responseText);
                            }
                        });
                    }
                });
            });

            // Set update data in modal
            let updateid;
            $('tbody').on("click", ".update-btn", function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    type: "GET",
                    url: `{{ url('post') }}/` + id + "/edit",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        updateid = {
                            "image": response.data.image,
                            "id": response.data.id
                        };
                        $('.post_update .title').val(response.data.title);
                        $('.post_update .content').val(response.data.content);
                        $('.post_update .catagory').val(response.data.catagory_id);
                        $('.post_update .status').val(response.data.status);
                        $('.post_update img').attr('src', '/images/' + response.data.image);
                    }
                });
            });

            // Update post
            $('.post_update').submit(function(e) {
                e.preventDefault();
                const formdata = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.update', '') }}/" + updateid.id,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });
                        pageRelod(response.data);
                    }
                });
            });
        });
    </script>
@endsection
