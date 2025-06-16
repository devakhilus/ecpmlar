@extends('admin.master')

@section('title', 'Products')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Products</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Add New Product Button -->
        <div class="mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Product
            </a>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%">
                                <a href="{{ route('products.index', ['sort' => 'id', 'direction' => $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                    ID {!! $sortField === 'id' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('products.index', ['sort' => 'name', 'direction' => $sortField === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                    Name {!! $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('products.index', ['sort' => 'price', 'direction' => $sortField === 'price' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                    Price {!! $sortField === 'price' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('products.index', ['sort' => 'stock', 'direction' => $sortField === 'stock' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                    Stock {!! $sortField === 'stock' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>Category</th>
                            <th style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix px-3">
                {{ $products->appends(['sort' => $sortField, 'direction' => $sortDirection])->links() }}
            </div>
        </div>

    </div>
</section>
@endsection