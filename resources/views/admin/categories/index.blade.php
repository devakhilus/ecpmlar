@extends('admin.master')

@section('title', 'Categories')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Categories</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Add New Category Button -->
        <div class="mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Category
            </a>
        </div>

        <!-- Categories Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 10%">
                                <a href="{{ route('categories.index', ['sort_by' => 'id', 'order' => ($sortField === 'id' && $sortOrder === 'asc') ? 'desc' : 'asc']) }}" class="text-white">
                                    ID {!! $sortField === 'id' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('categories.index', ['sort_by' => 'name', 'order' => ($sortField === 'name' && $sortOrder === 'asc') ? 'desc' : 'asc']) }}" class="text-white">
                                    Name {!! $sortField === 'name' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' !!}
                                </a>
                            </th>
                            <th style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix px-3">
                {{ $categories->appends(['sort_by' => $sortField, 'order' => $sortOrder])->links() }}
            </div>
        </div>

    </div>
</section>
@endsection