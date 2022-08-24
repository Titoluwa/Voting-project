@extends('admin.alayout')

@section('title', 'Candidates')

@section('admincontent')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-primary">
                <div class="card-header clearfix">
                    <div class="float-left">
                        <h5 class="mt-2"><i class="fa fa-user-friends"></i> 
                        {{ __('Candidates') }}
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    @if($office == null)
                        <h5 class="text-center text-primary">No Candidate Registered </h5>
                    @else
                        <ol>
                            
                            @foreach($offices as $office)
                                <li class="pb-1">{{ $office->position }} </li>                              
                                    @foreach($candidates as $candidate)
                                        @if ($candidate->office_id == $office->id)
                                        <div class="row pb-1 px-2">
                                            <div class="col-md-8 pl-4">{{$candidate->user->last_name}} {{$candidate->user->first_name}}</div> 
                                            <div class="col-md-4">
                                                @csrf
                                            <input type="hidden" class="delete_val" value="{{ $candidate->id }}">    
                                            <button type='button' class=" delete btn btn-sm btn-outline-danger" ><i class="fa fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                <hr>
                            @endforeach
                        </ol>

                        <ul>
                            
                        </ul>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-5">
            
            
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header">
                        
                        <h5 class=><i class="fa fa-user-plus"></i> 
                        {{ __('Add New Candidate') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($election_year == null)
                            <h5 class="text-center text-primary">Set your Election Year</h5>
                        @else
                            <form action="" method="POST">
                                @csrf

                                <label class="pb-2" for="office_id">Office: </label>  
                                <div class="input-group pb-2">
                                    <select name="office_id" id="" class='form-control'>
                                        <option value="" disabled selected hidden>Select Office</option>
                                        @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{$office->position}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='text-danger pb-2'>{{ $errors->first('office_id') }}</div>

                                <label class="pb-2" for="user_id">Student: </label>  
                                <div class="input-group pb-2">
                                    <select name="user_id" id="" class='form-control'>
                                        <option value="" disabled selected hidden>Select Student</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->last_name }} {{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='text-danger pb-2'>{{ $errors->first('user_id') }}</div>

                                <label class="pb-2" for="election_year_id">Year: </label>  
                                <div class="input-group pb-2">
                                    <select name="election_year_id" id="" class='form-control'>
                                        <option value="{{ $election_year->id }}">{{ $election_year->year }}</option>
                                    </select>
                                </div>
                                <div class='text-danger pb-2'>{{ $errors->first('election_year_id') }}</div>
                                
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                
                var delete_id = $(this).closest('div').find('.delete_val').val();
                // alert(delete_id);
                swal({
                    title: "Delete Candidate?",
                    text: "Are you sure you want to delete this candidate's record??",
                    icon: "warning",
                    buttons: ["Cancel","Delete"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/candidates/"+ delete_id,
                            data: data,
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@endsection