<?php

  //category wise
  if (isset($_GET['item'])) {
  	
  	$get_selected_itemsQ = "SELECT * FROM `newspaper` WHERE `name` = '{$_GET['item']}' AND `status`='approved'";

  	$get_selected_itemsQ = mysqli_query($con, $get_selected_itemsQ);

  	if ($get_selected_itemsQ) {
	  		
  		while ($item = mysqli_fetch_assoc($get_selected_itemsQ)) {
  			
  			$thumbnail = base64_encode($item['thumbnail']);

  			echo " <div class=\"col-lg-3 col-md-5 mb-2\" >
                <div class=\"card\" style=\"width: 18rem;background-color: rgba(245, 245, 245, -5);\">
                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">{$item['name']}</h5>
                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>";

                    if (isset($_SESSION['usr_id'])) {

                      /* check item subscribed*/
                      $is_subscribed = "SELECT * FROM `subscribe` WHERE `customer_id`={$_SESSION['usr_id']} AND `newspaper_id`={$item['newspaper_id']} ";

                      $res_is_subscribed =  mysqli_query($con,$is_subscribed);
                      if (0<mysqli_num_rows($res_is_subscribed)) {
                       echo "<a href=\"profile.php\" class=\"btn btn-outline-primary mr-1\">Subscribed</a>";
                      }else{
                        echo "<a href=\"choose-plan.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                    }



                    if (isset($_SESSION['usr_id'])) {

                      /* check item in cart*/
                      $is_in_cart = "SELECT * FROM `cart` WHERE `newspaper_id`={$item['newspaper_id']} AND `user_id`={$_SESSION['usr_id']}";

                      $res_is_in_cart =  mysqli_query($con,$is_in_cart);
                      if (0<mysqli_num_rows($res_is_in_cart)) {
                       echo "<a href=\"cart.php\" class=\"btn btn-outline-danger\">Added to cart</a>";
                      }else{
                        echo "<a href=\"index.php?id-cart={$item['newspaper_id']}\" class=\"btn btn-danger\">Add to cart</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-danger\">Add to cart</a>";
                    }

                    
              echo  "</div>
                </div>
            </div>";


  		}
  	}

  }
  //By search
  else if (isset($_GET['search'])) {
      
    $get_search_itemsQ = "SELECT * FROM `newspaper` WHERE `name` LIKE '%{$_GET['search-query']}%' OR `description` LIKE '%{$_GET['search-query']}%' OR  `date` LIKE '%{$_GET['search-query']}%' AND `status`='approved'; ";

    $res_search_items = mysqli_query($con, $get_search_itemsQ);

    if ($res_search_items) {
        
      while ($item = mysqli_fetch_assoc($res_search_items)) {
        
        $thumbnail = base64_encode($item['thumbnail']);

        echo " <div class=\"col-lg-3 col-md-5 mb-2\" >
                <div class=\"card\" style=\"width: 18rem;background-color: rgba(245, 245, 245, -5);\">
                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">{$item['name']}</h5>
                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>";

                    if (isset($_SESSION['usr_id'])) {

                      /* check item subscribed*/
                      $is_subscribed = "SELECT * FROM `subscribe` WHERE `customer_id`={$_SESSION['usr_id']} AND `newspaper_id`={$item['newspaper_id']}";

                      $res_is_subscribed =  mysqli_query($con,$is_subscribed);
                      if (0<mysqli_num_rows($res_is_subscribed)) {
                       echo "<a href=\"profile.php\" class=\"btn btn-outline-primary mr-1\">Subscribed</a>";
                      }else{
                        echo "<a href=\"choose-plan.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                    }



                    if (isset($_SESSION['usr_id'])) {

                      /* check item in cart*/
                      $is_in_cart = "SELECT * FROM `cart` WHERE `newspaper_id`={$item['newspaper_id']} AND `user_id`={$_SESSION['usr_id']}";

                      $res_is_in_cart =  mysqli_query($con,$is_in_cart);
                      if (0<mysqli_num_rows($res_is_in_cart)) {
                       echo "<a href=\"cart.php\" class=\"btn btn-outline-danger\">Added to cart</a>";
                      }else{
                        echo "<a href=\"index.php?id-cart={$item['newspaper_id']}\" class=\"btn btn-danger\">Add to cart</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-danger\">Add to cart</a>";
                    }

                    
              echo  "</div>
                </div>
            </div>";

      }
    }

  }

  //All items
  else{

  	$get_selected_itemsQ = "SELECT * FROM `newspaper` WHERE `status`='approved'";

  	$get_selected_itemsQ = mysqli_query($con, $get_selected_itemsQ);

  	if ($get_selected_itemsQ) {
	  		
  		while ($item = mysqli_fetch_assoc($get_selected_itemsQ)) {
  			
  			$thumbnail = base64_encode($item['thumbnail']);

  			echo " <div class=\"col-lg-3 col-md-5 mb-2\" >
                <div class=\"card\" style=\"width: 18rem;background-color: rgba(245, 245, 245, -5);\">
                <img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">{$item['name']}</h5>
                    <p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>";

                    if (isset($_SESSION['usr_id'])) {

                      /* check item subscribed*/
                      $is_subscribed = "SELECT * FROM `subscribe` WHERE `customer_id`={$_SESSION['usr_id']} AND `newspaper_id`={$item['newspaper_id']}";

                      $res_is_subscribed =  mysqli_query($con,$is_subscribed);
                      if (0<mysqli_num_rows($res_is_subscribed)) {
                       echo "<a href=\"profile.php\" class=\"btn btn-outline-primary mr-1\">Subscribed</a>";
                      }else{
                        echo "<a href=\"choose-plan.php?id-subscribe={$item['newspaper_id']}\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-primary mr-1\">Subscrib</a>";
                    }



                    if (isset($_SESSION['usr_id'])) {

                      /* check item in cart*/
                      $is_in_cart = "SELECT * FROM `cart` WHERE `newspaper_id`={$item['newspaper_id']} AND `user_id`={$_SESSION['usr_id']}";

                      $res_is_in_cart =  mysqli_query($con,$is_in_cart);
                      if (0<mysqli_num_rows($res_is_in_cart)) {
                       echo "<a href=\"cart.php\" class=\"btn btn-outline-danger\">Added to cart</a>";
                      }else{
                        echo "<a href=\"index.php?id-cart={$item['newspaper_id']}\" class=\"btn btn-danger\">Add to cart</a>";
                      }                      
                    }else{
                      echo "<a href=\"sign.php\" class=\"btn btn-danger\">Add to cart</a>";
                    }

                    
              echo  "</div>
                </div>
            </div>";

  		}
  	}


  }



?>

