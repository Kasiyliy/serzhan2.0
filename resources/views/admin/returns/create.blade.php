@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="panel"  style="padding: 10px">
                    <div class="panel-header">
                        <h2>Добавить возврат</h2>
                        <a  class="btn btn-primary btn-sm" href="{{route('category.index')}}">Назад</a>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('category.store')}}" method="post">
                            <div class="form-group">
                                <label for="name">Item</label>
                                <select name="order_item" class="form-control" placeholder="Наименование" required>
                                    @foreach($returns as $returnItem)
                                        <option value="{{$returnItem->orderItem->item->id}}"> {{$returnItem->orderItem->item->name}} </option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <label for="quantity">Количество</label>
                                    <input type="number" disabled min="0" name="quantity" class="form-control" placeholder="Количество" required>
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