@extends('layouts.app')

@push('javascript-external')
<link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">

<style>
    .iti__flag {
        display: none;
    }

    .intl-tel-input,
    .iti {
        width: 100%;
    }

    .iti--separate-dial-code .iti__selected-dial-code {
        font-size: 13px
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card _card" style="padding: 10px">
                <div class="card-body">
                    <p class="forgot-note">
                        Welcome to Bucky! Let’s begin the adventure
                    </p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="col-12">{{ __('Fullname') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="email" class="col-12">{{ __('Email Address')
                                    }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="phone" class="col-12">{{ __('Phone')
                                    }}</label>
                                <input id="mobile_code" type="phone"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone" required
                                    style="width: 100%">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

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

                        {{-- <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-sign">
                                    {{ __('Continue') }}
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

@push('javascript-external')
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/intlTelInput-jquery.min.js') }}"></script>

<script>
    $("#mobile_code").intlTelInput({
        initialCountry: "id",
        separateDialCode: true,
        showFlags: false,
        // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });
</script>
@endpush