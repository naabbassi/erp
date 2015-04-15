<?php
	$sales=$this->sale_model->select(array('customer_id'=>$this->uri->segment(3)));
 ?>
	<select class="form-control" name='sale_id' id="invoice_list" required>
		<option></option><?php 
  		foreach ($sales as $item) { 
  		echo "<option value='$item->id'>$item->id"." | $item->date_time"."</option>"	;
  		}
   ?>
   </select>