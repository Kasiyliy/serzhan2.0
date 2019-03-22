@extends('layouts.admin')

@section('styles')
    <style>
        .mr-1 {
            margin-right: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel" style="padding: 10px;">
                    <div class="panel-header">
                        <h2>Заказы</h2>
                        <a class="btn btn-success btn-sm" href="{{route('order.create')}}">Добавить</a>
                        <h4>Общая сумма заказов: <span class="divide">{{$overAllPrice}}</span></h4>
                        <h4>Общая сумма долгов: <span class="divide">{{$overAllDebtSum}}</span></h4>
                        <h4>Реальная сумма: <span class="divide">{{$overAllPrice - $overAllDebtSum}}</span></h4>
                        <div class="container" style="border: 1px solid #ccc; padding: 5px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Дата создания</label>
                                    <input type="text" class="form-control" name="datefilter" value=""/>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Клиент</label>
                                    <select class="form-control" id="client_id">
                                        <option></option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->first_name.' '.$client->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Сотрудник</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Статус</label>
                                    <select name="accepted" id="accepted" class="form-control">
                                        <option></option>
                                        <option value="1">Принят</option>
                                        <option value="0">Не принят</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Продавец</th>
                                <th>Клиент</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Дата создания</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('datatable')
    <script>

        $('.select2').select2();

        var table = null;
        $(document).ready(function () {


            var start = moment().subtract(29, 'days');
            var end = moment();

            $('input[name="datefilter"]').daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    "format": "DD-MM-YYYY",
                    "separator": " - ",
                    "applyLabel": "Принять",
                    "cancelLabel": "Отмена",
                    "fromLabel": "От",
                    "toLabel": "До",
                    "customRangeLabel": "Выборочный",
                    "weekLabel": "Н",
                    "daysOfWeek": [
                        "Вскр",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Суб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                    "firstDay": 1
                },
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                    'Предыдущий месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                table.draw();
            });


            table = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route("api.order.index")}}",
                    "data": function (d) {
                        d.client_id = $('#client_id').val();
                        d.user_id = $('#user_id').val();
                        d.current_user_id = '{{\Illuminate\Support\Facades\Auth::id()}}',
                        d.accepted = $('#accepted').val();
                        d.startDate = ($('input[name="datefilter"]').data('daterangepicker').startDate.format('YYYY-MM-DD'));
                        d.endDate = ($('input[name="datefilter"]').data('daterangepicker').endDate.format('YYYY-MM-DD'));
                    }
                },
                "order": [[0, "desc"]],
                "columns": [
                    {"data": "id"},
                    {"data": "user_id"},
                    {"data": "client_id"},
                    {"data": "price"},
                    {"data": "accepted"},
                    {"data": "created_at"},
                    {"data": "actions", name: "actions", orderable: false, searchable: false}
                ],
                "responsive": true,
                "lengthMenu": [[10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "Все"]],
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                },
                "orderCellsTop": true,
                "fixedHeader": true,
            });


            $('#client_id').change(function (e) {
                table.draw();
            });

            $('#user_id').change(function (e) {
                table.draw();
            });

            $('#accepted').change(function (e) {
                table.draw();
            });

            $('.divide').divide({
                delimiter: ' ',
                divideThousand: false
            });

            $('.divide').divide();

        });

        function deleteItem(id) {
            bootbox.confirm({
                message: "Вы действительно хотите удалить заказ?",
                locale: "ru",
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: 'api/orders/delete/' + id,
                            type: 'post',
                            success: function (resp) {
                                if (resp.success) {
                                    toastr.success("Удален!");
                                    table.ajax.reload(null, false);

                                } else {
                                    toastr.warning("Не удалось удалить!");
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                toastr.warning("Произошла ошибка!");
                            }
                        });
                    }
                }
            });
        }


        function acceptItem(id) {
            bootbox.confirm({
                message: "Вы действительно хотите принять заказ?",
                locale: "ru",
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: 'api/orders/accept/' + id,
                            type: 'post',
                            success: function (resp) {
                                if (resp.success) {
                                    toastr.success("Принят!");
                                    table.ajax.reload(null, false);

                                } else {
                                    toastr.warning("Не удалось принять!");
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                toastr.warning("Произошла ошибка!");
                            }
                        });
                    }
                }
            });
        }

    </script>
@endsection
