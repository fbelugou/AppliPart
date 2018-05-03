@extends('vueMere')


@section('contenu')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

      <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">

      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      		<span class="navbar-toggler-icon"></span>
      	</button>
        <a class="navbar-brand" href="{{ route('accueil') }}">
          <img src="{{ URL::asset('img/AMIOlogo.png') }}" height="33 px" width="83 px"class="rounded float-left" alt="logo AMIO">
        </a>
      	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="navbar-nav ml-md-auto">
      			<li class="nav-item active">
      				 <a class="nav-link active" href="#">Accueil<span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="#">Groupes</a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="#">Entreprises</a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="#">Actions</a>
      			</li>
            <li class="nav-item">
               <a class="nav-link active" href="#">Interlocuteurs</a>
            </li>
            <li class="nav-item">
      				 <span class="navbar-text">Utilisateur : XX</span>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="#">Déconnexion</a>
      			</li>
      		</ul>
      	</div>
      </nav>

			</div>
		</div>
  <div class="row">
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">Application de gestion de partenariats</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
        <h4 class="card-header">Outils de listing</h4>
        <div class="card-body">
					<div class="row">
						<div class="col-sm-6">
             <a href="#"><button type="button" class="btn btn-info" style="height:3rem;width:30rem;margin-bottom:15px;">Liste des partenaires réguliers</button></a><br/>
						 <a href="#"><button type="button" class="btn btn-info" style="height:3rem;width:30rem;margin-bottom:15px;">Liste des groupes</button></a><br/>
						 <a href="#"><button type="button" class="btn btn-info" style="height:3rem;width:30rem;margin-bottom:15px;">Liste des interlocuteurs</button></a><br/>
						 <a href="#"><button type="button" class="btn btn-info" style="height:3rem;width:30rem;margin-bottom:15px;">Liste des actions</button></a><br/>
					 </div>
					 <div class="col-sm-6">
						 <a href="#"><button type="button" class="btn btn-info pull-right" style="height:3rem;width:30rem;margin-bottom:15px;">Liste des entreprises</button></a><br/>
						 <a href="#"><button type="button" class="btn btn-info pull-right" style="height:3rem;width:30rem;margin-bottom:15px;">Génerer des badges</button></a><br/>
						 	{{ Form::open(['url' => route('rechercheActions')]) }}
						 		<div class="form-group">
									 {{ Form::select('Choisissez une action', [
										   'Stage' => 'Stage',
										   'Alternance' => 'Alternance',
										   'JobDating' => 'JobDating',
										   'VisiteEntreprise' => 'Visite d\'entreprise',
										   'TaxeApprentissage' => 'Taxe d\'apprentissage',
										   'JuryExamen' => 'Jury d\'examen',
										   'Parrainage' => 'Parrainage',
										   'InterventionTechnique' => 'Intervention technique',
										   'FormationStagiaire' => 'Formation stagiaire',
											 'FormationFormateur' => 'Formation formateur',
										   'Embauche' => 'Embauche',
										   'DonMateriel' => 'Don de matériel',
											 'Autres' => 'Autres']
										,null, ['class' => 'form-control pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}
								 </div>
						 	 	 {{ Form::submit('Liste des entreprises par action',['class'=>'btn btn-info pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}<br/>
							 {{ Form::close() }}
					 </div>
				 </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;margin-top:2rem;">
        <h4 class="card-header">Outils de recherche</h4>
        <div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<label class="pull-right" style="margin-bottom:15px;"><input type="checkbox" id="limitation" name="limitation" value="value" onchange="changerEtat()"> Limiter au partenaires réguliers</label>
						</div>
					</div>
					<div class="row">
				    <div class="col-sm-6">
							{{ Form::open(['url' => route('rechercheGroupes')]) }}
								{{ Form::hidden('limiteGrp', 'false', array('id' => 'limiteGrp')) }}
								{{ Form::text('grp', 'Cagemini', ['class' => 'form-control','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-6">
								{{ Form::submit('Rechercher un groupe',['class'=>'btn btn-info pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-6">
							{{ Form::open(['url' => route('rechercheEntreprises')]) }}
								{{ Form::hidden('limiteEnt', 'false', array('id' => 'limiteEnt')) }}
								{{ Form::text('ent', 'Cagemini Toulouse', ['class' => 'form-control','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-6">
								{{ Form::submit('Rechercher une entreprise',['class'=>'btn btn-info pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-6">
							{{ Form::open(['url' => route('rechercheInterlocuteurs')]) }}
								{{ Form::hidden('limiteInt', 'false', array('id' => 'limiteInt')) }}
								{{ Form::text('int', 'Baptiste Lagarde', ['class' => 'form-control','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-6">
								{{ Form::submit('Rechercher un interlocuteur',['class'=>'btn btn-info pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-5">
							{{ Form::open(['url' => route('rechercheEntreprisesDist')],['class'=>'form-inline']) }}
								{{ Form::hidden('limiteEntDist', 'false', array('id' => 'limiteEntDist')) }}
								{{ Form::text('ville', 'Millau', ['class' => 'form-control','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-1">
								{{ Form::text('dist', '25', ['class' => 'form-control','style'=>'height:3rem;width:5rem;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-1">
								{{ Form::label('km', 'Km',['style'=>'font-size:20px;margin-top:9px']) }}
						</div>
						<div class="col-sm-5">
								{{ Form::submit('Rechercher des entreprises par rapport à une distance',['class'=>'btn btn-info pull-right','style'=>'height:3rem;width:30rem;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	document.getElementById('limitation').checked=false;
	
	function changerEtat(){
		var etat = document.getElementById('limitation').checked;
		document.getElementById('limiteGrp').value=etat;
		document.getElementById('limiteEnt').value=etat;
		document.getElementById('limiteInt').value=etat;
		document.getElementById('limiteEntDist').value=etat;
	}

</script>
@endsection
