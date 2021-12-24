@extends('layouts.app')

@section('content')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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

                    Choose the question and then choose the appropriate answer
                    <br>
                    <hr>
                    Choose the question
                    <ul style="list-style-type:none;">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-12">
                             <select class="browser-default custom-select" id="question" name="question">
                             <option value="0" > Choose the question </option>
                        @foreach($data as $item)
                    <option value="{{$item->id}}"><span style="font-size: 0.4em;">{{$item->text}}</span></option>
                        @endforeach
                     
                    </select>
                        </div>
                        </div>

                    </div>
                   
                    </div>
                        
                    </ul> 
                    choose answer
                    <ul style="list-style-type:none;">
                    
                <div class="form-outline" id="option">
             
               
                </div>
                        
                    </ul> 
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-3">
                        </div>
                            <div class="col-sm-9">
                            <button type="button" id="save" name="save" class="btn btn-primary">Save</button>
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
            var question_id = $('#question').val();
            var value = $('#answer').val();
            $.ajax({
        type: "GET",
                url: "/getoptions",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        question_id:question_id,
      
      
      },
     
      beforeSend: function() {    
       
              },
                success: function (response) {
                    $("#option").empty();
                    $.each(response.res, function (key, item) {
                   
                    $('#option').append( '<div class="custom-control custom-radio mb-3" >\
                                      <input type="radio" class="custom-control-input" id="p1" name="p1"  value=' + item.OptionID + '   required>\
                                      <label class="custom-control-label" for="p1" ><h5 class="heading-md text-danger"></h5><small>(' + item.OptionText + ')</small></label>\
                                    </div>\
                               \ </div>');
                    });
                }
       
           
    
   
});
          
        });
         $("#save").on("click", function() {
            var question_id = $('#question').val();
            var val=$("input[name='gender']:checked").val();
            var i = 0;          
            $.ajax({
        type: "GET",
                url: "/createnewanswer",
                dataType: "json",
                data:{
        "_token": "{{ csrf_token() }}",
        question_id:question_id,
     
      
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

