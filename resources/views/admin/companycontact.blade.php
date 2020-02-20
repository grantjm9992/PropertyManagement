<div class="container-fluid">
    <form id="form" action="AdminCompanies.save">
        <input type="text" hidden name="id" value="{{ $company->id }}">
        <div class="row">
            <div class="col-12 col-lg-6 form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ $company->email }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" value="{{ $company->phone }}" class="form-control">
            </div>
            <div class="col-12 form-group">
                <label for="">Address</label>
                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $company->address }}</textarea>
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Receiving email address</label>
                <input type="text" name="send_address" value="{{ $company->send_address }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Google location coordinates</label>
                <input type="text" name="google_coordinates" value="{{ $company->google_coordinates }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Facebook link</label>
                <input type="text" name="link_facebook" value="{{ $company->link_facebook }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Instagram link</label>
                <input type="text" name="link_instagram" value="{{ $company->link_instagram }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Twitter link</label>
                <input type="text" name="link_twitter" value="{{ $company->link_twitter }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">LinkdIn link</label>
                <input type="text" name="link_linkdin" value="{{ $company->link_linkdin }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Youtube link</label>
                <input type="text" name="link_youtube" value="{{ $company->link_youtube }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Facebook feed</label>
                <input type="text" name="facebook_feed" value="{{ $company->facebook_feed }}" class="form-control">
            </div>
        </div>
    </form>
</div>
<script>
 function submitForm () {
     $("#form").submit();
 }
</script>