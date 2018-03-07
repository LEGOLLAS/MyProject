<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

if($isNew == "Y") {
	include_once(G5_PATH.'/_tailNew.php');
} else {
	include_once(G5_PATH.'/_tail.php');
}
?>