@extends('layouts.dash')

@section('heading', 'Create Category')
@section('content')

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3 form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid

            @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 form-group">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control @error('description') is-invalid

            @enderror" id="description" value="{{ old('description', $category->description) }}" name="description"
                required>
                {{ old('description', $category->description) }}
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </textarea>
        </div>

        <div class="mb-3 form-group">
            <label for="parent" class="form-label">Parent Category</label>
            <select name="parent_id" id="parent" class="form-control @error('parent_id') is-invalid

            @enderror">
                <option value="">None</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($category->parent_id == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 form-group @error('status') is-invalid

        @enderror">
            <label for="customRadioInline1" class="form-label d-block">Status</label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="active" name="status" class="custom-control-input" value="active" @checked($category->status == 'active')>
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="archived" name="status" class="custom-control-input" value="archived" @checked($category->status == 'archived')>
                <label class="custom-control-label" for="archived">Archived</label>
            </div>
        </div>
        @error('status')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror

        <div class="mb-3 form-group">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid

            @enderror" id="image" name="image" value="{{ old('image') }}" >
            @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" width="200">
            @endif
        </div>

        <button type="submit" class="btn  btn-success">Update</button>
    </form>

@endsection
