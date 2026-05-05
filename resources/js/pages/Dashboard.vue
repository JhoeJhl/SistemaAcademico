<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    auth: {
        user: {
            name: string;
            role: 'admin' | 'teacher' | 'tutor' | 'student';
        }
    },
    // Props para el Docente
    subjects?: Array<{
        id: number;
        name: string;
        students_count: number;
        schedule: string;
        performance_rate: number; // % de aprobados
    }>,
    assembly_students?: Array<{
        id: number;
        name: string;
        subject: string;
        teacher_name: string;
        current_grade: number;
        action_plan: string;
    }>,
    // Props para el Padre/Tutor
    child?: {
        name: string;
        grade: string;
        average: number;
        alerts: Array<{
            id: number;
            type: 'warning' | 'danger' | 'info';
            message: string;
        }>,
        at_risk_subjects: Array<{
            id: number;
            name: string;
            grade: number;
            teacher: string;
        }>,
        meetings: Array<{
            id: number;
            date: string;
            modality: 'Presencial' | 'Llamada' | 'Virtual';
            teacher: string;
            reason: string;
        }>
    },
    // Props para el Estudiante
    academic_record?: {
        status: string;
        attendance: string;
        subjects: Array<{
            id: number;
            name: string;
            grade: number;
            status: string;
        }>,
        pending_evaluations: Array<{
            id: number;
            teacher_name: string;
            subject: string;
            exam_name: string;
        }>
    }
}>();
</script>

