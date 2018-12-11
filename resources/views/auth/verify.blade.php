@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('authforms.verify_email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('authforms.fresh_verif_link') }}
                        </div>
                    @endif

                    {{ __('authforms.verif_link') }}
                    {{ __('authforms.is_receive') }}, <a href="{{ route('verification.resend') }}">{{ __('authforms.verif_request') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
