@extends('admin.master')

@section('title', 'Users')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Users</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            @php
                            function sort_link($field, $label, $currentSort, $currentOrder) {
                            $newOrder = ($currentSort === $field && $currentOrder === 'asc') ? 'desc' : 'asc';
                            $arrow = '';
                            if ($currentSort === $field) {
                            $arrow = $currentOrder === 'asc' ? '↑' : '↓';
                            }
                            $url = request()->fullUrlWithQuery(['sort_by' => $field, 'order' => $newOrder]);
                            return "<a href=\"$url\" class=\"text-white\">$label $arrow</a>";
                            }
                            @endphp

                            <th>{!! sort_link('id', 'ID', $sortField, $sortOrder) !!}</th>
                            <th>{!! sort_link('name', 'Name', $sortField, $sortOrder) !!}</th>
                            <th>{!! sort_link('email', 'Email', $sortField, $sortOrder) !!}</th>
                            <th>Verified</th>
                            <th>{!! sort_link('is_admin', 'Role', $sortField, $sortOrder) !!}</th>
                            <th>{!! sort_link('created_at', 'Created', $sortField, $sortOrder) !!}</th>
                            <th style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email_verified_at)
                                <span class="badge badge-success">Verified</span>
                                @else
                                <span class="badge badge-secondary">Unverified</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $user->is_admin ? 'info' : 'dark' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix px-3">
                {{ $users->appends(['sort_by' => $sortField, 'order' => $sortOrder])->links() }}
            </div>
        </div>

    </div>
</section>
@endsection