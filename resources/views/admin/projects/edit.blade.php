@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="text-center my-4">Aggiorna il progetto {{ $project->title }}</h2>
        <form method="POST" action="{{ route('admin.projects.update', $project->slug) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text"
                    class="form-control @error('title')
                is-invalid
                @enderror" id="title"
                    name="title" value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="type_id">Type:</label>
                <select class="form-select @error('type_id')
                is-invalid
                @enderror"
                    aria-label="Default select example" name="type_id" id="type_id">
                    <option value=""></option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @selected(old('type_id', $project->type_id) == $type->id)>{{ $type->name }}</option>
                    @endforeach


                </select>

                @foreach ($tecnologies as $tecnology)
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="tecnologies[]"
                            class="form-check-input @error('tecnologies')
                    is-invalid
                    @enderror"
                            id="tecnology-{{ $tecnology->id }}" @checked($project->tecnologies->contains($tecnology->id)) value="{{ $tecnology->id }}">
                        <label class="form-check-label" for="tecnology-{{ $tecnology->id }}">{{ $tecnology->name }}</label>
                        @error('tecnologies')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                @endforeach




                <div class="mb-3">
                    <label for="cover_image">Immagine</label>
                    <input type="file" name="cover_image" id="cover_image"
                        class="form-control @error('cover_image')
                is-invalid
                @enderror">
                    @error('cover_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mt-3 image-preview">
                        @if ($project->cover_image)
                            <img id="image_preview" src="{{ asset('storage/' . $project->cover_image) }}"
                                alt="{{ 'Cover image di ' . $project->title }}">
                        @endif

                    </div>

                </div>



                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea name="content" id="content" cols="30" rows="10"
                        class="form-control @error('content') 
                is-invalid
                @enderror">{{ old('content', $project->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror



                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>




    </div>
@endsection
