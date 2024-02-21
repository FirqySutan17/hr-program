@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card _card" style="padding: 10px">

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <p class="forgot-note">
                        Check your email for a link to reset your password. If it doesn’t appear within a few minutes,
                        check your spam folder.
                    </p>
                    {{-- <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request
                            another') }}</button>.
                    </form> --}}

                    <a class="btn btn-back" href="{{ route('login') }}">
                        {{ __('Return to sign in') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection