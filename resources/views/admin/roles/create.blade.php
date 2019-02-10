@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Добавить роль</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('role.index')}}">Назад</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('role.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" name="name" class="form-control" placeholder="Наименование" required>
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