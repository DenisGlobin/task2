<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новый заказ</title>
</head>
<body>
    <t1 align="center">Новый заказ</t1>
    <table>
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" align="left">ID:</th>
            <td>{{ $id }}</td>
        </tr>
        <tr>
            <th scope="row" align="left">Тема:</th>
            <td>{{ $title }}</td>
        </tr>
        <tr>
            <th scope="row" align="left">Сообщение:</th>
            <td>{{ $text }}</td>
        </tr>
        <tr>
            <th scope="row" align="left">Имя клиента:</th>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <th scope="row" align="left">Почтовый адрес:</th>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <th scope="row" align="left">Прикреплённый файл:</th>
            <td>
                @if (! is_null($file))
                    <a href="{{ $file }}" target="_blank">Прикреплённый файл</a>
                @endif
            </td>
        </tr>
        <tr>
            <th scope="row" align="left">Дата создания:</th>
            <td>{{ $createdAt }}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>