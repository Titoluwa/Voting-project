@extends('admin.alayout')

@section('title', 'Setup')

@section('admincontent')
<div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="col-md-8 card border-primary p-4 shadow-sm">
                <div class="card-body">
                    <p class="h4 text-primary text-center"> Date for the <b>{{ $setup->year }}</b> election</p>
                        @if(session()->has("message"))
                        <div class="alert alert-primary" role='alert'>
                            <strong> {{session()->get('message')}} </strong>
                        </div>
                        @endif
                        @if(! session()->has("message"))
                        <form class="form" action="{{ route('setup.update',['setup'=>$setup]) }}" method="POST">
                            @method("PATCH")
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="year">Year: </label>
                                <input class="col-md-12 form-control" type="text" name="year" id="year" value="{{ $setup->year }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="start_date">Election Start Date </label>
                                <input class="col-md-12 form-control" type="datetime-local" name="start_date" id="start_date" value="{{ $setup->start_date->format('Y-m-d\TH:i') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="end_date">Election End Date </label>
                                <input class="col-md-12 form-control" type="datetime-local" name="end_date" id="end_date"  value="{{ $setup->end_date->format('Y-m-d\TH:i') }}">
                            </div>
                            
                            <div class="float-right">
                            <button type="submit" class="btn btn-outline-primary">
                                {{ __('Change') }}
                            </button>
                            </div>
                            
                        </form>
                        @endif
                </div>
            </div>
        </div>
        
    </div>
@endsection            