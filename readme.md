
```
composer install
```

```
git submodule init && git submodule update 
```

```
cp .laradock.env.example laradock/.env
```

```
cd docker 
```

```
docker-compose up -d nginx postgres-postgis 
```

```
docker-compose exec workspace bash  
```

```
php artisan migrate && php artisan db:seed  
```

Сделать запрос
GET http://127.0.0.1:8080/api/tariffs/1
