## Python

The Python plugin uses the [Django framework](https://www.djangoproject.com/).

### How to start the plugin project

You have to set your ESP parameter on the settings.py file:

- host: the ESP domain uri
- environmentName: the ESP environment value
- final: The user session redirect uri (**Important! You have to contact the ESP team for a custom final uri** )
- apiKey: The api key useful for Backend Authentication
- attributes: The getKey *attributes* parameter
- level: The getKey *level* parameter
- spidType: The getKey *spidType* parameter

```text
ESP_HOST=INSERT HOST PARAMETER
ESP_ENVIRONMENT_NAME=INSERT ENVIRONMENT NAME PARAMETER
ESP_FINAL=http://127.0.0.1:8000/user
ESP_API_KEY=INSERT APIKEY PARAMETER
ESP_ATTRIBUTES=Base
ESP_LEVEL=1
ESP_SPID_TYPE= INSERT SPID TYPE
```

You can use the standard Python run program
```shell
pip install -r requirements.txt
python manage.py runserver
```

There is a second possibility, the plugin can run on Docker
You can use the docker-compose command to run the plugin

```shell
docker compose up esp-python
```

