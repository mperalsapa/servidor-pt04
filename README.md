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
    - aquest enllaç conte un token el qual caducara passats 15 minuts
    - el sistema de recuperacio de contrasenya limita els intents de recuperacio de contrasenya a 1 intent cada 5 minuts (configurable en una [variable](https://github.com/mperalsapa/servidor-pt04/blob/168546c0a881186fba8fc28e24d697636f9caf79/src/controllers/lost-password.php#L66))
- En comptes d'utilitzar SMTP, es fa servir l'API de [Sendinblue](https://es.sendinblue.com/) per l'enviament de correus.

## Millores
- Mostrar autor i data del article
- Si l'usuari ha iniciat sessio, permet escollir els articles a mostrar entre els propis articles o tots els del lloc web
- Ordre dels articles de mes nou a mes antic
- Perfil d'usuari, on es permet canviar dades personals, tancar sessio i esborrar el compte
    - Canvi de correu des del perfil, protegit per un token que s'envia al correu actual
    - Canvi de contrasenya des del perfil
- Enrutador de peticions des d'un mateix fitxer, permetent denegar els subdirectoris i nomes accedir a un unic php.