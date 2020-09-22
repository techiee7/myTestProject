@extends('layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('userData.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('userData.update',$userData->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $userData->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email ID:</strong>
                    <input type="text" class="form-control" name="email" value ="{{ $userData->email }}" placeholder="Email ID">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone Number:</strong>
                <input type="number" class="form-control" name="phone" placeholder="Phone Number" value ="{{ $userData->phone }}">
            </div>
        </div>

        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
 -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
              <label><input type="radio" name="gender" value="male" {{ $userData->gender == 'male' ? 'checked' : '' }}>Male</label>
              <label><input type="radio" name="gender" value="female" {{ $userData->gender == 'female' ? 'checked' : ''}}>Female</label>
              <label><input type="radio" name="gender" value="others" {{ $userData->gender == 'others' ? 'checked' : '' }}>Others</label>
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection