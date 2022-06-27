package Namirial;

import Namirial.models.KeyModel;
import Namirial.models.UserModel;
import io.quarkus.qute.CheckedTemplate;
import io.quarkus.qute.TemplateInstance;

@CheckedTemplate
public class Templates {
    public static native TemplateInstance index();
    public static native TemplateInstance key(KeyModel model);
    public static native TemplateInstance user(UserModel model);
}