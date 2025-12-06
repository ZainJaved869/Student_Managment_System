@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">My Profile</h2>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
    </div>

    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Information</h4>
                </div>
                <div class="card-body text-center">
                    <div class="profile-picture mb-3">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" 
                                 alt="Profile Picture" class="profile-img">
                        @else
                            <div class="profile-placeholder">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="text-muted">
                        <i class="fas fa-user-shield mr-2"></i>
                        {{ $user->role ? $user->role->name : 'No Role Assigned' }}
                    </p>
                    <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'warning' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Account Details -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Account Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Full Name</label>
                                <p class="info-value">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Email Address</label>
                                <p class="info-value">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Phone Number</label>
                                <p class="info-value">{{ $user->phone ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Account Status</label>
                                <p class="info-value">
                                    <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="info-group">
                        <label class="info-label">Address</label>
                        <p class="info-value">{{ $user->address ?? 'Not set' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Member Since</label>
                                <p class="info-value">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label">Last Updated</label>
                                <p class="info-value">{{ $user->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Quick Actions</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('profile.edit.password') }}" class="btn btn-outline-warning btn-block">
                                <i class="fas fa-lock"></i> Change Password
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('settings.index') }}" class="btn btn-outline-info btn-block">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-picture {
    position: relative;
    display: inline-block;
}

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
}

.info-group {
    margin-bottom: 1.5rem;
}

.info-label {
    font-weight: 600;
    color: #6e707e;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.info-value {
    color: #858796;
    margin: 0;
    font-size: 1rem;
}

.btn-block {
    padding: 10px;
    text-align: center;
}
</style>
@endsection