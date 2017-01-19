<?php

class text {

    function msg($no, $msg) {



        include ( "src/NexmoMessage.php" );
        //$msg = $instruction." ".$medname." ".$quantity." pills ";


        /**
         * To send a text message.
         *
         */
        // Step 1: Declare new NexmoMessage.
        $nexmo_sms = new NexmoMessage('6e26fb49', '9d1f6dc27fa40c34');

        // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
        $info = $nexmo_sms->sendText($no, 'MyApp', $msg);

        // Step 3: Display an overview of the message
        //echo $no;
        $t = $nexmo_sms->displayOverview($info);
        if ($t == 'Non White-listed Destination - rejected') {
           echo '<script language="javascript">';
            echo "alert('Confirmed order has not been sent successfully')";
            echo '</script>';
        } else if ('OK') {
            echo '<script language="javascript">';
            echo "alert('Confirmed order has been sent successfully,contact no is  $no ')";
            echo '</script>';
        }
        else{
           echo '<script language="javascript">';
            echo "alert('Confirmed order has not been sent successfully')";
            echo '</script>';
        // Done!}
    }
    }

}

?>