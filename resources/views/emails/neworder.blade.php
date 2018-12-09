@component('mail::message')
# Был оформлен новый заказ


@component('mail::table')
|                      |                                                                  |
| -------------------- |:----------------------------------------------------------------:|
| ID:                  | {{ $id }}                                                        |
| Тема:                | {{ $title }}                                                     |
| Сообщение:           | {{ $text }}                                                      |
| Имя клиента:         | {{ $name }}                                                      |
| Почтовый адрес:      | {{ $email }}                                                     |
@if (! is_null($file))
| Прикреплённый файл:  |     <a href="{{ $file }}" target="_blank">Прикреплённый файл</a> |
@endif
| Дата создания:       | {{ $createdAt }}                                                 |
@endcomponent

@component('mail::button', ['url' => env('APP_URL'), 'color' => 'blue'])
Перейти к списку заказов
@endcomponent
@endcomponent