@extends('layouts.app')
@section('title') Edit bet @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit bet</div>
                <div class="card-body">
                    <form method="POST" action="{{route('better.update',[$better])}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="better_name" value="{{old('better_name',$better->name)}}">
                        </div>
                        <div class="form-group">
                            <label>Surname:</label>
                            <input type="text" class="form-control" name="better_surname" value="{{old('better_surname',$better->surname)}}">
                        </div>
                        <div class="form-group">
                            <label>Bet:</label>
                            <input type="text" class="form-control" name="better_bet" value="{{old('better_bet',$better->bet)}}">
                        </div>
                        <div class="form-group">
                            <label>Horse name: </label>
                            <select name="horse_id" class="form-control">
                                @foreach ($horses as $horse)
                                <option value="{{$horse->id}}" @if($horse->id == $better->horse_id) selected @endif>{{$horse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button class="btn btn-info" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection