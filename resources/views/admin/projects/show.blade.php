@extends('layouts.admin')
@section('content')
    <div class="container">
        <h3 class="text-center my-3">{{ $project->title }}</h3>
        <h5 class="text-center my-3 {{ $project->type ? 'text-primary' : 'd-none' }}">{{ $project->type?->name }}</h5>
        <div class="d-flex justify-content-between my-2">
            <div>{{ $project->created_at }}</div>
            <div>{{ $project->slug }}</div>
        </div>
        @forelse ($tecnologies as $tecnology)
            <span>#{{ $tecnology->name }}</span>
        @empty
            <p>Non ci sono tecnologie associate a questo progetto</p>
        @endforelse

        <div class="text-center my-3">
            @if ($project->cover_image)
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="immagine" class="w-50">
            @else
                <span>Not image yet</span>
            @endif
        </div>
        <div>{{ $project->content }}</div>
    </div>
@endsection
