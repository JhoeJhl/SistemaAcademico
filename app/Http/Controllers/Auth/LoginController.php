<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Procesa la solicitud de autenticación.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validación estricta para prevenir payloads maliciosos
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // 2. Intentar autenticar (Laravel usa sentencias preparadas contra SQL Injection)
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            // 3. Respuesta genérica para no revelar si el usuario existe (Enumeración de usuarios)
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // 4. Seguridad: Regenerar sesión para prevenir Session Fixation attacks
        $request->session()->regenerate();

        // 5. Redirección segura
        return redirect()->intended('/dashboard');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidar sesión y regenerar token CSRF al salir
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
