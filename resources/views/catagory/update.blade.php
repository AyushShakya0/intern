@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href={{ route('catagory') }}>Catagory</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href={{ route('catagory.index') }}>Create</a>
                        </li>
                                            
                      </ul>

                    </div>
                  </nav>

                  <form method="post" action={{url('/catagory/update_data/'.$catagory_data->id)}}>
                    @method('PUT')
                    
                    @csrf
                    <div class="row">
                      <div class="col">
                        <label for="catagory">Catagory</label>
                        <input type="text" class="form-control" placeholder="Catagory" name="updatecatagory" value="{{ $catagory_data->catagory }}">
                        @error('catagory')
                            <div class="alert alert-primary" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                      </div>
                    
                      <div class="col">
                        <label for="status">Status</label>
                      <select class="form-control" name="updatestatus" id="status">
                        <option value="1" {{$catagory_data->status==1?'selected':''}}>Active</option>
                        <option value="0"  {{$catagory_data->status==0?'selected':''}}>Inactive</option>
              
                      </select>
                    </div>
                    
                      <div class="row">
                        <div class="col">
                            <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                 

                
                    </div>
                  </form>

            </div>
        </div>
    </div>
@endsection
