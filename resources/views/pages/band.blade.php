@extends('layouts.master')
@section('content')
    <h2><a target="_blank" href="{{ $band->website }}">{{ $band->name }}</a></h2>
    <div class="details">
        <p><strong>Formed:</strong> {{ date('M j, Y', strtotime($band->start_date)) }}</p>
        <p><strong>Status:</strong> {{ $band->still_active ? "Active" : "Inactive" }}</p>
    </div>
    <div id="discography">
        <h4>Discography</h4>
        <ul>
            @foreach($band->albums as $album)
                <li><a href="/albums/{{ $album->id }}">{{ $album->name }}</a> <small>{{ $album->release_date != '1970-01-01' ? ' - ' . date('M j, Y', strtotime($album->release_date)) : '' }}</small></li>
            @endforeach
        </ul>
    </div>
    <hr>
    <a href="/">Home</a>
@endsection