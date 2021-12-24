@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <ul style="list-style-type:none;">
                        <li><h4><a href="{{route('my-getquestionadmin') }}">Questions</a></h4></li>
                        <li><h4><a href="{{route('my-createoptions') }}">Options</a></h4></li>
                        <li><h4><a href="{{route('my-getanswre') }}">the answers</a></h4></li>
                    
                        
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
