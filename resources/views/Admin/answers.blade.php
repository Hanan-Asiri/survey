@extends('layouts.app')

@section('content')
<link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Questions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <hr>
                   
                    <ul style="list-style-type:none;">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            
                            <th scope="col">the question</th>
                            <th scope="col">the answer</th>
                            <th scope="col">user id</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              @foreach($data as $item)
                              <tr>
                                <th scope="row">{{$item->text}}></th>
                                <th scope="row">{{$item->value}}></th>
                                <th scope="row">{{$item->user_id}}</th>
                                <tr>
                               @endforeach
                               
                           
                            </tr>
                           
                        </tbody>
</table>
                      
                        
                    </ul> 
                   
                    <br>
                  
                </div>
            </div>
            <div id="fetch" name="fetch"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
       
       
        $("#question").on("change", function() {
            $('#fetch').html( '<div class="alert alert-warning" role="alert">Please write the answer</div>');
        });
         $("#save").on("click", function() {
            var name = $('#name').val();
            var mail = $('#mail').val();
         
            $.ajax({
        type: "GET",
                url: "/updateuser",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        name:name,
        mail:mail,
      
      },
     
      beforeSend: function() {    
     
              },
                success: function (response) {
                    $('#fetch').html( '<div class="alert alert-primary" role="alert">saved</div>');
                }
       
           
    
   
});
          });
    });
</script>
@endsection

