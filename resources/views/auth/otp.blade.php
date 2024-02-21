@extends('layouts.app')

@push('javascript-external')
<link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">

<style>
    .input-field {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .input-field {
        flex-direction: row;
        column-gap: 10px;
    }

    .input-field input {
        height: 45px;
        width: 42px;
        border-radius: 6px;
        outline: none;
        font-size: 1.125rem;
        text-align: center;
        border: 1px solid #ddd;
    }

    .input-field input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .input-field input::-webkit-inner-spin-button,
    .input-field input::-webkit-outer-spin-button {
        display: none;
    }

    form button {
        margin-top: 25px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        border: none;
        padding: 9px 0;
        cursor: pointer;
        border-radius: 6px;
        pointer-events: none;
        background: #6e93f7;
        transition: all 0.2s ease;
    }

    form button.active {
        background: #4070f4;
        pointer-events: auto;
    }

    form button:hover {
        background: #0e4bf1;
    }

    input:not([disabled]) {
        border: 1px solid #f59e0b;
    }

    .ctt {
        text-align: center;
        margin-top: 15px
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
                        OTP Verification, Enter OTP code sent to <br> +62 890 33830 900
                    </p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="input-field">
                                    <input type="number" autofocus />
                                    <input type="number" disabled />
                                    <input type="number" disabled />
                                    <input type="number" disabled />
                                    <input type="number" disabled />
                                    <input type="number" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-sign">
                                    {{ __('Register') }}
                                </button>
                                <p class="ctt">
                                    Didn’t receive OTP code?
                                    <a href="{{ route('register') }}" class="ca">
                                        Resend code
                                    </a>
                                </p>
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
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    const inputs = document.querySelectorAll("input"),
  button = document.querySelector("button");
// iterate over all inputs
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    // This code gets the current input element and stores it in the currentInput variable
    // This code gets the next sibling element of the current input element and stores it in the nextInput variable
    // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;
    // if the value has more than one character then clear it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }
    // if the next input is disabled and the current value is not empty
    //  enable the next input and focus on it
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }
    // if the backspace key is pressed
    if (e.key === "Backspace") {
      // iterate over all inputs again
      inputs.forEach((input, index2) => {
        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }
    //if the fourth input( which index number is 3) is not empty and has not disable attribute then
    //add active class if not then remove the active class.
    if (!inputs[3].disabled && inputs[3].value !== "") {
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});
//focus the first input which index is 0 on window load
window.addEventListener("load", () => inputs[0].focus());
</script>
@endpush