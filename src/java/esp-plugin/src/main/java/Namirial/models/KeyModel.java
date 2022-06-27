package Namirial.models;


import java.util.HashSet;
import java.util.Hashtable;
import java.util.Map;
import java.util.Set;

public class KeyModel {

   public KeyModel(String authnKey, Map<String, Object> authnKeyProperties,
                   String loginUrl){
       this.authnKey = authnKey;
       this.authnKeyProperties = authnKeyProperties;
       this.loginUrl = loginUrl;
   }

    public String authnKey;
    public Map<String, Object> authnKeyProperties;
    public String loginUrl;
}