@extends('layouts.app')

@section('title', 'Office Registration')

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
        <div class="col-md-8">
            <div class="card border-primary shadow">
                <div class="card-body m-3">
                    <h4 class="text-primary text-center">Register for an Office</h4>

                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card border-white">
                                <div class="card-body">
                                    <form action="" disabled method="POST">
                                        @csrf
                                        @if($end_date_check)
                                        <div class="alert alert-primary text-center" role='alert'>
                                            <strong> Electoral process is over</strong>
                                            <p>Go to View Results.</p>
                                        </div>
                                        @elseif($start_date_check)
                                        <div class="alert alert-primary text-center" role='alert'>
                                            <strong> Voting has started</strong>
                                            <p>You can't register for this election period.</p>
                                        </div>
                                        @else
                                        @if(in_array($id, $users))
                                            <div class="alert alert-primary text-center" role='alert'>
                                                <strong> You have registered for an Office  </strong>
                                                <p>Check the confirmatory email sent to you!</p>
                                            </div>
                                            @else
                                            @if(Auth::check())
                                            <label class="pb-1" for="user_id">{{ __('Matric Number:') }} </label>  
                                            <div class="input-group pb-1">
                                                <select name="user_id" id="" class='form-control'>
                                                                            
                                                    <option value="{{Auth::user()->id}}" selected>{{Auth::user()->matric_no}}</option>  
                                                </select>
                                            </div>
                                            <div class='text-danger pb-1'>{{ $errors->first('user_id') }}</div>

                                            @endif
                                            <label class="pb-1" for="office_id">{{ __('Office:') }} </label>  
                                            <div class="input-group pb-1">
                                                <select name="office_id" id="" class='form-control'required>
                                                    <option value=""selected disabled>Select Office</option>
                                                    @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}">{{$office->position}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='text-danger pb-1'>{{ $errors->first('office_id') }}</div>

                                            <label class="pb-1" for="election_year_id">{{ __('Year:') }} </label>  
                                            <div class="input-group pb-1">
                                                <select name="election_year_id" id="" class='form-control'>
                                                   
                                                        <option value="{{ $election_year->id }}">{{ $election_year->year }}</option>
                                                
                                                </select>
                                            </div>
                                            <div class='text-danger pb-1'>{{ $errors->first('election_year_id') }}</div>
                                            
                                            <div class="float-right  mt-2">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    {{ __('Apply') }}
                                                </button>
                                            </div>
                                            @endif
                                        @endif   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
