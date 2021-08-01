@extends('layouts.app')
@section('title') All bets @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All bets</div>
                <form action="{{route('better.index')}}" method="get" class="sort-form">
                    <fieldset>
                        <legend>Sort by:</legend>
                        <div>
                            <label>Name</label>
                            <input type="radio" name="sort_by" value="name" @if('name'==$sort) checked @endif>
                        </div>
                        <div>
                            <label>Bet</label>
                            <input type="radio" name="sort_by" value="bet" @if('bet'==$sort) checked @endif>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Direction:</legend>
                        <div>
                            <label>Asc</label>
                            <input type="radio" name="dir" value="asc" @if('asc'==$dir) checked @endif>
                        </div>
                        <div>
                            <label>Desc</label>
                            <input type="radio" name="dir" value="desc" @if('desc'==$dir) checked @endif>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Sort</button>
                    <a href="{{route('better.index')}}" class="btn btn-primary">Clear</a>
                </form>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($betters as $better)
                    <li class="list-group-item">
                        <div class="list-container">
                            <div class="list-container-content">
                                <p><span> Vardas: </span> {{$better->name}} </p>
                                <p><span> Pavardė: </span> {{$better->surname}} </p>
                                <p><span> Statoma suma eur: </span> {{$better->bet}} </p>
                                <br>
                                <p>Apie arklį:</p>
                                <p><span> Vardas: </span> {{$better->horse->name}} </p>
                                <p><span> Laimėtų rungtynių skaičius: </span> {{$better->horse->runs}} </p>
                                <p><span> Dalyvauta rungtynių skaičius: </span> {{$better->horse->wins}} </p>
                                <p><span> Aprašymas: </span> {!! $better->horse->about !!} </p>
                            </div>
                            <div class="list-container-buttons">
                                <form method="POST" action="{{route('better.destroy', [$better])}}">
                                    @csrf
                                    <a class="btn btn-success" href="{{route('better.edit',[$better])}}">EDIT</a>
                                    <button class="btn btn-danger" type="submit">DELETE</button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection