<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pendaftaran;
use App\Models\Periodic;
use App\Models\User;
use App\Models\Wawancara;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    
    //Google
    public function redirectGoogleShow()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallbackSubmit(Request $request)
    {

        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('google_id', $user->id)->first();

        $inPendaftaran = Pendaftaran::where('user_id', $user->id)->exists();
        $inDokumen = Dokumen::where('user_id', $user->id)
            ->whereNotNull('file_foto_terbaru')
            ->exists();
        $inWawancara = Wawancara::where('user_id', $user->id)
            ->whereNotNull('waktu_wawancara')
            ->exists();
        $getPeriod = Periodic::count();

        if ($getPeriod == 0) {
            Auth::logout();
            return redirect(route('loginShow'))->with('punyaAkun', 'Pendaftaran belum dibuka');
        } else {
            if ($finduser) {
                Auth::login($finduser);
                if ($inPendaftaran) {
                    if ($inDokumen) {
                        if ($inWawancara) {
                            return redirect()->route('jadwalWawancaraSiswaShow', Auth::user()->id);
                        }
                        return redirect()->route('seleksiSiswaShow', Auth::user()->id);
                    }
                    return redirect()->route('dokumenSiswaShow1', Auth::user()->id);
                }
                return redirect(route('pendaftaranSiswaShowPage1'));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => $user->password,
                    'role' => ['siswa'],
                ]);
                Auth::login($newUser);
                return redirect(route('pendaftaranSiswaShowPage1'));
            }
        }
    }

    // Register
    public function registerUserShow(){
        return view('pages.user-auth.register-user');
    }

    public function registerUserSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ' required|min:6'
        ]);

        $checkRegisterEmail = User::where('email', $request->email)->exists();
        if($checkRegisterEmail == false){
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'google_id' => $request->id,
                'password' => Hash::make($request->password),
                'role' => ['siswa'],
            ]);
            return redirect(route('loginShow'))->with('berhasil', 'Akun sudah terdaftar');
        }else{
            return redirect(route('loginShow'))->with('punyaAkun', 'Anda sudah pernah mendaftar');
        }
    }

    // Login
    public function loginShow(){
        return view ('pages.user-auth.login-user');
    }

    public function loginUserSubmit(Request $request){
        $credentials = $request->only('name', 'password');
        // dd($credentials);

        $nameUser = User::where('name', $credentials['name'])->first();
        $passwordUser = User::where('password', $credentials['password'])->first();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;
            
            $firstRole = $user->role[0] ?? null;
            $secondRole = $user->role[1] ?? null;

            $roleStatement = ['admin', 'inti', 'keuangan', 'wawancara', 'seragam'];
            $getRole = $user->role;
            
            $roleCount = count($role);
            $getPeriod = Periodic::count();
            // dd($getPeriod == 0 && $firstRole != 'admin');
            if ($getPeriod == 0 && !array_intersect($roleStatement, $getRole)) {
                Auth::logout();
                return redirect(route('loginShow'))->with('punyaAkun', 'Pendaftaran belum dibuka');
            } else {
                if ($roleCount > 0) {
                    if ($firstRole == 'siswa') {
                        $inPendaftaran = Pendaftaran::where('user_id', $user->id)->exists();
                        $inDokumen = Dokumen::where('user_id', $user->id)
                        ->whereNotNull('file_foto_terbaru')
                        ->exists();
                        $inWawancara = Wawancara::where('user_id', $user->id)
                        ->whereNotNull('waktu_wawancara')
                        ->exists();
                        if ($inPendaftaran) {
                            if ($inDokumen) {
                                if($inWawancara){
                                    return redirect()->route('jadwalWawancaraSiswaShow', Auth::user()->id);
                                }
                                return redirect()->route('seleksiSiswaShow', Auth::user()->id);
                            }
                            return redirect()->route('dokumenSiswaShow1', Auth::user()->id);
                        }
                        return redirect(route('pendaftaranSiswaShowPage1'));
                    }
                    return redirect(route('roleManyShow'));
                }else{
                    
                    if($firstRole == 'admin'){
                        return redirect(route('homeAdminShow'));
                    }
                }
            }
        }else if($nameUser != null && $passwordUser == null){
            return redirect(route('loginShow'))->with('punyaAkun', 'Password Salah');
        }else {
            return redirect(route('loginShow'))->with('punyaAkun', 'Anda belum pernah mendaftar');
        }
    }

    // Logout
    public function logoutUser(Request $request){
        Storage::disk('public')->deleteDirectory('temp');
        $request->session()->flush();
        Session::flush();
        Auth::logout();

        return redirect()->intended(route('loginShow'));
    }
}
