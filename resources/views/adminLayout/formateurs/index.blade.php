@extends('adminLayout.app')

@section('page_title', 'FORMATEURS') 

@section('content')
    <h1>Bienvenue !</h1>
    <p>Ceci est le contenu spécifique de la page formateurs.</p>

    @forelse ($formateurs as $forma)
        {{ $forma->nom }}
    @empty
        
    @endforelse
@endsection
