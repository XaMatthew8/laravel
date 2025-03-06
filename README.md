# GameDB - Proyecto Laravel para Gestión de Videojuegos

## Descripción
GameDB es una aplicación web desarrollada en **Laravel** con un diseño inspirado en **neón** usando **TailwindCSS**. Permite gestionar videojuegos, géneros, plataformas, reseñas y comentarios. 

## 🛠 Tecnologías Utilizadas
- **Laravel** (Framework PHP)
- **MySQL** (Base de Datos Relacional)
- **TailwindCSS** (Diseño y Estilos)
- **Laravel Breeze** (Autenticación de Usuarios)
- **Faker** (Generación de datos ficticios para pruebas)

## 🚀 Instalación
### 1️⃣ Clonar el repositorio
```bash
 git clone https://github.com/tuusuario/GameDB.git
 cd GameDB
```

### 2️⃣ Instalar dependencias de Laravel
```bash
 composer install
 npm install && npm run dev
```

### 3️⃣ Configurar variables de entorno
```bash
 cp .env.example .env
 php artisan key:generate
```
Editar el archivo `.env` y configurar la conexión a la base de datos:
```env
 DB_DATABASE=gamedb
 DB_USERNAME=root
 DB_PASSWORD=
```

### 4️⃣ Ejecutar migraciones y seeders
```bash
 php artisan migrate --seed
```
Esto creará las tablas en la base de datos y poblará datos de prueba.

### 5️⃣ Iniciar el servidor de desarrollo
```bash
 php artisan serve
```
La aplicación estará disponible en `http://127.0.0.1:8000`

## 📂 Estructura del Proyecto
El proyecto sigue la estructura estándar de Laravel, destacando los siguientes directorios:

- **`app/Models/`** → Contiene los modelos (`Game`, `Genre`, `Platform`, `Review`, `Comment`).
- **`app/Http/Controllers/`** → Contiene los controladores que manejan la lógica del backend.
- **`resources/views/`** → Contiene las vistas con diseño en TailwindCSS.
- **`database/migrations/`** → Contiene las migraciones para crear las tablas.
- **`database/factories/`** → Contiene las fábricas para generar datos de prueba.
- **`database/seeders/`** → Contiene los seeders para poblar la base de datos.

## 🔐 Autenticación
El sistema de autenticación está manejado con **Laravel Breeze** e incluye:
- Registro de usuarios.
- Inicio y cierre de sesión.
- Gestión de autenticación protegida con middleware.

## ✨ Funcionalidades
✔️ Gestión de videojuegos con información detallada.
✔️ Asociación de videojuegos a múltiples géneros y plataformas.
✔️ Sistema de reseñas con calificación de usuarios.
✔️ Sistema de comentarios en reseñas.
✔️ Generación de datos de prueba con factories y seeders.
✔️ Autenticación segura con Laravel Breeze.
✔️ Diseño moderno inspirado en **neón** con **TailwindCSS**.

## 🌍 Rutas Principales
| Método | Ruta | Descripción |
|--------|------|-------------|
| `GET` | `/games` | Listar todos los videojuegos |
| `GET` | `/games/{id}` | Ver detalles de un videojuego |
| `GET` | `/genres` | Listar géneros |
| `GET` | `/platforms` | Listar plataformas |
| `GET` | `/reviews` | Listar reseñas |
| `GET` | `/comments` | Listar comentarios |

## 🤝 Contribución
1. Realiza un **fork** del repositorio.
2. Crea una rama (`git checkout -b feature-nueva`).
3. Realiza los cambios y haz commit (`git commit -m "Agrega nueva funcionalidad"`).
4. Envía un **pull request**.

## 📜 Licencia
Este proyecto está bajo la licencia **MIT**. ¡Úsalo y modifícalo libremente! 🚀