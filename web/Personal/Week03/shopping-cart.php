<?php
session_start();

include "Includes/itemlist.php";
include "Includes/Actions.php";

?>
<html>
<head>
<title>Shopping Cart</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<link href="css/Week03.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="container masthead">
	<div class="logo">
		<img src="images/logo.png" alt="Books by Rick" width="207" height="75" />

	</div>
	<div class="searchbar">
		<div class="row-fluid">
			<div class="col-md-6">
				<a href="index.php" class="lnkCart">
					<span class="glyphicon glyphicon-book"></span>&nbsp;Find More Books
				</a>
			</div>
			<div class="col-md-6">
				<div class="pull-right">
					<a href="checkout.php" class="lnkCart">
						Continue to Checkout&nbsp;<span class="glyphicon glyphicon-forward"></span>
					</a>
				</div>
			</div>
		</div>	
	</div>
</div>
<div id="shopping-cart" class="container">
<div class="txt-heading">
    Shopping Cart
</div>

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th class="text-left width-40">
    Item
</th>
<th class="text-left width-10">
    Code
</th>
<th class="text-center width-10">
    Quantity
</th>
<th class="text-right width-10">
    Item Price
</th>
<th class="text-right width-10">
    Ext. Price
</th>
<th class="text-center width-5">
    Remove
</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = ($item["quantity"]*$item["price"]);
?>
	    
                <tr>
				    <td>
                        <img src="<?php echo $item["image"]; ?>" class="cart-item-image" />
                            <?php echo $item["product_name"]; ?>
                    </td>
				    <td>
                        <?php echo $item["product_code"]; ?>
                    </td>
				    <td class="text-center">
                        <form class="form-inline" method="post" action="shopping-cart.php?action=update&product_code=<?php echo $item["product_code"]; ?>">
                        <input type="number" class="number-only product-quantity" name="quantity" value="<?php echo $item["quantity"]; ?>" size="2"/>
                        <input type="submit" class="number-only product-quantity btn btnRick btn-xs" value="Update" href="shopping-cart.php?action=update&product_code=<?php echo $item["product_code"]; ?>" />
                        </form>
                    </td>                
				    <td class="text-right">
                        <?php echo "$ ". number_format($item["price"], 2); ?>
                    </td>
				    <td class="text-right">
                        <?php echo "$ ". number_format($item_price,2); ?>
                    </td>
				    <td class="text-center">
                        <a href="shopping-cart.php?action=remove&product_code=<?php echo $item["product_code"]; ?>" class="btnRemoveAction">
                            <img src="images/icon-delete.png" alt="Remove Item" />
                        </a>
                    </td>
				</tr>

				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
                ?>

<tr>
    <td colspan="2" class="text-right">
        <strong>
            Total:
         </strong>
    </td>
    <td class="text-center">
        <strong>
        <?php echo $total_quantity; ?> &nbsp;&nbsp;&nbsp;&nbsp;Items
        </strong>
    </td>
    <td class="text-right" colspan="2">
        <strong>
            <?php echo "$ ".number_format($total_price, 2); ?>
        </strong>
    </td>
    <td>
    </td>
</tr>
</tbody>
</table>
<a id="btnEmpty" href="shopping-cart.php?action=empty" class="btn btn-warning pull-left">
    Empty Cart
</a>	
<div class="pull-right">
	<a id="btnEmpty" href="checkout.php" class="btn btnRick pull-left">
		Continue to Checkout&nbsp;<span class="glyphicon glyphicon-forward"></span>
	</a></div>	
  <?php
} else {
?>
<div class="no-records">
    Your Cart is Empty
</div>
<?php 
}
?>
</div>

</body>
</html>