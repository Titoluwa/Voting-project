@extends('layouts.app')

@section('title', 'Results')

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
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="title pb-3 text-center text-primary">
            
        </div>
        <div class="col-md-10">
            
            <div class="card p-3 border-primary shadow">
            @if ($year == null)
                <div class="card-body m-5" style="padding: 100px 50px">
                    <h1 class="text-primary text-center">Results cannot be viewed</h1>
                    <h2 class="text-primary text-center"> Election Period has not been set</h2>
                    <h5 class="text-primary text-center">Email the Administrator</h5>
                </div>
            @else
                <div class="card-body">
                    <h4 class="text-primary text-center p-3">Results of {{ $year->year }} election</h4>
                    
                    @if($end_date_check)
                    <h5 class="text-center">Nothing to see here yet!</h5> 
                    @else
                    @foreach($offices as $office)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan=2><h5 class="text-primary">{{ $office->position }}</h5></td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    
                                    <td><b> Candidate Name </b></td>
                                    <td><b> Number of votes </b></td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($candidates as $candidate) 
                                @if ($candidate->office_id == $office->id)
                                    <tr>
                                        
                                        <td>{{$candidate->user->last_name}} {{$candidate->user->first_name}}</td>
                                        <td> o
                                        @foreach($votes as $vote)
                                            @if ($candidate->id == $vote->candidate_id)
                                                
                                                <b> {{ $vote->candidate_vote($vote->candidate_id, $vote->election_year_id) }} </b>
                                                @if($vote->candidate_vote($vote->candidate_id, $vote->election_year_id) == $vote->winner($office->id, $vote->election_year_id) )
                                                <strong class="text-success px-2">(Winner!)</strong>
                                                @endif
                                                @break
                                            @endif
                                        @endforeach
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        
                        <br>
                    @endforeach
                    <em class='text-secondary'>Total number of votes: {{ count($votes) }}</em>
                    @endif
                    
                </div>
            @endif
                
            </div>

        </div>
    </div>
</div>
@endsection
