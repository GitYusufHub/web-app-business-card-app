<?php 

function post($key=""){
	if($key==""){return $_POST;}
	else{return $_POST[$key];}	
}
function get($key=""){
	if($key==""){return $_GET;}
	else{return $_GET[$key];}	
}
function tarih(){
	echo date("Y-m-d H:i:s");
}

function devami($text, $sayi, $url)
	{
    	if(strlen($text) > $sayi){
       	 	$text = substr($text,0,$sayi)."... <a href='".$url."'>Devamını oku</a>";
		}
		return $text;
	}

	function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
		{
		$imgsize = getimagesize($source_file);
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];
	 
		switch($mime){
			case 'image/gif':
				$image_create = "imagecreatefromgif";
				$image = "imagegif";
				break;
	 
			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;
	 
			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 80;
				break;
	 
			default:
				return false;
				break;
		}
		 
		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$src_img = $image_create($source_file);
		 
		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}
		 
		$image($dst_img, $dst_dir, $quality);
	 
		if($dst_img)imagedestroy($dst_img);
		if($src_img)imagedestroy($src_img);
	}


		 function insert($table, $data=array()){
			  unset($data["insert"]);
			  unset($data["re_password"]);
			  $new_data="";	$keys="";	$vals="";
			  foreach($data as $key=>$val){
				if($key=="password") $val=md5(sha1($val));
				$keys.=$key.",";	$vals.="'".$val."',";
			  }
			  $keys=rtrim($keys,",");
			  $vals=rtrim($vals,",");
			  return "INSERT INTO ".$table." (".$keys.") VALUES (".$vals.")";
		  }
		   

		  function update($table, $data=array(), $where=array()){
			  unset($data["update"]);
			  unset($data["re_password"]);
			  $new_data="";
			  foreach($data as $key=>$val){
				if($key=="password") $val=sha1(md5($val));
				$new_data.=$key."='".$val."', "; 
			  }
			  $my_data=rtrim($new_data,", ");

			  $wh="";
			  unset($where["table"]);
			  
			  foreach($where as $key=>$val){
				  $wh.=$key."=".$val.",";
				}
				$wh=rtrim($wh,", ");
			  return "UPDATE ".$table." SET ".$my_data."  WHERE  ".$wh;
			   
			}