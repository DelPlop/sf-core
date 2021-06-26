# UserBundle

## Comment s'en servir
Dans le projet "enfant", configurer `composer.json` pour y ajouter :
```
    "repositories" : [{
        "type": "vcs",
        "url": "https://github.com/DelPlop/sf-core.git"
    }],
```
puis exécuter `composer require delplop/corebundle <version>`.

UserBundle sera disponible en tant que vendor.