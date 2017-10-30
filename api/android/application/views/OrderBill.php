<!DOCTYPE html>
<html>
<head>
	<title>Order Bill</title>
</head>
<body>
<center>
<div style="border:2px solid black; padding:5px;width:500px;height: auto; overflow-x: scroll;">
<div><img src="<?php echo base_url('upload/logo.png');?>" height="50px"></div>
<table style="border: 2px solid black; padding: 10px;">
<tr>
	<td>Provider Name : </td>
	<td><?php echo $provider_name; ?></td>
</tr>	
<tr>
	<td>Order Address : </td>
	<td><?php echo $order_details->address;?></td>
</tr>	

<tr>
	<td>Order Date : </td>
	<td><?php echo $order_details->date;?></td>
</tr>	

<tr>
	<td>Order Time : </td>
	<td><?php echo $order_details->time;?></td>
</tr>
</table>
<h3>-: Order Services :-</h3>
<table border="1px solid black">
	<tr>
		<th>Sr. No.</th>
		<th>Service Name</th>
		<th>Price Type</th>
		<th>Price</th>
		<th>Total Hour</th>
		<th>Total cost</th>
	</tr>
	<?php $i=1; foreach ($services as $key) { 
		
	?>

	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $key->sub_category;?></td>
		<td><?php if($key->price_type==0){echo 'per hour';}else {echo "Fixed";} ?></td>
		<td><?php echo $key->price; ?></td>
		<td><?php if($key->price_type==0){echo $key->total_hour;}else {echo "Fixed";} ?></td>
		<td><?php echo $key->total_cost; ?></td>
	</tr>

	<?php } ?>
	
</table>
</div>
</center>
</body>
</html>