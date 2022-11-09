# Practica 04

Enllaç al repositori public : https://github.com/mperalsapa/servidor-pt04

Aquesta practica inclou les seguents seccions
## Part Basica
- Paginacio dinamica
- Autenticacio d'usuari
- Registre d'usuari
- Creacio, edicio i eliminacio de articles
- Captcha en intents de inici de sessio fallats

## Social Auth
### Oauth2
- (TODO) Discord (Oauth2)

### HybridAuth
- Google Auth (Oauth2)
- Github Auth (Oauth2)
- Twitter Auth (Oauth)

## Recuperacio de contrasenya
- Sol·licitut de restablir contrasenya amb correu electronic existent. S'enviara un enllaç que permetra canviar la contrasenya.
- En comptes d'utilitzar SMTP, es fa servir l'API de [Sendinblue](https://es.sendinblue.com/) per l'enviament de correus.

## Millores
- Mostrar autor i data del article
- Ordre dels articles de mes nou a mes antic
- Perfil d'usuari, on es permet canviar el correu, contrasenya tancar sessio i esborrar el compte
- Canvi de correu des del perfil, protegit per un token que s'envia al correu actual
- Canvi de contrasenya des del perfil
- Enrutador de peticions des d'un mateix fitxer, permetent denegar els subdirectoris i nomes accedir a un unic php.