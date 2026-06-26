# Oracle Setup

This project is configured for Laravel + Oracle through `yajra/laravel-oci8`.

## Current Local Target

Your machine already has an Oracle XE 11g listener that responds to the `XE` service name.

```env
DB_CONNECTION=oracle
DB_HOST=127.0.0.1
DB_PORT=1521
DB_DATABASE=XE
DB_SERVICE_NAME=XE
DB_USERNAME=NEONJUDGE
DB_PASSWORD=neonjudge_password
DB_CHARSET=AL32UTF8
DB_SERVER_VERSION=11g
ORA_MAX_NAME_LEN=30
```

## Enable PHP OCI8

XAMPP already has `D:\xampp\php\ext\php_oci8_19.dll`, but `php -m` does not currently show `oci8`.

1. Install Oracle Instant Client 19.x 64-bit.
2. Put the Instant Client folder before older Oracle folders in the Windows `PATH`.
3. In `D:\xampp\php\php.ini`, enable:

```ini
extension=oci8_19
```

Do not enable `pdo_oci` for this Laravel driver; `yajra/laravel-oci8` uses OCI8.

Verify:

```powershell
php -m | Select-String oci8
```

## Create The Oracle User

Open SQL*Plus as SYSDBA:

```powershell
sqlplus / as sysdba
```

Then run:

```sql
CREATE USER NEONJUDGE IDENTIFIED BY neonjudge_password
    DEFAULT TABLESPACE users
    TEMPORARY TABLESPACE temp
    QUOTA UNLIMITED ON users;

GRANT CREATE SESSION,
      CREATE TABLE,
      CREATE SEQUENCE,
      CREATE TRIGGER,
      CREATE VIEW,
      CREATE PROCEDURE
TO NEONJUDGE;
```

Check login:

```powershell
sqlplus NEONJUDGE/neonjudge_password@XE
```

## Raw SQL Migration

The `users` table is written as simple Oracle SQL inside the Laravel migration:

```text
database/migrations/2026_06_23_000000_create_users_table.php
```

So the database table, sequence, trigger, and index are created by `php artisan migrate`.

## Run Laravel

After OCI8 is enabled:

```powershell
composer install
php artisan config:clear
php artisan migrate
php artisan db:seed
php artisan serve
```

If you switch to Oracle Free/23ai later, change `DB_DATABASE` and `DB_SERVICE_NAME` to `FREEPDB1`, set `DB_SERVER_VERSION=23ai`, and set `ORA_MAX_NAME_LEN=128`.
