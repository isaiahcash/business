<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Carousel</h3>
    <p>Edit the carousel and its images here.</p>
    <hr>
    <button onclick="create()" class="btn btn-primary mb-3">Create</button>
    <table id="admin_carousel" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Slide Position</th>
            <th>Image URL</th>
            <th>Text Content</th>
            <th>Text Position</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Slide Position</th>
            <th>Image URL</th>
            <th>Text Content</th>
            <th>Text Position</th>
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
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="edit_current_image">Current Image</label>
                        <br>
                        <img class="mx-auto my-3" style="height: 150px; width: 150px; object-fit: contain" id="edit_current_image" name="edit_current_image" src="/business/images/blank.png">
                        <div class="form-group">
                            <label for="edit_new_image">New Image</label>
                            <input type="file" class="form-control-file" id="edit_new_image" name="edit_new_image">
                        </div>
                        <div class="form-group">
                            <label for="edit_text_position">Text Position</label>
                            <select class="form-control" name="edit_text_position" id="edit_text_position">
                                <option value="Top Left">Top Left</option>
                                <option value="Top">Top</option>
                                <option value="Top Right">Top Right</option>
                                <option value="Left">Left</option>
                                <option value="Center">Center</option>
                                <option value="Right">Right</option>
                                <option value="Bottom Left">Bottom Left</option>
                                <option value="Bottom">Bottom</option>
                                <option value="Bottom Right">Bottom Right</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_text_content">Text Content</label>
                            <textarea class="form-control" id="edit_text_content" name="edit_text_content" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_slide_position">Slide Position</label>
                            <select class="form-control" name="edit_slide_position" id="edit_slide_position">
                                <?php retrieve_slide_options(); ?>
                            </select>
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
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_new_image">New Image</label>
                            <input type="file" class="form-control-file" id="create_new_image" name="create_new_image">
                        </div>
                        <div class="form-group">
                            <label for="create_text_position">Text Position</label>
                            <select class="form-control" name="create_text_position" id="create_text_position">
                                <option value="Top Left">Top Left</option>
                                <option value="Top">Top</option>
                                <option value="Top Right">Top Right</option>
                                <option value="Left">Left</option>
                                <option value="Center">Center</option>
                                <option value="Right">Right</option>
                                <option value="Bottom Left">Bottom Left</option>
                                <option value="Bottom">Bottom</option>
                                <option value="Bottom Right">Bottom Right</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create_text_content">Text Content</label>
                            <textarea class="form-control" id="create_text_content" name="create_text_content" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="create_slide_position">Slide Position</label>
                            <select class="form-control" name="create_slide_position" id="create_slide_position">
                               <?php retrieve_slide_options(); ?>
                            </select>
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
        var admin_carousel;

        var edit_modal = $("#edit_modal");
        var create_modal = $("#create_modal");

        var id_hidden = $("#id_hidden");
        var edit_new_image = $("#edit_new_image");
        var edit_current_image = $("#edit_current_image");
        var edit_text_position = $("#edit_text_position");
        var edit_text_content = $("#edit_text_content");
        var edit_slide_position = $("#edit_slide_position");

        var create_new_image = $("#create_new_image");
        var create_text_position = $("#create_text_position");
        var create_text_content = $("#create_text_content");
        var create_slide_position = $("#create_slide_position");

        var i = 0;

        $(document).ready(function() {
            admin_carousel = $('#admin_carousel').DataTable({
                "ajax": "admin_home/table.php",
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });
        });

        function edit(id){
            id_hidden.val(0);
            edit_current_image.attr('src', '/business/images/blank.png');
            edit_new_image.val("");
            edit_text_position.val("");
            edit_text_content.val("");
            edit_slide_position.val("");
            edit_slide_position.empty();
            $.post('admin_home/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_current_image.attr('src', data['image_url']);
                    edit_text_position.val(data['text_position']);
                    edit_text_content.val(data['text_content']);
                    edit_slide_position.append($('<option>', { value : data['slide_position'] }).text(data['slide_position']));
                    $.each(data['slide_position_options'], function(key, value) {
                        edit_slide_position.append($('<option>', { value : value }).text(value));
                    });
                });
            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_home/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_carousel.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function create()
        {
            create_new_image.attr('src', '/business/images/blank.png');
            create_text_position.val("");
            create_text_content.val("");
            create_slide_position.empty();
            $.ajax({
                url: "admin_home/slide_positions.php",
                success: function (data) {
                    data = JSON.parse(data);
                    $.each(data['slide_position_options'], function(key, value) {
                        create_slide_position.append($('<option>', { value : value }).text(value));
                    });
                }
            });
            create_modal.modal('show');
        }

        $("#create_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_home/create.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    create_modal.modal('hide');
                    admin_carousel.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function remove()
        {
            $.post('admin_home/remove.php', {id: id_hidden.val()},
                function(data){
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                });
            edit_modal.modal('hide');
            admin_carousel.ajax.reload(null, false);
        }


    </script>
<?php
end_page();