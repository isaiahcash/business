<?php
require_once('../config.php');
check_user();
start_page();
admin_start_content();
?>

    <h3>Settings</h3>
    <p>Main admin settings.</p>
    <hr>
    <div class="col-xs-12 col-md-6">
        <?php
        save_setting('form_email');

        ?>
        <form method="post" action="admin.php">
            <div class="form-group">
                <label for="form_email">Email Address for Contact Form</label>
                <input type="text" class="form-control" name="form_email" id="form_email" value="<?php echo get_setting('form_email') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


<?php
admin_end_content();
script_includes();
end_page();