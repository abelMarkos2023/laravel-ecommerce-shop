@extends('layouts.dash')

@section('heading', 'Categories')
@section('content')




<a href="{{route('categories.create')}}" class="btn btn-outline-primary float-end">New+</a>

<x-custom.alert type = "danger" />
<x-custom.alert type = "info" />
<x-custom.alert type = "success" />
<x-alert type='success' />

<form action="{{ URL::current() }}" class="d-flex justify-content-between my-2">
    <input type="text" name = 'name' value="{{request()->name}}" class="form-control mx-1">
    <select name="status" id="status" class="form-control mx-1">
        <option value="">All</option>
        <option value="active"   @selected(request()->status == 'active')>Active</option>
        <option value="archived" @selected(request()->status == 'archived')>Archived</option>
    </select>
    <button class="btn btn-outline-info">Search</button>
</form>
<table class="table table-striped my-4">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th>Parent ID</th>
            <th scope="col">Slug</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>

            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $index=>$category)
        <tr>

            <th>{{ $index + 1 }}</th>
            <th scope="row">{{$category->id}}</th>
            <td><img src="{{ asset('storage/'.$category->image) }}" width="50" height="50" alt=""></td>
            <td>{{$category->name}}</td>
            <th>{{ $category->parent_id }}</th>
            <td>{{$category->slug}}</td>
            <td>
                @if($category->status == 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Archived</span>
                @endif
            </td>
            <td>{{$category->created_at->diffForHumans()}}</td>

            <td class="d-flex flex-gap-2">
                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-success btn-sm">
                    Edit
                </a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty

        <h1 class="text-center text-2xl">No Categories</h1>
        @endforelse
</table>

{{ $categories->links() }}

@endsection
