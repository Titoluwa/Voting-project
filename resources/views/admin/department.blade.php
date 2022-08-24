@extends('admin.alayout')

@section('title', 'Departments')

@section('admincontent')
<div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card border-primary shadow-sm">
                <div class="card-header">
                   <i class="fa fa-university"></i> Departments
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dept as $d)
                                <tr>
                                    <td>{{$d->faculty}}</td>
                                    <td>{{$d->department}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 card border-primary mt-5 shadow-sm">
                <div class="card-body">
                    <p class="h4 text-primary text-center">Add Department</p>

                    <form class="form" action="{{ route('dept.store') }}" method="POST">
                        @csrf

                        
                        @if(session()->has("message"))
                        <div class="alert alert-primary" role='alert'>
                            <strong> {{session()->get('message')}} </strong>
                        </div>
                        @endif
                        {{-- <div class="form-group">
                            <label class="form-label" for="year">Year: </label>
                            <input class="col-md-12 form-control" required type="text" name="year" id="year" placeholder="{{ $previous_year }}/{{ $current_year }}" autocomplete="off">
                        </div> --}}

                        <div class="form-group">
                            <label class="form-label" for="faculty">Faculty</label>
                            <input class="col-md-12 form-control" required type="text" name="faculty" id="faculty">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="department">Department</label>
                            <input class="col-md-12 form-control" required type="text" name="department" id="department">
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