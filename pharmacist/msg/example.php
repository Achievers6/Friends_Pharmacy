<?php

class text {

    function msg($medname, $instruction, $quantity, $time, $contactno) {


        $contactno =  "94".substr($contactno, 1);
        include ( "src/NexmoMessage.php" );
        $msg = $instruction . " " . $medname . " " . $quantity . " pills ";


        /**
         * To send a text message.
         *
         */
        // Step 1: Declare new NexmoMessage.
        $nexmo_sms = new NexmoMessage('469ba9a4', '38e03b9be1550d7e');

        // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
        $info = $nexmo_sms->sendText($contactno, 'MyApp', $msg);

        // Step 3: Display an overview of the message
        $t = $nexmo_sms->displayOverview($info);
        if ($t == 'Non White-listed Destination - rejected') {
            echo '<script language="javascript">';
            echo "alert('Confirmed order has not been sent successfully')";
            echo '</script>';
        } else if ('OK') {
            echo '<script language="javascript">';
            echo "alert('Confirmed order has been sent successfully ')";
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Confirmed order has not been sent successfully')";
            echo '</script>';
            // Done!}
        }
    }

}

?>