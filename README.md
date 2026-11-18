# Biblioteca de John Conde

Aplicación web para administrar una biblioteca de libros de programación y tecnología. Permite consultar, buscar y filtrar libros por categoría, crear y editar sus registros, y administrar categorías sin eliminar aquellas que tengan libros asociados.

## Ficha del proyecto

- **Autor:** John Alejandro Conde Parra
- **Ficha:** 3478025
- **Framework:** Laravel 12
- **Base de datos:** MySQL

## Requisitos

- PHP 8.2 o superior con las extensiones requeridas por Laravel y PDO MySQL.
- Composer.
- MySQL en ejecución.

## Instalación

1. Instala las dependencias:

   ```bash
   composer install
   ```

2. Copia `.env.example` a `.env` (en PowerShell: `Copy-Item .env.example .env`) y verifica la configuración de MySQL:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=biblioteca_john_conde
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Crea la base de datos `biblioteca_john_conde` en MySQL si aún no existe.

4. Genera la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

5. Ejecuta las migraciones y carga las categorías y libros de ejemplo:

   ```bash
   php artisan migrate --seed
   ```

6. Inicia el servidor local:

   ```bash
   php artisan serve
   ```

Abre la dirección indicada por Artisan (normalmente `http://127.0.0.1:8000`).
