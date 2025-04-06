# Project Setup Guide

To set up the project, follow these steps:

1. Create a `.env` file in the project root and add the required environment variables. Use `.env.example` as a reference.

2. Run the setup command:
   ```bash
   sudo make setup
   ```
3. Connect to the database and import the latest version of the .sql file from the installation/backup/ folder (as of February 2025, the file was database_v14.9.sql).

4. Run the migration command:
   ```bash
   sudo make migrate
   ```

5. Set file and directory permissions by running the following commands:
   ```bash
   chmod 755 .env
   chmod 777 modules_statuses.json
   sudo chmod -R 777 storage
   sudo chmod -R 777 bootstrap/cache
   chmod -R 777 resources/lang
   chmod 777 app/Providers/RouteServiceProvider.php
   sudo chown -R www-data:www-data storage/oauth-private.key storage/oauth-public.key
   sudo chmod 444 storage/oauth-private.key storage/oauth-public.key
   ```

> **Note:** Ensure that permissions are configured securely to avoid potential vulnerabilities.

