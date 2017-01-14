<?php

class text {

    function msg($medname, $instruction, $quantity, $time,$contactno) {

	

	include ( "src/NexmoMessage.php" );
	$msg = $instruction." ".$medname." ".$quantity." pills ";


	/**
	 * To send a text message.
	 *
	 */

	// Step 1: Declare new NexmoMessage.
	$nexmo_sms = new NexmoMessage('469ba9a4', '38e03b9be1550d7e');

	// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
	$info = $nexmo_sms->sendText( $contactno , 'MyApp', $msg );

	// Step 3: Display an overview of the message
	echo $nexmo_sms->displayOverview($info);

	// Done!
	}
	}
?>