<?php
	$id='';
	$customer_id='';
		if ($this->input->post('sale_id') > 0) { $id=array('id'=>$this->input->post('sale_id'));} else { $id=array(); }
		if ($this->input->post('customer_id') > 0) { $customer_id=array('customer_id'=>$this->input->post('customer_id'));} else { $customer_id=array(); }
		$query=array_merge($id,$customer_id) ;
 ?>
<html>
<head>
	<title>ریزی فاکتورەکانی کڕین</title>
	<style type="text/css">
	@media print {
	.container{
		margin-top:-100px;
	}
    .search_form {
    	display:none !important;
    }
    .operation{
    	display:none !important;
    }
}
	</style>
</head>
<body>
<div class="container">
	<?php
		$this->load->view('nav');
	 ?>
	<h2 class="text-center text-info">ریزی فاکتورەکانی کڕین</h2>
	<hr>
	 <div class="col-md-12">
	 	<?php echo form_open('operation/purchase_list',array('class'=>'form-inline' , 'id'=>'serach_form')); ?>
		    <div class="form-group">
		    	<label>ژمارە فاکتور :</label>
		    	<input type="number" class="form-control" name="sale_id">
			</div>
			<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>موشتەری :</label>
		   	  <select name="customer_id" class="small form-control">
		   	  	<option value="0"></option>
		   	  	<?php
		   	  		$res=$this->customer_model->select(array('type'=>'saler'));
		   	  		foreach ($res as $item) {
		   	  			echo "<option value='".$item->id."'>".$item->f_name.' '.$item->m_name.' '.$item->l_name."</option>";
		   	  		}
							$res=$this->customer_model->select(array('type'=>'double'));
		   	  		foreach ($res as $item) {
		   	  			echo "<option value='".$item->id."'>".$item->f_name.' '.$item->m_name.' '.$item->l_name."</option>";
		   	  		}
		   	  	?>
		   	  </select>
			</div>&nbsp;&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-primary btn-sm">گەڕان</button>
		<?php echo form_close(); ?>
		<div id="table_loader">
	 	<table class="table table-hover table-striped table-bordered" id="table">
	 		<thead >
	 			<th class="text-center">#</th>
	 			<th class="text-center">I.ID</th>
	 			<th class="text-center">موشتەری</th>
	 			<th class="text-center">رێکەوت</th>
	 			<th class="text-center">بڕی پارە</th>
	 			<th class="text-center">داشکاندن</th>
	 			<th class="text-center">دڕاوە</th>
	 			<th class="text-center">بڕی قەرزداری</th>
	 			<th class="text-center operation">کارگێری</th>
	 		</thead>
	 		<?php
	 		if ($this->input->post()) {
	 			$res=$this->purchase_model->select($query);
	 		} else {
	 			$res=$this->purchase_model->all();
	 		}
	 		$discount=0;
	 		$total=0;
	 		$paid=0;
	 		$debet=0;
	 		$no=1;
	 		foreach ($res as $key) { ?>
	 			<tr>
	 				<td class="text-center "><small><?php echo $no; ?></small></td>
	 				<td class="text-center info"><small><?php echo $key->id; ?></small></td>
	 				<td class="text-center text-info"><small><?php $cas=$this->customer_model->select_row(array('id'=>$key->customer_id)); echo $cas->f_name.' '.$cas->m_name;  ?></small></td>
	 				<td class="text-info text-center"><small><?php echo $key->date_time; ?></small></td>
	 				<?php $sum=$this->purchase_details_model->multiple('quantity','price',array('purchase_id'=>$key->id));
	 					  $payment_amount=$this->purchase_payment_model->sum('amount',array('purchase_id'=>$key->id))->amount;
	 				?>
	 				<td class="text-primary text-center"><?php echo number_format($sum); ?> IQD</td>
	 				<td class="text-info text-center"><?php echo number_format($key->discount); ?> IQD</td>
	 				<td class="text-success text-center"><?php echo number_format($payment_amount); ?> IQD</td>
	 				<td class="text-danger text-center"><?php echo number_format($sum-$key->discount-$payment_amount); ?> IQD</td>
	 				<td class="text-center warning operation"><small>
	 					<a href="edit_purchase/<?php echo $key->id; ?>" value="<?php echo $key->title; ?>" id="edit">گۆڕانکاری</a> &nbsp;&nbsp;&nbsp;
	 					<?php 	$atts = array(
			              'width'      => '1100',
			              'height'     => '650',
			              'scrollbars' => 'yes',
			              'status'     => 'yes',
			              'resizable'  => 'yes',
			              'screenx'    => '0',
			              'screeny'    => '0'
			            );
			            echo anchor_popup('operation/purchase_show/'.$key->id,'کردنەوە',$atts) ?>
	 				</small></td>
	 			</tr>
	 		<?php
	 		$no++;
	 		$discount=$discount + $key->discount;
	 		$total=$total + $sum;
	 		$paid=$paid + $payment_amount;
	 		$debet=$debet + (($sum)-($key->discount)-$payment_amount);
	 		 } ?>
	 		 	 			<tr>
	 				<td colspan="4" class="text-center"> کۆی گشتی : </td>
	 				<td class="success text-info text-center" ><small><?php echo number_format($total,2)  ?> IQD</small></td>
	 				<td class="info text-info text-center" ><small><?php echo number_format($discount,2)  ?> IQD</small></td>
	 				<td class="success text-info text-center" ><small><?php echo number_format($paid,2)  ?> IQD</small></td>
	 				<td class="danger text-info text-center" ><small><?php echo number_format($debet,2)  ?> IQD</small></td>
	 			</tr>
	 	</table>
	 </div>
	 </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){

    /* Submit search form */

   $('#serach_form').on('submit',function(e) {
      $('#serach_form button').addClass('disabled');
      $('#serach_form button').text('لە حالی وەرگرتن دایە ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      console.log(data);
	      $('#serach_form button').removeClass('disabled');
	      $('#serach_form button').text('گەڕان');
	      $('#table_loader').html(data);
      },
      error:function(data){
          console.log(data);
          $('#serach_form button').removeClass('disabled');
          $('#serach_form button').text('گەڕان');
          $('#table_loader').html(data);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
  });
</script>
</body>
</html>
