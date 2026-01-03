@extends('adminLayout.app')

@section('page_title', 'ESPACE') 

@section('content')
    <h1>Bienvenue !</h1>
    <p>Ceci est le contenu spécifique de la page espaces.</p>
    @forelse ($espaces as $espaces)
        {{ $espaces->formateur->nom }}
    @empty
        
    @endforelse
@endsection
