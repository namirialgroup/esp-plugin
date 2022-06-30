from django.urls import path

from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('key', views.key, name='key'),
    path('user', views.user, name='user'),
]