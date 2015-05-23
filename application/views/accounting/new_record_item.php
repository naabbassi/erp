<?php 
echo form_open('accounting/insert_record_new_item/'.$this->uri->segment(3),array('class'=>'form-horizontal','id'=>'new_record_item_form','role'=>'form')); ?>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">گروپی هەژمار :</label>
			    <div class="col-sm-8">
				    <select name="group_id" class="form-control" id="group_accounts" required>
				    	<option></option>
				    	<?php
				    	$res=$this->group_accounts_model->all();
				    	foreach ($res as $key) {
				    		echo "<option value='".$key->id."' >".$key->title."</option>";
				    	}
				    	?>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">هەژماری سەرەکی :</label>
			    <div class="col-sm-8">
				    <select name="ledger_id" class="form-control" id="ledger_accounts" required>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">ژێر هەژمارە :</label>
			    <div class="col-sm-8">
				    <select name="sub_id" class="form-control" id="sub_accounts" required>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">هەژماری ورد :</label>
			    <div class="col-sm-8" id="detail_accounts">
				</div>
			  </div>
			  <div class="form-group">
				  	<label class="col-sm-4 control-label">سەردێر :</label>
			  	<div class="col-sm-8">
				  	<input class="form-control" name="title" type="text" >
			  	</div>
			  </div>
			  <div class="form-group">
				  	<label class="col-sm-4 control-label">بەروار :</label>
			  	<div class="col-sm-8">
				  	<input class="form-control" name="item_date" type="date" >
			  	</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">قەرزدار</label>
			    <div class="col-sm-8">
				    <div class="input-group">
				      <input class="form-control" type="text" id="debit" name="debit" placeholder="Debit Amount" >
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">قەرز دێر</label>
			    <div class="col-sm-8">
				    <div class="input-group">
				      <input class="form-control" type="text" id="credit" name="credit" placeholder="Credit Amount" >
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
	     <div class="form-group">
	        <div class="col-sm-offset-4 col-sm-5">
	          <button type="submit" id="cost_form_submit" class="btn btn-success">زیاد بکە</button>
	        </div>
      </div>
	</form>