<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordLoginGoogle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginUrl()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                $request->session()->flash('toastr', [
                    'type'      => 'success',
                    'message'   => 'Login thành công !'
                ]);
                return redirect('/');
            } else {
                $newPassword = rand(100000, 999999);
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make($newPassword),
                    'email_verified_at' => Carbon::now(),
                    'role' => config('contants.ROLE.USER'),
                    'phone' => rand(111111111, 999999999)
                ]);

                Auth::login($newUser);
                Mail::to($user->email)->send(new SendPasswordLoginGoogle($user->name, $newPassword));
                $request->session()->flash('toastr', [
                    'type'      => 'success',
                    'message'   => 'Tạo tài khoản và login thành công !'
                ]);
                // return redirect()->intended('/');
                return redirect('/');
            }
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }
}
