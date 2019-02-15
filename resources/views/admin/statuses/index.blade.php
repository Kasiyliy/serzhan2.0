@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Статусы</h2>
                        <a class="btn btn-success btn-sm" href="{{route('status.create')}}">Добавить</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{$status->id}}</td>
                                    <td>{{$status->name}}</td>
                                    <td class="d-flex">

                                        <button type="button" class="btn btn-danger btn-xs mr-1" data-toggle="modal" data-target="#exampleModal{{$status->id}}">
                                            Удалить
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$status->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{route('status.delete', ['id' => $status->id ])}}">
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


                                        <a href="{{route('status.edit' ,['id'=>$status->id ])}}" class="btn-xs btn btn-primary">Изменить</a>
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