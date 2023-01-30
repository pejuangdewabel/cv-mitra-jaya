<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationAccount;
use App\MetodePembayaran;
use App\Tentang;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        $about = Tentang::findOrFail(1);
        $metodePembayaran = MetodePembayaran::where('status', 1)->get();
        return view('frontend.pages.auth.login', compact('about', 'metodePembayaran'));
    }

    public function register()
    {
        $about = Tentang::findOrFail(1);
        $metodePembayaran = MetodePembayaran::where('status', 1)->get();
        return view('frontend.pages.auth.register', compact('about', 'metodePembayaran'));
    }

    public function postRegister(Request $request)
    {
        $resultCaptcha = $request->a + $request->b;

        $messages = [
            'required'              => ':attribute wajib diisi',
            'min'                   => ':attribute harus diisi minimal digit :min ',
            'max'                   => ':attribute harus diisi maksimal :max karakter',
            'password.same'         => 'Password tidak sama',
            'confirmPassword.same'  => 'Konfrimasi Password tidak sama',
            'answerCaptcha.in'      => 'Captcha Salah',
            'email.unique'          => 'Email Sudah Pernah Dipakai',
            'no_telp.unique'        => 'no_telp Sudah Pernah Dipakai',
        ];

        $this->validate($request, [
            'no_telp'           => 'required|min:11|max:13|unique:user,no_telp',
            'email'             => 'required|min:5|unique:user,email',
            'nama'              => 'required|string|min:3',
            'password'          => 'required|string|min:6',
            'confirmPassword'   => 'required|same:password|string|min:6',
            'answerCaptcha'     => 'required|in:' . $resultCaptcha,
        ], $messages);

        $data = array(
            'email'         => Str::lower($request->email),
            'nama'          => ucfirst($request->nama),
            'password'      => Hash::make($request->password),
            'no_telp'       => $request->no_telp,
            'status'        => true
        );

        $details = [
            'title'     => 'Verifikasi Akun Printing CV Mitra Jaya',
            'nama'      => ucfirst($request->nama),
            'token'     => Crypt::encryptString($request->email),
        ];

        Mail::to($request->email)->send(new EmailVerificationAccount($details));
        User::create($data);

        return redirect()->back()->with('success', 'Berhasil Melakukan Pendaftaran silahkan Cek Email Untuk Verifikasi Akun');
    }

    public function verifyAccount($id)
    {
        $check = User::where('email', Crypt::decryptString($id))->count();
        $check2 = User::where('email', Crypt::decryptString($id))->first();
        if ($check == 1 and $check2->email_verified_at == null) {
            $data = array(
                'email_verified_at' => Carbon::now()->toDateTimeString()
            );
            User::where('email', Crypt::decryptString($id))->update($data);
            return redirect()->route('login')->with('success', 'Verifikasi Akun Berhasil');
        } elseif ($check == 0) {
            return redirect()->route('register')->with('warning', 'Verifikasi Akun Gagal');
        } elseif ($check2->email_verified_at != null) {
            return redirect()->route('register')->with('warning', 'Verifikasi Akun Kadaluarsa');
        }
    }

    public function checkLogin(Request $request)
    {
        $email          = $request->email;
        $password       = $request->password;

        if (Auth::guard('user')->attempt([
            'email'     => $email,
            'password'  => $password
        ])) {
            return redirect()->route('dashboard-user')->with('success', 'Berhasil Login User');
        } elseif (Auth::guard('karyawan')->attempt([
            'username'  => $email,
            'password'  => $password
        ])) {
            return redirect()->route('dashboard-karyawan')->with('success', 'Berhasil Login');
        } else {
            return redirect()->back()->with('warning', 'Email dan Password Salah');
        }
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } elseif (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }
        return redirect()->route('login')->with('toast_success', 'Berhasil Keluar');
    }
}
