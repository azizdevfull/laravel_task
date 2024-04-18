<h1>Installation</h1>

install packages

```bash
composer i
```

.env setup database

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=db_user
DB_PASSWORD=db_pass
```

Key generate

```bash
php artisan key:generate
```

Storage link

```bash
php artisan storage:link
```

Migrate database

```bash
php artisan migrate
```

Database seed for create Regions and Districts

```bash
php artisan db:seed
```

Cron job for block inactive users and sync currency

```bash
php artisan schedule:work
```

Create swagger api docs then enter <a href="http://127.0.0.1:8000/api/documentation">Doc</a>

```bash
php artisan l5-swagger:generate
```
