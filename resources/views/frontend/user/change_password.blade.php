@extends('layout.master_user');
    <style>

    </style>
@section('content')
    <section class="py-4 py-lg-5" style="background: white;padding: 20px">
        <h2>Change Password</h2>
        <div class="row mb-5">
            <div class="col-sm-12">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group {{ $errors->first('password_current') ? 'has-error' : '' }}">
                        <label for="">Current Password</label>
                        <input type="password" name="password_current"  class="form-control" value="{{ old('password_current') }}"  placeholder="Enter password_current">
                        @if ($errors->first('password_current'))
                            <small class="text-danger">{{ $errors->first('password_current') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                        <label for="">New Password</label>
                        <input type="password" name="password"  class="form-control" value="{{ old('password') }}"  placeholder="Enter password">
                        @if ($errors->first('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('password_confirmation') ? 'has-error' : '' }}">
                        <label for="">New Confirm Password</label>
                        <input type="password" name="password_confirmation"  class="form-control" value="{{ old('password_confirmation') }}"  placeholder="Enter password_confirmation">
                        @if ($errors->first('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
