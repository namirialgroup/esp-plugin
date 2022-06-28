## Java

The Java plugin uses the [quarkus framework](https://quarkus.io/).

### How to start the plugin project

You have to set your ESP parameter on the **application.properties** file:

- host: the ESP domain uri
- environmentName: the ESP environment value
- final: The user session redirect uri (**Important! You have to contact the ESP team for a custom final uri** )
- apiKey: The api key useful for Backend Authentication
- attributes: The getKey *attributes* parameter
- level: The getKey *level* parameter
- spidType: The getKey *spidType* parameter

```text
quarkus.rest-client.esp-api.url=INSERT HOST PARAMETER 
esp.environment=INSERT ENVIRONMENT NAME PARAMETER
esp.finalUri=http://localhost:8080/user
esp.apikey=INSERT APIKEY PARAMETER
esp.attributes=Base
esp.level=1
esp.spidtype=""
```

You can use the standard Quarkus run program
```shell
quarkus dev
```

There is a second possibility, the plugin can run on Docker
You can use the docker-compose command to run the plugin

```shell
cd ./src/java/esp-plugin
./mvnw package
cd ../../../
docker compose up esp-java
```

