@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px">
                    <div class="panel-header">
                        <h2>Сделать заказ</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('order.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('item.store')}}" method="post">

                            <div class="form-group">
                                <label for="client">Клиент</label>
                                <select name="client_id" class="form-control" placeholder="Клиент" required>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->first_name.' '.$client->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input type="number" disabled min="0" name="price" class="form-control" placeholder="Цена" required>
                            </div>
                            {{csrf_field()}}
                            <div id="products">

                            </div>
                            <a id="addProduct" class="btn btn-success btn-sm">Добавить товар</a>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#addProduct').on('click' , function () {
                $.ajax({
                    url : '/api/products',
                    type : 'GET',
                    success : function(resp){

                        if(resp.length >0){
                            var div = document.createElement('div');
                            div.className = "form-group";
                            var label = document.createElement('label');
                            label.innerText = 'Продукт';
                            div.append(label);

                            var select = document.createElement('select');
                            select.className = "form-control";
                            for(var i = 0 ; i < resp.length ; i++){
                                var option = document.createElement('option');
                                option.value = resp[i].id;
                                option.innerText = resp[i].name;
                                select.append(option);

                            }
                            div.append(select);
                            $('#products').append(div);

                        }else{
                            toastr.error('error' , 'Продукты отсутствуют!');
                        }
                    },
                    error : function (error) {
                        
                    }
                });
            });
        });
    </script>
@endsection