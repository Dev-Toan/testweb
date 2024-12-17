@extends('layout.master_user');
    <style>

    </style>
@section('content')
    <section class="py-4 py-lg-5" style="background: white;padding: 20px">
    @if (!Auth::user()->email_verified_at)
        <p>Click <a style="color: red" href="{{ route('get.reset.verifyemail') }}">vào đây</a> để lấy lại link verify email !</p>
    @endif
        <h2>Cập nhật thông tin</h2>
        <div class="row mb-5">
            <div class="col-sm-12">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                        <label for="">Name </label>
                        <input type="text" name="name"  class="form-control" value="{{ Auth::user()->name }}"  placeholder="Enter name">
                        @if ($errors->first('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                        <label for="">Email </label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"  placeholder="Enter email" readonly>
                    </div>
                    <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                        <label for="">Phone </label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}"  placeholder="Enter Phone">
                        @if ($errors->first('phone'))
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
                        <label for="">Address </label>
                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}"  placeholder="Enter Address">
                        @if ($errors->first('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
