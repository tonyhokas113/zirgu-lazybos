@extends('layouts.app')
@section('title') Horse menu @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Horse menu</h3>
                    <form action="{{route('horse.index')}}" method="get" class="sort-form">
                        <fieldset>
                            <legend>Sort by:</legend>
                            <div>
                                <label>Name</label>
                                <input type="radio" name="sort_by" value="name" @if('name'==$sort) checked @endif>
                            </div>
                            <div>
                                <label>Wins</label>
                                <input type="radio" name="sort_by" value="wins" @if('wins'==$sort) checked @endif>
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
                        <a href="{{route('horse.index')}}" class="btn btn-primary">Clear</a>
                    </form>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($horses as $horse)
                        <li class="list-group-item">
                            <div class="list-container">
                                <div class="list-container-content">
                                    <p><span> Vardas: </span> {{$horse->name}} </p>
                                    <p><span> Laimėtų rungtynių skaičius: </span> {{$horse->wins}} </p>
                                    <p><span> Dalyvauta rungtynių skaičius: </span> {{$horse->runs}} </p>
                                    <p><span> Aprašymas: </span> {!! $horse->about !!} </p>
                                </div>
                                <div class="list-container-buttons">
                                    <a class="btn btn-success" href="{{route('horse.edit',$horse)}}">EDIT</a>
                                    <form method="POST" action="{{route('horse.destroy', $horse)}}">
                                        @csrf
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
</div>
@endsection
