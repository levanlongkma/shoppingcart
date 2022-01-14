@extends('shopping.index')

@push('title')
Đăng Nhập | E-Shopper
@endpush

@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng Nhập Vào Tài Khoản Của Bạn</h2>
                    @if (request()->session()->has('error'))
                        <p style="color: red">{{ request()->session()->get('error') }}</p>
                
                    @endif
                    <form method="POST" action="{{ route('shopping.login_post') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Tên Đăng Nhập" />
                        @error('name_login')
                            {{ $message }}
                        @enderror
                        <input type="password" name="password" placeholder="Mật Khẩu" />
                        @error('password_login')
                            {{ $message }}
                        @enderror
                        {{-- <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span> --}}
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">HAY</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng Ký Tài Khoản Mới!</h2>
                    <form method="POST" action="{{ route('shopping.register') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Tên Đăng Nhập"/>
                        @error('name')
                            {{ $message }}
                        @enderror
                        <input type="email" name="email" placeholder="Địa Chỉ Email"/>
                        @error('email')
                            {{ $message }}
                        @enderror
                        <input type="password" name="password" placeholder="Mật Khẩu"/>
                        @error('password')
                            {{ $message }}
                        @enderror
                        <button type="submit" class="btn btn-default">Đăng Ký Tài Khoản</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection