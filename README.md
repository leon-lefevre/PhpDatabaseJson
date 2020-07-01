# SIMPLE JSON DB

Une classe json db simple, très utile pour exécuter des tests ou pour développer des applications très basiques pour un usage personnel à la volée. De plus, il est très facile à configurer.

## INSTALLATION

Pour installer la base de données, vous devez télécharger `Database.php` et la placer où vous le souhaitez.

```php
    //Exiger le fichier dans votre script
    require("../ton-dossier/libs/Database.php");
```

## INITIALISER LA DB

In order to connect to a json db or to create one, you need to run the following code:

```php
    // initialiser une base de données avec le nom par défaut (db.json)
    $database = new DB();
```

Cela affectera à la variable `$ database` la base de données 'db', car vous n'avez pas fourni de base de données personnalisée.

```php
    // Un db nommé custom.json
    $database2 = new DB("custom");
```

Celui-ci, cependant, affectera à la variable «$ database2» la base de données «custom», fournie en tant que paramètre lorsque vous instanciez la classe.
Veuillez noter que si la base de données personnalisée n'existe pas lorsque vous l'instanciez, une base de données vide sera créée.

## INSÉRER

Afin d'insérer un nouveau champ dans la base de données sélectionnée, vous devez exécuter le code suivant:

```php
    //Ajoutez un nouveau champ à la base de données, en passant les données (un tableau) et la clé (dans ce cas, l'id, mais vous pouvez en choisir un personnalisé)
    $new_data = [
        "id" => 1,
        "name" => "John",
        "surname" => "Doe"
    ];
     $database->insert($new_data, $new_data['id']);
```

## Résultat Unique

Si vous avez besoin d'un résultat unique basé sur la clé, vous devez exécuter le code suivant:

```php
    $result = $database->getSingle("1");

    print_r($result);
```

Cela retournera un objet Json, comme ceci:

```json
{
  "1": {
    "id": "1",
    "name": "John",
    "surname": "Doe"
  }
}
```

## Résultat Multiple

Vous pouvez également décider de sélectionner plusieurs résultats, en fonction d'une requête.
La requête est un tableau de clés avec les valeurs relatives, quelque chose comme ceci:

```php
    $query = [
        "name" => "John",
        "surname" => "Doe"
    ];
```

Avec cette requête, j'essaie de sélectionner tous les résultats dont le nom est «John» et dont le nom de famille est «Doe».
Maintenant, nous devons exécuter cette requête et obtenir nos résultats:

```php
    //Afficher plusieurs résultats basés sur la requête du tableau (dans ce cas, tous les champs avec le nom: "John" et le nom de famille: "Doe")
    
    $result2 = $database3->getList($query);

    print_r($result2);
```

Cela retournera un objet Json, comme ceci:

```json
{
  "1": {
    "id": 1,
    "name": "John",
    "surname": "Doe",
    "age": 24,
    "city": "Amsterdam"
  },
  "27": {
    "id": 27,
    "name": "John",
    "surname": "Doe",
    "age": 47,
    "city": "Rome"
  }
}
```

Ce n'est qu'un test avec une base de données que j'ai remplie avec plusieurs résultats aléatoires!

### Trier

Vous pouvez également trier votre résultat en passant un autre paramètre à la fonction `getList`, comme suit:

```php
    //Commandez le param fourni
    $result2 = $database3->getList($query, ["on" => "name", "order" => "ASC"]);
```

Dans l'exemple précédent, avec la fonction, nous avons transmis des informations sur la façon dont nous voulons que le résultat soit trié:

- `on` est la clé que nous voulons considérer
- `order` est l'ordre, et il peut être ASC ou DESC

## Supprimer

Vous pouvez facilement supprimer un résultat en exécutant la fonction `delete`, comme suit:

```php
    //Supprimez la ligne de la base de données en fonction de la clé que vous passez
    $database3->delete("my-key");
```

## Nettoyer

Vous pouvez facilement effacer la base de données sélectionnée en exécutant la fonction `clear`, comme suit:

```php
    //Effacer la base de données
    $database3->clear();
```

