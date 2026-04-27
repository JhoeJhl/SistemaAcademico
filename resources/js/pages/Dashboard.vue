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
    }>,
    child?: {
        name: string;
        grade: string;
        average: number;
        alerts: Array<{
            id: number;
            type: 'warning' | 'danger' | 'info';
            message: string;
        }>
    },
    academic_record?: {
        status: string;
        attendance: string;
        subjects: Array<{
            id: number;
            name: string;
            grade: number;
            status: string;
        }>
    }
}>();
</script>

<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-slate-100 flex">
        <!-- Sidebar lateral -->
        <aside class="w-64 bg-indigo-900 text-white flex flex-col">
            <div class="p-6 text-xl font-bold border-b border-indigo-800">
                Panel {{ 
                    auth.user.role === 'admin' ? 'Académico' : 
                    auth.user.role === 'teacher' ? 'Docente' : 
                    auth.user.role === 'tutor' ? 'Padre/Tutor' : 'Estudiante'
                }}
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

                <template v-if="auth.user.role === 'tutor'">
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Boletín de Notas</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Asistencia</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Comunicados</Link>
                </template>

                <template v-if="auth.user.role === 'student'">
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Mis Calificaciones</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Mi Horario</Link>
                    <Link href="#" class="block p-3 rounded hover:bg-indigo-800 transition">Material de Apoyo</Link>
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
                    {{ 
                        auth.user.role === 'tutor' ? 'Tutor ADRE' : 
                        auth.user.role === 'student' ? 'Estudiante' : auth.user.role 
                    }}
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

            <!-- VISTA TUTOR -->
            <div v-if="auth.user.role === 'tutor' && child" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información del Hijo -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium mb-1">Nombre del Estudiante</h3>
                        <p class="text-2xl font-bold text-slate-900">{{ child.name }}</p>
                        <p class="text-indigo-600 font-medium">{{ child.grade }}</p>
                    </div>

                    <!-- Promedio General -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col justify-center">
                        <h3 class="text-slate-500 text-sm font-medium mb-1">Promedio General</h3>
                        <div class="flex items-end gap-2">
                            <p class="text-4xl font-black text-indigo-700">{{ child.average }}</p>
                            <p class="text-slate-400 mb-1">/ 10.0</p>
                        </div>
                    </div>
                </div>

                <!-- Alertas -->
                <section class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <span class="text-amber-500">⚠️</span> Alertas del Estudiante
                    </h2>
                    <div class="space-y-3">
                        <div v-for="alert in child.alerts" :key="alert.id" 
                            :class="[
                                'p-4 rounded-lg border flex justify-between items-center',
                                alert.type === 'danger' ? 'bg-red-50 border-red-100 text-red-800' : 'bg-amber-50 border-amber-100 text-amber-800'
                            ]"
                        >
                            <span class="font-medium text-balance">{{ alert.message }}</span>
                            <button class="text-xs underline font-bold uppercase tracking-wider">Ver detalle</button>
                        </div>
                    </div>
                </section>
            </div>

            <!-- VISTA ESTUDIANTE -->
            <div v-if="auth.user.role === 'student' && academic_record" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Estado Académico -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Estado Académico</h3>
                        <p class="text-2xl font-bold text-green-600 mt-2">{{ academic_record.status }}</p>
                    </div>
                    <!-- Asistencia -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Asistencia Total</h3>
                        <p class="text-2xl font-bold text-indigo-600 mt-2">{{ academic_record.attendance }}</p>
                    </div>
                    <!-- Mensaje Promocional/Informativo -->
                    <div class="bg-indigo-600 p-6 rounded-xl shadow-sm text-white">
                        <h3 class="opacity-80 text-sm font-medium">Próximo Examen</h3>
                        <p class="text-xl font-bold mt-2">Física - 30 Abr</p>
                    </div>
                </div>

                <!-- Tabla de Materias y Notas -->
                <section class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800">Mis Materias y Calificaciones</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Materia</th>
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nota Final</th>
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Estado</th>
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="subject in academic_record.subjects" :key="subject.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 font-medium text-slate-900">{{ subject.name }}</td>
                                    <td class="p-4">
                                        <span :class="[
                                            'text-lg font-bold',
                                            subject.grade >= 7 ? 'text-indigo-600' : 'text-red-500'
                                        ]">
                                            {{ subject.grade.toFixed(1) }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span :class="[
                                            'px-2 py-1 rounded text-xs font-bold uppercase',
                                            subject.status === 'Aprobado' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700'
                                        ]">
                                            {{ subject.status }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-bold">Ver Detalles</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>
</template>
