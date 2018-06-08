<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\BadgesRequest;
use App\Repositories\InterlocuteurRepository;
use Illuminate\Support\Facades\URL;

class GestionController extends Controller
{
    private $interlocuteurRepository;

    public function __construct(InterlocuteurRepository $IR)
    {
        //Récupération du repository nécéssaire
        $this->interlocuteurRepository = $IR;
    }

    //Fonction de redirection à la page d'accueil
    public function index()
    {
        //Affichage de la vue d'accueil
        return view('Accueil');
    }

    //Fonction d'affichage d'un formulaire de génération de badges
    public function formulaireBadges()
    {
        //Récupération des interlocuteurs
        $interlocuteurs= $this->interlocuteurRepository->getInterlocuteurs();
        //Envoi des interlocuteurs à la vue FormulaireBadges et affichage de la vue
        return view('FormulaireBadges',compact('interlocuteurs'));
    }

    //Fonction de génération d'un pdf de badges avec le résultats du formulaire
    public function genererBadges(BadgesRequest $request)
    {
        //CSS pour la taille des badges et les bordures
        $fichier='<style>
          tr{
              max-height: 207px;
              height: 207px;
          }
          td{
              width: 340px;
              border: 1px solid black;
          }
          .page-break {
              page-break-after: always;
          }
          </style>';
        $fichier.='<table>';
        //Récupération des clés du tableau(array_keys) qui sont des id des interlocuteurs
        //en ignorant les 2 premieres entrées(array_slice) qui sont le libellé de l'évenement et le token de sécurité
        foreach(array_slice(array_keys($request->all()),2) as $key=>$item){
            $fichier.='<tr>';
            $fichier.='<td>';
            $interlocuteur=$this->interlocuteurRepository->getById($item);
            $fichier.='<p>'.mb_strtoupper($interlocuteur->nom, 'UTF-8').' '.$interlocuteur->prenom.'</p>';
            $fichier.='</td>';
            $fichier.='<td>  </td>';
            $fichier.='</tr>';
        }
        $fichier.='</table>';
        $fichier.='<div class="page-break"></div>';
        $fichier.='<table>';
        foreach(array_slice(array_keys($request->all()),2) as $key=>$item){
            if($key % 2 == 0){
                $fichier.='<tr>';
            }
            $fichier.='<td>';
            $fichier.='<img height="33 px" width="83 px" src="'.URL::asset('img/AMIOlogo.png').'"/>';
            $fichier.='<div style="text-align:center;">';
            $fichier.='<p style="color:orange;font-weight: bold;">'.mb_strtoupper($request->intitule, 'UTF-8').'</p>';
            $interlocuteur=$this->interlocuteurRepository->getById($item);
            $fichier.='<p>'.mb_strtoupper($interlocuteur->nom, 'UTF-8').' '.$interlocuteur->prenom.'</p>';
            $fichier.='<p>'.$interlocuteur->fonction.'</p>';
            if(null != $interlocuteur->entreprisesDate()->first()){
              $fichier.='<p>'.mb_strtoupper($interlocuteur->entreprisesDate()->first()->nom, 'UTF-8').'</p>';
            }
            $fichier.='</div>';
            $fichier.='</td>';
            if($key % 2 == 1){
                $fichier.='</tr>';
            }
        }
        $pdf = PDF::loadHTML($fichier);
        //Téléchargement du fichier
        return $pdf->download('Badges '.$request->intitule.'.pdf');
    }
}
