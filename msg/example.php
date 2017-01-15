<?php

class text {

    function msg($no,$msg) {

	

	include ( "src/NexmoMessage.php" );
	//$msg = $instruction." ".$medname." ".$quantity." pills ";


	/**
	 * To send a text message.
	 *
	 */

	// Step 1: Declare new NexmoMessage.
	$nexmo_sms = new NexmoMessage('6e26fb49', '9d1f6dc27fa40c34');

	// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
	$info = $nexmo_sms->sendText( $no , 'MyApp', $msg);

	// Step 3: Display an overview of the message
        //echo $no;
	//echo $nexmo_sms->displayOverview($info);

	// Done!
	}
	}
?>