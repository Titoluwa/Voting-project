@extends('admin.alayout')

@section('title', 'Students')

@section('admincontent')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header clearfix">
                    <div class="float-left">
                        <h5 class="mt-2"><i class="fa fa-users"></i> 
                        {{ __('All Registered Student') }}
                        </h5>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary">Register a new Student</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table" style="width:100%">
                            
                            <thead>
                                <tr>
                                    <th>Matric Number</th>
                                    <th>Email</th>
                                    <th>Last Name</th>
                                    <th>Faculty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <input type="hidden" class="delete_val" value="{{ $user->id }}">
                                    <td>{{ $user->matric_no }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->faculty }}</td>
                                    <td>
                                        <a href="{{ route('users.show',['user'=>$user]) }}" class='btn btn-sm btn-outline-primary'><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('users.edit',['user'=>$user]) }}" class='btn btn-sm btn-outline-primary'><i class="fa fa-user-edit"></i></a>
                                        @csrf
                                        <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#myTable').DataTable();

        })
    </script> -->
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                
                var delete_id = $(this).closest('tr').find('.delete_val').val();
                // alert(delete_id);
                swal({
                    title: "Are you sure want to Delete?",
                    text: "You will not be able to recover this student's records",
                    icon: "warning",
                    buttons:["Cancel","Delete"],
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
                            url: "/admin/users/"+ delete_id,
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