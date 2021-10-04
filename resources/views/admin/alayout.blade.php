@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2 bg-light text-dark shadow-sm">
        <div class="m-3">
                <h6 class="mt-3 text-center"><i class="fa fa-user-shield"></i> Admin</h6>
                <hr>
                <ul class="nav flex-column mb-auto text-light">
                    <!-- <li class="nav-item">
                        <a href="/admin" class="nav-link" aria-current="page">
                        <i class="fa fa-home"></i> Home
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('users.index')}}" class="nav-link link-dark">
                        <i class="fa fa-users"></i> Students
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('setup.index')}}" class="nav-link link-dark">
                        <i class="fa fa-sliders-h"></i> Setup
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('office.index') }}" class="nav-link link-dark">
                        <i class="fa fa-user-tie"></i> Offices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('candidates.index') }}" class="nav-link link-dark">
                        <i class="fa fa-user-friends"></i> Candidates
                        </a>
                    </li>
                    <!-- <li class="nav-item dropright">
                        <a id="navbarDropdown" class="nav-link link-dark text-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user-tag"></i> Positions
                        </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('office.index') }}">
                                <i class="fa fa-user-tie"></i> Offices
                                </a>
                                <a class="dropdown-item" href="{{ route('candidates.index') }}">
                                <i class="fa fa-user-friends"></i> Candidates
                                </a>
                            </div>
                    </li> -->
                    <li>
                        <a href="{{ route('votes.index')}}" class="nav-link link-dark">
                        <i class="fa fa-poll"></i> Votes
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-10 p-5">
            @yield('admincontent') 
        </div>
    </div>
@endsection

@section('scripts')
    @yield('scripts')
@endsection