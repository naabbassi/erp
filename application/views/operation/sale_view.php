<html>
<head>
	<meta charset="utf-8">
	<title> <?php if ($this->uri->segment(3) === false ) {echo 'Failure'; exit(); } else { echo 'Invoice No'.$this->uri->segment(3); }; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/report_css.css">
</head>
<body>
<div class="container">
	<div class="logo"><img src="<?php echo base_url() ?>/asset/img/logo.png"></div>
	<div class="info">
	<?php
		$sale=$this->sale_model->findbyid($this->uri->segment(3));
		echo "<p class='back_color'>ژمارە فاکتۆر : ".$sale->id."</p>";
		echo "<p class='back_color'>".$sale->date_time."</p>";
	?>	
	</div>
	<h3 class="invoice">فاکتوڕی فرۆش :: Sale Invoice</h3>
	<BR><BR><BR><BR><BR>
	<div class="customer">
	<?php
		$company=$this->company_model->get_first()->row();
		echo "<br><h4>".$company->title."</h4>";
		echo "<p>ژمارە تلفۆن : ".$company->phone."</p>";
		echo "<p>شوێن : ".$company->adress."</p>";
		echo "<hr>";
		$customer=$this->customer_model->findbyid($sale->customer_id);
		echo "<p>مۆشتەری  : ".$customer->f_name.' '.$customer->m_name.' '.$customer->l_name."</p>";
		echo "<p>ژمارە تلفۆن : ".$customer->phone."</p>";
		echo "<p>شوێن : ".$customer->address."</p><br>";
	?>
	</div>
	<div class="description">
		<br>
		<?php
			echo "<p>سەردێر: ".$sale->title."</p>";
			echo "<p>تێبینی : ".$sale->description."</p>";
		?>
	</div>
	<table>
		<thead>
			<th style="width:30px;font-size:14px;">#</th>
			<th colspan="2">ناوەڕۆک (Content)</th>
			<th style="width:70px;font-size:14px;">هەژمار (Quantity)</th>
			<th style="width:70px;">یەکە (Unit)</th>
			<th style="max-width:50px;font-size:14px;">نرخ (Unit Price)</th>
			<th style="width:130px">کۆ (Total)</th>
		</thead>	
		<?php
		$no=1;
		$invoice_total=0;
		$res=$this->sale_details_model->select(array('sale_id'=>$this->uri->segment(3)));
		foreach ($res as $key) {
			$product=$this->product_model->findbyid($key->product_id);
			$unit=$this->unit_model->findbyid($key->unit_id);
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td colspan='2'>".$product->title."</td>";
			echo "<td>".$key->quantity."</td>";
			echo "<td>".$unit->title."</td>";
			echo "<td>".number_format($key->price,2)." $</td>";
			echo "<td>".number_format($key->price*$key->quantity,2)."</td>";
			echo "</tr>";
			$no++;
			$total=$key->price * $key->quantity;
			$invoice_total=$invoice_total + $total;
		}
		?>
		<tr>
			<td class=" text-center" colspan="6">کۆی گشتی (Grand Total) : </td>
			<td class="sum"><p class="underline"><?php echo number_format($invoice_total,2) ?> $</p></td>
		</tr>
		<tr>
			<td class="red-text text-center" colspan="6">داشکاندن (Discount) : </td>
			<td class="red-text ">( <?php echo number_format($sale->discount,2) ?> $ )</td>
		</tr>
		<tr>
			<td class=" text-center" colspan="6">کۆی گشتی و داشکاندن(Grand Total With Discount): </td>
			<td class="sum"><p class="underline"><?php echo number_format($invoice_total-$sale->discount,2) ?> $</p></td>
		</tr>
		<thead><th colspan="7">پارەی دڕاو (Payment) :</th></thead>
		<?php
		$paid=$this->payment_model->select(array('sale_id'=>$sale->id));
		$paid_no=1;
		$total_paid=0;
		foreach ($paid as $key) { ?>
					<tr>
						<td class="text-center"><?php echo $paid_no ?></td>
						<td class="text-center" colspan='1'><?php echo $key->type ?></td>
						<td class="text-center" colspan="1"><?php echo $key->date_time ?></td>
						<td class="text-center" colspan="2"><?php echo $key->description ?></td>
						<td class="text-center"><?php echo number_format($key->amount)?> $</td>
					</tr>
				<?php 
				$total_paid=$total_paid +$key->amount;
				}	?>
				<tr>
					<td  colspan="6">کۆی پارەی دڕاو بۆ ئەم فاکتورە (Total Payment for this invoice):</td>
					<td >(<?php echo number_format($total_paid )?> $)</td>
				</tr>
				<tr>
					<td  class="red-text" colspan="6">بڕی پارەی ماوە سەبارەت بە ئەم فاکتورە (Debet Due this invoice): </td>
					<td  class="sum red-text"><p class="underline"><?php echo number_format($invoice_total-$sale->discount-$total_paid )?> $</p></td>
				</tr>
	</table>
	<br><br><br><br><br>
	<p class="">فڕۆشیار (Saler):  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;کڕیار (Buyer): </p>
	<div class="footer">
		<div class="right_content">
		<h4><?php echo $company->title ?></h4>
		<p>ژمارە تلفون : <?php echo $company->phone ?></p>
		<p>شوێن : <?php echo $company->adress ?></p>
		</div>
		<div class="left_content">
		<p>Email : <?php echo $company->email ?></p>
		<p>Website : <?php echo $company->website ?></p>
		</div>
	</div>
</div>
</body>
</html>