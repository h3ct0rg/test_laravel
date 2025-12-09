# 🧪 Prueba Técnica — Backend Semi Senior  
**Stack:** Laravel 8 · PHP 7.4 · MySQL 5.7 · APIs · Vue 2 · Pentaho · GitHub · SQL

Esta prueba evalúa las capacidades principales para un rol **Backend Semi Senior**, considerando nuestro stack tecnológico. El proyecto está diseñado para poder completarse en **menos de 6 horas**.

---

# 📌 Objetivo General  
Construir una **pequeña API en Laravel 8** con funcionalidades básicas, conectada a MySQL 5.7, con un CRUD mínimo y dos endpoints públicos.  
Además, el candidato debe entregar:

- Una **consulta SQL avanzada**  
- Una **transformación ETL sencilla en Pentaho**  
- Flujo correcto en **GitHub (branch + PR)**  
- (Opcional / Extra) **Dockerfile** y **docker-compose.yml** para levantar el proyecto completo  

---

# 🧩 1. API Backend en Laravel 8

### ✔️ Requerimiento  
Crear una API simple para gestionar **Tareas** (*tasks*) y **Usuarios** (*users*, no autenticación, solo catálogo).

### 🛠️ Detalles

#### 📌 Modelos y migraciones
**User**  
- id  
- nombre  
- email  

**Task**  
- id  
- titulo  
- descripcion  
- estado (pendiente, en_progreso, completada)  
- user_id (FK)  

#### 📌 Endpoints requeridos

| Método | Ruta | Descripción |
|-------|------|-------------|
| GET | /api/tasks | Listar tareas (paginado) |
| GET | /api/tasks/{id} | Obtener una tarea |
| POST | /api/tasks | Crear tarea |
| PUT | /api/tasks/{id} | Actualizar tarea |
| DELETE | /api/tasks/{id} | Eliminar tarea |
| GET | /api/users | Listar usuarios |

#### 📌 Reglas técnicas obligatorias  
- Validaciones con **Form Requests**  
- Uso de **Eloquent** con relaciones  
- Respuestas JSON limpias  
- Manejo correcto de errores (HTTP 404, 422, 500, etc.)  
- Uso de **Resource Classes** es un plus (pero no obligatorio)  

---

# 🧩 2. Consulta SQL Avanzada

Crear una consulta SQL usando **MySQL 5.7** que responda:

> Obtener el total de tareas por usuario, sabiendo cuántas están completadas, cuántas en progreso y cuántas pendientes.

Debe devolver:

- nombre del usuario  
- total_tareas  
- tareas_pendientes  
- tareas_en_progreso  
- tareas_completadas  

**Entrega:** archivo `consulta.sql`.

---

# 🧩 3. Mini Transformación ETL con Pentaho

### ✔️ Requerimiento  
Crear una transformación `.ktr` que:

1. Lea un archivo CSV con el siguiente formato:  
   `id, titulo, descripcion, estado, user_id`
2. Valide:
   - estado ∈ {pendiente, en_progreso, completada}
   - titulo no vacío
3. Inserte los registros válidos en una tabla MySQL llamada `tasks_importadas`.
4. Registros inválidos → escribirlos en `errores.csv`.

**Entrega esperada:** archivo `.ktr` + screenshot de la transformación.

---

# 🧩 4. GitHub Flow (Obligatorio)

1. Hacer **fork** o **clone** del repositorio.  
2. Crear una rama siguiendo esta convención:

3. Commits pequeños y descriptivos.  
4. Al finalizar, abrir un **Pull Request** hacia `main`.  
5. En la PR agregar la descripción de lo desarrollado.

---

# ⭐ Puntos Extra (Opcionales)

Los siguientes puntos NO son obligatorios, pero suman a la evaluación final:

### 🐳 1. Dockerfile completo para Laravel  
- PHP 7.4  
- Extensiones necesarias (pdo_mysql, mbstring, intl, etc.)

### 🐳 2. Archivo `docker-compose.yml` con:  
- `app` (Laravel)  
- `mysql` (5.7)  
- `phpmyadmin` (opcional)

### ⭐ Plus adicional:
- Un comando `docker-compose up` debe dejar la app levantada en `http://localhost:8000`.

---

# 📦 Entregables Finales

El candidato debe entregar:

- Código Laravel (carpetas `/app`, `/routes`, migraciones, seeds opcionales)  
- Archivo SQL: `consulta.sql`  
- Transformación Pentaho: `.ktr`  
- Pull Request en GitHub  
- (Opcional) Dockerfile + docker-compose.yml  

---

# ⏱️ Tiempo Estimado  
**4 a 6 horas** máximo.

---

# 🏁 Criterios de Evaluación

| Área | Peso |
|------|------|
| Calidad del código (estructura, limpieza) | ⭐⭐⭐⭐ |
| Uso correcto de Laravel | ⭐⭐⭐⭐ |
| SQL avanzado | ⭐⭐⭐ |
| Pentaho ETL | ⭐⭐⭐ |
| Buenas prácticas de API | ⭐⭐⭐⭐ |
| Git/GitHub (PR, commits, naming) | ⭐⭐⭐⭐ |
| Extra: Docker | ⭐⭐⭐ |

---

# 🙌 Notas Finales  
El objetivo no es complejidad, sino **calidad**, **orden**, **criterio técnico** y **capacidad de entregar un proyecto completo**.

