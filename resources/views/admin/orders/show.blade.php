@extends('layouts.admin')
@section('styles')
    <style>
    th, td{
        text-align: center;
    }
    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px">
                    <div class="panel-header">
                        <h2>Посмотреть заказ</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('order.index')}}">Назад</a>
                        <a id="printBtn" class="btn btn-danger btn-sm" ><span class="fa fa-print"></span></a>
                    </div>

                    <div class="panel-body printArea">
                        <table width="100%" border="1"   style="text-align: center;border-collapse: collapse;" >
                            <thead>
                                <tr>
                                    <th>Склад</th>
                                    <th>Подразделение</th>
                                </tr>
                                <tr>
                                    <th>Основной склад</th>
                                    <th>Основное подразделение</th>
                                </tr>
                            </thead>
                        </table>
                        <br>

                        <h3 class="text-center">Расходная накладная</h3>
                        <br>

                        <p>
                            Торговый представитель: {{$order->user->name}}
                            <br>
                            Клиент: {{$order->client->first_name. ' ' . $order->client->last_name}}
                            <br>
                            Долг покупателя по текущему заказу: {{$debt}} тг
                            <br>
                            Основание: Без договора
                        </p>


                        <table width="100%" border="1"  style="text-align: center;border-collapse: collapse; font-size: 10px;">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Номенкл. номер</th>
                                    <th>Наименование, сорт, размер</th>
                                    <th>Ед. изм.</th>
                                    <th>Количество шт.</th>
                                    <th>Сумма тг.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($order->orderItems); $i++)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$order->orderItems[$i]->id}}</td>
                                        <td>{{$order->orderItems[$i]->item->name}}</td>
                                        <td>шт.</td>
                                        <td>{{$order->orderItems[$i]->quantity}}</td>
                                        <td>{{$order->orderItems[$i]->quantity*$order->orderItems[$i]->price}}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <br>
                        <p style="text-align: right">
                            Итого: {{$order->price}} тг
                        </p>
                        <br>
                        <p>
                            Всего {{count($order->orderItems)}} наименований на сумму {{$order->price}} тг<br>
                        <span id="priceToText">
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            function number_to_string(_number) {
                var _arr_numbers = new Array();
                _arr_numbers[1] = new Array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', 'десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
                _arr_numbers[2] = new Array('', '', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
                _arr_numbers[3] = new Array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
                function number_parser(_num, _desc) {
                    var _string = '';
                    var _num_hundred = '';
                    if (_num.length == 3) {
                        _num_hundred = _num.substr(0, 1);
                        _num = _num.substr(1, 3);
                        _string = _arr_numbers[3][_num_hundred] + ' ';
                    }
                    if (_num < 20) _string += _arr_numbers[1][parseFloat(_num)] + ' ';
                    else {
                        var _first_num = _num.substr(0, 1);
                        var _second_num = _num.substr(1, 2);
                        _string += _arr_numbers[2][_first_num] + ' ' + _arr_numbers[1][_second_num] + ' ';
                    }
                    switch (_desc){
                        case 0:
                            var _last_num = parseFloat(_num.substr(-1));
                            if (_last_num == 1) _string += 'тг';
                            else if (_last_num > 1 && _last_num < 5) _string += 'тг';
                            else _string += 'тг';
                            break;
                        case 1:
                            var _last_num = parseFloat(_num.substr(-1));
                            if (_last_num == 1) _string += 'тысяча ';
                            else if (_last_num > 1 && _last_num < 5) _string += 'тысячи ';
                            else _string += 'тысяч ';
                            _string = _string.replace('один ', 'одна ');
                            _string = _string.replace('два ', 'две ');
                            break;
                        case 2:
                            var _last_num = parseFloat(_num.substr(-1));
                            if (_last_num == 1) _string += 'миллион ';
                            else if (_last_num > 1 && _last_num < 5) _string += 'миллиона ';
                            else _string += 'миллионов ';
                            break;
                        case 3:
                            var _last_num = parseFloat(_num.substr(-1));
                            if (_last_num == 1) _string += 'миллиард ';
                            else if (_last_num > 1 && _last_num < 5) _string += 'миллиарда ';
                            else _string += 'миллиардов ';
                            break;
                    }
                    _string = _string.replace('  ', ' ');
                    return _string;
                }
                function decimals_parser(_num) {
                    var _first_num = _num.substr(0, 1);
                    var _second_num = parseFloat(_num.substr(1, 2));
                    var _string = ' ' + _first_num + _second_num;
                    if (_second_num == 1) _string += ' тиын';
                    else if (_second_num > 1 && _second_num < 5) _string += ' тиын';
                    else _string += ' тиын';
                    return _string;
                }
                if (!_number || _number == 0) return false;
                if (typeof _number !== 'number') {
                    _number = _number.replace(',', '.');
                    _number = parseFloat(_number);
                    if (isNaN(_number)) return false;
                }
                _number = _number.toFixed(2);
                if(_number.indexOf('.') != -1) {
                    var _number_arr = _number.split('.');
                    var _number = _number_arr[0];
                    var _number_decimals = _number_arr[1];
                }
                var _number_length = _number.length;
                var _string = '';
                var _num_parser = '';
                var _count = 0;
                for (var _p = (_number_length - 1); _p >= 0; _p--) {
                    var _num_digit = _number.substr(_p, 1);
                    _num_parser = _num_digit +  _num_parser;
                    if ((_num_parser.length == 3 || _p == 0) && !isNaN(parseFloat(_num_parser))) {
                        _string = number_parser(_num_parser, _count) + _string;
                        _num_parser = '';
                        _count++;
                    }
                }
                if (_number_decimals) _string += decimals_parser(_number_decimals);
                return _string;
            }

            $('#priceToText').html(number_to_string({{$order->price}}));

            $('#printBtn').click(function(){
                myWindow=window.open();


                $('.printArea').each(function(){
                    myWindow.document.write($(this).html());
                });

                myWindow.focus();
                myWindow.print();
                myWindow.close();
            });
        });
    </script>

@endsection
