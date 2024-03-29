@extends('layouts.app')



@section('usernav')
    <!-- <li class="nav-item">
        <a class="nav-link text-primary" aria-current="page" href="{{ route('user') }}">Home</a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link text-primary" href="{{ route('user.register') }}">Register</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-primary" href="{{ route('user.vote') }}">Vote</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-primary" href="{{ route('user.results') }}">View Results</a>
    </li>
@endsection

@section('content')
<div class="container pt-3 pb-5">
    <div class="row justify-content-center">
        <div class="title pb-3 text-center text-primary">
            Welcome to the Voting Platform !
        </div>
        <div class="words">
            {{-- <p>Hi, so this is my first Laravel Project.</p>
            <p>It is a voting web application that is built based on the enviroment of a university for a student body election process.</p> --}}
            <p>
                &nbsp; &nbsp; &nbsp; &nbsp; To procced to voting for your preferred candidate, each student must first
                register and indicate if they want to contest and for which office they would be contesting 
                for. The registration period will be made known to the students. 
                After the sitpulated time for registration has elasped, a date and time would be set 
                for voting. Each will student will login and vote for their candidate.
                And once the voting lines is closed, everyone can check the results
                on the website after it has been made available.
            </p>
        </div>
        <div class="col-md-8">
            
            <div class="card shadow">
                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::check())
                    <h5 class="text-primary">Welcome, {{Auth::user()->first_name}}</h5>
                    @endif
                    {{ __('You are logged in! Ready to Vote?') }}
                    <div class="pt-3">
                        <div class="p-1">Do you want to contest for an office?</div>
                        <a href="{{ route('user.register') }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i> Register Here</a>
                    </div>
                    <hr>
                    
                    <div>
                        <a href="{{ route('user.vote') }}" class="btn btn-lg btn-outline-primary"><i class="fa fa-vote-yea"></i> Vote Here</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
