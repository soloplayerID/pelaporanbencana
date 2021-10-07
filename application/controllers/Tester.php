<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tester extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    //http://localhost/sipena/Tester?test=...
    $text = $_GET['test'];
    $cipherText = $this->Encipher($text, "cipher");
    print_r($cipherText);
	}

  public function Mod($a, $b)
  {
  	return ($a % $b + $b) % $b;
  }

  public function Cipher($input, $key, $encipher)
  {
  	$keyLen = strlen($key);

  	for ($i = 0; $i < $keyLen; ++$i)
  		if (!ctype_alpha($key[$i]))
  			return ""; // Error

  	$output = "";
  	$nonAlphaCharCount = 0;
  	$inputLen = strlen($input);

  	for ($i = 0; $i < $inputLen; ++$i)
  	{
  		if (ctype_alpha($input[$i]))
  		{
  			$cIsUpper = ctype_upper($input[$i]);
  			$offset = ord($cIsUpper ? 'A' : 'a');
  			$keyIndex = ($i - $nonAlphaCharCount) % $keyLen;
  			$k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset;
  			$k = $encipher ? $k : -$k;
  			$ch = chr(($this->Mod(((ord($input[$i]) + $k) - $offset), 26)) + $offset);
  			$output .= $ch;
  		}
  		else
  		{
  			$output .= $input[$i];
  			++$nonAlphaCharCount;
  		}
  	}

  	return $output;
  }

  public function Encipher($input, $key)
  {
  	return $this->Cipher($input, $key, true);
  }

  public function Decipher($input, $key)
  {
  	return $this->Cipher($input, $key, false);
  }


}