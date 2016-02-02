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
		$purchase=$this->purchase_model->findbyid($this->uri->segment(3));
		echo "<p class='back_color'>ژمارە فاکتۆر : P".$purchase->id."</p>";
		echo "<p class='back_color'>".$purchase->date_time."</p>";
	?>
	</div>
	<h3 class="invoice">فاکتۆری کڕین :: Purchase Invoice</h3>
	<BR><BR><BR><BR><BR>
	<div class="customer">
	<?php
		$company=$this->company_model->get_first()->row();
		echo "<br><h4>".$company->title." (کڕیار)</h4>";
		echo "<p>ژمارە تلفۆن : ".$company->phone."</p>";
		echo "<p>شوێن : ".$company->adress."</p>";
		echo "<hr>";
		$customer=$this->customer_model->findbyid($purchase->customer_id);
		echo "<p>فرۆشیار : ".$customer->f_name.' '.$customer->m_name.' '.$customer->l_name."</p>";
		echo "<p>ژمارە تلفۆن : ".$customer->phone."</p>";
		echo "<p>شوێن : ".$customer->address."</p><br>";
	?>
	</div>
	<div class="description">
		<br>
		<?php
			echo "<p>سەردێر: ".$purchase->title."</p>";
			echo "<p>تێبینی : ".$purchase->description."</p>";
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
		$res=$this->purchase_details_model->select(array('purchase_id'=>$this->uri->segment(3)));
		foreach ($res as $key) {
			$product=$this->product_model->findbyid($key->product_id);
			$unit=$this->unit_model->findbyid($key->unit_id);
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td colspan='2'>".$product->title."</td>";
			echo "<td>".$key->quantity."</td>";
			echo "<td>".$unit->title."</td>";
			echo "<td>".number_format($key->price)." دینار</td>";
			echo "<td>".number_format($key->price*$key->quantity)." دینار</td>";
			echo "</tr>";
			$no++;
			$total=$key->price * $key->quantity;
			$invoice_total=$invoice_total + $total;
		}
		?>
		<tr>
			<td class=" text-center" colspan="6">کۆی گشتی (Grand Total) : </td>
			<td class="sum"><p class="underline"><?php echo number_format($invoice_total) ?> دینار</p></td>
		</tr>
		<tr>
			<td class="red-text text-center" colspan="6">داشکاندن (Discount) : </td>
			<td class="red-text ">( <?php echo number_format($purchase->discount) ?> دینار )</td>
		</tr>
		<tr>
			<td class=" text-center" colspan="6">کۆی گشتی و داشکاندن(Grand Total With Discount): </td>
			<td class="sum"><p class="underline"><?php echo number_format($invoice_total-$purchase->discount) ?> دینار</p></td>
		</tr>
		<tr><td colspan="6" class="payment_title">.: پارەی دراو (Payment) :.</td></tr>
		<thead >
			<th >#</th>
			<th >شێواز (Payment Kind) :</th>
			<th >بەروار (Date) :</th>
			<th colspan="2">تێبینی (Description) :</th>
			<th>بڕی پارە (Amount)</th>
		</thead>
		<?php
		$paid=$this->purchase_payment_model->select(array('purchase_id'=>$purchase->id));
		$total_paid=0;
		foreach ($paid as $key) { ?>
					<tr>
						<td class="text-center"><?php echo $key->id; ?></td>
						<td class="text-center" colspan='1'><?php echo $key->type ?></td>
						<td class="text-center" colspan="1"><?php echo $key->date_time ?></td>
						<td class="text-center" colspan="2"><?php echo $key->description ?></td>
						<td class="text-center"><?php echo number_format($key->amount)?> دینار</td>
					</tr>
				<?php
				$total_paid=$total_paid +$key->amount;
				}	?>
				<tr>
					<td  colspan="6">کۆی پارەی دڕاو بۆ ئەم فاکتورە (Payment Due this Invoice):</td>
					<td >(<?php echo number_format($total_paid )?> دینار)</td>
				</tr>
				<tr>
					<td  class="red-text" colspan="6">بڕی پارەی ماوە سەبارەت بە ئەم فاکتورە (Debt Due this invoice): </td>
					<td  class="sum red-text"><p class="underline"><?php echo number_format($invoice_total-$purchase->discount-$total_paid )?> دینار</p></td>
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
