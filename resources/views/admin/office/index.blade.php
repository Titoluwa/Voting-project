@extends('admin.alayout')

@section('title', 'Offices')

@section('admincontent')
<div class="col-md-6">

    <div class="card border-primary">
        <div class="card-header">
            <div class="">
                <h5 class=><i class="fa fa-list"></i> 
                {{ __('Available Positions') }}
                </h5>
            </div>
        </div>
        <div class="card-body">
            <form action="" class="form" method="POST">
                @csrf
                    
                <div class="col-md-12 pb-2">
                    <label for="position" class="col-form-label">{{ __('New Position') }}</label>
                    <input class="form-control" name="position" id="position" type="text" value="{{ old('position') }}"  autocomplete="off" required>

                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="pr-3 float-right">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add') }}
                    </button>
                </div>
            </form>
            <br><br>
            <hr>
            <div class="row">
                @foreach($offices as $office) 
                    <div class="col-md-8 px-4 pb-3">{{ $office->position }} </div>
                    <div class="col-md-4 px-4 pb-3">
                    @csrf
                    <input type="hidden" class="delete_val" value="{{ $office->id }}">
                    <button type='button' class="delete btn btn-sm btn-outline-danger" ><i class="fa fa-trash-alt"></i></button>
                    </div>
                @endforeach 
            </div>    
            <hr>                                    
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

            $('.delete').click(function(e) {
                e.preventDefault();
                
                var delete_id = $(this).closest('div').find('.delete_val').val();
                // alert(delete_id);
                swal({
                    title: "Delete Office ?",
                    text: "Are you sure you want to delete this office??",
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
                            url: "/admin/office/"+ delete_id,
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