package Namirial.models;

import java.util.Map;

public class UserModel {

    public UserModel(Map<String, Object> userProperties){
        this.userProperties = userProperties;
    }

    public Map<String, Object> userProperties;
}
