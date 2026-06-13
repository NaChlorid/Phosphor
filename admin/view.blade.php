@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($background_image)
    <p><strong>Current background:</strong></p>
    <img src="{{ $background_image }}" style="max-width:100%; max-height:200px; border-radius:4px; margin-bottom:12px;">
@else
    <p class="text-muted">Using default background.</p>
@endif

<form action="/admin/extensions/phosphor" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Upload New Background</label>
        <input type="file" name="background_image" accept="image/*" class="form-control">
        <small class="text-muted">Recommended: 1920x1080px, max 5MB. Supports JPG, PNG, WebP.</small>
    </div>
    <button type="submit" class="btn btn-primary">Save Background</button>
</form>

@if($background_image)
    <form action="/admin/extensions/phosphor" method="POST" style="margin-top:10px;">
        @csrf
        <input type="hidden" name="reset_background" value="1">
        <button type="submit" class="btn btn-default">Reset to Default</button>
    </form>
@endif
