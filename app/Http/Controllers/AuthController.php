<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('cliente.login.index');
    }

    public function showRegisterForm()
    {
        return view('cliente.register.index');
    }

    public function showlogoutForm()
    {
        return view('cliente.logout.index');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario,usu_email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação do usuário
        $user = User::create([
            'usu_nome' => $validatedData['name'],
            'usu_email' => $validatedData['email'],
            'usu_senha' => Hash::make($validatedData['password']),
        ]);

        // Autenticar o usuário
        Auth::login($user);

        // Redirecionar ou retornar uma resposta
        return redirect()->route('login')->with('success', 'Registro concluído com sucesso!');
    }
    public function login(Request $request)
    {
        // Validação dos dados
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Procurar o usuário no banco usando usu_email
        $user = User::where('usu_email', $credentials['email'])->first();

        // Verificar se o usuário existe e se a senha está correta
        if ($user && Hash::check($credentials['password'], $user->usu_senha)) {
            // Autenticar manualmente o usuário
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('cliente')->with('success', 'Login bem-sucedido!');
        }

        // Se as credenciais estiverem incorretas
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function logout(Request $request)
    {

        // Desautenticar o usuário
        Auth::logout();

        return redirect()->route(route: 'cliente')->with('success', 'Logout bem-sucedido!');
    }
}
