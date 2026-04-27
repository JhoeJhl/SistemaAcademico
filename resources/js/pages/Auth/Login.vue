<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div class="min-h-screen relative flex flex-col justify-center py-12 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Fondo con Imagen, Opacidad y Blur -->
        <div class="absolute inset-0 z-0">
            <img 
                src="../../../images/login-bg.jpg" 
                alt="Background" 
                class="w-full h-full object-cover opacity-30"
            />
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/40 to-indigo-900/20 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 sm:mx-auto sm:w-full sm:max-auto sm:max-w-md text-center">
            <!-- Icono o Logo -->
            <div class="flex justify-center mb-6">
                <div class="bg-indigo-600 p-3 rounded-2xl shadow-lg shadow-indigo-500/50 transform transition hover:scale-110 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight drop-shadow-sm">
                Sistema Académico
            </h2>
            <p class="mt-2 text-sm text-slate-700 font-medium">
                Bienvenido de nuevo. Por favor, ingresa tus credenciales.
            </p>
        </div>

        <div class="relative z-10 mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
            <div class="bg-white/90 backdrop-blur-md py-8 px-6 shadow-2xl shadow-slate-900/20 rounded-2xl sm:px-10 border border-white/50">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">
                            Correo electrónico
                        </label>
                        <div class="mt-1 relative">
                            <input 
                                id="email" 
                                v-model="form.email"
                                type="email" 
                                required 
                                class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 sm:text-sm"
                                placeholder="tu@ejemplo.com"
                                :class="{ 'border-red-500 focus:ring-red-500': form.errors.email }"
                            />
                            <div v-if="form.errors.email" class="mt-1 text-xs text-red-500">
                                {{ form.errors.email }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">
                            Contraseña
                        </label>
                        <div class="mt-1 relative">
                            <input 
                                id="password" 
                                v-model="form.password"
                                type="password" 
                                required 
                                class="appearance-none block w-full px-4 py-3 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 sm:text-sm"
                                placeholder="••••••••"
                                :class="{ 'border-red-500 focus:ring-red-500': form.errors.password }"
                            />
                            <div v-if="form.errors.password" class="mt-1 text-xs text-red-500">
                                {{ form.errors.password }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember_me" 
                                v-model="form.remember"
                                type="checkbox" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer"
                            />
                            <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer">
                                Recordarme
                            </label>
                        </div>

                        <div class="text-sm">
                            <Link href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed transform active:scale-[0.98]"
                        >
                            <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Acceder al sistema
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-500">
                                ¿No tienes cuenta?
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <Link 
                            href="#" 
                            class="w-full flex justify-center py-3 px-4 border border-slate-300 rounded-xl shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200"
                        >
                            Solicitar registro
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
