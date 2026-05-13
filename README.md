# ko.dok ERP

A legacy PHP/MySQL ERP system for managing clothing store inventory, sales, and employees. Originally built to study PHP with MySQL.

---

## Requirements

- [Docker](https://docs.docker.com/get-docker/) 20.10+
- [Docker Compose](https://docs.docker.com/compose/install/) v2+

No PHP or MySQL installation needed on the host machine.

---

## Running Locally

### 1 — Clone the repository

```bash
git clone https://github.com/jasonhdes/primeiro-projeto-php.git
cd primeiro-projeto-php
```

### 2 — Start the containers

```bash
docker compose up --build
```

The first run will:
1. Build the PHP 7.4 + Apache image
2. Start a MySQL 8.0 container
3. Run `database/migrate.sql` (creates all tables)
4. Run `database/seed.sql` (populates demo data)

Wait until you see `Starting Apache` in the logs before opening the browser.

### 3 — Open the application

```
http://localhost:8080
```

### 4 — Stop the containers

```bash
docker compose down
```

To also delete the database volume (full reset):

```bash
docker compose down -v
```

---

## Login Credentials

The login screen asks for a **registro** (employee ID) and **senha** (password).

### Administrador

| Registro | Senha    | Nome     | Loja           |
|----------|----------|----------|----------------|
| 1001     | Admin@1  | Carlos   | Matriz         |
| 1002     | Admin@2  | Fernanda | Filial Centro  |

### Gerente

| Registro | Senha      | Nome    | Loja           |
|----------|------------|---------|----------------|
| 2001     | Gerente@1  | Roberto | Matriz         |
| 2002     | Gerente@2  | Juliana | Filial Centro  |

### Almoxarifado

| Registro | Senha     | Nome    | Loja          |
|----------|-----------|---------|---------------|
| 3001     | Almoxa@1  | Marcos  | Matriz        |
| 3002     | Almoxa@2  | Patricia| Filial Norte  |

### Vendas

| Registro | Senha    | Nome   | Loja          |
|----------|----------|--------|---------------|
| 4001     | Vendas@1 | Lucas  | Filial Centro |
| 4002     | Vendas@2 | Amanda | Filial Norte  |

---

## Stores (Locais)

| ID | Nome           | Cidade          | Estado     |
|----|----------------|-----------------|------------|
| 1  | Matriz         | São Paulo       | SP         |
| 2  | Filial Centro  | Rio de Janeiro  | RJ         |
| 3  | Filial Norte   | Curitiba        | PR         |

---

## Project Structure

```
.
├── _css/          # Stylesheets
├── _ctrl/         # Controllers (form handlers)
├── _img/          # Static images
├── _js/           # JavaScript files
├── _mdl/          # Models (DB queries, access.php)
├── _vw/           # Views (PHP templates)
├── database/
│   ├── migrate.sql   # Schema creation
│   └── seed.sql      # Demo data
├── docker/
│   └── entrypoint.sh # Container startup script
├── Dockerfile
├── docker-compose.yml
├── bd.sql         # Original schema reference (legacy)
└── index.php      # Application entry point (login)
```

---

## Technical Notes

- **PHP 7.4** — required for compatibility with `utf8_encode()` and `md5()` used throughout the original code.
- **socat proxy** — the application hardcodes `localhost` as the MySQL host. The app container runs `socat` to forward `localhost:3306 → db:3306`, keeping the original source untouched.
- **MD5 passwords** — the login query uses `md5()` directly in SQL. Seed passwords are stored accordingly.

---

## Database Connection (for reference)

These credentials are hardcoded in `_mdl/access.php` and reflected in `docker-compose.yml`:

| Parameter | Value          |
|-----------|----------------|
| Host      | localhost      |
| Database  | jasonh_erp     |
| User      | jasonh_jason   |
| Password  | xcVd~T.HFJZ}   |
