using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using esp_plugin.BusinessLogic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.Logging;

namespace esp_plugin.Controllers;

/// <summary>
///     Sample Controller
/// </summary>
[Controller]
[Route("")]
public class EspController: Controller
{
    private readonly ILogger<EspController> _logger;
    private readonly IEspClient _espClient;
    private readonly EspConfiguration _espConfiguration;
    private readonly IConfiguration _configuration;

    public EspController(ILogger<EspController> logger,
        IEspClient espClient,
        IConfiguration configuration)
    {
        _configuration = configuration;
        _espConfiguration = new EspConfiguration();
        _configuration.GetSection("Esp").Bind(_espConfiguration);
        _logger = logger;
        _espClient = espClient;
    }
    
    /// <summary>
    ///  The homepage action
    /// </summary>
    /// <returns>The homepage view</returns>
    public ViewResult Index()
    {
        return View("Index");
    }
    
    /// <summary>
    ///  The GetKey action
    /// </summary>
    /// <returns>The key view</returns>
    [Route("key")]
    public ViewResult Key()
    {
        // Retrieve the authn key
        var authnkey = _espClient.GetKey().Result;
        // Parse the authnkey jwt 
        var handler = new JwtSecurityTokenHandler();
        var jwt = handler.ReadJwtToken(authnkey);
        _logger.Log(LogLevel.Information, $"AuthnKey {authnkey}");
        
        // Return the authnkey properties
        return View("Key", new EspModel
        {
            AuthnKey = authnkey,
            AuthnKeyProperties = jwt.Claims.ToDictionary(claim =>  claim.Type, claim => claim.Value),
            LoginUrl = $"{_espConfiguration.Host}/{_espConfiguration.EnvironmentName}/spidlogin?authnKey={authnkey}&final={_espConfiguration.Final}"
        });
    }
    
    /// <summary>
    ///  The GetUser action
    /// </summary>
    /// <returns>The user view</returns>
    [Route("user")]
    public ViewResult User()
    {
        if (HttpContext.Request.Query.TryGetValue("sessionid", out var sessionId) &&
            HttpContext.Request.Query.TryGetValue("sessionkey", out var sessionKey) &&
            !string.IsNullOrWhiteSpace(sessionId) &&
            !string.IsNullOrWhiteSpace(sessionKey)
           )
        {
            // Retrieve the user information from session id and key
            var userSession = _espClient.GetUser(sessionId, sessionKey).Result;
            
            // Parse the user jwt 
            var handler = new JwtSecurityTokenHandler();
            var jwt = handler.ReadJwtToken(userSession);
            
            // Return the user properties
            return View("User", new EspModel
            {
                UserMsg = $"Login successfully with session id {sessionId} and key {sessionKey}",
                UserProperties = jwt.Claims.ToDictionary(claim =>  claim.Type, claim => claim.Value)
            });
        }

        return View("User", new EspModel
        {
            UserMsg = $"Error during retrieve session",
        });

    }
    
}