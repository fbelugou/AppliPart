
# Application de gestion de partenariats

**[Application de gestion de partenariats](https://github.com/Alfezior/AppliPart/#manuel-de-maintenance)**  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Introduction](https://github.com/Alfezior/AppliPart/#introduction)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Présentation](https://github.com/Alfezior/AppliPart/#pr%C3%A9sentation)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Organisation](https://github.com/Alfezior/AppliPart/#organisation)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Les contrôleurs](https://github.com/Alfezior/AppliPart/#les-contr%C3%B4leurs)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[La sécuritée](https://github.com/Alfezior/AppliPart/#la-s%C3%A9curit%C3%A9e)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Les routes](https://github.com/Alfezior/AppliPart/#les-routes)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Les repositories](https://github.com/Alfezior/AppliPart/#les-repositories)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Les vues](https://github.com/Alfezior/AppliPart/#les-vues)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[Les données](https://github.com/Alfezior/AppliPart/#les-donn%C3%A9es)  

## Introduction

Le manuel de maintenance a pour but de décrire l’organisation du code afin d’être modifiable et réutilisable. Ce manuel peut être utilisable afin de déboguer des fonctionnalités. Il concerne l'application de gestion de partenariats (abrégée ci-après **AGP**). Ce manuel dispose d'une version en ligne à cette adresse :

[https://github.com/Alfezior/AppliPart](https://github.com/Alfezior/AppliPart)

## Présentation

L'AGP est une application Web qui a pour but de faciliter la **gestion des contacts** en entreprise pour les **conseillers** en insertion. Elle permet de gérer des **groupes**, des **entreprises**, des **interlocuteurs**, des **prises de contacts** et des **actions**.

## Organisation

Le code relatif aux classes appelées **modèles** (**MVC**) est séparé en plusieurs fichiers.

Tout d’abord on trouve les **contrôleurs** qui servent à faire le lien entre les **vues** et les **Repository**. Ils demandes des informations au **Repositories** et transmettent ces informations à des **vues**.

Les **Repository** servent à modifier des objets et à travailler avec base de données. Ils peuvent aussi consulter des objets. 

Ensuite on trouve les vues qui permettent d’afficher des pages web en exploitant le langage **Blade** de **Laravel**. Celles-ci peuvent afficher des informations sur des objets fournis. Par exemple afficher les détails d’une entreprise.

Aussi, on peut trouver les **tables de migration** qui sont les fichiers contenant les informations sur la table du **modèle** concerné.

Enfin on dispose des **modèles** qui viennent décrire un objet et renseigner les **clés étrangères** en base.

Pour chaque transmission d'informations de l'utilisateur au serveur on peux trouver des **requêtes** qui servent à assurer la sécuritée.

On peut trouver ces fichiers dans les répertoires : 

**app\Http\Controllers** pour les **[contrôleurs](https://github.com/Alfezior/AppliPart/#les-contr%C3%B4leurs)**.

**app\Repositories** pour les **[Repositories](https://github.com/Alfezior/AppliPart/#les-repositories)**.

**resources\views** pour les **[vues](https://github.com/Alfezior/AppliPart/#les-vues)**.

**app\Http\Requests** pour les **[requêtes](https://github.com/Alfezior/AppliPart/#la-s%C3%A9curit%C3%A9e)**.

**database\migrations** pour les **[tables de migration](https://github.com/Alfezior/AppliPart/#les-donn%C3%A9es)**. 

**app** pour les **[modèles](https://github.com/Alfezior/AppliPart/#les-donn%C3%A9es)**.

## Les contrôleurs

Selon le **contrôleur** les méthodes renseignées peuvent varier mais certains possèdent la même base.

Les **contrôleurs** gérants : les **actions**, les **entreprises**, les **groupes** et les **interlocuteurs** possèdent les méthodes :

- **Lister** : Cette fonction demande au **Repository** de récupérer tous les objets du **modèle** puis elle ***affiche la liste des objets***.

- **Ajouter** : Cette fonction récupère, si besoin, des informations sur d'autres objets. Puis elle ***affiche le formulaire d'ajout***.

- **Enregistrer** : Cette méthode a comme paramètre la **requête** contenant les informations du formulaire d'ajout. Elle transmet ces informations au **Repository** pour ***l'enregistrement en base de données***.

- **Afficher** : Cette méthode a comme paramètre **l'identifiant** de l'objet à ajouter. Elle transmet cet identifiant au **Repository** pour récupérer l'objet. Puis elle ***affiche la page de consultation***.

- **Modifier** : Cette méthode  a comme paramètre **l'identifiant** de l'objet à modifier. Elle transmet cet **identifiant** au **Repository** pour obtenir l'objet et récupère, si besoin, des informations sur d'autres objets. Puis elle ***affiche le formulaire de modification***.

- **MettreAJour** : Cette méthode a comme paramètres la **requête** contenant les informations du formulaire de modification et **l'identifiant** de l'objet à modifier. Elle transmet **l'identifiant** et les informations au **Repository** pour mettre à jour l'objet. Puis elle ***affiche la page de consultation*** de cet objet.

- **Supprimer** : Cette méthode a comme paramètre **l'identifiant** de l'objet à supprimer. Elle récupère et supprime l'objet. Dans certains cas elle peux aussi **supprimer** des **objets en lien** (pour une entreprise par exemple elle va supprimer les actions) ou se **détacher** d'objets (on va retirer le lien entre cette entreprise et une filière). Puis elle affiche ***la liste des objets***.

- **Recherche** : Cette fonction a comme paramètre la **requête** contenant les informations de la recherche. Elle transmet ces informations au **Repository** et récupère des objets correspondant à la recherche. Puis elle ***affiche la liste des résultats*** de recherche.

Le fonctionnement précis de chaque **méthode** est présenté dans le code étant donné que chaque **méthodes** sont entièrement commentés.

Pour le contrôleur des **contacts** les fonctionnement est identique mais il ne possède pas les **méthode** **Lister** et **Recherche**.

Dans certains **contrôleurs** on peux trouver des **méthodes** supplémentaires leurs but est toujours décrit avant la fonction et son fonctionnement aussi.

## La sécuritée

Cette partie concerne le **contrôleur** de connexion et les **requêtes**.

On trouve aussi dans le dossier **app\Http\Controllers\Auth** le **contrôleur** de **connexion** qui possède comme attribut **$redirectTo** qui indique l'URL ou est renvoyé une personne qui à réussi à s'authentifiée. On dispose aussi les méthodes :

- **username** : Cette méthode renvoi le nom du champ dans **l'active directory** qui est utilisé comme **identifiant**.
- **authentificate** : Cette méthode a comme paramètre la **requête** contenant **l'identifiant** et **le mot de passe** et tente de **s'authentifier**. En cas **d'échec** un message apparait **sinon** l'utilisateur est renvoyé à la **page demandée** ou à  **l'accueil** (si l'utilisateur demande d'accéder a la liste des entreprises l'écran de connexion va l'intercepter et si il s'identifie avec succès il sera renvoyé à la page voulu)
- **authenticated** : Cette méthode a comme paramètres la **requête** contenant les informations du formulaire de connexion et **l'utilisateur**. Cette méthode est apellée après une **authentification réussie**. Elle vérifie si **l'utilisateur** est autorisé à se connecter (groupes dans **l'active directory**). On déconnecte **l'utilisateur** si il n'as pas les authorisations.

Le dossier **app\Http\Middleware** comprends les fichiers qui concernent la sécurité de l'application. Le **Middleware** est un méchanisme de filtrage de **requêtes HTTP** . Ces fichiers n'ont pas été modifié et donc ne seront pas commentés. il est possible de trouver des informations sur le **Middleware** dans la [documentation](https://laravel.com/docs/5.6/middleware) officielle de **Laravel**.

Ce méchanisme permet l'utilisation des **requêtes** pour la transmission de données de l'utilisateur au serveur. On va trouver une **requête** a chaque ajout, modification ou recherche. on va aussi trouver deux **requêtes** supplémentaires qui  gère la génération de badges et de liste de mails d'entreprises.

Les **requêtes** permettent de vérifier que **l'utilisateur** est connecté et de vérifier si les données transmises sont répondent à des critères.

Voici une requête pour illustrer cette partie :

````php
<?php

//Définition de l'espace
namespace App\Http\Requests;

//Inclusion des bibliothèques nécéssaires
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

//Déclaration de la classe avec héritage
class ActionCreateRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est authorisé a effectuer la requête
     *
     * @return bool
     */
    public function authorize()
    {
        //Si l'utilisateur est connecté on authorise l'envoi de la requête
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Règles de validation de la requête
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nature' => Rule::notIn([0]),
            'date' => 'required|date',
            'commentaire' => 'max:65000',
            'entreprise' => Rule::notIn([0]),
        ];
    }
}

````

Il y a de nombreuses [règles](https://laravel.com/docs/5.6/validation#available-validation-rules) disponibles mais la définiton reste toujours identique  :

````php
'nomDuChamp' => règle,
'nomDuChamp' => 'règle[|règle|...]'
````

## Les routes

Lorsque une **URL** est demandée sur une application Web **Laravel**, on va chercher si la **route** est présente dans le fichier de **routes** pour trouver la **méthode** à appeler.

Les **routes** sont enregistrés dans le fichier **routes\web.php**.

Comme exemple voici une **route** relative à une entreprise:

````php
Route::get('/Entreprises',['as'=>'Entreprises','uses'=>'EntrepriseController@listerEntreprises']);
````
En découpant cette ligne on obtient toujours :

````php
Route::[méthode]('[URLrelative]',[ 'as' => '[nom]', 'uses'=>'[contrôleur@méthode]']);
````





Pour la méthode on à le choix entre les 4 méthodes **HTTP** : **GET**, **POST**, **PUT** et **DELETE**. l'**URL relative** commence par la racine de l'application **/** et peux être complétée ensuite. Le **nom** de la route est un nom utilisé pour faciliter l'appel à celle ci dans les **vues**. Le **contrôleur** est le nom du **contrôleur** à appeler et on trouve finalement la **méthode** qui est la **méthode** dans le **contrôleur** renseigné à appeler.

On trouve aussi des **groupes** dans les **routes**.

````php
Route::group(['middleware' => 'auth'], function()
{
    //Routes...
}
````

L'utilisation du **middleware** **auth** permet de restreindre l'accès au **routes** du groupes au **utilisateurs** authentifiés.

## Les repositories

L'utilisation de **Repositories** est un **design pattern** ou **patron de conception**. Ils représentent un schéma reconnu comme convention de conception afin de répondre à une question **d'efficience** et **d'ergonomie**.

> Ce **pattern** répond à un besoin d'accès aux données stockées en base. Son but principal est d'isoler la **couche d'accès aux données de la couche métier**. Il expose diverses méthodes s'appuyant sur un modèle **CRUD** (Create, Read, Update, Delete). Ce modèle fournis une centralisation de transaction aux données.
>
> ***Valentin BUSSEUIL***

Les méthodes **Repositories** sont donc appelées par les **contrôleurs** quand un travaille en rapport avec les données est demandé. 

Pour chaque **méthode** du **contrôleur** on peux trouver une **méthode** équivalente dans le **Repository** qui sont :

- **save** : Cette méthode à comme paramètres un **objet** et un **tableau**  contenant les données d'un formulaire. Cette méthode **injecte** les **données** dans **l'objet** et **enregistre** l'objet en base de données. Certains traitements sur les données sont parfois nécéssaires.

- **getObjets** : Cette méthode récupère **tout les objets** du modèle concerné et **rentourne** ces objets.

- **store** : Cette méthode à comme paramètre un **tableau** contenant les données d'un **formulaire de création** d'objet. Elle créée un objet et fait appel à la méthode **save** avec comme paramètre l'objet et le **tableau**. puis retourne l'objet créé.

- **getById** : Cette méthode à comme paramètre **l'identifiant** d'un objet. Elle récupère l'objet concerné en base et retourne cet objet.

- **update** : Cette méthode à comme paramètres **l'identifiant** d'un objet et un **tableau** contenant les données d'un **formulaire de modification** d'objet. Elle fait appel à la méthode **save** en récupérant l'objet à modifier en base avec **l'identifiant** et en donnant le **tableau**.

- **destroy** : Cette méthode à comme paramètre **l'identifiant** d'un objet et supprime cet objet de la base

- **search** : Cette méthode à comme paramètre un **tableau** contenant les données d'un **formulaire de recherche**. Elle recherche les objets correspondant et les retournes.

Le fonctionnement précis de chaque **méthode** est présenté dans le code étant donné que chaque **méthodes** sont entièrement commentés.

Certains **Repositories** peuvent avoir moins de **méthodes** étant données qu'elles ne sont pas toutes utilisées. Par exemple **ActiviteRepository** ne possède que la méthode **getActivites()**.

Dans certains **Repositories** on peux trouver des **méthodes** supplémentaires leurs but est toujours décrit avant la fonction et son fonctionnement aussi.

## Les vues

Les **vues** permettent d'afficher des pages web avec la possibilité d'utiliser le langage de modélisation **Blade**. 

Dans **l'AGP** on exploite une **vue mère** commune à toute les vues. Cette **vue mère** permet d'établir une base pour les vues qui en hérite. Elle permet d'inclure **Bootstrap 4** qui est utilisé pour déssiner l'application. les **vues** sont ensuite séparés dans des dossiers si elles appartiennent à un **modèle**. Chaque vue à un nom explicite comme **AjoutEntreprise.php** qui est la vue permettant d'afficher un **formulaire d'ajout** d'une entreprise. Les vues sont organisés comme ceci

````html
@extends('vueMere')

@section('contenu')
<div class="row">
	<div class="col-md-12">
		<!-- barre de navigation -->
	</div>
</div>
<div class="row">
	<!-- contenu de la page -->
</div>
@endsection

````

Afin de comprendre les différents éléments utilisé en **HTML/CSS** je voue conseille de regarder la [documentation](https://getbootstrap.com/docs/4.0/getting-started/introduction/) de **Bootstrap 4** (anglais uniquement).

Le langage Blade est utilisé pour effectuer des commandes php en effet tout ce qui est écrit entre double accolades est traduit de cette manière :

````php
{{ $objet->attribut }}
````

`````php 
<?php echo $objet->attribut ?>
`````

Avec **Blade** on dispose de deux syntaxes **{{  }}** et **{!!  !!}**. Avec la première syntaxe les données passent automatiquement dans la fonction **htmlspecialchars()** de PHP pour empecher les **attaques [XSS](https://fr.wikipedia.org/wiki/Cross-site_scripting)**. Mais si vous ne voulez pas que votre texte soit **[échappé](https://fr.wikipedia.org/wiki/Séquence_d%27échappement)** utilisez la seconde syntaxe. Pour la syntaxe des **formulaires** je vous invite à consulter la **[documentation](https://laravel.com/docs/4.2/html#opening-a-form)** de **Laravel** (version 4.2 mais encore fonctionelle)

## Les données

La création des tables dans la base de données est définie dans les **tables de migrations**. Tout les fichiers commencent par une date, c'est la **date de création** des fichiers ils représentent l'ordre dans lequel les fichiers vont être executés. Dans le cas de **clé étrangères** il faut donc ordonner la création des tables.Dans chacun de ces fichiers on trouve dans la classe héritée de **Migration** avec deux fonctions. **UP** qui est lancé lors d'une **migration** (création des tables) et **DOWN** qui est lancée si on annule une **migration**.

Une création de table se présente ainsi :

````php
Schema::create('entreprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->boolean('partenaireRegulier');
            $table->boolean('siegeSocial');
            $table->integer('taille')->nullable();
            $table->string('adresse1')->nullable();
            $table->string('adresse2')->nullable();
            $table->string('ville')->nullable();
            $table->string('cp')->nullable();
            $table->string('siteWeb')->nullable();
            $table->string('telephone')->nullable();
            $table->text('commentaire')->nullable();
            $table->unsignedInteger('groupe_id')->nullable();
            $table->foreign('groupe_id')->references('id')->on('groupes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('coordonnees_id')->nullable();
            $table->foreign('coordonnees_id')->references('id')->on('coordonees')
                ->onDelete('cascade')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->timestamps();
        });
````

On choisi le **nom** de la table avec le **premier paramètre**  ensuite on indique les champs dans une fonction qui viens incrémenter un plan (**Blueprint**). pour ajouter un **champ** on indique le **[type](https://laravel.com/docs/5.6/migrations#columns)** avec le **nom** en paramètre, il peux y avoir plusieurs paramètres. Pour comprendre plus en détails les **clés étrangères** je vous conseille la **[documentation](https://laravel.com/docs/5.6/migrations#foreign-key-constraints) officielle**.

La suppression de la table se présente ainsi :

````php
Schema::table('entreprises', function(Blueprint $table) {
            $table->dropForeign('entreprises_groupe_id_foreign');
            $table->dropForeign('entreprises_coord_id_foreign');
        });
        Schema::dropIfExists('entreprises');
````

On retire d'abord les **clés étrangères** puis on supprime la table. Le nom de la contrainte de la clé est **table_attribut_foreign**.

La déclaration des classes dans l'application se fait via les **modèles**. C'est par cet intermédiaire que sont accéssible les données des **clés étrangères**. Les modèles sont définis ainsi : 

````php
class Entreprise extends Model
{
    public $table = "entreprises";
    use Notifiable;

    /**
     * Les attributs qui sont remplissables
     *
     * @var array
     */
    protected $fillable = [
      'nom','partenaireRegulier','siegeSocial','taille','rue','ville','cp','siteWeb','telephone','commentaire','groupe_id','coord_id',
    ];

    /**
     * Les attributs qui sont cachés dans les tableaux.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //Retourne les actions de l'entreprise avec l'association de la plus récente à la plus ancienne
    public function actions()
  	{
  		return $this->hasMany('App\Action')->orderBy('date','desc');
  	}
    
    //Retourne les interlocuteurs qui ont travaillé ou qui travaillent encore pour l'entreprise avec les données de la table associative
    public function interlocuteurs()
  	{
		return $this->belongsToMany('App\Interlocuteur','contacts')
            ->withPivot('id','contactAMIO','date','objet','commentaire');
  	}

    //Retourne les coordonnées GPS de l'entreprise
    public function coordonnees()
  	{
  		return $this->belongsTo('App\Coordonnees');
  	}
    
    //Autres liens ...
}
````

Les **méthodes** sont ensuite appellé par rapport à un objet ( **$entreprise->coordonnees() **)

Pour chaque méthode on reprends une syntaxe identique :

````php
$this->lien('[nom]','[table(facultatif)]');
````

Il est ensuite possible d'ajouter des fonctions comme les attributs d'une **table associative** ou d'ordonner les résultats : 

````php
$this->lien('[nom]','[table(facultatif)]')
    	->withPivot('[attribut1]'[,'attribut2',...])
    	->orderBy('[attribut]','[asc|desc]');
````

