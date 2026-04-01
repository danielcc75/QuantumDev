

## Instalación con Docker

Sigue estos pasos para levantar el proyecto usando Docker.

### Requisitos previos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y en ejecución
- [Git](https://git-scm.com/) instalado

### Pasos

**1. Clonar el repositorio**

```bash
git clone <URL_DEL_REPOSITORIO>
cd QuantumDev
```

**2. Copiar el archivo de variables de entorno**

```bash
cp .env.example .env
```

**3. Construir y levantar los contenedores**

```bash
docker compose up --build
```

Este comando:
- Construye la imagen de PHP 8.2 con las dependencias necesarias
- Levanta el contenedor de la aplicación Laravel (`TIS_2026`) en el puerto `8000`
- Levanta el contenedor de PostgreSQL 16 (`TIS_2026_DB`) en el puerto `5432`
- Ejecuta automáticamente `composer install`, genera la `APP_KEY`, corre las migraciones e inicia el servidor

**4. Acceder a la aplicación**

Abre tu navegador en: [http://localhost:8000](http://localhost:8000)

### Detener los contenedores

```bash
docker compose down
```

Para detener y eliminar los volúmenes (base de datos):

```bash
docker compose down -v
```

---

