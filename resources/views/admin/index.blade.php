@extends('admin.alayout')

@section('title', 'Adminstrator')

@section('admincontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary p-5 shadow-sm">
                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::check())
                    <h3 class="text-primary">Welcome, {{Auth::user()->first_name}}</h3>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

@endsection
