@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Изменить роль</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('role.index')}}">Назад</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('role.update' ,['id'=>$role->id])}}" method="post">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" value="{{$role->name}}" name="name" class="form-control" placeholder="Наименование" required>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary btn-block" value="Изменить">
                            </div>
                            @if($errors)
                                @foreach($errors->all() as $error)
                                    <p class="m-1 text-danger">{{$error}}</p>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection