@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="section">
    <div class="section-header">
        <h2 class="section-title">My Profile</h2>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" 
                             class="profile-img">
                    @else
                        <div class="profile-placeholder">{{ substr($user->name, 0, 1) }}</div>
                    @endif
                    <h4>{{ $user->name }}</h4>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p><strong>Phone:</strong> {{ $user->phone ?? 'Not set' }}</p>
                    <p><strong>Address:</strong> {{ $user->address ?? 'Not set' }}</p>
                    <p><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $user->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-img { width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid #e9ecef; }
.profile-placeholder { width:120px; height:120px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:bold; border:4px solid #e9ecef; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:white; margin:0 auto; }
</style>
@endsection
