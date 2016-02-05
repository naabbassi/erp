<html>
<head>
	<meta charset="utf-8">
	<title>راپورتی کالا</title>
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
					<th>ژ . فاکتور</th>
          <th>بەروار</th>
					<th>فرۆشیار</th>
					<th>هەژمار</th>
					<th>نرخ</th>
          <th>کۆ</th>
				</thead>
		<?php
		$purchases = $this->purchase_details_model->select(array('product_id'=>$this->uri->segment(3)),'date_time');
    $row_count= 0;
		foreach ($purchases as $item) {
		  $purchase=$this->purchase_model->findbyid($item->purchase_id);
      $customer = $this->customer_model->select_row(array('id'=>$purchase->customer_id));
			$unit=$this->unit_model->findbyid($item->unit_id);
      $row_count ++;
       ?>
		<tr>
			<td><?php echo $row_count; ?></td>
			<td><?php echo $purchase->id; ?></td>
      <td><?php echo $purchase->date_time; ?></td>
			<td><?php echo $customer->f_name.' '.$customer->m_name.' '.$customer->l_name; ?></td>
			<td><?php echo $item->quantity.' '.$unit->title; ?></td>
			<td><?php echo number_format($item->price,2); ?></td>
      <td><?php echo number_format($item->price * $item->quantity,2); ?></td>
		</tr>

			<?php } ?>
			<table>
      <br>
      <table>
        <thead>
          <th>#</th>
          <th>ژ . فاکتور</th>
          <th>بەروار</th>
          <th>کڕیار</th>
          <th>هەژمار</th>
          <th>نرخ</th>
          <th>کۆ</th>
        </thead>
    <?php
    $sales = $this->sale_details_model->select(array('product_id'=>$this->uri->segment(3)));
    $row_count = 0;
    foreach ($sales as $item) {
      $sale=$this->sale_model->findbyid($item->sale_id);
      $customer = $this->customer_model->findbyid($sale->customer_id);
      $unit=$this->unit_model->findbyid($item->unit_id);
      $row_count ++;
       ?>
    <tr>
      <td><?php echo $row_count; ?></td>
      <td><?php echo $sale->id; ?></td>
      <td><?php echo $sale->date_time; ?></td>
      <td><?php echo $customer->f_name.' '.$customer->m_name.' '.$customer->l_name; ?></td>
      <td><?php echo $item->quantity.' '.$unit->title; ?></td>
      <td><?php echo number_format($item->price,2); ?></td>
      <td><?php echo number_format($item->price * $item->quantity,2); ?></td>
    </tr>

      <?php } ?>
      </table>
	</div>
</body>
</html>
