@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Role</h2>
        <a href="{{ route('roles.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Roles
        </a>
    </div>

    <div class="section">
        <form action="{{ route('roles.update', $role->id) }}" method="POST" id="role-form">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Role Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description *</label>
                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $role->description) }}</textarea>
                @error('description')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Permissions *</label>
                <div class="permissions-container" style="border: 1px solid #ddd; border-radius: 4px; padding: 15px; max-height: 300px; overflow-y: auto;">
                    <div class="form-check" style="margin-bottom: 10px;">
                        <input type="checkbox" class="form-check-input" id="select-all-permissions">
                        <label class="form-check-label" for="select-all-permissions" style="font-weight: bold;">
                            Select All Permissions
                        </label>
                    </div>
                    <hr>
                    @foreach($permissions as $key => $description)
                    <div class="form-check" style="margin-bottom: 8px;">
                        <input type="checkbox" name="permissions[]" value="{{ $key }}" class="form-check-input permission-checkbox" id="permission-{{ $key }}"
                            {{ in_array($key, old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="permission-{{ $key }}">
                            <strong>{{ $key }}</strong> - {{ $description }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('permissions')
                    <div class="text-danger" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Role
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('select-all-permissions');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const form = document.getElementById('role-form');

    // Select all permissions
    selectAll.addEventListener('change', function() {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Check select all if all permissions are selected
    function updateSelectAll() {
        const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
        selectAll.checked = allChecked;
    }

    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectAll);
    });

    // Initialize select all state
    updateSelectAll();

    // Form validation
    form.addEventListener('submit', function(e) {
        const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked');
        if (checkedPermissions.length === 0) {
            e.preventDefault();
            alert('Please select at least one permission.');
        }
    });
});
</script>
@endsection