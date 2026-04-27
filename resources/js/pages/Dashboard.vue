<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    auth: {
        user: {
            name: string;
            role: string;
        }
    },
    subjects?: Array<{
        id: number;
        name: string;
        students_count: number;
        schedule: string;
    }>
}>();
</script>

<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-slate-100 flex">
        <!-- Sidebar lateral -->
        <aside class="w-64 bg-indigo-900 text-white flex flex-col">
            <div class="p-6 text-xl font-bold border-b border-indigo-800">
                Panel {{ auth.user.role === 'admin' ? 'Académico' : 'Docente' }}
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <Link href="/dashboard" class="block p-3 rounded bg-indigo-800">Inicio</Link>
                
                <template v-if="auth.user.role === 'admin'">
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Usuarios</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Materias</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Cursos</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Reportes</Link>
                </template>

                <template v-if="auth.user.role === 'teacher'">
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Mis Materias</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Horarios</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Calificaciones</Link>
                </template>
            </nav>
            <div class="p-4 border-t border-indigo-800">
                <form @submit.prevent="" class="w-full">
                    <Link href="/logout" method="post" as="button" class="w-full text-left p-3 rounded hover:bg-red-600 transition">
                        Cerrar Sesión
                    </Link>
                </form>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-8">
            <header class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 text-balance">Bienvenido, {{ auth.user.name }}</h1>
                    <p class="text-slate-500">Sistema de Gestión Académica</p>
                </div>
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold uppercase">
                    {{ auth.user.role }}
                </span>
            </header>

            <!-- VISTA ADMINISTRADOR -->
            <div v-if="auth.user.role === 'admin'" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-slate-500 text-sm font-medium">Total Estudiantes</h3>
                    <p class="text-3xl font-bold text-slate-900 mt-2">1,250</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-slate-500 text-sm font-medium">En riesgo</h3>
                    <p class="text-3xl font-bold text-amber-600 mt-2">45</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h3 class="text-slate-500 text-sm font-medium">Reprobados</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">12</p>
                </div>
            </div>

            <!-- VISTA DOCENTE -->
            <div v-if="auth.user.role === 'teacher'" class="space-y-8">
                <section>
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Mis Materias Asignadas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="subject in subjects" :key="subject.id" class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:border-indigo-300 transition-colors">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-slate-900 text-lg">{{ subject.name }}</h3>
                                    <p class="text-sm text-slate-500">{{ subject.schedule }}</p>
                                </div>
                                <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded text-xs font-bold">
                                    {{ subject.students_count }} Est.
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3 mt-6">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                                    Registrar Notas
                                </button>
                                <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition">
                                    Ver Estudiantes
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</template>