<template>
    <Head title="Dashboard" />

    <div class="min-h-screen bg-slate-50 flex">
        <!-- Sidebar lateral -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl z-10">
            <div class="p-6 text-xl font-bold border-b border-slate-800">
                Panel {{ 
                    auth.user.role === 'admin' ? 'Director' : 
                    auth.user.role === 'teacher' ? 'Docente' : 
                    auth.user.role === 'tutor' ? 'Padre/Tutor' : 'Estudiante'
                }}
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <Link href="/dashboard" class="block p-3 rounded bg-blue-600 font-medium">Inicio</Link>
                
                <!-- Menú Director -->
                <template v-if="auth.user.role === 'admin'">
                    <Link href="/admin/rendimiento" class="block p-3 rounded hover:bg-slate-800 transition">Rendimiento Institucional</Link>
                    <Link href="/admin/personal" class="block p-3 rounded hover:bg-slate-800 transition">Gestión de Personal</Link>
                    <Link href="/admin/asambleas" class="block p-3 rounded hover:bg-slate-800 transition">Reportes de Asambleas</Link>
                </template>

                <!-- Menú Docente -->
                <template v-if="auth.user.role === 'teacher'">
                    <Link href="/teacher/materias" class="block p-3 rounded hover:bg-slate-800 transition">Mis Materias y Notas</Link>
                    <Link href="/teacher/asamblea" class="block p-3 rounded hover:bg-slate-800 transition text-amber-400">Asamblea de Docentes</Link>
                    <Link href="/teacher/desempeno" class="block p-3 rounded hover:bg-slate-800 transition">Desempeño de Clases</Link>
                </template>

                <!-- Menú Tutor -->
                <template v-if="auth.user.role === 'tutor'">
                    <Link href="/tutor/seguimiento" class="block p-3 rounded hover:bg-slate-800 transition">Seguimiento Académico</Link>
                    <Link href="/tutor/llamadas" class="block p-3 rounded hover:bg-slate-800 transition">Llamadas de Atención</Link>
                    <Link href="/tutor/reuniones" class="block p-3 rounded hover:bg-slate-800 transition">Reuniones Programadas</Link>
                </template>

                <!-- Menú Estudiante -->
                <template v-if="auth.user.role === 'student'">
                    <Link href="/student/calificaciones" class="block p-3 rounded hover:bg-slate-800 transition">Mis Calificaciones</Link>
                    <Link href="/student/horario" class="block p-3 rounded hover:bg-slate-800 transition">Mi Horario</Link>
                    <Link href="/student/evaluacion" class="block p-3 rounded hover:bg-slate-800 transition text-emerald-400">Evaluar Docentes</Link>
                </template>
            </nav>
            <div class="p-4 border-t border-slate-800">
                <form @submit.prevent="" class="w-full">
                    <Link href="/logout" method="post" as="button" class="w-full text-left p-3 rounded hover:bg-red-600 transition font-medium">
                        Cerrar Sesión
                    </Link>
                </form>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-8 overflow-y-auto">
            <header class="mb-8 flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Bienvenido, {{ auth.user.name }}</h1>
                    <p class="text-slate-500 mt-1">Sistema de Gestión Académica Digital</p>
                </div>
                <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-bold uppercase tracking-wide border border-blue-100">
                    Rol: {{ 
                        auth.user.role === 'tutor' ? 'Padre de Familia' : 
                        auth.user.role === 'student' ? 'Estudiante' : 
                        auth.user.role === 'admin' ? 'Director' : 'Docente' 
                    }}
                </span>
            </header>

            <!-- ================= VISTA DIRECTOR (ADMIN) ================= -->
            <div v-if="auth.user.role === 'admin'" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Total Estudiantes</h3>
                        <p class="text-3xl font-bold text-slate-900 mt-2">1,250</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Docentes Activos</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">48</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Estudiantes en Riesgo</h3>
                        <p class="text-3xl font-bold text-amber-500 mt-2">45</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Reuniones Padre-Docente</h3>
                        <p class="text-3xl font-bold text-purple-600 mt-2">12 hoy</p>
                    </div>
                </div>
                <!-- Aquí iría la vista general digitalizada del director -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-lg font-bold text-slate-800 mb-4">Métricas Institucionales (En desarrollo)</h2>
                    <p class="text-slate-600">Espacio reservado para métricas de evaluación docente y desempeño general del colegio.</p>
                </div>
            </div>

            <!-- ================= VISTA DOCENTE ================= -->
            <div v-if="auth.user.role === 'teacher'" class="space-y-8">
                <!-- Asamblea de Docentes (Alumnos en riesgo) -->
                <section v-if="assembly_students" class="bg-amber-50 p-6 rounded-xl shadow-sm border border-amber-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-amber-900 flex items-center gap-2">
                            <span>🤝</span> Asamblea de Docentes: Casos Críticos
                        </h2>
                        <button class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-medium hover:bg-amber-700">Programar Apoyo</button>
                    </div>
                    <div class="overflow-x-auto bg-white rounded-lg border border-amber-100">
                        <table class="w-full text-left">
                            <thead class="bg-amber-100/50">
                                <tr>
                                    <th class="p-3 text-xs font-bold text-amber-800 uppercase">Estudiante</th>
                                    <th class="p-3 text-xs font-bold text-amber-800 uppercase">Materia / Docente</th>
                                    <th class="p-3 text-xs font-bold text-amber-800 uppercase">Nota Actual</th>
                                    <th class="p-3 text-xs font-bold text-amber-800 uppercase">Plan de Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-amber-50">
                                <tr v-for="student in assembly_students" :key="student.id">
                                    <td class="p-3 font-medium text-slate-900">{{ student.name }}</td>
                                    <td class="p-3 text-sm text-slate-600">{{ student.subject }} (Prof. {{ student.teacher_name }})</td>
                                    <td class="p-3"><span class="text-red-600 font-bold">{{ student.current_grade }}</span></td>
                                    <td class="p-3 text-sm text-slate-600 italic">{{ student.action_plan || 'Sin plan definido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Gestión de Materias y Notas -->
                <section>
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Mis Materias (Carga de notas y Desempeño)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        <div v-for="subject in subjects" :key="subject.id" class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg">{{ subject.name }}</h3>
                                <p class="text-sm text-slate-500 mb-4">{{ subject.schedule }}</p>
                                
                                <div class="flex items-center justify-between bg-slate-50 p-3 rounded-lg mb-4 border border-slate-100">
                                    <div class="text-center">
                                        <p class="text-xs text-slate-500 uppercase font-bold">Estudiantes</p>
                                        <p class="font-black text-slate-800">{{ subject.students_count }}</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-slate-500 uppercase font-bold">Aprobación</p>
                                        <p :class="subject.performance_rate > 70 ? 'text-green-600' : 'text-amber-500'" class="font-black">
                                            {{ subject.performance_rate }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-auto">
                                <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition text-center">
                                    Cargar Notas
                                </button>
                                <button class="px-3 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition text-center">
                                    Ver Desempeño
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- ================= VISTA TUTOR / PADRE DE FAMILIA ================= -->
            <div v-if="auth.user.role === 'tutor' && child" class="space-y-8">
                
                <!-- Resumen e Hijo -->
                <div class="flex items-center gap-4 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-2xl">
                        {{ child.name.charAt(0) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ child.name }}</h2>
                        <p class="text-slate-500">Curso: {{ child.grade }} | Promedio General: <span class="font-bold text-blue-600">{{ child.average }}/10</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Alertas y Materias Peligrando -->
                    <div class="space-y-6">
                        <section class="bg-white p-6 rounded-xl shadow-sm border border-red-100">
                            <h3 class="text-lg font-bold text-red-800 mb-4 flex items-center gap-2">
                                <span>⚠️</span> Materias en Riesgo
                            </h3>
                            <div class="space-y-3" v-if="child.at_risk_subjects && child.at_risk_subjects.length > 0">
                                <div v-for="subject in child.at_risk_subjects" :key="subject.id" class="p-3 bg-red-50 rounded-lg border border-red-100 flex justify-between items-center">
                                    <div>
                                        <p class="font-bold text-slate-900">{{ subject.name }}</p>
                                        <p class="text-xs text-slate-600">Docente: {{ subject.teacher }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-red-200 text-red-800 font-bold rounded">{{ subject.grade }}</span>
                                </div>
                            </div>
                            <p v-else class="text-sm text-slate-500">No hay materias en riesgo actualmente.</p>
                        </section>

                        <section class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-bold text-slate-800 mb-4">Llamadas de Atención</h3>
                            <div class="space-y-2">
                                <div v-for="alert in child.alerts" :key="alert.id" class="p-3 bg-amber-50 rounded-lg border border-amber-100 text-amber-900 text-sm">
                                    {{ alert.message }}
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Reuniones y Entrevistas Digitalizadas -->
                    <section class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 h-fit">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-slate-800">Reuniones y Entrevistas</h3>
                            <button class="text-sm text-blue-600 hover:underline font-medium">Solicitar Cita</button>
                        </div>
                        <div class="space-y-4">
                            <div v-for="meeting in child.meetings" :key="meeting.id" class="flex items-start gap-4 p-4 border border-slate-100 rounded-lg hover:bg-slate-50 transition">
                                <div class="bg-blue-100 text-blue-700 p-3 rounded-lg text-center min-w-[70px]">
                                    <p class="text-xs font-bold uppercase">{{ meeting.date.split(' ')[0] }}</p>
                                    <p class="text-sm font-black">{{ meeting.date.split(' ')[1] }}</p>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Prof. {{ meeting.teacher }}</p>
                                    <p class="text-sm text-slate-600 mt-1">{{ meeting.reason }}</p>
                                    <span class="inline-block mt-2 px-2 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-full">
                                        Modalidad: {{ meeting.modality }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- ================= VISTA ESTUDIANTE ================= -->
            <div v-if="auth.user.role === 'student' && academic_record" class="space-y-8">
                
                <!-- Evaluaciones Pendientes -->
                <section v-if="academic_record.pending_evaluations && academic_record.pending_evaluations.length > 0" class="bg-emerald-50 border border-emerald-200 p-6 rounded-xl">
                    <h2 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">
                        <span>📝</span> Evaluar Docentes (Exámenes Recientes)
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="evalItem in academic_record.pending_evaluations" :key="evalItem.id" class="bg-white p-4 rounded-lg shadow-sm border border-emerald-100 flex justify-between items-center">
                            <div>
                                <p class="font-bold text-slate-900">{{ evalItem.subject }}</p>
                                <p class="text-sm text-slate-600">Examen: {{ evalItem.exam_name }}</p>
                                <p class="text-xs text-slate-400 mt-1">Docente: {{ evalItem.teacher_name }}</p>
                            </div>
                            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                                Evaluar
                            </button>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Estado Académico</h3>
                        <p class="text-2xl font-bold text-blue-600 mt-2">{{ academic_record.status }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                        <h3 class="text-slate-500 text-sm font-medium">Asistencia Total</h3>
                        <p class="text-2xl font-bold text-slate-900 mt-2">{{ academic_record.attendance }}</p>
                    </div>
                </div>

                <!-- Mis Materias y Notas -->
                <section class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800">Materias en Curso y Calificaciones</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Materia</th>
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nota Acumulada</th>
                                    <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="subject in academic_record.subjects" :key="subject.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 font-medium text-slate-900">{{ subject.name }}</td>
                                    <td class="p-4">
                                        <span :class="subject.grade >= 6 ? 'text-blue-600' : 'text-red-500'" class="text-lg font-bold">
                                            {{ subject.grade.toFixed(1) }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span :class="subject.status === 'Aprobando' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700'" class="px-2 py-1 rounded text-xs font-bold uppercase">
                                            {{ subject.status }}
                                        </span>
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