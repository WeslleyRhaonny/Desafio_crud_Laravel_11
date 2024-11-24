<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ]);
    
        if ($validator->fails()) {
            return redirect('login')
                   ->withErrors($validator)
                   ->withInput();
        }
    
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->has('remember_me');
    
        // Verifica se o e-mail está registrado
        $user = \App\Models\User::where('email', $credentials['email'])->first();
    
        if (!$user) {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->withErrors(['email' => 'O e-mail não está registrado.']);
        }
    
        // Verifica se a senha está correta
        if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $rememberMe)) {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->withErrors(['password' => 'A senha está incorreta.']);
        }
    
        // Atualiza o último login e redireciona ao painel
        Auth::user()->update(['last_login_at' => Carbon::now()]);
    
        return redirect()->intended(route('painel.index'));
    }
    
}
