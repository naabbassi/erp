<html>
<head>
	<meta charset="utf-8">
	<title>راپورتی گوژمەی کالاکان</title>
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
	<div class="customer">
	<?php
		$customer=$this->customer_model->findbyid($this->uri->segment(3));
		echo "<p>مۆشتەری  : ".$customer->f_name.' '.$customer->m_name.' '.$customer->l_name."</p>";
		echo "<p>ژمارە تلفۆن : ".$customer->phone."</p>";
		echo "<p>شوێن : ".$customer->address."</p><br>";
	?>
	</div>
	<br/>
			<table>
				<thead>
					<th>#</th>
					<th>نێوی کالا</th>
					<th>زانیاری یەکە</th>
					<th>فروشراوە</th>
				</thead>
		<?php
		$products=$this->product_model->all();
		foreach ($products as $product) {
			$sale=$this->customer_product_view_model->select(array('customer_id'=>$this->uri->segment(3),'product_id'=>$product->id));
			$sale_count=0;
			foreach ($sale as $key) {
				$unit=$this->unit_model->findbyid($key->unit_id);
				$sale_count=$sale_count + ($unit->scale * $key->quantity);
			} ?>	
		<tr>
			<td><?php echo $product->id; ?></td>
			<td><?php echo $product->title; ?></td>
			<td>هر <?php echo $product->unit_name ?> = <?php echo $product->unit_scale.' '.$product->component_name; ?></td>
			<?php $floor=floor($sale_count/$product->unit_scale); ?>
			<?php $component=($sale_count)-($floor*$product->unit_scale); ?>
			<td><?php  echo number_format($floor); ?> <?php echo $product->unit_name ?> و <?php echo $component.' '.$product->component_name;  ?></td>
		</tr>
	
			<?php } ?>
			</table>
			<br><br>
			<table>
				<thead>
					<th>#</th>
					<th>شێوازی پارە</th>
					<th>بەروار</th>
					<th>بری پارە</th>
				</thead>
			
			<?php 
				$payment=$this->payment_model->select(array('customer_id'=>$this->uri->segment(3)));
				$sum=0;
				foreach ($payment as $key) {
					echo "<tr>";
					echo "<td>$key->id</td>";
					echo "<td>$key->type</td>";
					echo "<td>$key->date_time</td>";
					echo "<td>".number_format($key->amount)." دینار</td>";
					echo "</tr>";
					$sum=$sum +$key->amount;
				}
			?>
			<tr>
				<td colspan="3" >کۆی گشتی :</td>
				<td style="background:#3399cc;color:white;"><?php echo number_format($sum); ?> دینار</td>
			</tr>
			</table>
	</div>
</body>
</html>