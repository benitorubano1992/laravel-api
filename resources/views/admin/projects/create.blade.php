@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="text-center my-4">Crea un nuovo Progetto</h2>
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control @error('title')
                is-invalid
            @enderror"
                    id="title" name="title" value="{{ old('title') }}">
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
                        <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>{{ $type->name }}</option>
                    @endforeach


                </select>
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- @if (count($tecnologies)) 
                <ul>
                    @foreach ($tecnologies as $tecnology)
                        <li>{{ $tecnology->name }}</li>
                    @endforeach


                </ul>
            @endif
                --}}
            @foreach ($tecnologies as $tecnology)
                <div class="mb-3 form-check">
                    <input type="checkbox" name="tecnologies[]"
                        class="form-check-input @error('tecnologies')
                    is-invalid
                    @enderror"
                        id="tecnology-{{ $tecnology->id }}" value="{{ $tecnology->id }}">
                    <label class="form-check-label" for="tecnology-{{ $tecnology->id }}">{{ $tecnology->name }}</label>
                    @error('tecnologies')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            @endforeach

            <div class="mb-3">
                <label for="cover_image" class="form-label">Image:</label>
                <input type="file"
                    class="form-control @error('cover_image')
                is-invalid
                @enderror"
                    id="cover_image" name="cover_image">
                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="image-preview">

            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea name="content" id="content" cols="30" rows="10"
                    class="form-control @error('content')
                is-invalid
                @enderror">{{ old('content') }}</textarea>
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
