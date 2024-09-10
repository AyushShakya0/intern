@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="ajax"></div>
        <div class="btn btn-primary">Test Ajax</div>
    </div>
    <script>
        $(document).ready(function() {
            let click = 0;
            $('.btn').click(function() {
                if (click == 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('ajax.test') }}",
                        // data: "data",
                        // dataType: "dataType",
                        success: function(response) {
                            $('.ajax').html(response);
                        },
                        error:function(xhr,status,error){
                            $('.ajax').text("Error in ajax response");
                        }
                    });
                    click = 1;
                } else {
                    $('.form-group').remove();
                    click = 0;
                }

            });
        });
    </script>
@endsection
