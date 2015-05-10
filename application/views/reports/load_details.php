<?php
if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
	$sub=$this->sub_accounts_model->select_row(array('id'=>$this->uri->segment(3)));
	$value=$sub->detail_kind;
	switch ($value) {
		case '0':
			echo "<div class='alert alert-info'>not defined any detailed account for this subsaidiary account.</div>";
			break;
		case '1':
			?>
			<strong class="text-info">Detailed type : Independence</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->independent_model->select(array('sub_id'=>$this->uri->segment(3)));
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '2':
			?>
			<strong class="text-info">Detailed type : Customers</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->customer_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->invoice_title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '3':
			?>
			<strong class="text-info">Detailed type : Revolving Fund</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->revolving_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '4':
			?>
			<strong class="text-info">Detailed type : Owners</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->personnels_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->name.' '.$key->family."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '5':
			?>
			<strong class="text-info">Detailed type : Owners</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->owners_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '6':
			?>
			<strong class="text-info">Detailed type : Fix Assets</strong>
			<select class="form-control" name="detail_id" id="detail_id">
			<option></option> 
				<?php $res=$this->fix_assets_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '7':
			?>
			<strong class="text-info">Detailed type : Bank Accounts</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->banks_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '8':
			?>
			<strong class="text-info">Detailed type : General Accounts</strong>
			<select class="form-control" name="detail_id" id="detail_id">
				<option></option>
				<?php $res=$this->general_model->all();
				foreach ($res as $key) {
					echo "<option value='".$key->id."' >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		default:
			echo '';
			break;
	}
}
else
{
	echo "<strong class='text-info'>Select subsaidiary account</strong>";
}
?>