@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-header" style="padding: 10px">
                        <h2>Изменить данные о должнике</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('debtor.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('debtor.update' ,['id'=>$debtor->id])}}" method="post">
                            <div class="form-group">

                                <label for="orders">Заказ</label>
                                <input type="number" readonly name="orders" value="{{$debtor->order_id}}" class="form-control" placeholder="Заказ: " >

                                <label for="price">Сумма</label>
                                <input type="number" name="price" value="{{$debtor->price}}" class="form-control" placeholder="Сумма: " >


                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Изменить">
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