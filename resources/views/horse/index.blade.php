@extends('layouts.app')
@section('title') Horse menu @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Horse menu</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($horses as $horse)
                        <li class="list-group-item">
                            <div class="list-container">
                                <div class="list-container-content">
                                    <p><span> Vardas: </span> {{$horse->name}} </p>
                                    <p><span> Keliose varžybose dalyvavo: </span> {{$horse->runs}} </p>
                                    <p><span> Laimėtos varžybos: </span> {{$horse->wins}} </p>
                                    <p><span> Apie žirgą: </span> {!! $horse->about !!} </p>
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