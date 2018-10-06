<?php

 if (isset($_POST['search'])) {
	$search = htmlspecialchars($_POST["search"]);
	$searchText = htmlspecialchars($_POST["search"]);
 }
 else {
	 $search = "";
	 $searchText = "";
 }
 if (isset($_SESSION['cartCount'])) {
	$CartCount = $_SESSION["cartCount"];
 }
 else {
	$CartCount = 0; 
 }

if(isset($searchText) && !empty($_SESSION["searchText"])) {
    unset($_SESSION["searchText"]);
    $_SESSION["searchText"] = $searchText;
}
else
{
    $_SESSION["searchText"] = $searchText;
}

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $items;
            $x = $_GET["product_code"];
            $myKey = array_search($x, array_column($items, "product_code"));

			$itemArray = array($productByCode[$myKey]["product_code"]=>array('product_name'=>$productByCode[$myKey]["product_name"], 'product_code'=>$productByCode[$myKey]["product_code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[$myKey]["price"], 'image'=>$productByCode[$myKey]["image"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[$myKey]["product_code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode[$myKey]["product_code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								else{
									 if (isset($_POST["quantity"])){
										$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
									 }
									 else {
											$_SESSION["cart_item"][$k]["quantity"] = 0;
									 }
								}

							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "update":
		if(!empty($_POST["quantity"])) {
			$productByCode = $items;
            $x = $_GET["product_code"];
            $myKey = array_search($x, array_column($items, "product_code"));

			$itemArray = array($productByCode[$myKey]["product_code"]=>array('product_name'=>$productByCode[$myKey]["product_name"], 'product_code'=>$productByCode[$myKey]["product_code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[$myKey]["price"], 'image'=>$productByCode[$myKey]["image"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[$myKey]["product_code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
                        if($productByCode[$myKey]["product_code"] == $k) {
                            if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                        }
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
        break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["product_code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "search":
		if (isset($search)) {

            $results = array_filter($items, function ($item) use ($search) {
                if (stripos($item['product_name'], $search) !== false) {
                    return true;
                }
                return false;
            });

            if(!empty($_SESSION["search"])) {
                unset($_SESSION["search"]);
                $_SESSION["search"] = $results;
            }
            else
            {
                $_SESSION["search"] = $results;
            }

        }
        break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
  }
}
?>