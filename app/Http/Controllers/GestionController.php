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
      $this->interlocuteurRepository = $IR;
    }

    public function index()
    {
        return view('Accueil');
    }

    public function formulaireBadges()
    {
        $interlocuteurs= $this->interlocuteurRepository->getInterlocuteurs();

        return view('FormulaireBadges',compact('interlocuteurs'));
    }

    public function genererBadges(BadgesRequest $request)
    {
        $fichier='<style>
          table, th, td {
              border: 1px solid black;
          }
          tr{
              max-height: 207px;
              height: 207px;
          }
          td{
              width: 340px;
          }
          </style>';
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
        $fichier.='</table>';
        $pdf = PDF::loadHTML($fichier);
        return $pdf->download('Badges '.$request->intitule.'.pdf');
    }

    public function genererPDF($request){

    }
}
