@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cấp vai trò cho user : {{$user->name}}</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{url('/insert_roles',[$user->id])}}" method="POST">
                  @csrf
                   {{--<p>Vai trò hiện tại :{{$name_roles}}</p>--}} 
                @foreach($role as $key => $r)
                @if(isset($all_column_roles))
                <div class="form-check form-check-inline">
                  <input class="form-check-input" {{$r->id==$all_column_roles->id ? 'checked' : ''}} type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                  <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                </div>
                @else
                <div class="form-check form-check-inline">
                  <input class="form-check-input"type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                  <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                </div>
                @endif
                @endforeach
                <br>
                <input type="submit" name="insertroles" value="Cấp vai trò" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
