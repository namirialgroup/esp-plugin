package Namirial;

import com.fasterxml.jackson.core.JsonProcessingException;
import io.quarkus.qute.TemplateInstance;
import javax.inject.Inject;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import java.net.URISyntaxException;

@Path("")
public class EspResource {

    @Inject
    EspService espService;

    @GET
    @Path("")
    @Produces(MediaType.TEXT_HTML)
    public TemplateInstance index() { return Templates.index(); }

    @GET
    @Path("/key")
    @Produces(MediaType.TEXT_HTML)
    public TemplateInstance key() throws JsonProcessingException, URISyntaxException {
        return Templates.key(espService.getKey());
    }

    @GET
    @Path("/user")
    @Produces(MediaType.TEXT_HTML)
    public TemplateInstance user(@QueryParam("sessionid") String id, @QueryParam("sessionkey") String key) throws JsonProcessingException {
        return Templates.user(espService.getUser(id, key));
    }
}