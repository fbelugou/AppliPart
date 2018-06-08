<?php


//renvoi le dernier contact avec une entreprise sous forme de lien html
function afficherDernierContact($entreprise)
{
    //Création d'un tableau de contacts
    $contacts=array();
    $i=0;
    //Récupération pour chaque contacts de la date et de l'id du contact
    foreach($entreprise->interlocuteurs as $in){
        $contacts[0][$i]=$in->pivot->date;
        $contacts[1][$i]=$in->pivot->id;
        $i++;
    }
    //Si il n'y a pas de contacts retourne une chaine vide;
    if(empty($contacts)){
        return '';
    }
    //parcours du tableau
    for($k=0;$k<$i;$k++){
        //Si le contacts actuel est le contact le plus récent alors on l'affiche
        if(max($contacts[0])==$contacts[0][$k]){
            //Récupération de la date en objet datetime
            $date=date_create($contacts[0][$k]);
            //Mise en format souhaité de la date
            $date=$date->format('d/m/Y');
            //Si la date est la date par défault lors de l'ajout d'interlocuteurs (pas un réel contact) on retourne une chaine vide
            if($date=='01/01/1000'){
              return '';
            }
            //retourne un lien HTML
            return "<a href=".route('FicheContact', [ 'id' => $contacts[1][$k] ] )." class=\"text-dark\">".$date."</a>";
        }
    }
}

//renvoi le dernier contact avec une entreprise sous forme d'objet php DateTime
function dernierContact($entreprise)
{
    //Création d'un tableau de contacts
    $contacts=array();
    $i=0;
    //Récupération pour chaque contacts de la date et de l'id du contact
    foreach($entreprise->interlocuteurs as $in){
        $contacts[0][$i]=$in->pivot->date;
        $contacts[1][$i]=$in->pivot->id;
        $i++;
    }
    //Si il n'y a pas de contacts retourne une chaine vide;
    if(empty($contacts)){
        return '';
    }
    //parcours du tableau
    for($k=0;$k<$i;$k++){
        //Si le contacts actuel est le contact le plus récent alors on la retourne
        if(max($contacts[0])==$contacts[0][$k]){
            //Récupération de la date en objet datetime
            $date=date_create($contacts[0][$k]);
            //Si la date est la date par défault lors de l'ajout d'interlocuteurs (pas un réel contact) on retourne une chaine vide
            if($date->format('d/m/Y')=='01/01/1000'){
              return null;
            }
            //Retourne l'objet date
            return $date;
        }
    }
}

//Renvoi la dernière action
function derniereAction($entreprise)
{
    //Création d'un tableau
    $actions=array();
    $i=0;
    //Récupération pour chaque actions de la date et de l'id
    foreach($entreprise->actions as $act){
        $actions[0][$i]=$act->date;
        $actions[1][$i]=$act->id;
        $i++;
    }
    //Si il n'y a pas d'action retourne un objet null
    if(empty($actions)){
        return null;
    }
    //Parcours du tableau
    for($k=0;$k<$i;$k++){
        //Si l'action actuelle est le l'action la plus récente alors on la retourne
        if(max($actions[0])==$actions[0][$k]){
            //Récupération de la date en objet datetime
            $date=date_create($actions[0][$k]);
            //retourne la date
            return $date;
        }
    }
}

//Renvoi les contacts de l'entreprise
function contacts($entreprise)
{
    //Création d'un tableau de contacts
    $contacts=array();
    $i=0;
    //Parcours les contacts et récupère les contacts si le champ objet est défini
    foreach($entreprise->interlocuteurs as $in){
        if(isset($in->pivot->objet)){
            $contacts[$i]['contactAMIO']=$in->pivot->contactAMIO;
            $contacts[$i]['date']=$in->pivot->date;
            $contacts[$i]['objet']=$in->pivot->objet;
            $contacts[$i]['commentaire']=$in->pivot->commentaire;
            $contacts[$i]['id']=$in->pivot->id;
            $i++;
        }
    }
    //Retourne les contacts 
    return $contacts;
}
