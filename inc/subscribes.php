<?php

	$get_my_subs = "SELECT * FROM `subscribe` a , `newspaper` n WHERE `customer_id` = {$_SESSION['usr_id']} AND a.`newspaper_id` = n.`newspaper_id`";
	$res_my_subs = mysqli_query($con,$get_my_subs);

	if ($res_my_subs) {
		
		while ($sub_item = mysqli_fetch_assoc($res_my_subs)) {
			//days lefts
			$sub = new DateTime(date("Y-m-d"));
			$exp = new DateTime("{$sub_item['expire_date']}");

			$diff = $exp->diff($sub)->format("%a");
			$is_exp = $exp<$sub;



			if ($sub_item['package']=="Lite") {
				$header = $sub_item['name'];
				$link = "subscriptions.php?name={$sub_item['name']}";
			}else{
				$header = "All newspapers";
				$link = "subscriptions.php?name=all";
			}
			if (!$is_exp) {
				$days =  "{$diff} Day(s) left";
				$body = "This subscription will expire in {$sub_item['expire_date']}";
				$btn = "<a href=\"{$link}\" class=\"btn btn-primary\">View All</a>";
				$theme = "primary";
			}else{
				$days =  "0 Day(s) left";
				$body = "This subscription is expired";
				$btn = "<a href=\"choose-plan.php?id-subscribe={$sub_item['newspaper_id']}\" class=\"btn btn-danger\">Subscrib</a>";
				$theme = "danger";
			}

				echo "
				<div class=\"card border-{$theme} mb-3\" >
				  <div class=\"card-header\">{$header}</div>
				  <div class=\"card-body text-{$theme}\">
				    <h5 class=\"card-title\">{$days}</h5>
				    <p class=\"card-text\">{$body}</p>
				    {$btn}
				  </div>
				</div>
			";
				
		}

			

	}


	

		


?>