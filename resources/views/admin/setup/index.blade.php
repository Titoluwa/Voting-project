@extends('admin.alayout')

@section('title', 'Setup')

@section('admincontent')
<div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card border-primary shadow-sm">
                <div class="card-header">
                   <i class="far fa-calendar"></i> Election Year
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Voting Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($election_year as $setup)
                                <tr>
                                    <td>{{$setup->year}}</td>
                                    @if ($setup->status == 0)
                                        <td class="text-danger">
                                        <b>Election year is closed!</b>
                                        Started: {{ $setup->start_date->format('d/m/Y') }}, Ended: {{ $setup->end_date->format('d/m/Y') }}   
                                        </td>
                                    @else
                                        <td class="text-primary">
                                        Starts: {{ $setup->start_date->format('d/m/Y h:i A') }}, Ends: {{ $setup->end_date->format('d/m/Y h:i A') }} 
                                        &nbsp;<a class="btn btn-sm btn-outline-dark" href="{{ route('setup.edit',['setup'=>$setup]) }}"><i class="fa fa-edit"></i></a>
                                        
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 card border-primary mt-5 shadow-sm">
                <div class="card-body">
                    <p class="h4 text-primary text-center">Add Election Year</p>

                    <form class="form" action="{{ route('setup.store') }}" method="POST">
                        @csrf

                        
                        @if(session()->has("message"))
                        <div class="alert alert-primary" role='alert'>
                            <strong> {{session()->get('message')}} </strong>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="year">Year: </label>
                            <input class="col-md-12 form-control" required type="text" name="year" id="year" placeholder="{{ $previous_year }}/{{ $current_year }}" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="start_date">Election Start Date </label>
                            <input class="col-md-12 form-control" required type="datetime-local" name="start_date" id="start_date">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="end_date">Election End Date </label>
                            <input class="col-md-12 form-control" required type="datetime-local" name="end_date" id="end_date">
                        </div>
                        
                        <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary">
                            {{ __('Add') }}
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection            