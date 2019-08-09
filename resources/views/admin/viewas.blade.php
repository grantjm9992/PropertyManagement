<div class="container-fluid">
    <div class="row">
        @foreach ( $admins as $admin )
        <div class="col-12 col-sm-6">
            <div style="width: 96%; margin: 10px auto;">
                <a href="Admin.viewAs?id={{ $admin->id }}" class="btn btn-outline-black width100">
                    {{ $admin->name }} {{ $admin->surname }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>