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

                  <form method="post" action={{route('catagory.create')}}>
                    
                    @csrf
                    <div class="row">
                      <div class="col">
                        <label for="catagory">Catagory</label>
                        <input type="text" class="form-control" placeholder="Catagory" name="catagory">
                        @error('catagory')
                            <div class="alert alert-primary" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                      </div>
                    
                      <div class="col">
                        <label for="status">Status</label>
                      <select class="form-control" name="status" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
              
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
@endsection
