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
      				 <a class="nav-link active" href="{{ route('Groupes') }}">Groupes</a>
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
      <h3 class="text-center" style="margin-top:1rem;">{{ $groupe->nom }}</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-3">
		</div>
    <div class="col-sm-6">
			<table class="table">
				<tbody>
					<tr>
						<td style="width:60%">Taille :</td>
						<td style="width:40%"> {{ $groupe->taille }} </td>
					</tr>
					<tr>
						<td>Siège social :</td>
						<td>
							@foreach($groupe->entreprises as $entreprise)
								@if($entreprise->siegeSocial)
									<a href="{{ route('FicheEntreprise',['id' => $entreprise->id]) }}" class="text-dark">{{ $entreprise->nom }}</a> <br>
								@endif
							@endforeach
						</td>
					</tr>
					<tr>
						<td>Entreprise(s) :</td>
						<td>
							@foreach($groupe->entreprises as $entreprise)
								@if(!$entreprise->siegeSocial)
									<a href="{{ route('FicheEntreprise',['id' => $entreprise->id]) }}" class="text-dark">{{ $entreprise->nom }}</a> <br>
								@endif
							@endforeach
						</td>
					</tr>
				</tbody>
			</table>
    </div>
		<div class="col-sm-3">
			{{ link_to_route('GroupeModifier', 'Modifier', ['id' => $groupe->id ], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }} <br/> <br/> <br/>
			{!! Form::open(['method' => 'DELETE', 'route' => ['GroupeSupprimer', $groupe->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right','style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px' , 'onclick' => 'return confirm(\'Vraiment supprimer ce groupe ?\')']) !!}
			{!! Form::close() !!}
		</div>
  </div>
</div>

@endsection
