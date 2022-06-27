package Namirial.configurations;

import org.eclipse.microprofile.config.ConfigProvider;

public class EspConfiguration {

    //private final String CONFIGURATION_PREFIX = "esp.";

    public EspConfiguration(){
        this.host = ConfigProvider.getConfig().getValue("quarkus.rest-client.esp-api.url", String.class);
        this.environment = ConfigProvider.getConfig().getValue("esp.environment", String.class);
        this.finalUri = ConfigProvider.getConfig().getValue("esp.finalUri", String.class);
        this.apikey = ConfigProvider.getConfig().getValue("esp.apikey", String.class);
        this.attributes = ConfigProvider.getConfig().getValue("esp.attributes", String.class);
        this.level = ConfigProvider.getConfig().getValue("esp.level", Integer.class);
        this.spidtype = ConfigProvider.getConfig().getValue("esp.spidtype", String.class);

    }

    public String host;
    public String environment;
    public String finalUri;
    public String apikey;
    public String attributes;
    public Integer level;
    public String spidtype;
}
