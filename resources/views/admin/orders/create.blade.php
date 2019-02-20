@extends('layouts.admin')
@section('styles')
    <style>
        label.switch {
            text-align: left;
            width: 60px;
            height: calc(60px / 2);
            border-radius:60px;
            background-color:#4ed164;
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        label.switch > span {
            display: block;
            width: 100%;
            height: 100%;
        }

        label.switch > input[type="checkbox"] {
            opacity: 0;
            position: absolute;
        }

        label.switch > span:before, label.switch > span:after {
            content: "";
            cursor: pointer;
            position: absolute;
        }

        label.switch > input[type="checkbox"]:focus ~ span {
            box-shadow: 0 0 0 4px #43b556;
        }

        label.switch > input[type="checkbox"]:checked:focus ~ span {
            box-shadow: 0 0 0 4px #fff;
        }

        label.switch > span {
            border-radius: 60px;
        }

        label.switch > span:before {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            background-color: #f1f1f1;
            border-radius: 60px;
            transition: opacity .2s ease-out .1s, transform .2s ease-out .1s;
            transform: scale(1);
            opacity: 1;
        }

        label.switch > span:after{
            top: 50%;
            z-index: 3;
            transition: transform .4s cubic-bezier(0.44,-0.12, 0.07, 1.15);
            width: calc(60px / 2);
            height: calc(60px / 2);
            transform: translate3d(0, -50%, 0);
            background-color: #fff;
            border-radius: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
        }

        label.switch > input[type="checkbox"]:checked ~ span:before {
            transform: scale(0);
            opacity: .7;
        }

        label.switch > input[type="checkbox"]:checked ~ span:after {
            transform: translate3d(100%, -50%, 0);
        }
    </style>
@endsection
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

                        <div class="row text-right">
                            <h4>Изменять цены</h4>
                            <div class="col-sm-12">
                                <label class="switch" id="mySwitch">
                                    <input type="checkbox" >
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <form action="{{route('order.store')}}" method="post">

                            <div class="form-group">
                                <label for="client">Клиент</label>
                                <select name="client_id" class="form-control selectpicker" data-live-search="true" placeholder="Клиент" required>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->first_name.' '.$client->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{csrf_field()}}
                            <div id="products">

                            </div>
                            <div class="form-group">
                                <a id="addProduct" class="btn btn-primary btn-sm">Добавить товар</a>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="price">Цена</label>
                                        <input type="number" readonly min="0" value="0" name="price" id="overallPrice" class="form-control" placeholder="Цена" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit"  id="makeOrder" class="btn btn-success btn-block" value="Сделать заказ">
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


            $('#makeOrder').on('click',function(event){
                if(parseFloat($('#overallPrice').val()) == 0){
                    event.preventDefault();
                    toastr.warning('Внимание!', "Выберите товары!");
                }
            });

            var switchValue = false;

            $('#mySwitch').on('change', function(){
                switchValue = !switchValue;

                $('.my-switches').each(function (obj) {
                    $(this).attr('readonly', !switchValue);
                });

                $('.selectpicker').each(function(){
                   $(this).trigger("change");
                });
            });
            
            function evalPrice(){
                var price = 0;
                $('.my-switches').each(function(index){
                    var quantityInput = $('.my-quantity');
                    if($(this).val() && quantityInput[index].value){
                        price += (parseInt($(this).val())* parseInt(quantityInput[index].value));
                    }
                });


                $('#overallPrice').val(price);
            }

            $('#addProduct').on('click' , function () {
                evalPrice();
                $.ajax({
                    url : '/api/products',
                    type : 'GET',
                    success : function(resp){

                        if(resp.length > 0){


                            var div = document.createElement('div');
                            div.className = "form-group row";
                            var innerDiv1 = document.createElement('div');
                            innerDiv1.className = "col-sm-4";

                            var innerDiv2 = document.createElement('div');
                            innerDiv2.className = "col-sm-4";

                            var innerDiv3 = document.createElement('div');
                            innerDiv3.className = "col-sm-3";

                            var innerDiv4 = document.createElement('div');
                            innerDiv4.className = "col-sm-1";

                            var label1 = document.createElement('label');
                            label1.innerText = 'Продукт';
                            innerDiv1.append(label1);

                            var label2 = document.createElement('label');
                            label2.innerText = 'Цена';
                            innerDiv2.append(label2);

                            var label3 = document.createElement('label');
                            label3.innerText = 'Количество';
                            innerDiv3.append(label3);

                            var label4 = document.createElement('label');
                            label4.innerText = 'Удалить';
                            innerDiv4.append(label4);

                            var selectProduct = document.createElement('select');
                            selectProduct.className = "form-control selectpicker";
                            selectProduct.append(document.createElement('option'));

                            selectProduct.setAttribute('data-live-search', "true");
                            selectProduct.name = "productId[]";
                            for(var i = 0 ; i < resp.length ; i++){
                                var option = document.createElement('option');

                                option.value = resp[i].id;
                                option.innerText = resp[i].name;
                                option.setAttribute('data-price', resp[i].price);
                                selectProduct.append(option);

                                $(function() {
                                    $('.selectpicker').selectpicker();
                                });
                            }

                            var inputPrice = document.createElement('input');
                            inputPrice.type = 'number';
                            inputPrice.name = 'productPrice[]';
                            inputPrice.readonly = !switchValue;
                            inputPrice.className = 'form-control my-switches';
                            selectProduct.onchange = function (){
                                inputPrice.value = selectProduct.options[selectProduct.selectedIndex].getAttribute("data-price");
                            };

                            var removeA = document.createElement('a');
                            removeA.className = ('btn btn-danger text-white');
                            removeA.innerText = "X";
                            removeA.onclick = function(){
                                div.remove();

                            };

                            var inputQuantity = document.createElement('input');
                            inputQuantity.value = 0;
                            inputQuantity.type = 'number';
                            inputQuantity.name = 'productQuantity[]';
                            inputQuantity.setAttribute('min', 0);
                            inputQuantity.className = 'form-control my-quantity';

                            inputPrice.addEventListener('click', function(){
                                evalPrice();
                            });
                            inputPrice.addEventListener('input', function(){
                                evalPrice();
                            });

                            inputQuantity.addEventListener('input', function(){
                                evalPrice();
                            });
                            inputQuantity.addEventListener('change', function(){
                                evalPrice();
                            });
                            removeA.addEventListener('click', function(){
                                evalPrice();
                            });
                            selectProduct.addEventListener('change', function(){
                                evalPrice();
                            });

                            innerDiv1.append(selectProduct);
                            innerDiv2.append(inputPrice);
                            innerDiv3.append(inputQuantity);
                            innerDiv4.append(removeA);

                            div.append(innerDiv1);
                            div.append(innerDiv2);
                            div.append(innerDiv3);
                            div.append(innerDiv4);

                            $('#products').append(div);

                        }else{
                            toastr.error('Ошибка!' , 'Продукты отсутствуют!');
                        }
                    },
                    error : function (error) {
                        
                    }
                });
            });
        });
    </script>
@endsection