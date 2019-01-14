
```
composer install
```


```
cp .env.example .env
```

```
git submodule init && git submodule update 
```

```
cp .laradock.env.example laradock/.env
```

```
cd laradock 
```

```
docker-compose up -d nginx postgres-postgis 
```

```
docker-compose exec workspace bash  
```

```
php artisan migrate:fresh && php artisan db:seed  
```

Сделать запрос для получения информации о тарифе `GET http://127.0.0.1:8080/api/tariffs/1`
