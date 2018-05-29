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
      				 <a class="nav-link" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link" href="{{ route('Groupes') }}">Groupes</a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('Entreprises') }}">Entreprises</a>
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
      <h3 class="text-center" style="margin-top:1rem;">Fiche de contact</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-3">
		</div>
    <div class="col-sm-6">
			<table class="table">
				<tbody>
					<tr>
						<td style="width:60%">Contact  :</td>
						<td style="width:40%"> {{ $contact->contactAMIO }} </td>
					</tr>
					<tr>
						<td>Date :</td>
						<td> {{ date_create($contact->date)->format('d/m/Y') }} </td>
					</tr>
					<tr>
						<td>Objet :</td>
						<td> {{ $contact->objet }} </td>
					</tr>
					<tr>
						<td>Entreprise :</td>
						<td> <a href="{{ route('FicheEntreprise',['id' => isset($contact->entreprise_id) ? $contact->entreprise_id : ' '] ) }}" class="text-dark"> {{ isset($contact->entreprise_id) ? $entreprise->nom : ' ' }} </a> </td>
					</tr>
					<tr>
						<td>Interlocuteur :</td>
						<td> <a href="{{ route('FicheInterlocuteur',['id' => isset($contact->interlocuteur_id) ? $contact->interlocuteur_id : ' '] ) }}" class="text-dark"> {{ isset($contact->interlocuteur_id) ? $interlocuteur->prenom.' '.$interlocuteur->nom : ' ' }} </a> </td>
					</tr>
					<tr>
						<td>Commentaire :</td>
						<td> {{ $contact->commentaire }}</td>
					</tr>
				</tbody>
			</table>
    </div>
		<div class="col-sm-3">
			{{ link_to_route('ContactModifier', 'Modifier', ['id' => $contact->id ], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:15px;' ]) }} <br/> <br/> <br/>
			{!! Form::open(['method' => 'DELETE', 'route' => ['ContactSupprimer', $contact->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right','style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:15px' , 'onclick' => 'return confirm(\'Vraiment supprimer ce contact ?\')']) !!}
			{!! Form::close() !!}
		</div>
  </div>
</div>

@endsection
