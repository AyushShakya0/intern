@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href={{ route('post.index') }}>Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href={{ route('post.create') }}>Create</a>
                            </li>

                        </ul>

                    </div>
                </nav>

                <form method="post" action="" enctype="multipart/form-data" class="post_create">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="catagory">Title</label>
                            <input type="text" class="form-control" placeholder="Title" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-primary" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="content">Content</label>

                            <textarea class="form-control" name="content" id="" rows="3">{{ old('content') }}</textarea>

                            @error('content')
                                <div class="alert alert-primary" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status">Image</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    {{-- <input type="file" class="custom-file-input" id="inputGroupFile02" name="images[]" multiple> --}}
                                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="images">
                                    <label class="custom-file-label" for="inputGroupFile02"
                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="status">Catagory</label>
                            <select class="form-control" name="catagory" id="catagory">
                                <option>Select catagory</option>
                                @foreach ($catagory as $item)
                                    <option value="{{ $item->id }}">{{ $item->catagory }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option>Select Status</option>
                                <option value="published">Published</option>
                                <option value="Draft">Draft</option>

                            </select>
                        </div>

                        <div class="row">
                            <div class="col">
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>



                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
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
                    if (response.success) {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        }).then((request) => {
                            if (request.isConfirmed)
                                window.location.href = "{{ route('post.index') }}";
                        })
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
    </script>
@endsection
