@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="pb-3 text-center text-primary">
           <h3> <i class="fa fa-user-circle"></i> {{ __('Login') }} </h3>
        </div>
        <div class="words pb-3">
            {{-- <p>Hi, so this is my first Laravel Project.</p>
            <p>It is a voting web application that is built based on the enviroment of a university for a student body election process.</p> --}}
            <p>
               &nbsp; &nbsp; &nbsp; &nbsp; This website was created to allow all student any department in the university 
                to vote for their preferred candidate for each position in the
                student body association a university (but Obafemi Awolowo University was my case study). 
                Every student has a right to vote and every student will vote count. 
            </p>
        </div>
        <br>
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header">
                    {{-- <h5 class="text-center text-primary">
                        <i class="fa fa-user-circle"></i> {{ __('Login') }}</h5> --}}
                </div>
                
                <div class="card-body mt-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-sm btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
