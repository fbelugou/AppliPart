<?php


/**
* renvoi le dernier contact avec une entreprise
*
*/
function dernierContact($entreprise)
{
    $contacts=array();
    $i=0;
    foreach($entreprise->interlocuteurs as $in){
        $contacts[0][$i]=$in->pivot->date;
        $contacts[1][$i]=$in->pivot->id;
        $i++;
    }
    if(empty($contacts)){
        return '';
    }

    for($k=0;$k<$i;$k++){
        if(max($contacts[0])==$contacts[0][$k]){
            $date=date_create($contacts[0][$k]);
            $date=$date->format('d/m/Y');
            return "<a href=".route('FicheContact', [ 'id' => $contacts[1][$k] ] )." class=\"text-dark\">".$date."</a>";
        }
    }
}

function contacts($entreprise)
{
    $contacts=array();
    $i=0;
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
    return $contacts;
}
