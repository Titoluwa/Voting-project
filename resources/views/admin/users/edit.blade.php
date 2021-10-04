@extends('admin.alayout')

@section('title', 'Students')

@section('admincontent')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary">
                <div class="card-header">
                    <h5>Edit form for {{ $user->matric_no }} --> {{ $user->last_name }}</h5>
                </div>
                <div class="card-body">
                    <form class='form' method="POST" action="{{ route('users.update',['user'=>$user]) }}">
                        @method('PATCH')    
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-5 pb-2">
                                <label for="matric_no" class="form-label">{{ __('Matric Number') }}</label>
                                <input id="matric_no" type="text" pattern="[A-Z]{3}/[0-9]{4}/[0-9]{3}" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ $user->matric_no }}" autocomplete="matric_no" autofocus>

                                @error('matric_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-7 pb-2">    
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pb-2">
                            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>

                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" autocomplete="last_name" >

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pb-2">
                            <label for="first_name" class="form-label">{{ __('First Name') }}</label>

                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autocomplete="first_name" >

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
                                    <option value="{{ $f->faculty }}" {{ $user->faculty == $f->faculty ? 'selected': ''}}>{{ $f->faculty }}</option>
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
                                    <option value="" disabled selected >Select Department</option>
                                </select>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>         
                            <div class="col-md-4 pb-2">
                                <label class="form-label" for="level">{{ __('Year') }}</label>
                                <select class="form-control" name="level" value="{{ $user->level }}" id="level">
                                    <option value="" class='text-muted'>Select Year</option>
                                    <option value="1" {{ $user->level  == '1' ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ $user->level  == '2' ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ $user->level  == '3' ? 'selected' : ''}}>3</option>
                                    <option value="4" {{ $user->level  == '4' ? 'selected' : ''}}>4</option>
                                    <option value="5" {{ $user->level  == '5' ? 'selected' : ''}}>5</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{route('users.index')}}" class="btn btn-primary">Go Back</a>
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