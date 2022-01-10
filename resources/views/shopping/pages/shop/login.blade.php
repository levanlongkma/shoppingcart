@extends('shopping.index')

@push('title')
Login | E-Shopper
@endpush

@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    @if (request()->session()->has('error'))
                        <p style="color: red">{{ request()->session()->get('error') }}</p>
                
                    @endif
                    <form method="POST" action="{{ route('shopping.login_post') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Name" />
                        @error('name_login')
                            {{ $message }}
                        @enderror
                        <input type="password" name="password" placeholder="Password" />
                        @error('password_login')
                            {{ $message }}
                        @enderror
                        {{-- <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span> --}}
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form method="POST" action="{{ route('shopping.register') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Name"/>
                        @error('name')
                            {{ $message }}
                        @enderror
                        <input type="email" name="email" placeholder="Email Address"/>
                        @error('email')
                            {{ $message }}
                        @enderror
                        <input type="password" name="password" placeholder="Password"/>
                        @error('password')
                            {{ $message }}
                        @enderror

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection