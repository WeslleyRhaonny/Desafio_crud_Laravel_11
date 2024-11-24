<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\RequestGuard;

use Illuminate\Support\Facades\Auth;


class LogoutController extends Controller
{
    public function destroy(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flash('success', 'Você foi desconectado com sucesso!');
        
        return redirect()->route('index');

    }
}
