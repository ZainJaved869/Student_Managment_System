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
            <div class="card">
                <div class="card-header"><h4 class="card-title">Profile Picture</h4></div>
                <div class="card-body text-center">
                    <div class="profile-picture mb-3">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" 
                                 class="profile-img" id="profileImagePreview">
                        @else
                            <div class="profile-placeholder" id="profileImagePreview">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="profile_picture" class="form-control-file" accept="image/*" onchange="previewImage(this)">
                        <small class="form-text text-muted">Max 2MB. JPG, PNG, GIF only.</small>

                        <label class="mt-3">Full Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>

                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">

                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">

                        <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Update Profile</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary mt-3"><i class="fas fa-times"></i> Cancel</a>
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
                preview.outerHTML = `<img src="${e.target.result}" class="profile-img" id="profileImagePreview">`;
            } else {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>

<style>
.profile-img { width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid #e9ecef; }
.profile-placeholder { width:120px; height:120px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:bold; border:4px solid #e9ecef; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:white; margin:0 auto; }
</style>
@endsection
