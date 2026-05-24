@extends('layouts.admin')

@section('content')
<div class="card shadow-sm p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Users</h4>
        <div>
            <button class="btn btn-outline-secondary me-2">Filter</button>
            <button class="btn btn-outline-secondary me-2">Export</button>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ New User</a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
        <input type="text" name="q" value="{{ request('q') }}" 
               class="form-control" placeholder="Search by ID, name or email">
    </form>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>User</th>
                    <th>Contact</th>
                    <th>Role</th>
                    <th>Orders</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>

                    <td class="d-flex align-items-center">
                        @if($user->avatar ?? false)
                            <img src="{{ asset($user->avatar) }}" 
                                 class="rounded-circle me-2" width="40" height="40" alt="{{ $user->name }}">
                        @else
                            <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center"
                                 style="width:40px;height:40px;">
                                <i class="fa-solid fa-user text-muted"></i>
                            </div>
                        @endif
                        <div>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="fw-bold text-primary">
                                ID {{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}
                            </a>
                            <div>{{ $user->name }}</div>
                        </div>
                    </td>

                    <td>
                        <div>{{ $user->email }}</div>
                        <small class="text-muted">{{ $user->phone ?? '—' }}</small>
                    </td>
                    <td>{{ ucfirst($user->usertype) }}</td>
                    <td>{{ $user->orders_count ?? 0 }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-primary me-2" title="View">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-warning me-2" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 text-danger" 
                                    onclick="return confirm('Delete this user?')" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }}
        </div>
        <div class="d-flex justify-content-end">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.getElementById('checkAll').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>
@endsection
