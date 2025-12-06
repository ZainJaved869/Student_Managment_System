@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Edit Profile</h2>
        <a href="{{ route('profile.show') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <!-- Profile Picture -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Picture</h4>
                </div>
                <div class="card-body text-center">
                    <div class="profile-picture mb-3">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" 
                                 alt="Profile Picture" class="profile-img" id="profileImagePreview">
                        @else
                            <div class="profile-placeholder" id="profileImagePreview">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="file" name="profile_picture" id="profile_picture" 
                                   class="form-control-file" accept="image/*" onchange="previewImage(this)">
                            <small class="form-text text-muted">
                                Maximum file size: 2MB. Allowed types: JPG, PNG, GIF.
                            </small>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" 
                                       value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Account Status</label>
                                <input type="text" class="form-control" 
                                       value="{{ ucfirst($user->status) }}" disabled>
                                <small class="form-text text-muted">
                                    Contact administrator to change status.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Current Password *</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">New Password *</label>
                                    <input type="password" name="password" class="form-control" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-lock"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('profileImagePreview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (preview.classList.contains('profile-placeholder')) {
                preview.outerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="profile-img" id="profileImagePreview">`;
            } else {
                preview.src = e.target.result;
            }
        }
        
        reader.readAsDataURL(file);
    }
}
</script>

<style>
.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
}

.profile-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
    border: 4px solid #e9ecef;
    margin: 0 auto;
}
</style>
@endsection