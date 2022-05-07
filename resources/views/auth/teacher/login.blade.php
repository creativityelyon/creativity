@extends('layouts.auth_app')
@section('title')
    Teacher Login
@endsection
@section('content')
    <div class="card card-primary" style="background-color:#020f23">
        <div class="card-header"><h4>Teacher Login</h4></div>

        <div class="card-body">
            <form method="POST" action="{{ route('teacher.login.submit') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input aria-describedby="emailHelpBlock" id="nip" type="text"
                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip"
                           placeholder="Enter NIP" tabindex="1"
                           value="{{ (Cookie::get('nip') !== null) ? Cookie::get('nip') : old('nip') }}" autofocus
                           required>
                    <div class="invalid-feedback">
                        {{ $errors->first('nip') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="Enter Password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
