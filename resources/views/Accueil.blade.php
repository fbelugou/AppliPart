@extends('vueMere')


@section('contenu')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">

      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      		<span class="navbar-toggler-icon"></span>
      	</button>
        <a class="navbar-brand" href="{{ route('Accueil') }}">
          <img src="{{ URL::asset('img/AMIOlogo.png') }}" height="33 px" width="83 px"class="rounded float-left" alt="logo AMIO">
        </a>
      	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="navbar-nav ml-md-auto">
      			<li class="nav-item">
      					<a class="nav-link active" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item">
      					<a class="nav-link" href="{{ route('Groupes') }}">Groupes</a>
      			</li>
            <li class="nav-item">
      					<a class="nav-link" href="{{ route('Entreprises') }}">Entreprises</a>
      			</li>
            <li class="nav-item">
      					<a class="nav-link" href="{{ route('Actions') }}">Actions</a>
      			</li>
            <li class="nav-item">
            		<a class="nav-link" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
            </li>
            <li class="nav-item">
      					<span class="navbar-text">Utilisateur : {{ strtoupper(Auth::user()->initials[0]) }}</span>
      			</li>
            <li class="nav-item">
      					<a class="nav-link" href="#" onclick="document.getElementById('formLogout').submit();">Déconnexion</a>
								{{ Form::open(['url' => route('logout'), 'id' => 'formLogout']) }}
								{{ Form::close() }}
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
             <a href={{ route('Partenaires') }}><button type="button" class="btn btn-info btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Partenaires réguliers</button></a><br/>
						 <a href={{ route('Groupes') }}><button type="button" class="btn btn-info btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Groupes</button></a><br/>
						 <a href={{ route('Interlocuteurs') }}><button type="button" class="btn btn-info btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Interlocuteurs</button></a><br/>
						 <a href={{ route('Actions') }}><button type="button" class="btn btn-info btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Actions</button></a><br/>
					 </div>
					 <div class="col-sm-6">
						 <a href={{ route('Entreprises') }}><button type="button" class="btn btn-info pull-right btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Entreprises</button></a><br/>
						 <a href={{ route('Badges') }}><button type="button" class="btn btn-info pull-right btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Génerer des badges</button></a><br/>
						 <a href={{ route('EntrepriseMailsForm') }}><button type="button" class="btn btn-info pull-right btn-lg" style="height:3rem;width:85%;margin-bottom:15px;">Générer une liste de mails</button></a><br/>
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
								{{ Form::text('grp', null, ['class' => 'form-control','style'=>'height:3rem;width:85%;margin-bottom:15px;','placeholder'=>'Capgemini']) }}
						</div>
						<div class="col-sm-6">
								{{ Form::submit('Trouver un groupe',['class'=>'btn btn-info pull-right btn-lg','style'=>'height:3rem;width:85%;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-6">
							{{ Form::open(['url' => route('rechercheEntreprises')]) }}
								{{ Form::hidden('limiteEnt', 'false', array('id' => 'limiteEnt')) }}
								{{ Form::text('ent', null, ['class' => 'form-control','style'=>'height:3rem;width:85%;margin-bottom:15px;','placeholder'=>'Capgemini Toulouse']) }}
						</div>
						<div class="col-sm-6">
								{{ Form::submit('Trouver une entreprise',['class'=>'btn btn-info pull-right btn-lg','style'=>'height:3rem;width:85%;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-4">
							{{ Form::open(['url' => route('rechercheInterlocuteurs')]) }}
								{{ Form::hidden('limiteInt', 'false', array('id' => 'limiteInt')) }}
								{{ Form::text('int',null, ['class' => 'form-control','style'=>'height:3rem;width:100%;margin-bottom:15px;','placeholder'=>'Baptiste Lagarde']) }}
						</div>
						<div class="col-sm-4">
								{{ Form::select('type', ['Tous types','Opérationel','Ressources Humaines','Mission Handicap'],null, ['class' => 'form-control','style'=>'height:3rem;width:70%;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-4">
								{{ Form::submit('Trouver un interlocuteur',['class'=>'btn btn-info pull-right btn-lg','style'=>'height:3rem;width:131%;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-5">
							{{ Form::open(['url' => route('rechercheEntreprisesDist')],['class'=>'form-inline']) }}
								{{ Form::hidden('limiteEntDist', 'false', array('id' => 'limiteEntDist')) }}
								{{ Form::text('ville', null, ['class' => 'form-control','style'=>'height:3rem;width:103%;margin-bottom:15px;','placeholder'=>'Millau']) }}
						</div>
						<div class="col-sm-1">
								{{ Form::text('dist', null, ['class' => 'form-control','style'=>'height:3rem;width:100%;margin-bottom:15px;','placeholder'=>'25']) }}
						</div>
						<div class="col-sm-1">
								{{ Form::label('km', 'Km',['style'=>'font-size:20px;margin-top:9px']) }}
						</div>
						<div class="col-sm-5">
								{{ Form::submit('Trouver des entreprises par rapport à une distance',['class'=>'btn btn-info pull-right btn-lg','style'=>'height:3rem;width:103%;margin-bottom:15px;']) }}<br/>
							{{ Form::close() }}
						</div>
						<div class="col-sm-6">
							{{ Form::open(['url' => route('rechercheActions')]) }}
								{{ Form::hidden('limiteEntAct', 'false', array('id' => 'limiteEntAct')) }}
								{{ Form::select('action', ['Choisissez un type d\'action','Stage','Alternance','JobDating','Visite d\'entreprise','Taxe d\'apprentissage','Jury d\'examen','Parrainage','Intervention technique','Formation stagiaire','Formation formateur','Embauche','Don de matériel','Autres']
								 ,null, ['class' => 'form-control','style'=>'height:3rem;width:85%;margin-bottom:15px;']) }}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Trouver des entreprises par rapport à une action',['class'=>'btn btn-info pull-right btn-lg','style'=>'height:3rem;width:85%;margin-bottom:15px;']) }}<br/>
						{{ Form::close() }}
						</div>
					</div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	document.getElementById('limitation').checked=false;
	document.getElementById('limiteGrp').value=false;
	document.getElementById('limiteEnt').value=false;
	document.getElementById('limiteInt').value=false;
	document.getElementById('limiteEntAct').value=false;
	document.getElementById('limiteEntDist').value=false;

	function changerEtat(){
		var etat = document.getElementById('limitation').checked;
		document.getElementById('limiteGrp').value=etat;
		document.getElementById('limiteEnt').value=etat;
		document.getElementById('limiteInt').value=etat;
		document.getElementById('limiteEntAct').value=etat;
		document.getElementById('limiteEntDist').value=etat;
	}

</script>
@endsection
