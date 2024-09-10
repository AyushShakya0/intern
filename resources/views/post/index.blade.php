@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal"
                                    data-bs-target="#createModal">Create</a>
                                {{-- <a class="nav-link" href="{{ route('post.create') }}">Create</a> --}}
                            </li>
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
                                {{-- <td>
                                @if ($item->postimage)
                                @foreach ($item->postimage as $images)
                                <img src="{{ asset('images/'.$images->images) }}" alt="{{ $item->title }}" width="100" height="100">
                                @endforeach
                                
                                @else
                                <img src="" alt=""  width="100" height="100">
                                @endif
                                
                            </td>  --}}

                                <td>
                                    <a name="edit" id="{{ $item->id }}" class="btn btn-primary update-btn"
                                        role="button" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</a>
                                    <button type="button" class="btn btn-danger delete-button"
                                        id="{{ $item->id }}">Delete</button>
                                    {{-- <form action='{{ route('post.destroy', $item) }}' method="post">
                                        @method('DELETE')
                                        @csrf
                                    </form> --}}

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




            //create post 
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
                                <td><img src="/images/${data.image}"  width="100" height="100"></td>
                                 <td>
                                    <a name="edit" class="btn btn-primary update-btn" id="${data.id}" role="button" data-bs-toggle="modal"
                                    data-bs-target="#updateModal">Edit</a>
                                    <button type="button" class="btn btn-danger delete-button"id="${data.id}">Delete</button>
                                
                                </td>
                                
                            </tr>`
                });


                $('tbody').html(data);
                $('.modal').modal('hide');
                $('.post_create input').val('');
                $('.post_create textarea').val('');

            }



            //for deleting the data

            //event delegation when the button is dynamically added this event listener will not work 

            //so use already  existed element when the page was initially loaded in this casse tbody
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
                        // $(this).next().submit();
                        // Swal.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                        const ref = $(this)
                        const id = parseInt($(this).attr('id'));
                        console.log(id)
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('post.destroy', '') }}/" + id,
                            success: function(response) {
                                if (response.success) {
                                    ref.parent().parent().remove();
                                    Swal.fire({
                                        title: "Succeess!",
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
                                console.log('Error:', xhr
                                    .responseText
                                ); // This will also show the dumped content

                            }
                        });
                    }
                });
            })



            //set update data in model
            // $('tbody').on("click",".update-btn",function(e) {
            let updateid;
            $('tbody').on("click",".update-btn",function(e) {
                console.log("hello")
                e.preventDefault();
                let id = $(this).attr('id');


                $.ajax({
                    type: "GET",
                    url: `{{ url('post') }}/` + id + "/edit",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response)
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


            //update the data
            $('.post_update').submit(function(e) {
                e.preventDefault();
                const formdata = new FormData(this)
                console.log(formdata.get('title'));
                console.log(updateid.id)
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.update', '') }}/" + updateid.id,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Succeess!",
                            text: response.message,
                            icon: "success"
                        });
                        console.log(response.data)
                        pageRelod(response.data)
                    }
                });
            })


        })
    </script>
@endsection
