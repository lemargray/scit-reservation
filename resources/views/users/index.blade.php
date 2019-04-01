@extends('layouts.main')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif
<div class="card">
<div class="card-header">Users &nbsp;&nbsp;&nbsp;<a class="action-icon" href="{{route('register')}}"><i style="color:#00ce68;" class="fas fa-user-plus"></i></a></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-mobile">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th class="hide-mobile" scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th class="hide-mobile" scope="col">Email</th>
                        <th class="hide-mobile" scope="col">Role</th>
                        <th class="hide-mobile" scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <!-- <th scope="row">{{$user->id}}</th> -->
                        <td class="hide-mobile">{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td class="hide-mobile">{{$user->email}}</td>
                        <td class="hide-mobile">{{$user->role->description}}</td>
                        <td class="hide-mobile"><span class="badge badge-{{$user->active == \App\User::LOCK? 'danger':'success'}}">{{$user->active == \App\User::LOCK? 'Locked':'Active'}}</span></td>
                        <td>
                            <a href="{{route('edit-user', ['id' => $user->id])}}"><i style="color:#00ce68;" class="action-icon fas fa-user-edit"></i></a>
                            <a href="#" onclick="disable_user({{$user->id}})"><i style="color:#e65251;" class="action-icon far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>  

<script>
    function disable_user(user_id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure you want to disable this user account?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, De-Active account!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                    'De-Activated!',
                    'The account was de-activated successfully.',
                    'success'
                )
            }
        });
    }
</script>
@endsection