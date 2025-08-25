@extends('layouts.dash')

@section('heading', 'products')
@section('content')




<a href="{{route('products.create')}}" class="btn btn-outline-primary float-end">New+</a>

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
            <th scope="col">Store</th>
            <th scope="col">Category</th>
            <th scope="col">Slug</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>

            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $index=>$product)
        <tr>

            <th>{{ $index + 1 }}</th>
            <th scope="row">{{$product->id}}</th>
            {{-- <td><img src="{{ asset('storage/'.$product->image) }}" width="50" height="50" alt=""></td> --}}
            <th><img src = "{{ $product->image }}" /></th>
            <td>{{$product->name}}</td>
            <th>{{ $product->store_id }}</th>
            <th>{{ $product->category_id }}</th>
            <td>{{$product->slug}}</td>
            <td>
                @if($product->status == 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Archived</span>
                @endif
            </td>
            <td>{{$product->created_at->diffForHumans()}}</td>

            <td class="d-flex flex-gap-2">
                <a href="{{route('products.edit', $product->id)}}" class="btn btn-success btn-sm">
                    Edit
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty

        <h1 class="text-center text-2xl">No products</h1>
        @endforelse
</table>

{{ $products->withQueryString()->links() }}

@endsection
