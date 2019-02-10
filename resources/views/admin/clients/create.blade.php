@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Добавить клиента</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('client.index')}}">Назад</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('client.store')}}" method="post">
                            <div class="form-group">
                                <label for="first_name">Имя</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Имя: " required>
                                <label for="last_name">Фамилия</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Фамилия: " required>
                                <label for="phone_number">Телефон</label>
                                <input type="text" name="phone_number" class="form-control" placeholder="Телефон: " >
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Добавить">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection