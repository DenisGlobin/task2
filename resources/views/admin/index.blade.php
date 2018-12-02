@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список заявок</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('processed') }}" method="post">
                            @csrf
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Тема</th>
                                    <th scope="col">Сообщение</th>
                                    <th scope="col">Имя клиента</th>
                                    <th scope="col">Почтовый адрес</th>
                                    <th scope="col">Прикреплённый файл</th>
                                    <th scope="col">Дата создания</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        @if ($order->is_processed == 1)
                                            <tr class="table-success">
                                                <th scope="row">
                                                <input type="checkbox" name="chkbox[]" value="{!! $order->id !!}" checked disabled>
                                                </th>
                                        @else
                                            <tr class="table-default">
                                                <th scope="row">
                                                <input type="checkbox" name="chkbox[]" value="{!! $order->id !!}">
                                                </th>
                                        @endif
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->title }}</td>
                                        <td>{{ $order->message }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>
                                            @if (! is_null($order->file_path))
                                                <a href="{{ $order->file_path }}" target="_blank">Прикреплённый файл</a></td>
                                            @endif
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-row align-items-center">
                                <div class="col-auto my-1">
                                    <button type="submit" class="btn btn-primary">Обработать</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection