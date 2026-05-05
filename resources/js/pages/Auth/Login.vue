<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Estado para mostrar/ocultar contraseña
const showPassword = ref(false);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        preserveScroll: true,
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Acceso Académico" />

    <div class="min-h-screen flex bg-white font-sans text-slate-900">
        
        <!-- PANEL IZQUIERDO: Branding e Imagen Institucional (Oculto en móviles) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900 overflow-hidden flex-col justify-between p-12">
            <!-- Imagen de fondo con overlay elegante -->
            <div class="absolute inset-0 z-0">
                <img 
                    src="../../../images/loginbg.jpg" 
                    alt="Campus Universitario" 
                    class="w-full h-full object-cover opacity-20 mix-blend-overlay"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-indigo-900/80 to-transparent"></div>
            </div>

            <!-- Logo Superior Izquierdo -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="bg-white p-2.5 rounded-xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <span class="text-white text-2xl font-bold tracking-tight">Tux<span class="font-light text-indigo-200">System</span></span>
            </div>

            <!-- Texto de Bienvenida Inferior -->
            <div class="relative z-10 text-white max-w-lg mb-8">
                <h1 class="text-4xl font-extrabold mb-4 leading-tight">
                    El portal hacia tu futuro profesional.
                </h1>
                <p class="text-lg text-indigo-200 font-medium leading-relaxed">
                    Accede a tus calificaciones, material de estudio y gestiona tu historial académico desde un entorno seguro y centralizado.
                </p>
            </div>
            
            <!-- Decoración sutil -->
            <div class="absolute -bottom-32 -left-40 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        </div>

        <!-- PANEL DERECHO: Formulario de Login -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-24 bg-slate-50 lg:bg-white relative">
            <div class="w-full max-w-md">
                
                <!-- Cabecera del Formulario -->
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Iniciar Sesión</h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Ingresa tus credenciales institucionales para continuar.
                    </p>
                </div>

                <!-- Formulario -->
                <form class="space-y-6" @submit.prevent="submit">
                    
                    <!-- Campo: Correo -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            Correo institucional
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                v-model="form.email"
                                type="email" 
                                required 
                                autofocus
                                class="block w-full pl-10 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-shadow duration-200 sm:text-sm"
                                :class="{ 'border-red-500 focus:ring-red-500 bg-red-50': form.errors.email }"
                                placeholder="tu@universidad.edu"
                            />
                        </div>
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <!-- Campo: Contraseña -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-semibold text-slate-700">
                                Contraseña
                            </label>
                            <Link href="/forgot-password" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                                ¿Olvidaste tu contraseña?
                            </Link>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'" 
                                required 
                                class="block w-full pl-10 pr-12 py-3 bg-white border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-shadow duration-200 sm:text-sm"
                                :class="{ 'border-red-500 focus:ring-red-500 bg-red-50': form.errors.password }"
                                placeholder="••••••••"
                            />
                            <!-- Botón Mostrar/Ocultar Contraseña -->
                            <button 
                                type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 focus:outline-none"
                            >
                                <svg v-if="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            v-model="form.remember"
                            type="checkbox" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-600 border-slate-300 rounded cursor-pointer transition-colors"
                        />
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">
                            Mantener sesión iniciada
                        </label>
                    </div>

                    <!-- Botón Submit -->
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span v-if="!form.processing">Ingresar al Portal</span>
                        <span v-else>Autenticando...</span>
                    </button>
                </form>

                <!-- Pie del formulario (Registro) -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <p class="text-center text-sm text-slate-600">
                        ¿Aún no tienes credenciales? 
                        <Link href="/contact-support" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                            Contactar a control escolar
                        </Link>
                    </p>
                </div>

            </div>
        </div>
    </div>
</template>