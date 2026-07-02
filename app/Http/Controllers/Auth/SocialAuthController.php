<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'ไม่สามารถเข้าสู่ระบบด้วย ' . ucfirst($provider) . ' ได้');
        }

        $idField = $provider === 'google' ? 'google_id' : 'microsoft_id';

        $user = User::where($idField, $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if ($user) {
            $user->update([
                $idField => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'name'   => $user->name ?: $socialUser->getName(),
            ]);
        } else {
            $user = User::create([
                'name'    => $socialUser->getName(),
                'email'   => $socialUser->getEmail(),
                $idField  => $socialUser->getId(),
                'avatar'  => $socialUser->getAvatar(),
                'role'    => 'student',
            ]);
        }

        if (!$user->is_active) {
            return redirect()->route('login')->with('error', 'บัญชีของคุณถูกระงับการใช้งาน');
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }

    public function loginDev(\Illuminate\Http\Request $request)
    {
        abort_unless(app()->isLocal(), 403);

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
        }

        if (!Auth::user()->is_active) {
            Auth::logout();
            return back()->withErrors(['email' => 'บัญชีของคุณถูกระงับการใช้งาน']);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
