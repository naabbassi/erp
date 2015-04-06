<?php
	$units=$this->product_model->select(array('cat_id'=>$this->uri->segment(3)));
 ?>
	<select class="form-control" name='product_id' id="product" required>
		<option></option><?php 
  		foreach ($units as $item) { 
  		echo "<option value='$item->id'>$item->title</option>"	;
  		}
   ?>
   </select>