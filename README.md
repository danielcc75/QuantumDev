# QuantumDev — Portafolio (TIS 2026)

Aplicación web desarrollada en **Laravel 11** sobre **PostgreSQL 16**, contenedorizada con Docker.

> **Nota sobre la entrega:** este proyecto se distribuye en CD con todas las
> credenciales incluidas. El archivo `.env` ya viene configurado (`APP_KEY`,
> conexión a la base de datos, etc.), por lo que **no es necesario** copiar
> `.env.example` ni generar claves manualmente. Basta con levantar los
> contenedores.

## Stack tecnológico

- **Backend:** PHP 8.2 / Laravel 11
- **Base de datos:** PostgreSQL 16
- **Frontend:** Vite + Tailwind CSS
- **Entorno:** Docker / Docker Compose

## Instalación con Docker

Forma recomendada para levantar el proyecto tal como se entrega en el CD.

### Requisitos previos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y en ejecución
- [Git](https://git-scm.com/) instalado (solo si se clona desde el repositorio)

### Pasos

**1. Ubicarse en la carpeta del proyecto**

Copia la carpeta `QuantumDev` del CD a tu equipo y entra en ella:

```bash
cd QuantumDev
```

> Si en lugar del CD usas el repositorio, primero clónalo
> (`git clone <URL_DEL_REPOSITORIO>`) y luego copia el `.env` provisto, ya que
> ese archivo no se versiona.

**2. Construir y levantar los contenedores**

```bash
docker compose up --build
```

Este comando:
- Construye la imagen de PHP 8.2 con las dependencias necesarias
- Levanta el contenedor de la aplicación Laravel (`TIS_2026`) en el puerto `8000`
- Levanta el contenedor de PostgreSQL 16 (`TIS_2026_DB`) en el puerto `5432`
- Ejecuta automáticamente `composer install`, corre las migraciones e inicia el servidor

**3. Acceder a la aplicación**

Abre tu navegador en: [http://localhost:8000](http://localhost:8000)

### Detener los contenedores

```bash
docker compose down
```

Para detener y eliminar los volúmenes (base de datos):

```bash
docker compose down -v
```

## Credenciales incluidas

Como el proyecto se entrega completo, las credenciales ya vienen configuradas
en el archivo `.env` y en `docker-compose.yml`. La base de datos es la misma en
ambos casos; solo cambia el host según dónde se ejecute:

| Servicio        | Valor                          |
| --------------- | ------------------------------ |
| Base de datos   | `Portafolio`                   |
| Usuario BD      | `quantumdev`                   |
| Contraseña BD   | `quantumdev`                   |
| Host BD (Docker)| `postgres`                     |
| Host BD (local) | `localhost`                    |
| Puerto BD       | `5432`                         |
| App URL         | `http://localhost:8000`        |

> En Docker, el bloque `environment` de `docker-compose.yml` fija `DB_HOST=postgres`
> y tiene prioridad sobre el `.env`. Para una ejecución local (`php artisan serve`)
> se usa el `localhost` definido en el `.env`.

El `.env` incluido también trae configuradas las integraciones de **OAuth
(GitHub y Google)** y el envío de **correo (SMTP de Gmail)**. Estas credenciales
corresponden al entorno de desarrollo del equipo y **no deben usarse en
producción** ni publicarse fuera de esta entrega.

## Estructura del proyecto

```
QuantumDev/
├── app/                # Modelos, controladores y proveedores
├── bootstrap/          # Arranque de la aplicación
├── config/             # Configuración de Laravel
├── database/           # Migraciones, seeders y factories
├── public/             # Punto de entrada (index.php) y assets públicos
├── resources/          # Vistas Blade, CSS y JS
├── routes/             # Definición de rutas (web.php, console.php)
├── storage/            # Logs, caché y archivos generados
├── tests/              # Pruebas automatizadas
├── docker-compose.yml  # Definición de los servicios
└── dockerfile          # Imagen de PHP/Laravel
```

## Equipo

**QuantumDev** — Taller de Ingeniería de Software (TIS), 2026.
