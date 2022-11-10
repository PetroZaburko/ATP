@extends('voyager::auth.master')

@section('content')
    <div class="login-container">

        <p>Please fill out this fields</p>

        <form action="{{ route('candidate.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group form-group-default" id="nameGroup">
                <label>{{ __('voyager::generic.name') }}</label>
                <div class="controls">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('voyager::generic.name') }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group form-group-default" id="surnameGroup">
                <label>Surname</label>
                <div class="controls">
                    <input type="text" name="surname" id="surname" value="{{ old('surname') }}" placeholder="Surname" class="form-control" required>
                </div>
            </div>

            <div class="form-group form-group-default" id="emailGroup">
                <label>{{ __('voyager::generic.email') }}</label>
                <div class="controls">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                </div>
            </div>

            <div class="form-group form-group-default" id="birthGroup">
                <label>Day of birth</label>
                <div class="controls">
                    <input type="date" name="birth" id="birth" value="{{ old('birth') }}" placeholder="Day of birth" class="form-control" required>
                </div>
            </div>

            <div class="form-group" id="loginGroup">
                <div class="controls">
                    <a href="{{ route('voyager.login') }}">Back to login form</a>
                </div>
            </div>

            <button type="submit" class="btn btn-block login-button">
                <span class="signingin hidden"><span class="voyager-refresh"></span> Adding candidate...</span>
                <span class="signin">{{ __('voyager::generic.add') }}</span>
            </button>

        </form>

        <div style="clear:both"></div>

        @if(!$errors->isEmpty())
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> <!-- .login-container -->
@endsection

@section('post_js')

    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var first_name = document.querySelector('[name="name"]');
        var surname = document.querySelector('[name="surname"]');
        var email = document.querySelector('[name="email"]');
        var birth = document.querySelector('[name="birth"]');

        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        first_name.focus();
        document.getElementById('nameGroup').classList.add("focused");

        // Focus events for email and password fields

        first_name.addEventListener('focusin', function(e){
            document.getElementById('nameGroup').classList.add("focused");
        });
        first_name.addEventListener('focusout', function(e){
            document.getElementById('nameGroup').classList.remove("focused");
        });

        surname.addEventListener('focusin', function(e){
            document.getElementById('surnameGroup').classList.add("focused");
        });
        surname.addEventListener('focusout', function(e){
            document.getElementById('surnameGroup').classList.remove("focused");
        });

        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        birth.addEventListener('focusin', function(e){
            document.getElementById('birthGroup').classList.add("focused");
        });
        birth.addEventListener('focusout', function(e){
            document.getElementById('birthGroup').classList.remove("focused");
        });

    </script>

@endsection
