<?php
if (session_id() == ""){
	session_start();
	
}

$_SESSION["checkoutType"]="return";

if(!isset($_SESSION['pid'])){
	$_SESSION['pid']=array();
}
//var_dump($_SESSION);
require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
			if(!in_array($_GET['p_id'],array_keys($_SESSION["pid"]))){
				$_SESSION['pid'][$_GET['p_id']]=array('p_id'=>$_GET['p_id']);
				//var_dump($_SESSION['pid']);
				//##################################################################################3
				$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
				$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>1,'p_id'=>$_GET['p_id'] ,'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
				
				if(!empty($_SESSION["Returncart_item"])) {
					if(in_array($productByCode[0]["code"],array_keys($_SESSION["Returncart_item"])) ) {
						foreach($_SESSION["Returncart_item"] as $k => $v) {
								if($productByCode[0]["code"] == $k) {
									if(empty($_SESSION["Returncart_item"][$k]["quantity"])) {
										$_SESSION["Returncart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["Returncart_item"][$k]["quantity"] += 1;
									//echo $_SESSION["Returncart_item"][$k]["type"];
									
								}
						}
					 
					}	else {
						$_SESSION["Returncart_item"] = array_merge($_SESSION["Returncart_item"],$itemArray);
					}
				} else {
					$_SESSION["Returncart_item"] = $itemArray;
				}
			}
			//var_dump($_SESSION['pid']);
			break;
	
	case "remove":
		unset($_SESSION['pid'][$_GET['p_id']]);
		if(!empty($_SESSION["Returncart_item"])) {
			foreach($_SESSION["Returncart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["Returncart_item"][$k]);				
					if(empty($_SESSION["Returncart_item"]))
						unset($_SESSION["Returncart_item"]);
			}
		}
	break;
	
}
exit();
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<link href="css/style.css" type="text/css" rel="stylesheet" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
		<?php include 'navbar.php';?>
		
	<!--#####################################-->
		
		<!--###################################3-->
		<script>
		function submitBtn(code,p_id){
			$.ajax({
			  method: "GET",
			  url: "return1.php?action=add&code="+code+"&p_id="+p_id,
			  //data: { name: "John", location: "Boston" }
			})
			//.done(function( msg ) {
				//$("#ajaxReturnDisplay").html(msg);
			  //});
			$('#shopping-cart').load(' #shopping-cart');
			
			//$('#submitBtn').prop('disabled', true);
			  
		}
		
		function cancelBtn(code,p_id){
			$.ajax({
			  method: "GET",
			  url: "return1.php?action=remove&code="+code+"&p_id="+p_id,
			  //data: { name: "John", location: "Boston" }
			})
			$('#shopping-cart').load(' #shopping-cart');
			//$('#submitBtn').prop('disabled', false);
			  
		  }
		</script>
		<!--##############################################id="shopping-cart"-->
		<div id="ajaxReturnDisplay"></div>
	<div class="container" id="shopping-cart">
		<div class="txt-heading font-italic font-weight-bold">Return Cart</div>
		<!-- <a id="btnEmpty" href="return1.php?action=empty">Empty Cart</a> -->
		<?php
		if(isset($_SESSION["Returncart_item"])){
			$total_quantity = 0;
			$total_price = 0;
		?>	
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
		<tbody>
		<tr>
		<th class="font-italic font-weight-bold" style="text-align:left;">Name</th>
		<th class="font-italic font-weight-bold" style="text-align:right;" width="5%">Quantity</th>
		<th class="font-italic font-weight-bold" style="text-align:right;" width="10%">Unit Price</th>
		<th class="font-italic font-weight-bold" style="text-align:right;" width="10%">Price</th>
		</tr>	
		<?php		
			foreach ($_SESSION["Returncart_item"] as $item){
				$item_price = $item["quantity"]*$item["price"];
				?>
						<tr>
						<td class="font-italic font-weight-bold"><?php echo $item["name"]; ?></td>
						<td class="font-italic font-weight-bold" style="text-align:center;"><?php echo $item["quantity"]; ?></td>
						<td class="font-italic font-weight-bold" style="text-align:right;"><?php echo "Rs ".$item["price"]; ?></td>
						<td class="font-italic font-weight-bold" style="text-align:right;"><?php echo "Rs ". number_format($item_price,2); ?></td>
						
						</tr>
						<?php
						$total_quantity += $item["quantity"];
						
						$total_price += ($item["price"]*$item["quantity"]);
				}
				?>

		<tr>
		<td class="font-italic font-weight-bold" align="right">Total:</td>
		<td class="font-italic font-weight-bold" align="center"><?php echo $total_quantity; ?></td>
		<td class="font-italic font-weight-bold" align="right" colspan="2"><?php echo "Rs ".number_format($total_price, 2); ?></td>
		</tr>
		</tbody>
		</table>
		<div><a href="checkout/address.php"><input type="submit" class="btn btn-outline-dark mb-4" value="Proceed "></a></div>
		  <?php
		} else {
		?>
		<div class="no-records font-italic font-weight-bold">Your Cart is Empty</div>
		<?php 
		}
		?>
		
		
	</div>
		<!--##################################################-->
				
		
		<div class="container">
			<?php if(isset($_SESSION['name'])){?>
				<table class="table tbl-cart" id="table" cellpadding="10" cellspacing="1">
					<tbody>
						<tr>
							<th class="font-italic font-weight-bold" style="text-align:left;" >Name</th>
							
							<th class="font-italic font-weight-bold" style="text-align:center;" width="10%">Quantity</th>
							<th class="font-italic font-weight-bold" style="text-align:center;" width="10%">Price</th>
							<th style="text-align:center;" width="5%"></th>
							<th style="text-align:center;" width="5%"></th>
						</tr>	
						<?php
						include("php/connect.php"); error_reporting(1);
						$total_quantity = 0;
						$total_price = 0;
						/*
						$query="select s.p_id, s.id,code,n.invoice_no, image,description,qty,product_amt,price,course,semester,date_time from  tbl_invoice_description s,tblproduct m, tbl_invoive_date n where s.id={$_SESSION['id']} and s.type='new' and s.description = m.name and s.invoice_no=n.invoice_no";
						*/
						$query="select s.p_id,s.id,code,image,description,qty,product_amt from tbl_invoice_description s,tblproduct m where s.id={$_SESSION['id']} and s.type='new' and s.description = m.name";
						$data=mysqli_query($con,$query);
						while($row = mysqli_fetch_array($data)) {
						?>

							<tr>
								<td class="font-italic font-weight-bold"><?php echo $row["description"]; ?></td>
								<td class="font-italic font-weight-bold" style="text-align:center;"><?php echo $row["qty"]; ?></td>
								<td class="font-italic font-weight-bold" style="text-align:center;"><?php echo "Rs ".$row["product_amt"]; ?></td>
								
								<td><input id="submitBtn" class="btn btn-outline-success" type="button" onclick="$(this).closest('tr').addClass('table-success');submitBtn('<?php echo $row['code']; ?>','<?php echo $row['p_id']; ?>')" style="font-size: 10px;" value="Return"></td>

								<td><input id="cancelBtn" class="btn btn-outline-danger" type="button" onclick="$(this).closest('tr').removeClass('table-success');cancelBtn('<?php echo $row['code']; ?>','<?php echo $row['p_id']; ?>')" style="font-size: 10px;" value="Cancel"></td>
							</tr>
							
							
							
							<?php
								
								$total_quantity += $row["qty"];
								$total_price += $row["product_amt"];
						}	
							?>
							

						<tr>
							<td class="font-italic font-weight-bold" align="right">Total:</td>
							<td class="font-italic font-weight-bold" align="center"><?php echo $total_quantity; ?></td>
							<td class="font-italic font-weight-bold" align="right"><?php echo "Rs ".$total_price; ?></td>
							<td colspan="2"></td>
						</tr>
					</tbody>
				</table>		
			<?php } ?>
			<?php
				//if($total_quantity ==0){
			?>
			<!--	<div class="no-records">Your Cart is Empty</div> -->
			<?php
				//}
			?>
			
		</div>
	</body>
</html>
