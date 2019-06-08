<?php
require_once('config.php');

$alert_msg = alert_message();

start_page();
nav_bar();
start_content();
?>
<div class="container">
<h3>Careers</h3>
<p>Interesting in joining The Test Company?</p>
   <?php print_content('careers'); ?>
    <hr>
    <div class="card col-md-5" style="padding-top: 20px">
    Send us your name and email and we'll start the conversation:
    <form method="post" action="/business/send_form.php">
        <?php
        alert_message_show($alert_msg);
        ?>
        <div class="form-group">
            <label for="full_name">Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email_address" name="email_address" placeholder="name@example.com">
        </div>
        <input type="hidden" name="request_type" value="Interested in Employment" readonly hidden>
        <button type="submit" class="btn btn-success float-right">I'm interested!</button>
    </form>
        <br>
    </div>
</div>
<?php
end_content();
footer();
script_includes();
end_page();