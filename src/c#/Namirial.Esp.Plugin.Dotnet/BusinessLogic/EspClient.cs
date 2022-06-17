using System;
using System.Net.Http;
using System.Threading.Tasks;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.Logging;

namespace esp_plugin.BusinessLogic;

public interface IEspClient
{
    /// <summary>
    ///     Get key Method (https://namirialgroup.github.io/esp-docs/integrations/getkey/)
    /// </summary>
    /// <returns>The AuthnKey</returns>
    public Task<string> GetKey();
    /// <summary>
    ///     Get User Method (https://namirialgroup.github.io/esp-docs/integrations/token/)
    /// </summary>
    /// <returns>The AuthnKey</returns>
    public Task<string> GetUser(string id, string key);
}

public class EspClient: IEspClient
{
    /// <summary>
    ///  Typed Http Client (https://docs.microsoft.com/en-us/aspnet/core/fundamentals/http-requests#typed-clients)
    /// </summary>
    private readonly HttpClient _httpClient;
    private readonly ILogger<EspClient> _logger;
    private readonly IConfiguration _configuration;
    /// <summary>
    ///     Configuration with Asp.Net Option pattern (https://docs.microsoft.com/en-us/aspnet/core/fundamentals/configuration/options)
    /// </summary>
    private readonly EspConfiguration _espConfiguration;

    #region Constructor

    public EspClient(HttpClient httpClient,
        ILogger<EspClient> logger,
        IConfiguration configuration)
    {
        _httpClient = httpClient;
        _logger = logger;
        _configuration = configuration;
        _espConfiguration = new EspConfiguration();
        _configuration.GetSection("Esp").Bind(_espConfiguration);
        _httpClient.BaseAddress = new Uri(_espConfiguration.Host);
        _httpClient.DefaultRequestHeaders.Add("Esp-Api-Key", _espConfiguration.ApiKey);
    }

    #endregion

    #region Methods
    
    /// <inheritdoc />
    public async Task<string> GetKey()
    {
        try
        {
            /* Http Get request with all GetKey parameters
             - Attributes
             - Level
             - Spidtype
             */
            var res = await _httpClient.GetAsync(
                $"/api/secure/{_espConfiguration.EnvironmentName}/getkey" +
                $"?attributes={_espConfiguration.Attributes}" +
                $"&level={_espConfiguration.Level}" +
                (string.IsNullOrWhiteSpace(_espConfiguration.SpidType) ? $"&spidType={_espConfiguration.SpidType}": ""));
            
            // If the response is successful it returns the authnkey jwt
            if (res.IsSuccessStatusCode)
            {
                return await res.Content.ReadAsStringAsync();
            }
            return "";
        }
        catch (Exception e)
        {
            _logger.Log(LogLevel.Error, e, "Error");
            throw;
        }
    }
    
    /// <inheritdoc />
    public async Task<string> GetUser(string id, string key)
    {
        try
        {
            /* Http Get request with all GetUser parameters
             - Attributes
             - Level
             - Spidtype
             */
            var res = await _httpClient.GetAsync(
                $"/api/secure/{_espConfiguration.EnvironmentName}/getuser" +
                $"?ID={id}" +
                $"&key={key}");
            
            // If the response is successful it returns the user jwt
            if (res.IsSuccessStatusCode)
            {
                return await res.Content.ReadAsStringAsync();
            }
            return "";
        }
        catch (Exception e)
        {
            _logger.Log(LogLevel.Error, e, "Error");
            throw;
        }
    }
    
    #endregion

}