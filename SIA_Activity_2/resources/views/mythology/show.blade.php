@extends('layouts.app')

@section('title', $item['name'] . ' - Philippine Mythology Almanac')

@section('content')
    <a href="{{ route('mythology.index') }}" class="back-link">&larr; Back to Catalogue</a>

    <h2 style="color: #2d3748; margin-top: 0; font-size: 2.5rem;">{{ $item['name'] }}</h2>
    
    <div style="font-size: 1.1rem; color: #4a5568; line-height: 1.8;">
        <p>{{ $item['description'] }}</p>
    </div>

    <div class="details-container">
        <h3 style="color: #2d3748;">Attributes and Characteristics</h3>
        <div class="detail-item">
            <span class="attribute">Habitat:</span> <span>{{ $item['habitat'] }}</span>
        </div>
        <div class="detail-item">
            <span class="attribute">Abilities:</span> <span>{{ $item['abilities'] }}</span>
        </div>
        <div class="detail-item">
            <span class="attribute">Weakness:</span> <span>{{ $item['weakness'] }}</span>
        </div>
    </div>
@endsection
