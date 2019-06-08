<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Products</h3>
    <p>Edit products here.</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_products" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Company</th>
            <th>Image</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Company</th>
            <th>Image</th>
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
                            <label for="edit_full_name">Product Name</label>
                            <input type="text" class="form-control" name="edit_full_name" id="edit_full_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_company_id">Company</label>
                            <select class="form-control" name="edit_company_id" id="edit_company_id">
                                <?php
                                $sql = "SELECT * FROM companies ORDER BY full_name ASC";
                                $query = DB::query($sql);
                                $companies = $query -> fetchAll(PDO::FETCH_ASSOC);
                                foreach($companies as $company)
                                {
                                    print "<option value='" . $company['id'] . "'>" . $company['full_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_desc">Description</label>
                            <textarea class="form-control" name="edit_desc" id="edit_desc" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_url">URL</label>
                            <input type="text" class="form-control" name="edit_url" id="edit_url">
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
                            <label for="create_full_name">Product Name</label>
                            <input type="text" class="form-control" name="create_full_name" id="create_full_name">
                        </div>
                        <div class="form-group">
                            <label for="create_company_id">Company</label>
                            <select class="form-control" name="create_company_id" id="create_company_id">
                                <?php
                                $sql = "SELECT * FROM companies ORDER BY full_name ASC";
                                $query = DB::query($sql);
                                $companies = $query -> fetchAll(PDO::FETCH_ASSOC);
                                foreach($companies as $company)
                                {
                                    print "<option value='" . $company['id'] . "'>" . $company['full_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create_desc">Description</label>
                            <textarea class="form-control" name="create_desc" id="create_desc" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="create_url">URL</label>
                            <input type="text" class="form-control" name="create_url" id="create_url">
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
        var admin_products;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_full_name = $("#edit_full_name");
        var edit_current_image = $("#edit_current_image");
        var edit_new_image = $("#edit_new_image");
        var edit_desc = $("#edit_desc");
        var edit_url = $("#edit_url");
        var edit_company_id = $("#edit_company_id");

        var create_full_name = $("#create_full_name");
        var create_new_image = $("#create_new_image");
        var create_desc = $("#create_desc");
        var create_url = $("#create_url");
        var create_company_id = $("#create_company_id");


        var i = 0;

        $(document).ready(function() {
            admin_products = $('#admin_products').DataTable({
                "ajax": "admin_solutions/table.php",
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
            edit_company_id.val("");
            $.post('admin_solutions/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_full_name.val(data['full_name']);
                    edit_current_image.attr('src', data['image_url']);
                    edit_desc.val(data['description']);
                    edit_url.val(data['url']);
                    edit_company_id.val(data['company_id']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_solutions/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_products.ajax.reload(null, false);
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
            create_company_id.val("");
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_solutions/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_products.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_solutions/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_products.ajax.reload(null, false);
        }


    </script>
<?php
end_page();