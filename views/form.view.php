<?php if(count($errors) > 0): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <?php print_r($error); ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="row">
    <div class="col-md-6 col-md-offset-1">
        <form role="form" method="post">
            <div class="form-group">
                <label for="first-name">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username preference" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="email-address">Email address:</label>
                <input type="email" class="form-control" id="email-address" name="email_address" placeholder="Enter email" value="<?php echo $email_address; ?>">
            </div>
            <div class="form-group">
                <label for="first-name">Given Name:</label>
                <input type="text" class="form-control" id="first-name" name="first_name" placeholder="Enter your first name" value="<?php echo $first_name; ?>">
            </div>
            <div class="form-group">
                <label for="last-name">Sir Name:</label>
                <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Enter your lastname"  value="<?php echo $last_name; ?>">
            </div>
            <div class="form-group">
                <label>Resistor Value:</label>
                <input type="text" class="form-control" id="resistor_value" name="resistor_value" placeholder="Resistor Value">
                &nbsp;
                <p>Figure out the value of the resistor using the <a href="http://en.wikipedia.org/wiki/Electronic_color_code#Resistor_color-coding" target="_blank">color code of the resistor</a> representation below. Hover over the color to get the name of the color.</p>
                <div class="resistor" style="position: relative; width: 70px; height: 25px; border: 2px solid #999; margin-top: 10px; margin-left: 30px;">
                    <div class="band-one" style="width: 10px; height: 21px; background-color: <?php echo $colors[$resistor[0]]; ?>; position: absolute; top: 0px; left: 5px; border: 1px solid #999; border-top: none; border-bottom: none;" title="<?php echo $colors[$resistor[0]]; ?>"></div>
                    <div class="band-two" style="width: 10px; height: 21px; background-color: <?php echo $colors[$resistor[1]]; ?>; position: absolute; top: 0px; left: 20px; border: 1px solid #999; border-top: none; border-bottom: none;" title="<?php echo $colors[$resistor[1]]; ?>"></div>
                    <div class="band-three" style="width: 10px; height: 21px; background-color: <?php echo $colors[$resistor[2]]; ?>; position: absolute; top: 0px; left: 35px; border: 1px solid #999; border-top: none; border-bottom: none;" title="<?php echo $colors[$resistor[2]]; ?>"></div>
                </div>
            </div>
            <p>Upon creation of your account, your password will be emailed to the address you specified above.</p>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</div>