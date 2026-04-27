# Sistema Académico

Un sistema integral de gestión educativa diseñado para optimizar los procesos administrativos y académicos de instituciones de enseñanza. Construido con un stack moderno y escalable.

## 🚀 Funcionalidades Principales

### 👨‍🎓 Gestión de Estudiantes
*   **Expediente Digital:** Registro completo de información personal, médica y académica.
*   **Matriculación Inteligente:** Proceso simplificado para inscripción en ciclos escolares y materias.
*   **Seguimiento de Desempeño:** Visualización de historial académico y progreso en tiempo real.

### 👩‍🏫 Portal del Docente
*   **Control de Calificaciones:** Carga de notas por periodos con cálculo automático de promedios.
*   **Registro de Asistencia:** Control diario de asistencia con notificaciones automáticas.
*   **Planificación Curricular:** Gestión de contenidos, tareas y recursos didácticos.

### 📚 Administración Académica
*   **Gestión de Cursos y Materias:** Configuración de planes de estudio y prerequisitos.
*   **Horarios Dinámicos:** Organización de jornadas académicas y asignación de aulas.
*   **Ciclos Lectivos:** Configuración de periodos, vacaciones y fechas clave.

### 📊 Reportes y Analítica
*   **Boletas de Calificaciones:** Generación automática de reportes en PDF.
*   **Estadísticas de Deserción:** Indicadores para la detección temprana de riesgo académico.
*   **Certificados:** Emisión de constancias y certificados de estudio.

### 🔐 Seguridad y Control
*   **Roles y Permisos:** Control de acceso basado en roles (Admin, Docente, Estudiante, Tutor).
*   **Auditoría:** Registro de actividades críticas dentro del sistema.

## 🛠️ Stack Tecnológico

*   **Backend:** [Laravel 11](https://laravel.com)
*   **Frontend:** [Vue 3](https://vuejs.org) con [Inertia.js](https://inertiajs.com)
*   **Lenguaje:** [TypeScript](https://www.typescriptlang.org/)
*   **Estilos:** CSS moderno (Vite)
*   **Base de Datos:** MySQL / PostgreSQL

## ⚙️ Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/tu-usuario/sistema-academico.git
    cd sistema-academico
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de Node:**
    ```bash
    npm install
    ```

4.  **Configurar el entorno:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Ejecutar migraciones y seeders:**
    ```bash
    php artisan migrate --seed
    ```

6.  **Iniciar el servidor de desarrollo:**
    ```bash
    npm run dev
    # En otra terminal
    php artisan serve
    ```

## 📄 Licencia

Este proyecto está bajo la licencia MIT.
