@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-header">
                        <h2>Клиенты</h2>
                        <a class="btn btn-success btn-sm" href="{{route('client.create')}}">Добавить</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Телефон</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->id}}</td>
                                        <td>{{$client->first_name}}</td>
                                        <td>{{$client->last_name}}</td>
                                        <td>{{$client->phone_number}}</td>


                                        <td class="d-flex">

                                            <button type="button" class="btn btn-danger btn-xs mr-1" data-toggle="modal" data-target="#exampleModal{{$client->id}}">
                                                Удалить
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post" action="{{route('client.delete', ['id' => $client->id ])}}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Предупреждение!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Вы точно хотите удалить?
                                                                {{csrf_field()}}


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Отмена</button>
                                                                <input type="submit" value="Удалить" class="btn btn-danger btn-sm mr-1">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <a href="{{route('client.edit' ,['id'=>$client->id ])}}" class="btn-xs btn btn-primary">Изменить</a>
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