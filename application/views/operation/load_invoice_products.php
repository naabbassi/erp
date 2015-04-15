<?php
	$sales=$this->sale_details_model->select(array('sale_id'=>$this->uri->segment(3)));
 ?>
	<select class="form-control" name='sale_id' id="product_id" required>
		<option></option><?php 
  		foreach ($sales as $item) { 
  			$product=$this->product_model->findbyid($item->product_id);
  		echo "<option value='$product->id'>$product->title</option>"	;
  		}
   ?>
   </select>