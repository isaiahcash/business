<?php
require_once('config.php');
$option = "";
if(isset($_POST['request_type1']))
{
    $option = "I am interested in " . htmlentities($_POST['request_type1']);
}
if(isset($_POST['request_type2']))
{
    $option = "Report Error";
}

$alert_msg = alert_message();

start_page();
nav_bar();
start_content();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-6">
            <div class="card p-3">
                <form method="post" action="/business/send_form.php">
                    <?php
                    alert_message_show($alert_msg);
                    ?>
                    <div class="form-group">
                        <label for="full_name">Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email_address">Email Address</label>
                        <input type="email" class="form-control" id="email_address" name="email_address" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="(865) 555-1234">
                    </div>
                    <div class="form-group">
                        <label for="request_type">Request</label>
                        <select class="form-control" id="request_type" name="request_type">
                            <?php

                            if($option != "")
                            {
                                print "<option value='" . htmlentities($option) . "' selected>" . htmlentities($option) . "</option>";
                            }
                            else
                            {
                                print "<option value='' selected>Select Request Type</option>";
                            }

                            $sql = "SELECT * FROM contact_options";
                            $query = DB::query($sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach($result as $row)
                            {
                                print "<option value='" . htmlentities($row['option_text']) . "'>" . htmlentities($row['option_text']) . "</option>";
                            }

                            ?>
                        </select>


                    </div>

                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default disabled" disabled>Submit</button>
                </form>
            </div>
        </div>

        <div class="col-xs-12 col-lg-6">
            <p>
                <?php print_content('contact_page'); ?>
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10862.679289203516!2d-83.92664138145157!3d35.95934930037896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x885c162246ce42a9%3A0x7bea92dac4f534c5!2sKnoxville%2C+TN!5e0!3m2!1sen!2sus!4v1554256760527!5m2!1sen!2sus" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>


<?php
end_content();
footer();
script_includes();
end_page();