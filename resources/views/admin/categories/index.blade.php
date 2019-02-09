@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Категории</h2>
                        <a class="btn btn-success btn-sm" href="{{route('category.create')}}">Добавить</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td class="d-flex">
                                            <form method="post" action="{{route('category.delete', ['id' => $category->id ])}}">
                                                {{csrf_field()}}
                                                <input type="submit" value="Удалить" class="btn btn-danger btn-sm mr-1">
                                            </form>
                                            <a href="{{route('category.edit' ,['id'=>$category->id ])}}" class="btn-sm btn btn-primary">Изменить</a>
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