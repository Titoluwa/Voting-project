@extends('admin.alayout')

@section('title', 'Students')

@section('admincontent')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header">
                    <h5><i class="fa fa-user"></i>
                Details for {{ $user->matric_no }} --> {{ $user->last_name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Matric Number: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->matric_no }}</h6>
                        </div>
                       
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Full Name: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->last_name }} {{ $user->first_name }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Email: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->email }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Faculty: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->faculty }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Department: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->department }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class=""><b>Year: </b></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="">{{ $user->level }}</h6>
                        </div>
                    </div>
                    <a class="btn btn-outline-primary mt-2 mb-2" href="{{ route('users.edit',['user'=>$user]) }}">Edit</a>
                    <!-- <form action="{{ route('users.destroy',['user'=>$user]) }}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type='submit' class="btn btn-danger">Delete</button>
                    </form> -->
                </div>
                <div class="card-footer">
                    <a href="{{route('users.index')}}" class="btn btn-primary">Go Back</a>
                </div>
            </div> 
        </div>   
    </div>
@endsection