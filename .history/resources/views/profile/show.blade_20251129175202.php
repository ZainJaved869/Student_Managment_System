<div class="text-center">
    @if($user->profile_picture)
        <img src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}" class="profile-img">
    @else
        <div class="profile-placeholder">{{ substr($user->name, 0, 1) }}</div>
    @endif
    <h4>{{ $user->name }}</h4>
    <p>{{ $user->email }}</p>
</div>

<style>
.profile-img { width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid #e9ecef; }
.profile-placeholder { width:120px; height:120px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:bold; border:4px solid #e9ecef; background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; margin:0 auto; }
</style>
