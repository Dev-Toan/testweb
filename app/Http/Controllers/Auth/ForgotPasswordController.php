<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function getFormForgot()
    {
        return view('frontend.auth.forgot');
    }

    public function postForgot(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Str::uuid();
            $reset_password = DB::table('password_resets')
                ->updateOrInsert(['email' => $request->email], ['token' => $token, 'created_at' => Carbon::now()]);
            $user->notify(new ForgotPassword($request->email, $token));
        }
        
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'mã token và link đổi password đã được gửi vô email !'
        ]);
        return redirect()->back();
    }

    public function getChangeForgotPassword()
    {
        return view('frontend.auth.change-password-forgot');
    }

    public function postChangeForgotPassword(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $token = $request->token;
        $customMessages = [
            'required' => ':attribute không được để trống ! ',
            'confirmed' => ':attribute không trùng nhau ! ',
            'min' => ':attribute lớn hơn 3 ký tự ! '
        ];
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:3',
        ], $customMessages);
        // ['required', 'confirmed', Password::min(8)
        //         ->mixedCase()
        //         ->numbers()]

        // dd($validator->errors()->all());

        $errors = '';
        foreach ($validator->errors()->all() as $item) {
            $errors .= $item . '\n';
        }
        if ($validator->fails()) {
            $request->session()->flash('toastr', [
                'type'      => 'error',
                'message'   => $errors
            ]);
            return redirect()->back();
        }
        $user = User::where('email', $email)->first();
        $reset_password = DB::table('password_resets')->where('email', $email)->first();
        if ($reset_password) {
            if ($reset_password->token == $token) {
                if (Carbon::now()->diffInMinutes($reset_password->created_at) < 60) {
                    $user->update([
                        "password" => Hash::make($password)
                    ]);
                    $request->session()->flash('toastr', [
                        'type'      => 'success',
                        'message'   => 'Đổi password thành công'
                    ]);
                    return redirect()->route('get.login');
                }
                $request->session()->flash('toastr', [
                    'type'      => 'error',
                    'message'   => 'Token đã hết hạn vui lòng làm mới lại !'
                ]);
                return redirect()->back();
            }
            $request->session()->flash('toastr', [
                'type'      => 'error',
                'message'   => 'Token không trung khớp'
            ]);
            return redirect()->back();
        }
        $request->session()->flash('toastr', [
            'type'      => 'error',
            'message'   => 'Email không tồn tại'
        ]);
        return redirect()->back();
    }
}
