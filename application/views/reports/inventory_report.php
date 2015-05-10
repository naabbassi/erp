<html>
<head>
	<title>Inventory</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/trial_balance.css">
	<style type="text/css">
		p{
			text-align:left;
			line-height:26px;
			padding-left:10px;
		}
		hr{
		height:0;
		margin:10px 0 10px -10px;
		border-top:2px solid #777;
	}
	</style>
</head>
<body>
	<div class="container">
		<?php
		$products=$this->product_model->all();
		foreach ($products as $product) {
			$count=$this->income_items_model->count(array('product_id'=>$product->id));
			if ($count > 0 ) {
				$cat=$this->product_cat_model->findbyid($product->cat_id);
			 ?>
				<table>
					<tr>
						<td colspan="7" ><p>Product Name : <?php echo $product->id.' - '.$product->title; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category: <?php echo $cat->title; ?></p></td>
					</tr>
					<tr>
						<td class="bold">Date</td>
						<td class="bold">Vendor</td>
						<td class="bold">Invoice ID</td>
						<td class="bold">Unit</td>
						<td class="bold">Quantity</td>
						<td class="bold">Unit Price</td>
						<td class="bold">Total</td>
					</tr>
					<?php
					$products=$this->income_items_model->select(array('product_id'=>$product->id));
					foreach ($products as $item) {
						$invoice=$this->income_invoice_model->findbyid($item->income_id); ?>
						<tr>
							<td><?php echo $invoice->invoice_date; ?></td>
							<td><?php echo $invoice->company; ?></td>
							<td><?php echo '('.$invoice->id.') - '.$invoice->invoice_no; ?></td>
							<td><?php echo $product->unit ?></td>
							<td><?php echo number_format($quantity=$item->quantity) ?></td>
							<td><?php $unit_price=$item->unit_price; echo number_format($unit_price,2); ?>$</td>
							<td><?php $total=$quantity*$unit_price; echo number_format($total,2) ?>$</td>
						</tr>
					<?php } ?>
					 <tr>
					 	<td colspan="4">Inventory</td>
					 	<td></td>
					 	<td></td>
					 	<td></td>
					 </tr>
				</table><hr>
			<?php }
		}
		 ?>
	</div>
</body>
</html>