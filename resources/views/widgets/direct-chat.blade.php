
<div class="card direct-chat direct-chat-primary">
    <div class="card-header">
        <h3 class="card-title">Direct Chat</h3>

        <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                    data-widget="chat-pane-toggle">
            <i class="fas fa-comments"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <!-- Conversations are loaded here -->
    <div id="messages" class="direct-chat-messages">
        {!! $messages !!}
    </div>
    <!--/.direct-chat-messages-->

    <!-- Contacts are loaded here -->
    <div class="direct-chat-contacts">
        <ul class="contacts-list">
            {!! $conversations !!}
        </ul>
        <!-- /.contacts-list -->
    </div>
    <!-- /.direct-chat-pane -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    <form method="post">
        <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
        <span class="input-group-append">
            <div onclick="send()" class="btn btn-primary">Send</div>
        </span>
        </div>
    </form>
    </div>
    <!-- /.card-footer-->
</div>