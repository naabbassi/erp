<?php
	$units=$this->unit_model->select(array('product_id'=>$this->uri->segment(3)));
 ?>
	<select class="form-control" name='unit_id' required>
		<option></option><?php 
  		foreach ($units as $item) { 
  		echo "<option value='$item->id'>$item->title</option>"	;
  		}
   ?>
   </select>