@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('user.title')</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p>@lang('user.next_order_at') {{ $nextOrderAt }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection