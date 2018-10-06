<?php
session_start();

include "Includes/itemlist.php";
include "Includes/Actions.php";

$cartCount = 0;
if(!empty($_SESSION["cart_item"])) {
    foreach($_SESSION["cart_item"] as $k => $v) {
        $cartCount += $v["quantity"];
    }

}
?>
<html>
<head>
    <title>
        Browse Items
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link href="css/Week03.css" type="text/css" rel="stylesheet" />
    <script src="js/Week03.js"></script>
</head>
<body>
<div class="container masthead">
	<div class="logo">
		<img src="images/logo.png" alt="Books by Rick" width="207" height="75" />

	</div>
	<div class="searchbar">
		<div class="pull-right">
			<a class="lnkCart" href="shopping-cart.php">
				<span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;<?php echo $cartCount; ?>&nbsp;items
			</a>
		</div>		
		<!-- Search input-->
		<?php
		 $search = "";
		if (isset($_POST["search"])){
			$search = htmlspecialchars($_POST["search"]);
		}
		?>
		<form method="post" class="form-inline" action="index.php?action=search&search=<?php echo $search; ?>">
		 <div class="input-group">
			<input type="text" class="form-control" placeholder="Search" value="<?php echo $_SESSION["searchText"]; ?>" name="search">
			<div class="input-group-btn">
			  <button class="btn btnRick btnSearch" type="submit">
				<i class="glyphicon glyphicon-search"></i>
			  </button>
			  &nbsp;<i class="fa fa-question-circle searchTooltip" data-toggle="tooltip" title="If the search does not return any results all items will be returned."></i>
			</div>
		  </div>			
		</form>
	</div>
</div>
<div class="container">
    <div id="product-grid">
	    <div class="txt-heading">
            Products
        </div>
    </div>
    <?php

        if(!empty($_SESSION["search"])) {
            $products = $_SESSION["search"];
        }
        else
        {
            $products = $items;
        }


        if (!empty($products)) {
	        foreach($products as $key=>$value){
                $price = number_format($products[$key]["price"], 2);
    ?>
	    <div class="product-item col-md-12">
		    <form method="post" action="index.php?action=add&product_code=<?php echo $products[$key]["product_code"]; ?>">
				<div class="col-md-1 product-price pull-left">
					<?php echo "$".$price; ?>
				</div>
				<div class="col-md-1 pull-left">
					<div class="product-image">
						<img src="<?php echo $products[$key]["image"]; ?>" height="150" width="93">
					</div>
				</div>
				<div class="col-md-8 pull-left">
					<?php echo $products[$key]["product_name"]; ?>
				</div>
				<div class="col-md-2 pull-right">
		            <div>
                        <input type="number" class="number-only product-quantity" name="quantity" value="1" size="2" required />
                        <input type="submit" value="Add to Cart" class="btnAddAction1 btn btn-sm btnRick" />
                    </div>			
				</div>
				
		    </form>
	    </div>
    <?php
	    }
    }
    ?>
    </div>
</div>
</body>
</html>