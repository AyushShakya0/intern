@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="btn btn-primary" id="show">Show</div>
    <div class="btn btn-danger" id="hide">Hide</div>
    <p>this is show and hide</p>


    <h2> this is fade in</h2>
    <div class="fase1" style="display: none">This is fade in 1</div>
    <div class="fase2" style="display: none">This is fade in 2</div>
</div>
<script>
    $(document).ready(function () {
        $('#show').click(function () { 
            $('p').show();
            $('#hide').show();
            $('.fase1').fadeIn('slow',function (){
                alert("The fase 1 is fadein")
            });
            $('.fase2').fadeIn(5000);
        });

        $('#hide').click(function () { 
            $('p').hide();
            $(this).hide();
            $('.fase1').fadeOut('slow',function (){
                alert("The fase 1 is fadeout")//callback function
            });
            $('.fase2').fadeOut(5000);
            
        });
        $('#hide').mouseover(function () { 
            let htmlcreate=$('<div></div>').text("mouse have entered hide");
            htmlcreate.attr('id', 'mouseenter');
            $('.main-container').append(htmlcreate);
            
        });
        $('#hide').mouseleave(function () { 
            $('#mouseenter').remove();
            
        });

        
    });
</script>

@endsection