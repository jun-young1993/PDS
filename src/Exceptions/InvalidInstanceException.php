<?php
namespace PDS\Exceptions;
use Exception;

class InvalidInstanceException extends Exception {
	private $customMessage;
	public function __construct($successInstance, string $failInstance)
	{

		$successInstancelName = gettype($successInstance);
		if(is_object($successInstance)){
			$successInstancelName = get_class($successInstance);
		}
		$this->customMessage = "Invalid Instance $successInstancelName. Found $successInstance";
	}
}

?>