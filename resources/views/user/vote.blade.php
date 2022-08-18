@extends('layouts.app')

@section('title', 'Vote')

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
<div class="container p-3">
    <!-- <div class="row justify-content-center"> -->
        <div class="col-md-12">
            
            <div class="card bg-transparent border-light">
                @if (($election_year == null) OR ($year == null))
                    <div class="card-body m-5" style="padding: 100px 50px">
                        {{-- <h1 class="text-primary text-center">Voting has not commenced</h1> --}}
                        <h1 class="text-primary text-center"> Election Period has not been set</h1>
                        <h5 class="text-primary text-center">Email the Administrator</h5>
                    </div>
                @else
                    <div class="card-body">
                        <div class="card-header text-center bg-transparent">
                            <small class="text-secondary text-center mb-4"><em><b>Disclaimer</b>: After votes has been submitted, changes cannot be made. YOU HAVE ONLY ONE VOTE.</em></small>
                        </div>
                        <div class="m-3">
                            <h2 class="text-primary text-center"><i class="far fa-check-circle"></i>VOTE for {{ $election_year->year }} session</h2>
                            <!-- <p class="text-center">Choose your preferred candidate</p> -->
                        </div>
                        
                        @if($start_date_check)
                        <div class="row justify-content-center">
                            <div class="card m-3 border-primary shadow">
                                <div class="card-body bg-transparent m-5">
                                    <h4 class="text-center text-primary">Voting is NOT open </h4>
                                    
                                    <h5 class="text-center">Today's date is 
                                    {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                        <br>
                                            Voting opens <b class="text-primary">{{ $election_year->start_date->format('d-m-Y') }}</b>
                                        and closes <b class="text-primary">{{ $election_year->end_date->format('d-m-Y') }}</b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        @elseif($end_date_check)
                        <div class="row justify-content-center">
                            <div class="card m-3 border-primary shadow">
                                <div class="card-body bg-transparent m-5">
                                    <h4 class="text-center text-danger">Voting has CLOSED!</h4>
                                    <br>
                                    <h5 class="text-center">Today's date is 
                                    {{\Carbon\Carbon::now()->format('d-m-Y')}}
                                        <br> 
                                        
                                            Voting opened <b class="text-primary">{{ $election_year->start_date->format('d-m-Y') }}</b>
                                        and closed <b class="text-primary">{{ $election_year->end_date->format('d-m-Y') }}</b>
                                    </h5>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card border-primary shadow">
                                    <div class="card-header bg-transparent">
                                        <h4 class="text-primary">Positions</h4><i class="text-secondary">Select a position to view candidates</i>
                                    </div>
                                    <div class="card-body p-3 m-3">
                                        
                                        @csrf
                                        @foreach($offices as $office)
                                            @if (in_array($office->office_id, $officers)) 
                                            <!-- Checks the offices the user has voted for  -->
                                            <button class="position btn btn-outline-primary" value="{{ $office->office_id }}" disabled >{{ $office->office->position }}</button>
                                            <hr>
                                            @else
                                            <button class="position btn btn-outline-primary" value="{{ $office->office_id }}">{{ $office->office->position }}</button>
                                            <hr>
                                            @endif
                                        @endforeach
                                    <small><i class="text-secondary float-right">{{ $election_year->year }}</i></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <form class="form" action="{{ route('vote.store') }}" method="POST">
                                    @csrf
                            
                                    <div class='candidates'>
                                    
                                    </div>
                                    
                                </form>    
                                
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                @endif
                    
                <small class="text-secondary text-center mb-4"><em><b>Disclaimer</b>: After votes has been submitted, changes cannot be made. YOU HAVE ONLY ONE VOTE.</em></small>
            </div>

        </div>
    <!-- </div> -->
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.position').click(function(){
                if($(this).val()!= ''){   
                    var value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('candidate.fetch') }}",
                        method:'POST',
                        data: {value:value, _token:_token},
                        success: function (result)
                        {
                            $('.candidates').html(result);
                        }
                    });
                }
            });
        });
    </script>
@endsection