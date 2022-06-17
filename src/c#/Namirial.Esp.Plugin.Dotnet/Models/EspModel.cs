using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;

namespace esp_plugin;


/// <summary>
///     This is a sample model. It only useful for demo purposes
/// </summary>
public class EspModel
{
    public string AuthnKey { get; set; }
    public Dictionary<string, string> AuthnKeyProperties { get; set; }
    
    public string LoginUrl { get; set; }
    
    public string UserMsg { get; set; }
    
    public Dictionary<string, string> UserProperties { get; set; }

}