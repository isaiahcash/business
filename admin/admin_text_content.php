<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>

    <h3>Text Content</h3>
    <p>Change the text in different locations around the website. Basic HTML can be added as well.</p>
    <hr>
    <table id="admin_text_content" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Field</th>
            <th>Content</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Field</th>
            <th>Content</th>
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
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_field">Field</label>
                            <input type="text" class="form-control" name="edit_field" id="edit_field" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_content">Content</label>
                            <textarea class="form-control" id="edit_content" name="edit_content" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="id_hidden" name="id_hidden" hidden>
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
        var admin_text_content;

        var edit_modal = $("#edit_modal");

        var id_hidden = $("#id_hidden");
        var edit_field = $("#edit_field");
        var edit_content = $("#edit_content");

        var i = 0;

        $(document).ready(function() {
            admin_text_content = $('#admin_text_content').DataTable({
                "ajax": "admin_text_content/table.php",
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });
        });

        function edit(id){
            id_hidden.val(0);
            edit_field.val("");
            edit_content.val("");
            $.post('admin_text_content/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_field.val(data['field']);
                    edit_content.val(data['content']);
                });

            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_text_content/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_text_content.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });


    </script>
<?php
end_page();