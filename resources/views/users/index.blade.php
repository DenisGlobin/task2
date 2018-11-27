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
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Тема</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Тема">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Текст сообщения</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Выбрать файл</label>
                                </div><br><br>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection