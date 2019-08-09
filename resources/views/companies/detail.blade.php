<form action="AdminCompanies.save">
    <div class="container-fluid">
        <div class="row">
            <input type="text" name="id" value="{{ $company->id }}" hidden>
            <div class="col-12 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $company->name }}" class="form-control">
            </div>
            <div class="col-12 form-group">
                <label for="application_url">Application URL</label>
                <input type="text" name="application_url" value="{{ $company->application_url }}" class="form-control">
            </div>
        </div>
        <button type="submit" id="submit" hidden></button>
    </div>
</form>

<script>
function deleteCompany()
{
    $.ajax({
        type: "POST",
        url: "AdminCompanies.delete",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {id: "{{ $company->id }}"},
        success: function(data)
        {
            if ( data == "OK" )
            {
                window.location = "AdminCompanies";
            }
        }
    })
}
</script>