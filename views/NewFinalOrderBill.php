<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />	
	<title>Invoice</title>
	<style type="text/css">
* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header{  height: 15px;
    width: 100%;
    margin: 5px 0;
    background: #222;
    text-align: center;
    color: white;
    font: bold 15px Helvetica, Sans-Serif;
    text-decoration: uppercase;
    letter-spacing: 5px;
    padding: 10px 0px;}

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 12px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 10px 0 0 0; border: 1px solid black; }
#items th { background: #eee; font-size: 12px; }
#items td { font-size: 12px; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 {font: 13px Helvetica, Sans-Serif; letter-spacing: 1px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0;color: #175d9a; font-weight: bolder; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
	</style>
</head>


<div id="page-wrap">

		<div id="header">Order Detail</div>
		
		<div id="identity">
            <div style="margin-left: 45%;">
	              <img id="image" src="https://syplo.se/api/assest/img/Untitled-3.png" alt="logo">
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		<?php 
		$canceling_policy='';
		if($order_details->provider_cancelPolicy==1)
	 	{ $canceling_policy='Flexible';}
	 	else if($order_details->provider_cancelPolicy==2)
	 	{ $canceling_policy='Strict';}
	 	else
	 	{ $canceling_policy='Moderate';}
		?>
	
			<table id="items">
                <tbody>
	               <tr>
				  	  <th>Provider Name</th>	
				      <td><?php echo $details['provider_name']; ?></td>
				      <th>Provider Email</th>	
				      <td><?php echo $details['provider_email']; ?></td>
			  		</tr>
			  		<tr>
				  	  <th>Customer Name</th>	
				      <td><?php echo $details['customer_name']; ?></td>
				      <th>Customer Email</th>
				      <td><?php echo $details['customer_email'];?></td>
			  		</tr>
			  		<tr>
				  	  <th>Cancel Policy</th>	
				      <td><?php echo $canceling_policy; ?></td>
				      <th>Order Date</th>
				      <td><?php echo $order_details->date;?></td>
			  		</tr>			  
				  <tr>
					  <th>Order Address</td>	
				      <td class="description"><?php echo $order_details->address;?></td>
				      <th>OrderTime</th>
				      <td><?php echo $order_details->time;?></td>
				  </tr>
			  <tr>
				  <th style="font-weight: bolder;">Transaction Id</td>	
			      <td style="font-weight: bolder;"><?php echo $payment_detail->transaction_id;?></td>
			      <th style="font-weight: bolder;">Transaction Status</td>	
			      <td style="font-weight: bolder;"><?php echo $payment_detail->transaction_status;?></td>
			  </tr>
            	</tbody>
            </table>

		<table id="items">
		  <tbody>
			  <tr>
			  	  <th>Sr.No.</th>	
			      <th>Service Name</th>
			      <th>Price Type</th>
			      <th>Price</th>
			      <th>Total Hour</th>
			      <th>Total cost</th>
			  </tr>
			  <?php $ServiceCoast =0; $i=1;
			   	foreach ($services as $key)
			    {
			  		if($key->total_hour==24)
				  	{ $total_hour = 'Fixed'; }
				  	else
				  	{ $total_hour = $key->total_hour; }
			    ?>

			  <tr>
			  		<td><?php echo $i++; ?></td>	
			      	<td class="item-name">
			      	<div class="delete-wpr">
			      		<div><?php echo $key->sub_category;?></div>
			      	</div>
			      </td>
			      <td><?php if($key->price_type==0){echo 'per hour';}else {echo "Fixed";} ?></td>
			      <td><?php echo 'kr '.$key->price; ?></td>
			      <td><?php echo $total_hour; ?></td>
			      <td><?php echo 'kr '.$key->total_cost; ?></td>
			  </tr>

			  <?php 
			  $ServiceCoast = $ServiceCoast+$key->total_cost; 
			}
			  $payed_amount  = $payment_detail->gross_amount;
			  $due_amount    = $ServiceCoast-$payed_amount;

			  $discount_type ='No Discount';
			  $discount      = 0;
			  	    if($payment_detail->discount!='')
			  	    {
			  	    	$discount = $ServiceCoast-$payment_detail->gross_amount;
			  	    	if($payment_detail->discount_id==0)
			  	    	{
			  	    		$discount_type = 'Referral Discount';
			  	    	}
			  	    	else
			  	    	{
			  	    		$discount_type = 'General Discount';
			  	    	}

			  	    }

			   ?>
			   <tr>
			      <td colspan="3" class="blank"> </td>
			      <td colspan="2" style="font-weight: bolder;">Final Bill Amount</td>
			      <td  style="font-weight: bolder;"><?php echo 'kr '.$ServiceCoast;?></td>
			  </tr>	
			  <tr>
			      <td colspan="3" class="blank"> </td>
			      <td colspan="2" style="font-weight: bolder;">- Amount Payed</td>
			      <td><?php echo 'kr '.$payment_detail->gross_amount;?></td>
			  </tr>
			   <tr>
			      <td colspan="3" class="blank"> </td>
			      <td colspan="2" style="font-weight: bolder;">Net Due Payment</td>
			      <td  style="font-weight: bolder;"><?php echo 'kr '.$due_amount;?></td>
			  </tr>		
			</tbody>
		</table>		
		<span style="font-size:10px;"><strong>*This is only e-generat order bill. If any query regarding bill please drop email to <u>info@syplo.se</u></strong></span>
		<div id="terms">
		  <h5>!! Thanks Syplo Team !!</h5>
		</div>
	
	</div>
	</html>