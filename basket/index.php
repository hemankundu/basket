<?php
	session_start();
	require_once("connect_db.php");
	$table_name = "product";
	$query = "SELECT * FROM ".$table_name.";";
	$products = mysqli_query($link, $query);
	$tot_qty=0;
	$tot=0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Basket- heman</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100  m-b-110">
					<table>
						<thead>
							<tr class="row100 head">
								<th class="column100 col1" >Name</th>
								<th class="column100 col2" >Quantity</th>
								<th class="column100 col3" >Rate</th>
								<th class="column100 col4" >Detail</th>
								<th class="column100 col5" >Sub Total</th>
								<th class="column100 col6" >Remove?</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($products as $product):?>
							<tr class="row100 body" id=<?=$product['id']?>>
								<td class="column100 col1" id="name"><input class="input100" value="<?=$product['name']?>"></td>
								<td class="column100 col2" id="qty"><input class="input100" value=<?=$product['qty']?>></td>
								<td class="column100 col3" id="rate"><input class="input100" value=<?=$product['rate']?>></td>
								<td class="column100 col4" id="detail"><input class="input100" value="<?=$product['detail']?>"></td>
								<td class="column100 col5" id="subtot"><label class="input100"><?=$product['qty']*$product['rate']?></label></td>	
								<td class="column100 col6"><button class="btn del-btn">X</button></td>
							</tr>
							<?php
								$tot+=$product['qty']*$product['rate'];
								$tot_qty+=$product['qty'];
								endforeach?>
						</tbody>
						<tfoot>
							<tr class="row100 head total">
								<th class="column100 col1" >Total</th>
								<th class="column100 col2" ><label id="tot_qty_label"><?=$tot_qty?></label></th>
								<th class="column100 col3" ></th>
								<th class="column100 col4" ></th>
								<th class="column100 col5" ><label id="tot_label"><?=$tot?></label></th>
								<th class="column100 col6" ></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="container-btn">
					<button class="btn add-btn">Add</button>
					<button class="btn save-btn hidden">Save</button>
				</div>
			</div>
			
		</div>
		
	</div>      

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>