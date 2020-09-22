@extends('layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Login</h2>
        </div>
    </div>
</div>

@if($msg)
<div class="alert alert-danger">
    <strong>Whoops!</strong> Invalid details.<br><br>
    <ul> 
        {{ $msg }}
    </ul>
</div>
@endif

<form action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
  
     <div class="row">
         
        <div class="col-xs-6 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
        </div>

        <div class="col-xs-6 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection  