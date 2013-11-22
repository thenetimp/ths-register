<?php
    
namespace ths_register\functions;

/**
 *
 *
 *
 */
function register_form()
{
    global $wpdb;
  
    if(!is_user_logged_in()){
        
        // Define the errors array.
        $errors = array();
 
        // Get the values from the POST request.
        $username = (isset($_POST['username']) && $_POST['username'] != "")
            ? $_POST['username'] : "";
        $email_address = (isset($_POST['email_address']) && $_POST['email_address'] != "")
            ? $_POST['email_address'] : "";
        $first_name = (isset($_POST['first_name']) && $_POST['first_name'] != "")
            ? $_POST['first_name'] : "";
        $last_name = (isset($_POST['last_name']) && $_POST['last_name'] != "")
            ? $_POST['last_name'] : "";
        $resistor_value = (isset($_POST['resistor_value']) && $_POST['resistor_value'] != "")
            ? $_POST['resistor_value'] : "";

        // If we are posting we'll process
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Check if the username exists
            if($response = username_exists($email_address))
            {
                $errors['email_address'] = $response;
            }
            
            $nowtime = mktime(date('H'), date('i')-15, date('s'));
            $now = date("Y-m-d H:i:s", $nowtime);
            // Build the sql to check to see if another registration happened
            // within 15 minutes from the same IP address.
            $sql = $wpdb->prepare('select count(*) as counter from wp_users wu,wp_usermeta wum where (wum.meta_key = "registered_ip_address" and wum.meta_value = %s) and (wu.id = wum.user_id) and wu.user_registered > %s
', $_SERVER['REMOTE_ADDR'], $now);
            
            $spamCheckResult = $wpdb->get_row($sql);

            if($spamCheckResult->counter > 0)
            {
              $errors['spamcheck'] = "A user has recently registered from this IP address, please try again later.";
            }

            // If we should check the resistor value check it.
            if(isset($_SESSION['resistor_value']) && 
                ($_SESSION['resistor_value'] != "") &&
                ($resistor_value != "") &&    
                ($_SESSION['resistor_value'] != $resistor_value))
            {
                $errors['resistor_value'] = "The resistor value is incorrect. Please try again.";
            }

            // User a while loop so we can break out of an if conditional later
            // Seems kind of stupid if you ask me. but it's the only way.
            do if(count($errors) == 0)
            {
                $user_id = null;
                $password = wp_generate_password( 12, true);
                $user_id = wp_create_user ( $username, $password, $email_address );

                // Get the errors.
                if(is_object($user_id))
                {
                    foreach($user_id->errors as $key => $error)
                    {
                        $errors[$key] = $error;
                    }
                    break;
                }

                // setup the user data.
                $user_data = array(
                        'ID' => $user_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'display_name' => $last_name . " " . $first_name,
                    );
                
                // Set the nickname
                $user_id = wp_update_user($user_data);

                add_user_meta( $user_id, 'registered_ip_address', $_SERVER['REMOTE_ADDR']);


                // Get the errors.
                if(is_object($user_id))
                {
                    foreach($user_id->errors as $key => $error)
                    {
                        $errors[$key] = $error;
                    }
                    break;
                }
                
                // Set the role
                $user = new \WP_User($user_id);
                $user->set_role('subscriber');

                 // Send the user a welcome email. (modify this in the future)
                 wp_mail( $email_address, 'Welcome!', 'Your Password: ' . $password );

                 // include the redirect javascript.
                 include_once(dirname(__FILE__) . '/views/redirect.view.php');
            } while (false);
        }
    
        // Set up the resistor value
        $colors = array('black', 'brown', 'red', 'orange', 'yellow', 'green', 'blue', 'violet', 'gray', 'white');
    
        // build the resistor
        $resistor = array(
            rand(1, 9),
            rand(0, 9),
            rand(0, 5),
        );

        // Store the resistor value in the session.
        $_SESSION['resistor_value'] = (intval($resistor[0] . $resistor[1])) * pow(10, $resistor[2]);

        // Include the form.
        include_once(dirname(__FILE__) . '/views/form.view.php');
    }
    else
    {
        // Include the form.
        include_once(dirname(__FILE__) . '/views/loggedin.view.php');
    }
}

/**
 *
 *
 *
 */
function register_success()
{
    
}