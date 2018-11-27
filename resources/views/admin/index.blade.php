@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form>
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
                                <tr class="table-default">
                                    <th scope="row">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </th>
                                    <td>1</td>
                                    <td>Тема 1</td>
                                    <td>Тестовое сообщение</td>
                                    <td>Иван Иванов</td>
                                    <td>test1@tst.com</td>
                                    <td><a href="#">Файл</a></td>
                                    <td>19:23 26.11.2018</td>
                                </tr>
                                <tr class="table-success">
                                    <th scope="row">
                                        <input type="checkbox" aria-label="Checkbox for following text input" disabled checked>
                                    </th>
                                    <td>2</td>
                                    <td>Тема 2</td>
                                    <td>Тестовое сообщение</td>
                                    <td>Петр Петренко</td>
                                    <td>test2@tst.com</td>
                                    <td><a href="#">Файл</a></td>
                                    <td>19:23 26.11.2018</td>
                                </tr>
                                <tr class="table-default">
                                    <th scope="row">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                    </th>
                                    <td>3</td>
                                    <td>Тема 3</td>
                                    <td>Тестовое сообщение</td>
                                    <td>Петр Петренко</td>
                                    <td>test2@tst.com</td>
                                    <td><a href="#">Файл</a></td>
                                    <td>19:23 26.11.2018</td>
                                </tr>
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