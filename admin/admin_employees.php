<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Employees</h3>
    <p>Edit employees here.</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_employees" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Position</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Position</th>
            <th>Image</th>
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
                            <label for="edit_full_name">Full Name</label>
                            <input type="text" class="form-control" name="edit_full_name" id="edit_full_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_position">Position</label>
                            <input type="text" class="form-control" name="edit_position" id="edit_position">
                        </div>
                        <div class="form-group">
                            <label for="edit_info1">Info 1</label>
                            <input type="text" class="form-control" name="edit_info1" id="edit_info1">
                        </div>
                        <div class="form-group">
                            <label for="edit_info2">Info 2</label>
                            <input type="text" class="form-control" name="edit_info2" id="edit_info2">
                        </div>
                        <div class="form-group">
                            <label for="edit_info3">Info 3</label>
                            <input type="text" class="form-control" name="edit_info3" id="edit_info3">
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
                            <label for="create_full_name">Full Name</label>
                            <input type="text" class="form-control" name="create_full_name" id="create_full_name">
                        </div>
                        <div class="form-group">
                            <label for="create_position">Position</label>
                            <input type="text" class="form-control" name="create_position" id="create_position">
                        </div>
                        <div class="form-group">
                            <label for="create_info1">Info 1</label>
                            <input type="text" class="form-control" name="create_info1" id="create_info1">
                        </div>
                        <div class="form-group">
                            <label for="create_info2">Info 2</label>
                            <input type="text" class="form-control" name="create_info2" id="create_info2">
                        </div>
                        <div class="form-group">
                            <label for="create_info3">Info 3</label>
                            <input type="text" class="form-control" name="create_info3" id="create_info3">
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
        var admin_employees;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_full_name = $("#edit_full_name");
        var edit_current_image = $("#edit_current_image");
        var edit_new_image = $("#edit_new_image");
        var edit_position = $("#edit_position");
        var edit_info1 = $("#edit_info1");
        var edit_info2 = $("#edit_info2");
        var edit_info3 = $("#edit_info3");

        var create_full_name = $("#create_full_name");
        var create_new_image = $("#create_new_image");
        var create_position = $("#create_position");
        var create_info1 = $("#create_info1");
        var create_info2 = $("#create_info2");
        var create_info3 = $("#create_info3");

        var i = 0;

        $(document).ready(function() {
            admin_employees = $('#admin_employees').DataTable({
                "ajax": "admin_employees/table.php",
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });
        });

        function edit(id){
            id_hidden.val(0);
            edit_full_name.val("");
            edit_current_image.attr('src', '/business/images/blank.png');
            edit_new_image.val("");
            edit_position.val("");
            edit_info1.val("");
            edit_info2.val("");
            edit_info3.val("");
            $.post('admin_employees/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_full_name.val(data['full_name']);
                    edit_current_image.attr('src', data['image_url']);
                    edit_position.val(data['position']);
                    edit_info1.val(data['info1']);
                    edit_info2.val(data['info2']);
                    edit_info3.val(data['info3']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_employees/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_employees.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function create()
        {
            create_full_name.val("");
            create_new_image.val("");
            create_position.val("");
            create_info1.val("");
            create_info2.val("");
            create_info3.val("");
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_employees/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_employees.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_employees/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_employees.ajax.reload(null, false);
        }


    </script>
<?php
end_page();