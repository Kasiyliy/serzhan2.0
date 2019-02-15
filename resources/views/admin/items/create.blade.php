@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Добавить продукт</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('item.index')}}">Назад</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('item.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Наименование</label>
                                <input type="text" name="name" class="form-control" placeholder="Наименование" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Цена</label>
                                <input  type="number" min="0" value="0" name="price" class="form-control" placeholder="Цена" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Количество</label>
                                <input type="number" value="0" min="0" name="quantity" class="form-control" placeholder="Количество" required>
                            </div>

                            <div class="form-group">
                                <label for="category">Категория</label>
                                <select name="category_id" class="form-control" placeholder="Категория" required>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Добавить">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection