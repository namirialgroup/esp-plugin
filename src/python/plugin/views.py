import os

import jwt
from django.http import HttpResponse
from django.template import loader
from django.shortcuts import render
from django.conf import settings
import requests


def index(request):
    template = loader.get_template('index.html')
    return HttpResponse(template.render())


def user(request):
    session_id = request.GET.get("sessionid")
    session_key = request.GET.get("sessionkey")
    headers_dictionary = {"Esp-Api-Key": settings.ESP_API_KEY}
    user_response = requests.get(f'{settings.ESP_HOST}/api/secure/{settings.ESP_ENVIRONMENT_NAME}/getuser'
                                 f'?ID={session_id}'
                                 f'&key={session_key}', headers=headers_dictionary, verify=False)
    user_properties = jwt.decode(user_response.text, options={"verify_signature": False})
    context = {'user_msg': user_response.text, 'user_properties': user_properties}
    return render(request, 'user.html', context)


def key(request):
    headers_dictionary = {"Esp-Api-Key": settings.ESP_API_KEY}
    spid_type = f'&spidType={settings.ESP_SPID_TYPE}' if settings.ESP_SPID_TYPE else ""
    authn_key = requests.get(f'{settings.ESP_HOST}/api/secure/{settings.ESP_ENVIRONMENT_NAME}/getkey'
                             f'?attributes={settings.ESP_ATTRIBUTES}'
                             f'&level={settings.ESP_LEVEL}'
                             f'{spid_type}', headers=headers_dictionary, verify=False)
    authn_key_properties = jwt.decode(authn_key.text, options={"verify_signature": False})
    login_url = f'{settings.ESP_HOST}/{settings.ESP_ENVIRONMENT_NAME}/spidlogin?authnKey={authn_key.text}&final={settings.ESP_FINAL} '
    context = {'authn_key': authn_key.text, 'authn_key_properties': authn_key_properties, 'login_url': login_url}
    return render(request, 'key.html', context)
