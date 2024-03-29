@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php 
                    $count = count($list_sach);
                @endphp
                <div class="card-header"><b>Liệt kê sách: Tổng {{$count}}</b></div>

                <div class="card-body">
                    <div id="thongbao"></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sách</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Slug sách</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_sach as $key =>$sach)
                                <tr>
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$sach->tensach}}</td>
                                    <td><img src="{{asset('public/uploads/sach/'.$sach->hinhanh)}}" height=200 width=180></td>
                                    <td>{{$sach->slug_sach}}</td>
                                    <td>
                                        @php
                                        $tomtat = substr($sach->tomtat,0,200);
                                        @endphp
                                        {{$sach->tomtat}}
                                    </td>
                                    <td>
                                        @if($sach->kichhoat==1)
                                            <span class="text text-success">Kích hoạt</span>
                                        @else
                                            <span class="text text-danger">Không kích hoạt</span>
                                        @endif
                                    </td>
                                    <td>{{$sach->created_at}}</br>{{$sach->created_at->diffForHumans()}}</td>
                                    <td>{{$sach->updated_at}}</br>{{$sach->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <form action="{{route('sach.destroy',[$sach->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('sach.edit',[$sach->id])}}" class="btn btn-primary">Edit</a>
                                        <button onclick="return confirm('Bạn muốn xóa sách này không?')"class="btn btn-danger">Delete</button>
                                        </form>
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
