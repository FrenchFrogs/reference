# reference
Gestion des tables de références

#Je ne maintiens plus ce package, j'ai migré https://github.com/cotcotquedec/frenchfrogs

l'objectif de ce modules est de facilité la crétion de reference dans un projet en apportant un maximum de confort pour les developpeurs.
Les fonctions principals sont :
- Unification des tables de reference dans une seul table (allègement du modèle de donnée)
- Facilité pour les développeur de créer de nouvelle référence à travers des migrations
- Mise en cache des reference pour ne plus soliciter systematiquement la BDD
- Création d'un fichier pour via la console pour facilité l'utilisation de ses références

# Installation

Si vous souhaitez utiliser l'import des reference pour utiliser des constante dans le code avec l'autocomplétion :
- verifier que vous avez un fichier Ref.php dans le dossier bootstrap (même vide)
- ajouter "files": ["bootstrap/Ref.php"] dans votre fichier composer.json ou un require_once de fichier dans le fichier bootstrap/app.php


```bash
composer require frenchfrogs/reference
php artisan reference:table
php migrate
php artisan reference:build
```

Et voilà!!!!

# Comment ca marche

## Ajouter des références en Base de donnée

Dans un fichier de migration, mettre le code suivant pour créer un référence
```php
use FrenchFrogs\Models\Reference;

//....

Reference::createDatabaseReference($id, $name, $collection, $data = null );
```

La fonction ref() est ajouté pour avoir un accès rapide a des listes de collections

```php
$reference = \ref('member.status')->getData();
dd($reference);
```

Affichera : 
```
array:3 [▼
  0 => array:7 [▼
    "reference_id" => "MEMBER_STATUS_ACTIVE"
    "name" => "Actif"
    "collection" => "member.status"
    "data" => "null"
    "deleted_at" => null
    "created_at" => "2016-06-21 11:05:14"
    "updated_at" => "2016-06-21 11:05:14"
  ]
  1 => array:7 [▼
    "reference_id" => "MEMBER_STATUS_PAID"
    "name" => "Payant"
    "collection" => "member.status"
    "data" => "null"
    "deleted_at" => null
    "created_at" => "2016-06-21 11:05:14"
    "updated_at" => "2016-06-21 11:05:14"
  ]
  2 => array:7 [▼
    "reference_id" => "MEMBER_STATUS_DELETED"
    "name" => "Supprimé"
    "collection" => "member.status"
    "data" => "null"
    "deleted_at" => null
    "created_at" => "2016-06-21 11:05:14"
    "updated_at" => "2016-06-21 11:05:14"
  ]
]
```

Affichera : 
```php
$reference = \ref('member.status')->pairs();
dd($reference);
```

```
array:3 [▼
  "MEMBER_STATUS_ACTIVE" => "Actif"
  "MEMBER_STATUS_PAID" => "Payant"
  "MEMBER_STATUS_DELETED" => "Supprimé"
]
```









