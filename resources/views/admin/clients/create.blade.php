@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-header" style="padding: 10px">
                        <h2>Добавить клиента</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('client.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('client.store')}}" method="post">
                            <div class="form-group">
                                <label for="first_name">Имя</label>
                                <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control" placeholder="Имя: " required>
                                <label for="last_name">Фамилия</label>
                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control" placeholder="Фамилия: " required>
                                <label for="phone_number">Телефон</label>
                                <input type="text" value="{{old('phone_number')}}" name="phone_number" class="form-control" placeholder="Телефон: " >
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Добавить">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection