<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset("admin/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/bower_components/font-awesome/css/font-awesome.min.css")}}">

    <link rel="stylesheet" href="{{asset("admin/dist/css/AdminLTE.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/dist/css/skins/_all-skins.min.css")}}">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset("admin/bower_components/datatable/css/dataTables.bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("admin/bower_components/datatable/css/responsive.bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("admin/bower_components/datatable/css/scroller.bootstrap.min.css")}}"/>
    @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="{{route('home')}}" class="logo">
            <span class="logo-mini"><b>S</b>KZ</span>
            <span class="logo-lg"><b>Serzhan</b>KZ</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle" style="color:white"></i>
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <i class="fa fa-home fa-3x" style="color:white"></i>
                                <p>
                                    {{Auth::user()->name}}
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left text-white">
                    <i class="fa fa-user-circle fa-2x " style="color:white"></i>
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Главная</li>
                <li>
                    <a href="{{route('client.index')}}">
                        <i class="fa fa-users"></i> <span>Клиенты</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('order.index')}}">
                        <i class="fa fa-dollar"></i> <span>Заказы</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-caret-left"></i> <span>Возвраты товаров</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('debtor.index')}}">
                        <i class="fa fa-money"></i> <span>Должники</span>
                    </a>
                </li>
                <li class="header">Склад</li>
                <li>
                    <a href="{{route('category.index')}}">
                        <i class="fa fa-list"></i> <span>Категории</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('item.index')}}">
                        <i class="glyphicon glyphicon-shopping-cart"></i> <span>Продукты</span>
                    </a>
                </li>
                <li class="header">Настройки</li>
                <li>
                    <a href="{{route('status.index')}}">
                        <i class="fa fa-user-secret"></i> <span>Статусы</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('role.index')}}">
                        <i class="fa fa-gears"></i> <span>Роли</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.index')}}">
                        <i class="fa fa-id-card"></i> <span>Сотрудники</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content">

            @yield('content')

        </section>
    </div>
    <footer class="main-footer">
        All rights
        reserved {{date('Y')}}. SERZHAN.KZ
    </footer>
</div>



<script src="{{asset("admin/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("admin/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{asset("admin/dist/js/adminlte.min.js")}}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>

<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/jquery.dataTables.min.js")}}"></script>
<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/dataTables.bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/dataTables.responsive.min.js")}}"></script>
<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/responsive.bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/dataTables.scroller.min.js")}}"></script>


<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
            "responsive": true,
            "lengthMenu": [[10, 25, 50,100,200,500, -1], [10, 25, 50,100,200,500, "Все"]],
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
            }
        });
    } );
</script>
<script>
    toastr.options.closeButton = true;
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif

    @if(Session::has('error'))
    toastr.info("{{Session::get('error')}}");
    @endif

    @if(Session::has('warning'))
    toastr.info("{{Session::get('warning')}}");
    @endif

</script>
@yield('scripts')
</body>
</html>
