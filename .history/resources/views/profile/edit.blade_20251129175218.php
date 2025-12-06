<img id="profileImagePreview" class="profile-img"
     @if($user->profile_picture)
        src="{{ asset('storage/profile-pictures/' . $user->profile_picture) }}"
     @else
        style="display:none"
     @endif
>

<div id="profilePlaceholder" class="profile-placeholder" 
     @if($user->profile_picture) style="display:none" @endif>
    {{ substr($user->name, 0, 1) }}
</div>

<input type="file" name="profile_picture" onchange="previewImage(this)">

<script>
function previewImage(input) {
    const preview = document.getElementById('profileImagePreview');
    const placeholder = document.getElementById('profilePlaceholder');
    const file = input.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}
</script>
