<?php

	$get_subs = "";

	$earlier = new DateTime("2010-07-06");
	$later = new DateTime("2010-07-09");

	$diff = $later->diff($earlier)->format("%a");

	echo "
		<div class=\"card border-primary mb-3\" >
		  <div class=\"card-header\">Header</div>
		  <div class=\"card-body text-primary\">
		    <h5 class=\"card-title\">{$diff} Days left</h5>
		    <p class=\"card-text\">This subscription will expire in 2020-06-20</p>
		    <a href=\"choose-plan.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary mr-1\">View All</a>
		  </div>
		</div>
	";	


?>