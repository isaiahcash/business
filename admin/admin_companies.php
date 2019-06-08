<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Companies</h3>
    <p>Edit companies here.</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_companies" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Image</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Image</th>
            <th>Edit</th>
        </tr>
        </tfoot>
    </table>

    <div id="edit_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
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
                            <label for="edit_full_name">Company Name</label>
                            <input type="text" class="form-control" name="edit_full_name" id="edit_full_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_desc">Description</label>
                            <textarea class="form-control" name="edit_desc" id="edit_desc" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_url">Website URL</label>
                            <input type="text" class="form-control" name="edit_url" id="edit_url">
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="edit_info1_name">Info1 Name</label>
                                <input type="text" class="form-control" name="edit_info1_name" id="edit_info1_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="edit_info1_url">Info1 URL</label>
                                <input type="text" class="form-control" name="edit_info1_url" id="edit_info1_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="edit_info2_name">Info2 Name</label>
                                <input type="text" class="form-control" name="edit_info2_name" id="edit_info2_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="edit_info2_url">Info2 URL</label>
                                <input type="text" class="form-control" name="edit_info2_url" id="edit_info2_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="edit_info3_name">Info3 Name</label>
                                <input type="text" class="form-control" name="edit_info3_name" id="edit_info3_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="edit_info3_url">Info3 URL</label>
                                <input type="text" class="form-control" name="edit_info3_url" id="edit_info3_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="edit_info4_name">Info4 Name</label>
                                <input type="text" class="form-control" name="edit_info4_name" id="edit_info4_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="edit_info4_url">Info4 URL</label>
                                <input type="text" class="form-control" name="edit_info4_url" id="edit_info4_url">
                            </div>
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
        <div class="modal-dialog modal-lg" role="document">
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
                            <label for="create_full_name">Company Name</label>
                            <input type="text" class="form-control" name="create_full_name" id="create_full_name">
                        </div>
                        <div class="form-group">
                            <label for="create_desc">Description</label>
                            <textarea class="form-control" name="create_desc" id="create_desc" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="create_url">Website URL</label>
                            <input type="text" class="form-control" name="create_url" id="create_url">
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="create_info1_name">Info1 Name</label>
                                <input type="text" class="form-control" name="create_info1_name" id="create_info1_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="create_info1_url">Info1 URL</label>
                                <input type="text" class="form-control" name="create_info1_url" id="create_info1_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="create_info2_name">Info2 Name</label>
                                <input type="text" class="form-control" name="create_info2_name" id="create_info2_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="create_info2_url">Info2 URL</label>
                                <input type="text" class="form-control" name="create_info2_url" id="create_info2_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="create_info3_name">Info3 Name</label>
                                <input type="text" class="form-control" name="create_info3_name" id="create_info3_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="create_info3_url">Info3 URL</label>
                                <input type="text" class="form-control" name="create_info3_url" id="create_info3_url">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="create_info4_name">Info4 Name</label>
                                <input type="text" class="form-control" name="create_info4_name" id="create_info4_name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="create_info4_url">Info4 URL</label>
                                <input type="text" class="form-control" name="create_info4_url" id="create_info4_url">
                            </div>
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
        var admin_companies;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_full_name = $("#edit_full_name");
        var edit_current_image = $("#edit_current_image");
        var edit_new_image = $("#edit_new_image");
        var edit_desc = $("#edit_desc");
        var edit_url = $("#edit_url");
        var edit_info1_url = $("#edit_info1_url");
        var edit_info2_url = $("#edit_info2_url");
        var edit_info3_url = $("#edit_info3_url");
        var edit_info4_url = $("#edit_info4_url");
        var edit_info1_name = $("#edit_info1_name");
        var edit_info2_name = $("#edit_info2_name");
        var edit_info3_name = $("#edit_info3_name");
        var edit_info4_name = $("#edit_info4_name");


        var create_full_name = $("#create_full_name");
        var create_new_image = $("#create_new_image");
        var create_desc = $("#create_desc");
        var create_url = $("#create_url");
        var create_info1_url = $("#create_info1_url");
        var create_info2_url = $("#create_info2_url");
        var create_info3_url = $("#create_info3_url");
        var create_info4_url = $("#create_info4_url");
        var create_info1_name = $("#create_info1_name");
        var create_info2_name = $("#create_info2_name");
        var create_info3_name = $("#create_info3_name");
        var create_info4_name = $("#create_info4_name");


        var i = 0;

        $(document).ready(function() {
            admin_companies = $('#admin_companies').DataTable({
                "ajax": "admin_companies/table.php",
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
            edit_desc.val("");
            edit_url.val("");
            edit_info1_url.val("");
            edit_info2_url.val("");
            edit_info3_url.val("");
            edit_info4_url.val("");
            edit_info1_name.val("");
            edit_info2_name.val("");
            edit_info3_name.val("");
            edit_info4_name.val("");
            $.post('admin_companies/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_full_name.val(data['full_name']);
                    edit_current_image.attr('src', data['image_url']);
                    edit_desc.val(data['description']);
                    edit_url.val(data['url']);
                    edit_info1_url.val(data['info1_url']);
                    edit_info2_url.val(data['info2_url']);
                    edit_info3_url.val(data['info3_url']);
                    edit_info4_url.val(data['info4_url']);
                    edit_info1_name.val(data['info1_name']);
                    edit_info2_name.val(data['info2_name']);
                    edit_info3_name.val(data['info3_name']);
                    edit_info4_name.val(data['info4_name']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_companies/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_companies.ajax.reload(null, false);
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
            create_desc.val("");
            create_url.val("");
            create_info1_url.val("");
            create_info2_url.val("");
            create_info3_url.val("");
            create_info4_url.val("");
            create_info1_name.val("");
            create_info2_name.val("");
            create_info3_name.val("");
            create_info4_name.val("");
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_companies/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_companies.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_companies/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_companies.ajax.reload(null, false);
        }


    </script>
<?php
end_page();