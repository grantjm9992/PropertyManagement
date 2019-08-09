<form action="Users.save" id="form">
    <div class="container-fluid">
        <div class="row">
        <input type="text" name="id" value="{{ $user->id }}" hidden>
            <div class="col-12 col-lg-6 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="surname">Surname</label>
                <input type="text" name="surname" value="{{ $user->surname }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="user">Username</label>
                <input type="text" name="user" value="{{ $user->user }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    @foreach ( $roles as $role )
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="id_company">Company</label>
                <select name="id_company" id="id_company" class="form-control">
                    @foreach ( $companies as $company )
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="password">Confirm password</label>
                <input type="password" id="password2" class="form-control">
            </div>
        </div>
    </div>
</form>

<script>
    function submitForm()
    {
        if ( $('#password').val() != $('#password2').val() && $('#password').val() != "" )
        {
            var options = Array();
            options.title = "Error";
            options.text = "The passwords entered do not match";
            options.icon = "error";
            sweerAlert( options );
        }
        else
        {
            $('#form').submit();
        }
    }

    function addToContacts()
    {
        $.ajax({
            type: "POST",
            url: "Contacts.addFromUser",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id: "{{ $user->id }}"},
            success: function(data)
            {
                var s = jQuery.parseJSON(data);
                if ( s.success === 1 )
                {
                    $.notify(s.message, {
                        clickToHide: true,
                        autoHide: true,
                        position: "bottom-left",
                        className: "success"
                    });
                }
            }
        })        
    }
</script>