@inject('translator', 'App\Providers\TranslationProvider')
@if ( $user->role == "SA" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Popular actions</h5>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Admin.viewAs">
                    <i class="fas fa-user-secret"></i> Virtual Session
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
    </div>
</div>
@elseif ( $user->role == "WA" )

@elseif ( $user->role == "AA" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Popular actions</h5>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Admin.viewAs">
                    <i class="fas fa-user-secret"></i> Virtual Session
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="btn btn-black width100" href="Users.new">
                    <i class="fas fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
    </div>
</div>
@elseif ( $user->role == "M" )
<div class="container-fluid">
    <div class="row">
            <h5 class="width100">Quick actions</h5>
            <div class="col-12 text-center pt-3">
                <span onclick="addTask()" title="Add task" class="quick-action">
                   <i class="fas fa-calendar-plus"></i>
                </span>
                <span onclick="addPerson()" title="Add person" class="quick-action">
                   <i class="fas fa-address-book"></i>
                </span>
            </div>
        </div>
    </div>
</div>
@elseif ( $user->role == "PO" )

@endif
<div class="container-fluid" style="margin-top: 30px;">
    <div class="row">
        {!! $widgets !!}
    </div>
</div>