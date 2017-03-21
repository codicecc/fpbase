<?php
class email2{
	static function send2($fromlabel,$to,$subject,$msg) {
		/**
		1. An address to 'send from'.
		2. An address to send to.
		3. And last but not least, the message
		**/
		
		// Create an instance
		$email = Email::forge();
		
		// Set the from address
		// From set application.email-addresses.from.website
		//$email->from('application.email-addresses.from.website', $fromlabel);
		// This is my local conf
		$email->from(Config::get('application.email-addresses.from.website'), $fromlabel);
		
		// Set the to address
		//$email->to('receiver@elsewhere.co.uk', 'Johny Squid');
		$email->to($to);
		
		// Set a subject
		$email->subject($subject);
		
		// Set bcc addresses
		$email->cc(array(Config::get('admin_email')));
		
		// And set the body.
		$email->body($msg);
		
		$return=22;
		
		try
		{
				$email->send();
				$return=0;
		}
		catch(\EmailValidationFailedException $e)
		{
				// The validation failed
				debug::dump('The validation failed');
				$return=1;
		}
		catch(\EmailSendingFailedException $e)
		{
				// The driver could not send the email
				debug::dump('The driver could not send the email');
				$return=2;
		}
		return $return;
	}
}	
