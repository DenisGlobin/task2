@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Форма обратной связи</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form  action="{{ route('/orders/add') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input id="userId" name="userId" type="hidden" value="{{ isset($userId) ? $userId : null }}">
                                    <label for="exampleFormControlInput1">Тема</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Тема">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Текст сообщения</label>
                                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div><br>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection