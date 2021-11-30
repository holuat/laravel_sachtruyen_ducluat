@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Liệt kê User</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên User</th>
                            <th scope="col">Email</th>
                            <!-- <th scope="col">Password</th> -->
                            <th scope="col">Vai trò(Role)</th>
                            <th scope="col">Quyền(Permissions</th>
                            <th scope="col">Quản lý</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $key => $u)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <th scope="row">{{$u->name}}</th>
                                <th scope="row">{{$u->email}}</th>
                                <!-- <th scope="row">{{$u->password}}</th> -->
                                <th scope="row">
                                    @foreach($u->roles as $key =>$role)   
                                        {{$role->name}}
                                    @endforeach
                                </th>
                                <th scope="row">
                                    @foreach($role->permissions as $key =>$permission)
                                        <h6><span class="badge badge-danger">{{$permission->name}}</span></h6>
                                    @endforeach
                                </th>
                                @role('admin')
                                <th scope="row">
                                    <a href="{{url('phan-vaitro/'.$u->id)}}" class="btn btn-success">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-danger">Phân quyền</a>
                                    <a href="{{url('/impersonate/user/'.$u->id)}}" class="btn btn-primary">Chuyển quyền nhanh</a>
                                </th>
                                @endrole
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
