@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px">
                    <div class="panel-header">
                        <h2>Добавить продукт</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('item.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('item.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Наименование</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Наименование" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input  type="number" min="0" value="{{old('price')}}" value="0" name="price" class="form-control" placeholder="Цена" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Количество</label>
                                <input type="number" value="0" value="{{old('quantity')}}" min="0" name="quantity" class="form-control" placeholder="Количество" required>
                            </div>

                            <div class="form-group">
                                <label for="category">Категория</label>
                                <select name="category_id" class="form-control" placeholder="Категория" required>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select name="status_id" class="form-control" placeholder="Статус" required>
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{csrf_field()}}
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