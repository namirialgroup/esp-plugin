# Namirial ESP Plugin
The following repository contains an ESP plugin for SPID Authentication (a.k.a. the Italian 'Sistema Pubblico di Identità Digitale').
The plugin is available for the most famous programming languages:
- [C#](https://docs.microsoft.com/en-us/dotnet/csharp/)
- [Typescript](https://www.typescriptlang.org/)
- [PHP](https://www.php.net/)
- [Python](https://www.python.org/)
- [Java](https://www.java.com/it/)
- [Kotlin](https://kotlinlang.org/)
- [Swift](https://developer.apple.com/swift/)

## C#

The C# plugin uses the [Asp.Net Core 6.0 framework](https://dotnet.microsoft.com/en-us/download/dotnet/6.0).
The project use the new [minimal](https://docs.microsoft.com/en-us/aspnet/core/release-notes/aspnetcore-6.0?view=aspnetcore-6.0#minimal-apis) Program.cs version.


### How to start the plugin project
You have to set your ESP parameter on the **appsettings.json** file:
- host: the ESP domain uri
- environmentName: the ESP environment value
- final: The user session redirect uri (**Important! You have to contact the ESP team for a custom final uri** )
- apiKey: The api key useful for Backend Authentication
- attributes: The getKey *attributes* parameter
- level: The getKey *level* parameter
- spidType: The getKey *spidType* parameter

```json
"Esp": {
    "host": "<INSERT HOST PARAMETER>",
    "environmentName": "<INSERT ENVIRONMENT NAME PARAMETER>",
    "final": "http://localhost:8000/user",
    "apiKey": "<INSERT API KEY PARAMETER>",
    "attributes": "Base",
    "level": 1,
    "spidType": null
}
```

You can use the standard .Net run program
```shell
dotnet build "Namirial.Esp.Plugin.Dotnet.csproj"
dotnet run "Namirial.Esp.Plugin.Dotnet.csproj"
```

There is a second possibility, the plugin can run on Docker
You can use the docker-compose command to run the plugin

```shell
docker compose up esp-dotnet
```

### Possible troubleshooting
If you want to use the https version, maybe the plugin can have some problem with
the dev certificates.
The following commands resolve this problem:
```shell
dotnet dev-certs https --clean 
dotnet dev-certs https --trust
```

# Authors
* [Federico Simonetti](https://github.com/Soapfedan) (maintainer)