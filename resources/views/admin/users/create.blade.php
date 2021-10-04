@extends('admin.alayout')

@section('title', 'Add Student')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header pt-3 pb-2"><h4 class="text-primary">{{ __('Student Registration') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.index') }}">
                        @csrf
                            
                        <div class="form-group row">
                            <div class="col-md-5 pb-2">
                                <label for="matric_no" class="col-form-label">{{ __('Matric Number') }}</label>
                                <input id="matric_no" type="text" pattern="[A-Z]{3}/[0-9]{4}/[0-9]{3}" placeholder="CSC/2011/001" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ old('matric_no') }}"  autocomplete="matric_no" autofocus>

                                @error('matric_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-7 pb-2">    
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pb-2">
                            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>

                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="last_name" >

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pb-2">
                            <label for="first_name" class="form-label">{{ __('First Name') }}</label>

                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  autocomplete="first_name" >

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pb-2">
                            <label for="faculty" class="form-label">{{ __('Faculty') }}</label>
                                <select name="faculty" id="faculty" class="form-control dynamic" data-dependant='department' >
                                    <option value="" disabled selected hidden>Select Faculty</option>
                                    @foreach($faculty as $f)
                                    <option value="{{ $f->faculty }}">{{ $f->faculty }}</option>
                                    @endforeach
                                </select>
                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-8 pb-2">
                            <label for="department" class="form-label">{{ __('Department') }}</label>
                                <select class="form-control" name="department" id="department">
                                    <option value="" disabled selected hidden>Select a Faculty</option>
                                </select>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>         

                            <div class="col-md-4 pb-2">
                                <label class="form-label" for="level">{{ __('Year') }}</label>
                                <select class="form-control" name="level" id="level">
                                    <option value="" disabled selected hidden>Select Year</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 pb-2">    
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 pb-2">    
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            $('.dynamic').change(function(){
                if($(this).val()!= ''){   
                    var value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('dept.fetch') }}",
                        method:'POST',
                        data: {value:value, _token:_token},
                        success: function (result)
                        {
                            $('#department').html(result);
                        }
                    });
                }
            });
        });
    </script>
@endsection