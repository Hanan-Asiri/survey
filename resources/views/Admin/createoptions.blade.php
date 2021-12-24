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

                    Choose the question and then choose the appropriate option
                    <br>
                    <hr>
                    Choose the question
                    <ul style="list-style-type:none;">
                    <select class="browser-default custom-select" id="question" name="question">
                        @foreach($data as $item)
                    <option value="{{$item->id}}">{{$item->text}}</option>
                        @endforeach
                     
                    </select>
                      
                        
                    </ul> 
                   Add - option
                    <br>
                    <ul style="list-style-type:none;">
                    
                <div class="form-outline">
                <input type="text" id="answer" name="answer" class="form-control" />
               
                </div>
                        
                    </ul> 
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-3">
                        </div>
                            <div class="col-sm-9">
                            <button type="button" id="save" name="save" class="btn btn-primary">Save</button>
                            <button type="button" id="delete" name="delete" class="btn btn-primary">delete</button>
                            <button type="button" id="update" name="update" class="btn btn-primary">update</button>
                            </div>
                        </div>
                    </div>
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
            var question_id = $('#question').val();
            var value = $('#answer').val();
            $.ajax({
        type: "GET",
                url: "/createnewoption",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        question_id:question_id,
        text:value,
      
      },
     
      beforeSend: function() {    
     
              },
                success: function (response) {
                    $('#fetch').html( '<div class="alert alert-primary" role="alert">saved</div>');
                }
       
           
    
   
});
          });
          $("#delete").on("click", function() {
            var question_id = $('#question').val();
            var value = $('#answer').val();
            $.ajax({
        type: "GET",
                url: "/deletequestion",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        question_id:question_id,
        text:value,
      
      },
     
      beforeSend: function() {    
     
              },
                success: function (response) {
                    $('#fetch').html( '<div class="alert alert-primary" role="alert">Updated</div>');
                }
       
           
    
   
});
          });
          $("#update").on("click", function() {
            var question_id = $('#question').val();
            var value = $('#answer').val();
            $.ajax({
        type: "GET",
                url: "/updatequestion",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        question_id:question_id,
        text:value,
      
      },
     
      beforeSend: function() {    
     
              },
                success: function (response) {
                    $('#fetch').html( '<div class="alert alert-primary" role="alert">Updated</div>');
                }
       
           
    
   
});
          });
    });
</script>
@endsection

