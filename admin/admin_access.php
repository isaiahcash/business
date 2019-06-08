<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>
    <h3>Known Clients</h3>
    <p>These are IP address that have viewed the site. Page visited count is listed.</p>
    <hr>
    <table id="admin_log" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Client Name</th>
            <th>Last Accessed</th>
            <th>Page Visits</th>
            <th>Access Blocked</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Client Name</th>
            <th>Last Accessed</th>
            <th>Page Visits</th>
            <th>Access Blocked</th>
            <th>View</th>
        </tr>
        </tfoot>
    </table>

    <hr>

    <h3>Access Log</h3>
    <p>These are IP address and Known hosts that have accessed the site.</p>
    <hr>
    <table id="admin_access" class="table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Requested URL</th>
            <th>Timestamp</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Requested URL</th>
            <th>Timestamp</th>
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
                            <label for="edit_ip_address">IP Address:</label>
                            <input type="text" class="form-control" name="edit_ip_address" id="edit_ip_address" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_client_name">Client Name:</label>
                            <input type="text" class="form-control" name="edit_client_name" id="edit_client_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_last_accessed">Last Accessed:</label>
                            <input type="text" class="form-control" name="edit_last_accessed" id="edit_last_accessed" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_blocked_access">Access Blocked</label>
                            <select class="form-control" name="edit_blocked_access" id="edit_blocked_access">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_page_visits">Page Visits:</label>
                            <input type="text" class="form-control" name="edit_page_visits" id="edit_page_visits" style="width: 200px;" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_ip_info">IP Info:</label>
                            <textarea class="form-control" name="edit_ip_info" id="edit_ip_info" rows="10" readonly>
                            </textarea>
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
        var admin_log;
        var admin_access;


        var edit_modal = $("#edit_modal");


        var id_hidden = $("#id_hidden");
        var edit_ip_address = $("#edit_ip_address");
        var edit_last_accessed = $("#edit_last_accessed");
        var edit_client_name = $("#edit_client_name");
        var edit_blocked_access = $("#edit_blocked_access");
        var edit_page_visits = $("#edit_page_visits");
        var edit_ip_info = $("#edit_ip_info");


        var i = 0;

        $(document).ready(function() {
            admin_log = $('#admin_log').DataTable({
                "ajax": "admin_log/table.php",
                "order": [[3, 'desc']],
                "stateSave": true,
                "columnDefs": [
                    {"targets": [-1], "searchable": false, "width": "1px", "sortable": false}
                ]
            });

            admin_access = $('#admin_access').DataTable({
                "ajax": "admin_access/table.php",
                "order": [[0, 'desc']],
                "stateSave": true
            });
        });

        function edit(id, flag){
            id_hidden.val(0);
            edit_ip_address.val("");
            edit_client_name.val("");
            edit_last_accessed.val("");
            edit_blocked_access.val("");
            edit_page_visits.val("");
            edit_ip_info.val("");
            $.post('admin_log/edit.php', {id: id},
                function(data){
                    data = JSON.parse(data);
                    id_hidden.val(data['id']);
                    edit_ip_address.val(data['ip_address']);
                    edit_client_name.val(data['client_name']);
                    edit_last_accessed.val(data['last_accessed']);
                    edit_blocked_access.val(data['block_access']);
                    edit_page_visits.val(data['page_visits']);
                    edit_ip_info.val(data['ip_info']);
                });
            console.log(flag);
            if(flag){
                edit_blocked_access.attr('readonly', true);
                edit_blocked_access.attr('disabled', true);
            } else {
                edit_blocked_access.attr('readonly', false);
                edit_blocked_access.attr('disabled', false);
            }
            edit_modal.modal('show');
        }


        $("#edit_data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'admin_log/save.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    data = JSON.parse(data);
                    for (i = 0; i < data.length; i++) {
                        show_alert(data[i][0], data[i][1]);
                    }
                    edit_modal.modal('hide');
                    admin_log.ajax.reload(null, false);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

    </script>
<?php
end_page();