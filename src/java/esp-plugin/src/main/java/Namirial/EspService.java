package Namirial;

import Namirial.configurations.EspConfiguration;
import Namirial.models.KeyModel;
import Namirial.models.UserModel;
import Namirial.rest.client.EspClient;
import com.fasterxml.jackson.core.JsonProcessingException;
import org.eclipse.microprofile.rest.client.inject.RestClient;
import javax.enterprise.context.ApplicationScoped;
import javax.inject.Inject;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.Base64;
import java.util.HashMap;
import com.fasterxml.jackson.databind.ObjectMapper;
import java.util.Hashtable;
import java.util.Map;

@ApplicationScoped
public class EspService {

    @Inject
    @RestClient
    EspClient espClient;

    private EspConfiguration configuration;

    public EspService() {
        configuration = new EspConfiguration();
    }

    public KeyModel getKey() throws JsonProcessingException, URISyntaxException {
        var authnKey = espClient.getKey(configuration.environment, configuration.attributes, configuration.level);
        String[] chunks = authnKey.split("\\.");
        Base64.Decoder decoder = Base64.getUrlDecoder();
        String payload = new String(decoder.decode(chunks[1]));
        Map<String, Object> mapping = new ObjectMapper().readValue(payload, HashMap.class);

        String loginUrl = configuration.host
                + "/"
                + configuration.environment
                + "/spidlogin"
                + "?authnKey="
                + authnKey.replace("\"","")
                + "&final="
                + configuration.finalUri;

        return new KeyModel(authnKey, mapping,loginUrl);
    }

    public UserModel getUser(String ID, String key) throws JsonProcessingException {
        var jwt = espClient.getUser(configuration.environment, ID, key);
        String[] chunks = jwt.split("\\.");
        Base64.Decoder decoder = Base64.getUrlDecoder();
        String payload = new String(decoder.decode(chunks[1]));
        Map<String, Object> mapping = new ObjectMapper().readValue(payload, HashMap.class);
        return new UserModel(mapping);
    }
}
