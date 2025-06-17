@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="mb-4 text-center">Đăng ký</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required
                            autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu:</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-success ">Đăng ký</button>
                    </div>
                    <hr>
                    <div class="mb-3 text-center mt-4">
                        <a href="{{ route('auth.google') }}" class="btn btn-danger w-50">
                            <i class="bi bi-google"></i> Đăng nhập với Google
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
