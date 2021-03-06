@extends('layouts.app')
@section('title') Edit horse @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit horse</div>
                <div class="card-body">
                    <form method="POST" action="{{route('horse.update',$horse)}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="horse_name" value="{{old('horse_name',$horse->name)}}">
                        </div>
                        <div class="form-group">
                            <label>Runs:</label>
                            <input type="text" class="form-control" name="horse_runs" value="{{old('horse_runs',$horse->runs)}}">
                        </div>
                        <div class="form-group">
                            <label>Wins:</label>
                            <input type="text" class="form-control" name="horse_wins" value="{{old('horse_wins',$horse->wins)}}">
                        </div>
                        <div class="form-group">
                            <label>About:</label>
                            <textarea class="form-control" name="horse_about" value="{{old('horse_about',$horse->about)}}" id="summernote">{{$horse->about}}</textarea>
                        </div>
                        @csrf
                        <button class="btn btn-info" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection