<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Página en Construcción" />

    <div class="min-h-screen bg-slate-900 flex flex-col items-center justify-center text-white p-6">
        <div class="max-w-md w-full text-center space-y-8">
            <div class="flex justify-center">
                <div class="p-4 bg-amber-500 rounded-full animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            
            <h1 class="text-4xl font-bold tracking-tight">Página en Construcción</h1>
            
            <p class="text-slate-400 text-lg">
                Estamos trabajando en las nuevas funcionalidades. ¡Vuelve pronto!
            </p>

            <div class="pt-6">
                <Link 
                    href="/dashboard" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-slate-900 bg-amber-500 hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors"
                >
                    Volver al Dashboard
                </Link>
            </div>
        </div>
        
        <div class="mt-12 text-slate-500 text-sm">
            &copy; 2026 Sistema Académico. Todos los derechos reservados.
        </div>
    </div>
</template>
