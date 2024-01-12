## Michicoin 1.0v

Michicoin 1.0v es un CMS construit sobre backpack 5 + laravel 9 que ens permet tenir una web a mida operativa en molt poc temps.

- [Framework Laravel 9](https://laravel.com/docs/).
- [Framework Backpack 5.0](https://backpackforlaravel.com/docs).


## Instal·lació

Descomprimir i executar

    composer install

Modificar els valors del .env per la base de dades. Llavors executar

    php artisan fnx7:install

i ja podrem accedir a /admin per crear el nostre usuari


## Generant Elements Multiidioma amb URL

Si necessitem generar entitats (productes, activitats, etc...) amb una url a mida i tot només cal fer ús de la comanda:

    php artisan fnx7:crud-url entitat

Entitat es en singular. Ex( product, house, entry...) Que ens generara el model, controller, vista, migració, request i o posará al menú. Si volem que tingui categories afegim --with-categories


    php artisan fnx7:crud-url entitat --with-categories


Això generara tb les taules, models i controllers per la categoria, amb el nom EntitatCat

## Fitxer .env

Si treballes amb MAMP descomenta el DB_SOCKET.

**ALLOW_CREATE_SETTINGS:** Et permet afegir o no noves configuracions, un cop has donat d'alta els tipus cal posar-ho a FALSE

**BACKPACK_REGISTRATION_OPEN:** De backpack. Per crear el primer usuari. Un cop creat posar a false

**VALID_MENU_MODELS**: Els models URL que volem tenir disponibles per afegir al menu. Separat per , Per defecte només permetem pàgines


## Menus i Settings

Ara per accedir al menu des de la vista es la funcio getMenu(POSITION). Ex.:
getMenu('principal');

per les Settings, ara podem definir settings amb camps crud. Per obtenirles es getSetting(KEY,TRANSLATABLE,DEFAULT)

KEY: Clau de la setting. Obligatori
TRANSLATABLE: TRUE/FALSE. Opcional. Defecte FALS. Ens indica si hem d'obtenir una setting traduible o no
DEFAULT: Valor a obtenir per defecte si no esta definida


## Més dubtes

Consulta la WIKI del bitbucket.