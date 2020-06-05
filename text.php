<?php
	$date = new DateTime(date('Y-m-d'));
	$date->modify('+30 day');
	echo $date->format('Y-M-d');

?>