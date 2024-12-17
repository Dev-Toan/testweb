<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserRequestUpdateInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{
    public function updateInfo()
    {
        return view('frontend.user.update_info');
    }

    public function saveUpdateInfo(UserRequestUpdateInfo $request)
    {
        $data               = $request->except('_token');
        $user               = User::find(Auth::id());
        $user->update($data);
        // $user->created_at   =  Carbon::now('Asia/Ho_Chi_Minh');
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Cập nhật thành công !'
        ]);
        // dd($user);
        return redirect()->back();
    }

    public function getChangePassword()
    {
        return view('frontend.user.change_password');
    }

    public function postChangePassword(UserChangePasswordRequest $request)
    {
        $user = User::find(Auth::id());
        $password_current = $request->password_current;
        $password = $request->password;
        if (Hash::check($password_current, $user->password)) {
            $user->update([
                'password' => Hash::make($password)
            ]);
            $request->session()->flash('toastr', [
                'type'      => 'success',
                'message'   => 'Thay đôỉ password thành công !'
            ]);
            return redirect()->back();
        }
        $request->session()->flash('toastr', [
            'type'      => 'error',
            'message'   => 'Mật khẩu cũ sai !'
        ]);
        return redirect()->back();
    }
}
