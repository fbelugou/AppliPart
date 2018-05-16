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
      			<li class="nav-item active">
      				 <a class="nav-link active" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('Groupes') }}">Groupes</a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('Entreprises') }}">Entreprises</a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('Actions') }}">Actions</a>
      			</li>
            <li class="nav-item">
               <a class="nav-link active" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
            </li>
            <li class="nav-item">
      				 <span class="navbar-text">Utilisateur : XX</span>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('logout') }}">Déconnexion</a>
      			</li>
      		</ul>
      	</div>
      </nav>
		</div>
	</div>
  <div class="row">
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">{{$entreprise->nom}}</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-3">
		</div>
    <div class="col-sm-6">
			<table class="table">
				<tbody>
					<tr>
						<td style="width:60%">Partenaire régulier :</td>
						<td style="width:40%"><img src="{{ ($entreprise->partenaireRegulier)? URL::asset('img/V.png') : URL::asset('img/X.png') }}" height="16px" widht="16px"/> </td>
					</tr>
					<tr>
						<td>Groupe :</td>
						<td>{{ (!is_null($entreprise->groupe)) ? $entreprise->groupe->nom : ' ' }}</td>
					</tr>
					<tr>
						<td>Taille :</td>
						<td>{{ $entreprise->taille }}</td>
					</tr>
					<tr>
					  <td>Activité(s) :</td>
						<td>
							@foreach($entreprise->activites as $activite)
								{{ $activite->libelle }} <br>
							@endforeach
						</td>
					</tr>
					<tr>
					  <td>Filière(s) :</td>
						<td>
							@foreach($entreprise->filieres as $filiere)
								{{ $filiere->metier }}<br>
							@endforeach
						</td>
					</tr>
					<tr>
					  <td>Adresse :</td>
						<td> {{ $entreprise->rue }} {{ $entreprise->cp }} {{ $entreprise->ville }}</td>
					</tr>
					<tr>
						<td>Site Web :</td>
						<td><a href="{{ $entreprise->siteWeb }}">{{ $entreprise->siteWeb }}</a></td>
					</tr>
					<tr>
						<td>Téléphone :</td>
						<td>{{ $entreprise->telephone }} </td>
					</tr>
					<tr>
						<td>Interlocuteur(s) :</td>
						<td>
							@foreach($entreprise->Interlocuteurs as $interlocuteur)
								 <a class="text-dark" href="{{ route('FicheInterlocuteur',[ 'id' => $interlocuteur->id ]) }}">{{  $interlocuteur->prenom  }}  {{ $interlocuteur->nom }}</a><br>
							@endforeach
						</td>
					</tr>
					<tr>
						<td>Commentaire :</td>
						<td> {{ $entreprise->commentaire }}</td>
					</tr>
				</tbody>
			</table>
    </div>
		<div class="col-sm-3">
			{{ link_to_route('EntrepriseModifier', 'Modifier', ['id' => $entreprise->id ], ['class' => 'btn btn-info pull-right', 'style' => 'height:2.5rem;width:10rem;margin-bottom:15px;' ]) }} <br/> <br/> <br/>
			{!! Form::open(['method' => 'DELETE', 'route' => ['EntrepriseSupprimer', $entreprise->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right','style' => 'height:2.5rem;width:10rem;margin-bottom:15px;' , 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
			{!! Form::close() !!}
		</div>
  </div>
</div>

@endsection
