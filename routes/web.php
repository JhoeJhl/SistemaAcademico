<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;

// La raíz ahora muestra el Login
Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('login')->middleware('guest');

// Ruta protegida para procesar el login con limitación de intentos (Rate Limiting)
Route::post('/login', [LoginController::class, 'store'])
    ->middleware(['guest', 'throttle:5,1']) // Máximo 5 intentos por minuto
    ->name('login.store');

// Ruta de cierre de sesión
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Ejemplo de ruta protegida (Dashboard)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $data = [];

        if ($user->role === 'teacher') {
            $data = [
                'subjects' => [
                    ['id' => 1, 'name' => 'Matemáticas Avanzadas', 'students_count' => 25, 'schedule' => 'Lun - Mie 08:00'],
                    ['id' => 2, 'name' => 'Física Cuántica', 'students_count' => 18, 'schedule' => 'Mar - Jue 10:00'],
                    ['id' => 3, 'name' => 'Programación Web', 'students_count' => 30, 'schedule' => 'Vie 14:00'],
                ]
            ];
        }

        if ($user->role === 'tutor') {
            $data = [
                'child' => [
                    'name' => 'Carlos Garcia',
                    'grade' => '10mo Grado',
                    'average' => 8.5,
                    'alerts' => [
                        ['id' => 1, 'type' => 'warning', 'message' => 'Inasistencia en Física - 25/04'],
                        ['id' => 2, 'type' => 'danger', 'message' => 'Bajo rendimiento en Matemáticas'],
                    ]
                ]
            ];
        }

        if ($user->role === 'student') {
            $data = [
                'academic_record' => [
                    'status' => 'Regular',
                    'attendance' => '92%',
                    'subjects' => [
                        ['id' => 1, 'name' => 'Matemáticas', 'grade' => 7.5, 'status' => 'Aprobado'],
                        ['id' => 2, 'name' => 'Física', 'grade' => 6.0, 'status' => 'En Riesgo'],
                        ['id' => 3, 'name' => 'Programación', 'grade' => 9.5, 'status' => 'Aprobado'],
                        ['id' => 4, 'name' => 'Literatura', 'grade' => 8.0, 'status' => 'Aprobado'],
                    ]
                ]
            ];
        }

        return Inertia::render('Dashboard', $data);
    })->name('dashboard');
});
