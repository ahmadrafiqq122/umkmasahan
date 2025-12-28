<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Check if email is verified
            if (!Auth::user()->email_verified_at) {
                $email = Auth::user()->email;
                Auth::logout();
                return redirect()->route('verification.show', ['email' => $email])
                    ->withErrors([
                        'email' => 'Email Anda belum diverifikasi. Silakan verifikasi email terlebih dahulu.',
                    ])
                    ->with('warning', 'Silakan cek email Anda untuk kode verifikasi atau klik "Kirim Ulang" jika belum menerima.');
            }

            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda telah dinonaktifkan.',
                ]);
            }

            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Show registration form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'nik' => 'nullable|string|size:16',
            'address' => 'nullable|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'nik' => $request->nik,
            'address' => $request->address,
            'role' => 'user',
        ]);

        // Generate and send verification code
        $verificationCode = VerificationCode::createForEmail($user->email);
        
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode->code, $user->name));
            
            return redirect()->route('verification.show', ['email' => $user->email])
                ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk kode verifikasi.');
        } catch (\Exception $e) {
            // If email fails, inform the user and log the error
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            
            return redirect()->route('verification.show', ['email' => $user->email])
                ->with('warning', 'Registrasi berhasil! Namun email verifikasi gagal dikirim. Silakan klik "Kirim Ulang Kode" untuk mencoba lagi.')
                ->with('email_error', true);
        }
    }

    /**
     * Show verification form
     */
    public function showVerification(Request $request)
    {
        $email = $request->query('email');
        
        if (!$email) {
            return redirect()->route('register');
        }

        return view('auth.verification', ['email' => $email]);
    }

    /**
     * Handle verification request
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        if (VerificationCode::verify($request->email, $request->code)) {
            $user = User::where('email', $request->email)->first();
            
            if ($user) {
                $user->update(['email_verified_at' => now()]);
                
                Auth::login($user);
                
                return redirect()->route('user.dashboard')
                    ->with('success', 'Email berhasil diverifikasi! Selamat datang.');
            }
        }

        return back()->withErrors([
            'code' => 'Kode verifikasi tidak valid atau sudah kadaluarsa.',
        ])->withInput();
    }

    /**
     * Resend verification code
     */
    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user->email_verified_at) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah terverifikasi.'
            ], 400);
        }

        $verificationCode = VerificationCode::createForEmail($user->email);
        
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode->code, $user->name));
            
            return response()->json([
                'success' => true,
                'message' => 'Kode verifikasi baru telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Resend verification code failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Redirect based on user role
     */
    private function redirectBasedOnRole()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('user.dashboard');
    }
}
