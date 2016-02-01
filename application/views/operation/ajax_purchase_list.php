<?php
	$id='';
	$customer_id='';
		if ($this->input->post('sale_id') > 0) { $id=array('id'=>$this->input->post('sale_id'));} else { $id=array(); }
		if ($this->input->post('customer_id') > 0) { $customer_id=array('customer_id'=>$this->input->post('customer_id'));} else { $customer_id=array(); }
		$query=array_merge($id,$customer_id) ;
 ?>
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
	 				<td class="text-primary text-center"><?php echo number_format($sum); ?> $</td>
	 				<td class="text-info text-center"><?php echo number_format($key->discount); ?> $</td>
	 				<td class="text-success text-center"><?php echo number_format($payment_amount); ?> $</td>
	 				<td class="text-danger text-center"><?php echo number_format($sum - $key->discount-$payment_amount); ?> $</td>
	 				<td class="text-center warning operation"><small>
	 					<a href="edit_purchase/<?php echo $key->id; ?>" value="<?php echo $key->title; ?>" id="edit">گۆڕانکاری</a> &nbsp;&nbsp;&nbsp;
	 					<?php 	$atts = array(
			              'width'      => '1000',
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
	 				<td class="success text-info text-center" ><small><?php echo number_format($total,2)  ?> $</small></td>
	 				<td class="info text-info text-center" ><small><?php echo number_format($discount,2)  ?> $</small></td>
	 				<td class="success text-info text-center" ><small><?php echo number_format($paid,2)  ?> $</small></td>
	 				<td class="danger text-info text-center" ><small><?php echo number_format($debet,2)  ?> $</small></td>
	 			</tr>
	 	</table>
