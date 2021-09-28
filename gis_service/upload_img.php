<?php

	$img_name=$_POST['info'];
	$img=$_POST['upload'];
	$data_id=$_POST['data_id'];	
	   
	usleep(250);
	$salt = microtime(true);
	$filename = $data_id.$img_name.$salt.".jpg";
	file_put_contents("images/".$filename,base64_decode($img));

?>