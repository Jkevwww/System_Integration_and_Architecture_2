@extends('layouts.app')

@section('title', 'Creatures List - Philippine Mythology Almanac')

@section('content')
    <h2 style="color: #2d3748; margin-top: 0;">Mythological Creatures Catalogue</h2>
    <p>Discover the legendary beings of Philippine folklore. Select a creature to view full details and attributes.</p>
    
    <ul class="item-list">
        @foreach($items as $id => $item)
            <li>
                <a href="{{ route('mythology.show', $id) }}" class="item-link">{{ $item['name'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection
