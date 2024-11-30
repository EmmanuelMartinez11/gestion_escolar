# Gestión Escolar

Este es un sistema de gestión escolar desarrollado con **Laravel** para manejar la administración de estudiantes, cursos, comisiones, profesores y asignaturas.

## Alumno
Emmanuel Martinez - Legajo: 28159


## Requisitos

Para poder ejecutar esta aplicación, necesitas tener instalados los siguientes programas:

- **PHP** >= 8.1
- **Composer**
- **MySQL** (o cualquier otra base de datos compatible)
- **Git**

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/EmmanuelMartinez11/gestion_escolar.git

2. **Instalar dependencias con Composer**
   ```bash
    composer install

3. **Instalar dependencias con Composer**
   Copia el archivo .env.example a .env. Luego, edita el archivo .env con tus datos de configuración para la base de datos y otras variables de entorno (por ejemplo, las credenciales de la base de datos).

4. **Generar la clave de la aplicación**
   ```bash
    php artisan key:generate

5. **Generar la clave de la aplicación**
   ```bash
    php artisan serve
