<?php

  if (isset($_GET['item'])) {
  	
  	$get_selected_itemsQ = "SELECT * FROM `newspaper` WHERE `name` = '{$_GET['item']}'";

  	$get_selected_itemsQ = mysqli_query($con, $get_selected_itemsQ);

  	if ($get_selected_itemsQ) {
	  		
  		while ($item = mysqli_fetch_assoc($get_selected_itemsQ)) {
  			
  			$thumbnail = base64_encode($item['thumbnail']);

  			echo "<div class=\"card\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">{$item['name']}</h5>
                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>
                    <a href=\"index.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary\"> Subscribe </a>
                    <a href=\"index.php?id-cart={$item['newspaper_id']}\" class=\"btn btn-danger\">Add to cart</a>
                </div>
            </div>";
           

  		}
  	}

  }else{

  	$get_selected_itemsQ = "SELECT * FROM `newspaper`";

  	$get_selected_itemsQ = mysqli_query($con, $get_selected_itemsQ);

  	if ($get_selected_itemsQ) {
	  		
  		while ($item = mysqli_fetch_assoc($get_selected_itemsQ)) {
  			
  			$thumbnail = base64_encode($item['thumbnail']);

  			echo "<div class=\"card\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">{$item['name']}</h5>
                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>
                    <a href=\"index.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary\"> Subscribe </a>
                    <a href=\"index.php?id-cart={$item['newspaper_id']}\" class=\"btn btn-danger\">Add to cart</a>
                </div>
            </div>";
           

  		}
  	}


  }



?>