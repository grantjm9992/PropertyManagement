
<form action="Pages.uploadImage" class="dropzone" id="my-awesome-dropzone">
    <input type="text" name="id" hidden value="{{ $page->id }}">
    @csrf()
</form>