@extends('layouts.master')
@section('content')
    <h2>{{ $album->name }}</h2>
    <small>by <em>{{ $album->band->name }}</em></small>
    <div class="details">
        <p><strong>Date Recorded:</strong> {{ $album->recorded_date != '1970-01-01' ? date('M j, Y', strtotime($album->recorded_date)) : '' }}</p>
        <p><strong>Releaase Date:</strong> {{ $album->release_date != '1970-01-01' ? date('M j, Y', strtotime($album->release_date)) : '' }}</p>
        <p><strong>Number of Tracks:</strong> {{ $album->number_of_tracks ? $album->number_of_tracks : '' }}</p>
        <p><strong>Label:</strong> {{ $album->label }}</p>
        <p><strong>Producer:</strong> {{ $album->producer }}</p>
        <p><strong>Genre:</strong> {{ $album->genre }}</p>
        <p></p>
    </div>
    <hr>
    <a href="{{ url()->previous() }}">Back</a>
@endsection