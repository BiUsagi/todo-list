@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-4">Xác minh địa chỉ email</h3>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success">
                        Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn!
                    </div>
                @endif

                <p>Trước khi tiếp tục, vui lòng kiểm tra email để xác minh địa chỉ của bạn.</p>
                <p>Nếu bạn không nhận được email, bạn có thể yêu cầu gửi lại.</p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Gửi lại email xác minh</button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-link">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
@endsection
