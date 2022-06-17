namespace esp_plugin;

/// <summary>
///     For more information see the documentation (https://namirialgroup.github.io/esp-docs/)
/// </summary>
public class EspConfiguration
{
    /// <summary>
    ///     The Esp domain uri
    /// </summary>
    public string Host { get; set; }
    /// <summary>
    ///     Your esp environment name
    /// </summary>
    public string EnvironmentName { get; set; }
    /// <summary>
    ///     The final redirect uri. It receives the user session
    /// </summary>
    public string Final { get; set; }
    /// <summary>
    ///     Your environment api key
    /// </summary>
    public string ApiKey { get; set; }
    /// <summary>
    ///     The GetKey attribute parameter (https://namirialgroup.github.io/esp-docs/integrations/getkey/)
    /// </summary>
    public string Attributes { get; set; }
    /// <summary>
    ///     The GetKey level parameter (https://namirialgroup.github.io/esp-docs/integrations/getkey/)
    /// </summary>
    public int Level { get; set; }
    /// <summary>
    ///     The GetKey spidtype parameter (https://namirialgroup.github.io/esp-docs/integrations/getkey/)
    /// </summary>
    public string SpidType { get; set; }
}