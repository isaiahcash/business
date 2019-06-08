<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Posts</h3>
    <p>Do stuff with posts</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_posts" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created</th>
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
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" name="edit_title" id="edit_title">
                        </div>
                        <div class="form-group">
                            <label for="edit_content">Content</label>
                            <textarea class="form-control" id="edit_content" name="edit_content" rows="10"></textarea>
                        </div>
                        <label for="edit_current_image">Current Image</label>
                        <br>
                        <img class="mx-auto my-3" style="height: 150px; width: 150px; object-fit: contain" id="edit_current_image" name="edit_current_image" src="/business/images/blank.png">
                        <div class="form-group">
                            <label for="edit_new_image">New Image</label>
                            <input type="file" class="form-control-file" id="edit_new_image" name="edit_new_image">
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
                            <label for="create_title">Title</label>
                            <input type="text" class="form-control" name="create_title" id="create_title">
                        </div>
                        <div class="form-group">
                            <label for="create_content">Content</label>
                            <textarea class="form-control" id="create_content" name="create_content" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="create_new_image">New Image</label>
                            <input type="file" class="form-control-file" id="create_new_image" name="create_new_image">
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
        var admin_posts;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_title = $("#edit_title");
        var edit_content = $("#edit_content");
        var edit_current_image = $("#edit_current_image");
        var edit_new_image = $("#edit_new_image");

        var create_title = $("#create_title");
        var create_content = $("#create_content");
        var create_new_image = $("#create_new_image");

        var i = 0;

        $(document).ready(function() {
            admin_posts = $('#admin_posts').DataTable({
                "ajax": "admin_posts/table.php",
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });
        });

        function edit(id){
            id_hidden.val(0);
            edit_title.val("");
            edit_content.val("");
            edit_current_image.attr('src', '/business/images/blank.png');
            edit_new_image.val("");
            $.post('admin_posts/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_title.val(data['title']);
                    edit_content.val(data['content']);
                    edit_current_image.attr('src', data['image_url']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_posts/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_posts.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function create()
        {
            create_title.val("");
            create_content.val("");
            create_new_image.val("");
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_posts/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_posts.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_posts/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_posts.ajax.reload(null, false);
        }


    </script>
<?php
end_page();