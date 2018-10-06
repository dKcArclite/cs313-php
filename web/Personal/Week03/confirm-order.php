<?php
session_start();

include "Includes/itemlist.php";
include "Includes/Actions.php";

$formData['nameFirstLast'] = filter_input(INPUT_POST, 'nameFirstLast', FILTER_SANITIZE_STRING);
$formData['mailAddress1'] = filter_input(INPUT_POST, 'mailAddress1', FILTER_SANITIZE_STRING);
$formData['mailAddress2'] = filter_input(INPUT_POST, 'mailAddress2', FILTER_SANITIZE_STRING);
$formData['mailCity'] = filter_input(INPUT_POST, 'mailCity', FILTER_SANITIZE_STRING);
$formData['mailRegion'] = filter_input(INPUT_POST, 'mailRegion', FILTER_SANITIZE_STRING);
$formData['mailPostalCode'] = filter_input(INPUT_POST, 'mailPostalCode', FILTER_SANITIZE_STRING);
$formData['mailCountry'] = filter_input(INPUT_POST, 'mailCountry', FILTER_SANITIZE_STRING);

?>
<html>
<head>
    <title>
        Order Confirmation
    </title>
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
					<span class="glyphicon glyphicon-home"></span>&nbsp;Home
				</a>
			</div>
		</div>	
	</div>
</div>
<div class="container">
    <div class="row-fluid">
        <form class="form-horizontal" action="confirm-order.php" method="post">
            <fieldset>
                <h2>
                    Order Confirmation:
                </h2>
                <div class="txt-heading">
                    Delivery Information
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Name:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['nameFirstLast'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Address Line 1:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailAddress1'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Line2:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailAddress2'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        City/Town:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailCity'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        State/Province/Region:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailRegion'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Postal Code:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailPostalCode'] ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Country:
                    </label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?= $formData['mailCountry'] ?>
                        </p>
                    </div>
                </div>
            </fieldset>
            <div class="txt-heading">
                Order Details
            </div>
            <div class="row-fluid">
                <table class="tbl-cart" cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th class="text-left width-50">
                                Product
                            </th>
                            <th class="text-left width-20">
                                Code
                            </th>
                            <th class="text-center width-10">
                                Quantity
                            </th>
                            <th class="text-right width-10">
                                Unit Price
                            </th>
                            <th class="text-right width-10">
                                Price
                            </th>
                        </tr>

                        <?php
			if(isset($_SESSION["cart_item"])){
				$total_quantity = 0;
				$total_price = 0;

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
                                <?php echo $item["quantity"]; ?>
                            </td>
                            <td class="text-right">
                                <?php echo "$ ". number_format($item["price"], 2); ?>
                            </td>
                            <td class="text-right">
                                <?php echo "$ ". number_format($item_price,2); ?>
                            </td>
                        </tr>
                        <?php
						    $total_quantity += $item["quantity"];
						    $total_price += ($item["price"]*$item["quantity"]);
				}
			}
			else {
					$total_quantity = 0;
					$total_price = 0;
					header("Location: index.php");
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
                                    <?php echo $total_quantity; ?> 
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
            </div>
        </form>
    </div>
		<?php		
			unset($_SESSION["cart_item"]);
		?>
</div>
</body>
</html>