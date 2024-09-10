<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="model-title">Create Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                    <input type="file" class="custom-file-input" id="inputGroupFile02"
                                        name="images">
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
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary model-button">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>



{{-- update data model --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="model-title">Update Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data" class="post_update">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="catagory">Title</label>
                            <input type="text" class="form-control title" placeholder="Title" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-primary" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="content">Content</label>

                            <textarea class="form-control content" name="content" id="" rows="3">{{ old('content') }}</textarea>

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
                                    <input type="file" class="custom-file-input" id="inputGroupFile02"
                                        name="image">
                                    <label class="custom-file-label" for="inputGroupFile02"
                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                            <img src="" alt="" width="100" height="100">
                        </div>

                        <div class="col-md-6">
                            <label for="status">Catagory</label>
                            <select class="form-control catagory" name="catagory" id="catagory">
                                <option>Select catagory</option>
                                @foreach ($catagory as $item)
                                    <option value="{{ $item->id }}">{{ $item->catagory }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control status" name="status" id="status">
                                <option>Select Status</option>
                                <option value="published">Published</option>
                                <option value="Draft">Draft</option>

                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update-button">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
