package Namirial.rest.client;


import Namirial.configurations.EspConfiguration;
import org.eclipse.microprofile.rest.client.ext.ClientHeadersFactory;

import javax.enterprise.context.ApplicationScoped;
import javax.ws.rs.core.MultivaluedHashMap;
import javax.ws.rs.core.MultivaluedMap;

@ApplicationScoped
public class ApiKeyFactory implements ClientHeadersFactory {

    private EspConfiguration configuration;

    public ApiKeyFactory() {
        configuration = new EspConfiguration();
    }

    @Override
    public MultivaluedMap<String, String> update(MultivaluedMap<String, String> incomingHeaders, MultivaluedMap<String, String> clientOutgoingHeaders) {
        MultivaluedMap<String, String> result = new MultivaluedHashMap<>();
        result.add("Esp-Api-Key", configuration.apikey);
        return result;
    }
}