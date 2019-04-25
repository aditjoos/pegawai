<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xfungsi{
			
	public function hex_encode($string)
	{
	    return bin2hex($string);
	}
	 
	public function hex_decode($string)
	{
	    return pack("H*", $string);
	}
	
	public function showmessage($msg){
		echo $msg.PHP_EOL;
	}
	
	public function encryptSn($q) {
    $cryptKey  = 'PR0d3pBP5DMP';
    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
	}
	
	public function decryptSn($q) {
	    $cryptKey  = 'PR0d3pBP5DMP';
	    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
	
	function EncryptV2($src){
		$key = md5('PR0d3pBP5DMP');
		$iv  = substr(md5('PR0d3pBP5DMP'),0,16);
	  $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
	  //echo "Block size: " . $block . "\r\n";
	  $pad = $block - (strlen($src) % $block);
	  $src .= str_repeat(chr($pad), $pad);  
	
	  $enc = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $src, MCRYPT_MODE_CBC, $iv);
	  $r = base64_encode($enc);
	  return $r;
	}
	
	function DecryptV2($src){
		$key = md5('PR0d3pBP5DMP');
		$iv  = substr(md5('PR0d3pBP5DMP'),0,16);
		
	  $enc = base64_decode($src);
	  $dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $enc, MCRYPT_MODE_CBC, $iv);
	
	  $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
	  $pad = ord($dec[($len = strlen($dec)) - 1]);
	  return substr($dec, 0, strlen($dec) - $pad);
	}
	
	public function encodeSn($q){
		$key = 'PR0d3pBP5DMP';
		
	}
	
	public function digit_format($num,$digit){
		$tmp = sprintf('%0'.$digit.'d',$num);
		return $tmp;
	}
	
	public function encryptSnV2($q) {
		$data = $q; //'cd6f6eea9a2a59f2';
		$key = 'cd6f6eea9a2a59f21bc0b8e91608c9aa';
		$iv = $data; //'cd6f6eea9a2a59f2';
		$cryptKey = 'cd6f6eea9a2a59f2';
		//$ecb = mcrypt_ecb(MCRYPT_RIJNDAEL_128,$key,$data,MCRYPT_ENCRYPT,$iv); 
		//$cbc = mcrypt_cbc(MCRYPT_RIJNDAEL_128,$key,$data,MCRYPT_ENCRYPT,$iv);
		$cbc = mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$data,MCRYPT_MODE_CBC,$iv);

    //$qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    $qEncoded = base64_encode($cbc);
    return( $qEncoded );
	}
	
	public function decryptSnV2($q) {
	    $cryptKey  = 'PR0d3pBP5DMP';
	    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
	
	function fix_json($json){
		$tmp = str_replace("},]","}]",$json); 
		$result = json_decode($json);
		return $result;
	}
	
	function cek_jadwal($data){
		$ci =& get_instance();
		$ci->load->model('mfungsi');
		$login = $ci->users_model->login($email, md5($password));
    if($login){
        $session_array = array(
            'user_id' => $login->user_id,
            'name' => $login->name,
            'type' => 'Standard'
        );
        $ci->session->set_userdata($session_array);

        // Update last login time
        $ci->users_model->update_user(array('last_login' => date('Y-m-d H:i:s', time())), $login->user_id);

        return true;
    } else {
        $this->errors[] = 'Wrong email address/password combination';
        return false;
    }
	}
	
	function cek_session(){
		$ci =& get_instance();
		
		$stt_login = $ci->session->userdata('stt_login');		
		if(!isset($stt_login) || $stt_login != TRUE)
		{
			redirect('home');
		}
	}
	
}