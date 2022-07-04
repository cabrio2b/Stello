@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 heroLeft">
            <h1>Stello aide les équipes à avancer dans leur travail.</h1>
            <p>gérez des projets et atteignez de nouveaux sommets en matière de productivité. Que votre équipe soit sur site ou en télétravail, votre méthode de travail est unique. Accomplissez toutes vos tâches grâce à Stello.</p>
        </div>
        <div class="col-md-4 heroRight">
            <img src="{{ asset('/images/hero.webp') }}" alt="" style="width:380px;">
        </div>
    </div>
</div>
@endsection
