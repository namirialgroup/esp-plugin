package Namirial.rest.client;

import org.eclipse.microprofile.rest.client.annotation.RegisterClientHeaders;
import org.eclipse.microprofile.rest.client.inject.RegisterRestClient;
import org.jboss.resteasy.annotations.jaxrs.PathParam;
import org.jboss.resteasy.annotations.jaxrs.QueryParam;

import javax.ws.rs.GET;
import javax.ws.rs.Path;

@Path("/api/secure")
@RegisterRestClient(configKey="esp-api")
@RegisterClientHeaders(ApiKeyFactory.class)
public interface EspClient {

    @GET
    @Path("/{environment}/getKey")
    String getKey(@PathParam String environment, @QueryParam String attributes, @QueryParam Integer level);

    @GET
    @Path("/{environment}/getUser")
    String getUser(@PathParam String environment, @QueryParam String ID, @QueryParam String key);
}