<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prefecture; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    // 都道府県のリストを取得
    $prefectures = Prefecture::all();

    return view('auth.register', compact('prefectures'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prefecture_id' => ['required', 'exists:prefectures,id'], 
            'year' => 'required|integer|between:1900,' . date('Y'),
            'month' => 'required|integer|between:1,12',
            'day' => 'required|integer|between:1,31',
        ]);
        
        
    $now = date('Ymd');
    $birthday = $request->age; // "YYYY-MM-DD"形式
    $birthday = str_replace("-", "", $birthday); // "-"を削除
    $age = floor(($now - $birthday) / 10000); // 年齢を計算
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prefecture_id' => $request->prefecture_id, 
            'age' => $age,
            'gender' => $request->gender
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}