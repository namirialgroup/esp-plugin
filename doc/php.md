## PHP

The PHP plugin uses the [Laravel framework](https://laravel.com/).

### How to start the plugin project

You have to set your ESP parameter on the **.env** file:

- host: the ESP domain uri
- environmentName: the ESP environment value
- final: The user session redirect uri (**Important! You have to contact the ESP team for a custom final uri** )
- apiKey: The api key useful for Backend Authentication
- attributes: The getKey *attributes* parameter
- level: The getKey *level* parameter
- spidType: The getKey *spidType* parameter

```text
HOST=INSERT HOST PARAMETER
ENVIRONMENT_NAME=INSERT ENVIRONMENT NAME PARAMETER
FINAL=http://127.0.0.1:8000/user
API_KEY=INSERT APIKEY PARAMETER
ATTRIBUTES=Base
LEVEL=1
SPID_TYPE=
```

You can use the standard PHP run program
```shell
php composer.phar install
php artisan serve
```

There is a second possibility, the plugin can run on Docker
You can use the docker-compose command to run the plugin

```shell
docker compose up esp-php
```

