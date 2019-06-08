<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Users</h3>
    <p>These are the people that have access to this admin page</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_users" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Edit</th>
        </tr>
        </tfoot>
    </table>

    <div id="edit_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="edit_data" method="post" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" name="edit_username" id="edit_username">
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Reset Password</label>
                            <input type="text" class="form-control" id="edit_password" name="edit_password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="id_hidden" name="id_hidden" hidden>
                        <button type="button" class="btn btn-danger mr-auto" onclick="remove()">Delete</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="create_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="create_data" method="post" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_username">Username</label>
                            <input type="text" class="form-control" name="create_username" id="create_username">
                        </div>
                        <div class="form-group">
                            <label for="create_password">Reset Password</label>
                            <input type="text" class="form-control-file" id="create_password" name="create_password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
admin_end_content();
script_includes();
?>
    <script>
        var admin_users;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_username = $("#edit_username");
        var edit_password = $("#edit_password");

        var create_username = $("#create_username");
        var create_password = $("#create_password");


        var i = 0;

        $(document).ready(function() {
            admin_users = $('#admin_users').DataTable({
                "ajax": "admin_users/table.php",
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });
        });

        function edit(id){
            id_hidden.val(0);
            edit_username.val("");
            edit_password.val("");
            $.post('admin_users/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_username.val(data['username']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_users/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_users.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function create()
        {
            create_username.val("");
            create_password.val("");
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_users/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_users.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_users/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_users.ajax.reload(null, false);
        }


    </script>
<?php
end_page();