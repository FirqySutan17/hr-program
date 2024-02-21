@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card _card" style="padding: 10px">
                <div class="card-body">
                    <p class="forgot-note">
                        Change password for <br> imranimated@gmail.com
                    </p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- <div class="row mb-3">
                            <div class="col-12">
                                <label for="email" class="col-12 col-form-label text-md-end">{{ __('Email Address')
                                    }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="password" class="col-12">{{ __('Password')
                                    }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="password-confirm" class="col-12">{{ __('Confirm
                                    Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <p class="forgot-note" style="font-size: 12px; font-family: pjsReguler">
                            Make sure it's at least 15 characters OR at least 8 characters including a number and a
                            lowercase letter.
                        </p>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-sign">
                                    {{ __('Change password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection