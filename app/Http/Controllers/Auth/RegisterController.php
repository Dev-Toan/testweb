<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FrontendRegisterRequest;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function getFormRegister()
    {
        return view('frontend.auth.register');
    }

    public function postRegister(FrontendRegisterRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => config('contants.ROLE.USER'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
        $user->notify(new VerifyEmail());
        Auth::login($user);
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Đăng ký tài khoản thành công ! vào email để Verify !'
        ]);
        return redirect()->route('get.home');
    }

    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->markEmailAsVerified();
        Auth::login($user);
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Verify thành công, bạn có thể mua sắm !'
        ]);
        return redirect()->route('get.home');
    }

    public function resetVerifyEmail(Request $request)
    {
        $user = User::find(Auth::id());
        $user->notify(new VerifyEmail());
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Link verify đã được gửi vào mail !'
        ]);
        return redirect()->back();
    }
}
