@extends('vueMere')

@section('contenu')
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
						 <a class="nav-link" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Groupes') }}">Groupes</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Entreprises') }}">Entreprises</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Actions') }}">Actions</a>
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
	<div class="col-sm-3">
	</div>
	<div class="col-sm-6">
		<div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
			<h2 class="card-header">Modification d'une action</h2>
			<div class="card-body">
				{{ Form::model($action,['route' => ['ActionMAJ',$action->id], 'method' => 'put']) }}
          <div id="nat" class="form-group" style="margin-top:10px;">
						{{ Form::label('nature', 'Nature :') }}

  					{!! $errors->first('nature', '<small class="form-text text-muted">:message</small>') !!}
						@if(preg_match('#Autres#',$action->nature))
							{{ Form::select('nature',['Choisissez la nature de l\'action','Stage','Alternance','JobDating','Visite d\'entreprise','Taxe d\'apprentissage','Jury d\'examen','Parrainage','Intervention technique','Formation stagiaire','Formation formateur','Embauche','Don de materiel','Autres',	] ,13, ['class' => 'form-control','onChange'=>'siAutres()']) }}
							<label id="siAutre">Si autres :</label>
							@php preg_match('#\((.*?)\)#', $action->nature, $raison); @endphp
							{{ Form::text('autres',$raison[1],['class' => 'form-control', 'placeholder' => 'Autres']) }}
						@else
							@php
								switch ($action->nature) {
				          case 'Stage':
				            $nat=1;
				            break;
				          case 'Alternance':
				            $nat=2;
				            break;
				          case 'JobDating':
				            $nat=3;
				            break;
				          case 'Visite d\'entreprise':
				            $nat=4;
				            break;
				          case 'Taxe d\'apprentissage':
				            $nat=5;
				            break;
				          case 'Jury d\'examen':
				            $nat=6;
				            break;
				          case 'Parrainage':
				            $nat=7;
				            break;
				          case 'Intervention technique':
				            $nat=8;
				            break;
				          case 'Formation stagiaire':
				            $nat=9;
				            break;
				          case 'Formation formateur':
				            $nat=10;
				            break;
				          case 'Embauche':
				            $nat=11;
				            break;
				          case 'Don de materiel':
				            $nat=12;
				            break;
				        }
							@endphp
							{{ Form::select('nature',['Choisissez la nature de l\'action','Stage','Alternance','JobDating','Visite d\'entreprise','Taxe d\'apprentissage','Jury d\'examen','Parrainage','Intervention technique','Formation stagiaire','Formation formateur','Embauche','Don de materiel','Autres',	] ,$nat, ['class' => 'form-control','onChange'=>'siAutres()']) }}
						@endif
  				</div>
          <div class="form-group" style="margin-top:10px;">
						{{ Form::label('date', 'Date :') }}
  					{{ Form::date('date', null) }}
  					{!! $errors->first('taille', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('entreprise', 'Entreprise :') }}
						{{ Form::select('entreprise', $entreprises ,$action->entreprise->id,['class' => 'form-control']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('commentaire', 'Commentaire :') }}
  					{{ Form::text('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire']) }}
  					{!! $errors->first('commentaire', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
			{{ Form::submit('Valider', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:20px;' ]) }}
			{{ link_to_route('FicheAction', 'Annuler',['id'=>$action->id],['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }}
		{{ Form::close() }}
	</div>
</div>
<script>
	function siAutres(){
		if(document.getElementById('nature').value==13){
			var lab=document.createElement('label');
			lab.for='autres';
			lab.id="siAutre";
			lab.appendChild(document.createTextNode('Si autres :'))
			var txt=document.createElement('input');
			txt.className="form-control";
			txt.placeholder="Autres";
			txt.name="autres";
			txt.id="autres";
			txt.type="text";
			document.getElementById("nat").appendChild(lab);
			document.getElementById("nat").appendChild(txt);
		}
		else{
			var element = document.getElementById("autres");
			element.parentNode.removeChild(element);
			var elementlab = document.getElementById("siAutre");
			elementlab.parentNode.removeChild(elementlab);
		}
	}
</script>
@endsection
