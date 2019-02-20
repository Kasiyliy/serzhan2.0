@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-header">
                        <h2>Заказы</h2>
                        <a class="btn btn-success btn-sm" href="{{route('order.create')}}">Добавить</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Продавец</th>
                                <th>Клиент</th>
                                <th>Цена</th>
                                <th>Принят</th>
                                <th>Действия</th>
                                <th>Принять/Отклонить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->client->first_name.' '.$order->client->last_name}}</td>
                                    <td>{{$order->price}}</td>
                                    <td><span class=' btn-sm{{$order->accepted ? " btn-success fa fa-plus-circle" : " btn-danger fa fa-minus-circle" }}' aria-hidden="true"></span></td>
                                    <td class="d-flex">
                                        <button type="button" class="btn btn-danger btn-xs mr-1" data-toggle="modal" data-target="#exampleModal{{$order->id}}">
                                            Удалить
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{route('item.delete', ['id' => $order->id ])}}">
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


                                        <a href="{{route('order.accept' ,['id'=>$order->id ])}}" class="btn btn-primary btn-xs">Изменить</a>
                                        <a href="{{route('order.show',['id'=>$order->id ])}}" class="btn fa fa-print btn-xs mr-1">
                                        </a>
                                    </td>
                                    <td>
                                        <form class="d-inline" action="{{route('order.accept' ,['id'=>$order->id ])}}"  method="post">
                                            {{csrf_field()}}
                                                @if($order->accepted)
                                                <button type="submit" class="btn btn-warning btn-xs">
                                                Отклонить
                                                </button>
                                                @else
                                                <button type="submit" class="btn btn-success btn-xs">
                                                    Принять
                                                </button>
                                            @endif
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
