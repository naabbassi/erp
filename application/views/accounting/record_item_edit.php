<?php $record=$this->accounting_record_items_model->findbyid($this->uri->segment(3));
echo form_open('accounting/update_record_item/'.$record->id,array('class'=>'form-horizontal','id'=>'edit_record_item_form','role'=>'form')); ?>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">گروپی هەژمار :</label>
			    <div class="col-sm-8">
				    <select name="group_id" class="form-control" id="group_accounts" required>
				    	<?php
				    	$res=$this->group_accounts_model->all();
				    	foreach ($res as $key) {
				    		if($key->id==$record->group_id){$selected="selected";}else{$selected="";}
				    		echo "<option value='".$key->id."' $selected>".$key->title."</option>";
				    	}
				    	?>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">هەژماری سەرەکی :</label>
			    <div class="col-sm-8">
				    <select name="ledger_id" class="form-control" id="ledger_accounts" required>
				    	<?php
				    	$res=$this->ledger_accounts_model->select(array('group_id'=>$record->group_id));
				    	foreach ($res as $key) {
				    		if($key->id==$record->ledger_id){$selected="selected";}else{$selected="";}
				    		echo "<option value='".$key->id."' $selected>".$key->title."</option>";
				    	}
				    	?>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">ژێر هەژمارە :</label>
			    <div class="col-sm-8">
				    <select name="sub_id" class="form-control" id="sub_accounts" required>
				    	<?php
				    	$res=$this->sub_accounts_model->select(array('ledger_id'=>$record->ledger_id));
				    	foreach ($res as $key) {
				    		if($key->id==$record->sub_id){$selected="selected";}else{$selected="";}
				    		echo "<option value='".$key->id."' $selected>".$key->title."</option>";
				    	}
				    	?>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">هەژماری ورد :</label>
			    <div class="col-sm-8" id="detail_accounts">
			    	<?php
	$sub=$this->sub_accounts_model->select_row(array('id'=>$record->sub_id));
	$value=$sub->detail_kind;
	switch ($value) {
		case '0':
			echo "<div class='alert alert-info'>هیچ جورە وردە هەژمارێک دابین نەکراوە.</div>";
			break;
		case '1':
			?>
			<strong class="text-info">جوری وردە هەژمار : هەژماری سەربەخۆ کان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<?php $res=$this->independent_model->select(array('sub_id'=>$record->sub_id));
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='$key->id' $selected>".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '2':
			?>
			<strong class="text-info">جوری وردە هەژمار : موشتەرێکان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->customer_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='$key->id' $selected >$key->f_name $key->m_name</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '3':
			?>
			<strong class="text-info">جوری وردە هەژمار : خوبەرێوبەر</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->revolving_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='$key->id' $selected >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '4':
			?>
			<strong class="text-info">جوری وردە هەژمار : کارمەندان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->personnels_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='".$key->id."' $selected >".$key->name.' '.$key->family."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '5':
			?>
			<strong class="text-info">جوری وردە هەژمار : پشک دارەکان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->owners_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='".$key->id."' $selected >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '6':
			?>
			<strong class="text-info">جوری وردە هەژمار : دارایی ثابتەکان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
			<option></option> 
				<?php $res=$this->fix_assets_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='".$key->id."' $selected >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '7':
			?>
			<strong class="text-info">جوری وردە هەژمار : هەژمارە بانکەکان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->banks_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='".$key->id."' $selected >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		case '8':
			?>
			<strong class="text-info">جوری وردە هەژمار : هەژمارە گشتیەکان</strong>
			<select class="form-control" name="detail_id" id="detail_id" required>
				<option></option>
				<?php $res=$this->general_model->all();
				foreach ($res as $key) {
					if($key->id==$record->detail_id){$selected="selected";}else{$selected="";}
					echo "<option value='".$key->id."' $selected >".$key->title."</option>";
				}
				 ?>
			</select>
			<?php
			break;
		default:
			echo '';
			break;
	}
?>
				</div>
			  </div>
			  <div class="form-group">
				  	<label class="col-sm-4 control-label">سەردێر :</label>
			  	<div class="col-sm-8">
				  	<input class="form-control" name="title" type="text" value="<?php echo $record->title; ?>">
			  	</div>
			  </div>
			  <div class="form-group">
				  	<label class="col-sm-4 control-label">بەروار :</label>
			  	<div class="col-sm-8">
				  	<input class="form-control" name="item_date" type="date" value="<?php echo $record->item_date; ?>" required>
			  	</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">قەرزدار</label>
			    <div class="col-sm-8">
				    <div class="input-group">
				      <input class="form-control" type="text" id="debit" name="debit" placeholder="Debit Amount" value="<?php echo $record->debit; ?>" required>
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">قەرز دێر</label>
			    <div class="col-sm-8">
				    <div class="input-group">
				      <input class="form-control" type="text" id="credit" name="credit" placeholder="Credit Amount" value="<?php echo $record->credit; ?>" required>
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
	     <div class="form-group">
	        <div class="col-sm-offset-4 col-sm-5">
	          <button type="submit" id="cost_form_submit" class="btn btn-success">گورانکاری تومار بکە</button>
	        </div>
      </div>
	</form>