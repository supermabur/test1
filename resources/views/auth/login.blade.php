@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body small">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <span>
                            <h1 class="mb-0"style="color: #003167 !important" ><strong>{{ str_replace('_', ' ', config('app.name', 'Backoffice')) }}</strong></h1>
                            <h4 class="mb-4" style="color: #003167 !important" >Login Page</h4>
                        </span>


                        {{-- {{$errors}} --}}
                        <div class="form-group row">
                            <label for="login" class="col-lg-3 col-form-label">
                                {{ __('Username or Email') }}
                            </label>
                         
                            <div class="col-lg-9">
                                <input id="login" type="text"
                                       {{-- class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" --}}
                                       class="form-control"
                                       name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                         
                                {{-- @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-lg-3 col-form-label">{{ __('Password') }}</label>

                            <div class="col-lg-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-9 offset-lg-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            {{-- {{ $errors }} --}}
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        @if($errors->has('username') || $errors->has('email') || $errors->has('password'))
                                            <li>Kombinasi Username dan Password Salah</li>
                                        @else
                                            <li>{{ $error }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-lg-9 offset-lg-3">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
