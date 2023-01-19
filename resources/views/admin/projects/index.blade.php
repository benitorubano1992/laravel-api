@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="text-center my-4">Project List</h2>
        <div class="d-flex my-4 ">
            <a href="{{ route('admin.projects.create') }}" target="_blank" class="btn btn-success ms-auto">new Project</a>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Data di Creazione</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->title }}</th>
                        <td>{{ $project->created_at }}</td>
                        <td>
                            @if ($project->cover_image)
                                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="immagine db" class="w-50">
                            @else
                                <div class="w-50 bg-secondary py-3 text-center">
                                    Not image yet
                                </div>
                            @endif
                        </td>
                        <td><a class="btn btn-info" href="{{ route('admin.projects.show', $project->slug) }}"
                                role="button">Dettagli</a>
                            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->slug) }}"
                                role="button">Update</a>
                            <form class="d-inline"
                                action="{{ route('admin.projects.destroy', $project->slug) }}"method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn"
                                    data-title="{{ $project->title }}">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        @include('layouts.modal')


    </div>
@endsection
