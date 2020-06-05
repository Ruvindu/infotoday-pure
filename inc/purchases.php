<?php

	$get_purchased = "SELECT * FROM `newspaper` n ,`buy` b WHERE n.`newspaper_id` = b.`newspaper_id` AND `user_id` = {$_SESSION['usr_id']}";

	//echo $get_purchased;

	$res_purchased = mysqli_query($con,$get_purchased);

	if ($res_purchased) {
		
		while ($item = mysqli_fetch_assoc($res_purchased)) {

			$thumbnail = base64_encode($item['thumbnail']);

  			echo " <div class=\"col-lg-4 col-md-5 mb-2\" >
                	<div class=\"card\" style=\"width: 17rem;background-color: rgba(245, 245, 245, -5);\">
		                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
		                    <div class=\"card-body\">
		                    <h5 class=\"card-title\">{$item['name']}</h5>
		                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>
               				<a href=\"{$item['file']}\" class=\"btn btn-primary mr-1\">Read</a>              
		          		</div>
		              </div>
		            </div>";
			
		}
	}


?>