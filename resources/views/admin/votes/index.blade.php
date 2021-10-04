@extends('admin.alayout')

@section('title', 'Votes')

@section('admincontent')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary shadow-sm">
                <div class="card-header">
                    <h5 class="mt-2">
                        <i class="fa fa-poll-h"></i> 
                        Votes for {{$election_year->year}}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="col-md-10">
                    @foreach($offices as $office)
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td colspan=3><h4 class="text-primary">{{ $office->position }}</h4></td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                   
                                    <td><b>Candidate Name</b></td>
                                    <td><b>Number of votes</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($candidates as $candidate) 
                                @if ($candidate->office_id == $office->id)
                                    <tr>
                                        
                                        <td>{{$candidate->user->last_name}} {{$candidate->user->first_name}}</td>
                                        <td> 
                                        <form action="{{ route('votes.store') }}" method="POST">
                                        @csrf
                                        @foreach($votes as $vote)
                                            @if ($candidate->id == $vote->candidate_id)
                                                <b> {{ $vote->candidate_vote($vote->candidate_id, $vote->election_year_id) }} </b>
                                                @if($vote->candidate_vote($vote->candidate_id, $vote->election_year_id) == $vote->winner($office->id, $vote->election_year_id) )
                                                <strong class="text-success px-3">(Winner!)</strong>
                                                    <!-- set the candidate successflag to 1 (as the winner) -->
                                                    
                                                    @if($candidate->success_flag == 0)
                                                        <input type="hidden" name="candidate_id" value="{{$candidate->id}}">
                                                        <div class="float-right"><button class="btn btn-sm btn-outline-secondary" type="submit">Set as Winner</button></div>
                                                    @else
                                                        <div class="float-right"><button class="btn btn-sm btn-outline-secondary" type="submit" disabled>Set as Winner</button></div>
                                                    @endif
                                                @endif
                                                @break
                                            @endif
                                        @endforeach
                                        </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tfoot>
                                <tr>
                                    @foreach($winners as $winner)
                                        @if($winner->office_id == $office->id)
                                        <td colspan=3><h5 class="text-primary"><b>Winner: {{ $winner-> user->last_name }} {{ $winner-> user->first_name }}</b></h5></td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    @endforeach
                        <em class='text-secondary'>Total number of votes: {{ count($votes) }}</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection            