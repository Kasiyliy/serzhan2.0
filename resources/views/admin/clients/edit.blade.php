@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Изменить данные о клиенте</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('client.index')}}">Назад</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('client.update' ,['id'=>$client->id])}}" method="post">
                            <div class="form-group">
                                <label for="first_name">Имя</label>
                                <input type="text" value="{{$client->first_name}}" name="first_name" class="form-control" placeholder="Имя: " required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Фамилия</label>
                                <input type="text" value="{{$client->last_name}}" name="last_name" class="form-control" placeholder="Фамилия: " required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Телефон</label>
                                <input type="text" value="{{$client->phone_number}}" name="phone_number" class="form-control" placeholder="Телефон: ">
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