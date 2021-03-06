<html>
<head>
	<meta charset="utf-8">
	<title>راپورتی گوژمەی کالاکان</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/trial_balance.css">
	<style type="text/css">
	*{
		font-family: tahoma;;
	}
		a{
			text-decoration:none;
			color: inherit;
		}
		a:hover{
			color:#f22333;
		}
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
	<br/>
			<table>
				<thead>
					<th>#</th>
					<th>نێوی کالا</th>
					<th>کڕدراوە</th>
					<th>فرۆشراوە</th>
					<th>ماوەتەوە</th>
				</thead>
		<?php
		$products=$this->product_model->all();
		foreach ($products as $product) {
			$sale=$this->sale_details_model->select(array('product_id'=>$product->id));
			$purchase=$this->purchase_details_model->select(array('product_id'=>$product->id));
			$sale_count=0; $purchase_count=0;
			foreach ($sale as $key) {
				$unit=$this->unit_model->findbyid($key->unit_id);
				$sale_count=$sale_count + ($unit->scale * $key->quantity);
			}
			foreach ($purchase as $key) {
				$unit=$this->unit_model->findbyid($key->unit_id);
				$purchase_count=$purchase_count + ($unit->scale * $key->quantity);
			}
			 ?>
		<tr>
			<td><?php echo $product->id; ?></td>
			<td><?= anchor('reports/product_report/'.$product->id,$product->title); ?></td>
			<td><?php  echo number_format(($purchase_count/$product->unit_scale),2); ?> <?php echo $product->unit_name ?></td>
			<td><?php  echo number_format(($sale_count/$product->unit_scale),2); ?> <?php echo $product->unit_name ?></td>
			<td><?php  echo number_format(($purchase_count-$sale_count)/$product->unit_scale,2); ?> <?php echo $product->unit_name ?></td>
		</tr>

			<?php } ?>
			</table>
	</div>
</body>
</html>
