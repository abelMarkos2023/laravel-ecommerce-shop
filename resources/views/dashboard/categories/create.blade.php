@extends('layouts.dash')

@section('heading', 'Create Category')

@section('content')

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3 form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name')
                is-invalid
            @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="description" value="{{ old('description') }}" name="description"
                required></textarea>
        </div>

        <div class="mb-3 form-group">
            <label for="parent" class="form-label">Parent Category</label>
            <select name="parent_id" id="parent" class="form-control">
                <option value="">None</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 form-group">
            <label for="customRadioInline1" class="form-label d-block">Status</label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="active" name="status" class="custom-control-input" value="active" checked>
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="archived" name="status" class="custom-control-input" value="archived">
                <label class="custom-control-label" for="archived">Archived</label>
            </div>
        </div>

        <div class="mb-3 form-group">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" required>
         <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 300px;" />
        </div>

        <button type="submit" class="btn  btn-primary">Submit</button>
    </form>

@endsection
