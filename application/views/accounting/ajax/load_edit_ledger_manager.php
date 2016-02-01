   <?php 
   		$res=$this->ledger_accounts_model->select_row(array('id'=>$this->uri->segment(3)));

    ?>

   		<div class="form-group">
		<label class="col-sm-4 control-label">سەردێری هەژمار :</label>
		  <div class="col-sm-8">
		    <input type="text" class="form-control" name="title" value="<?php echo $res->title; ?>">
		  </div>
		</div>

		<div class="form-group">
		<label class="col-sm-4 control-label">جوری هەژمار :</label>
		  <div class="col-sm-8">
			<select class="form-control" name="nature">
				<option value="1" <?php if($res->nature == 1) echo "selected"; ?>>Debit and Credit</option>
				<option value="2" <?php if($res->nature == 2) echo "selected"; ?>>Without Credit Balance</option>
				<option value="3" <?php if($res->nature == 3) echo "selected"; ?>>Without Debit Balance</option>
				<option value="4" <?php if($res->nature == 4) echo "selected"; ?>>Just Debit</option>
				<option value="5" <?php if($res->nature == 5) echo "selected"; ?>>Just Credit</option>
			</select>
		  </div>
		</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-primary" value="پاشکەوت کردن">
<button type="button" class="btn btn-default" data-dismiss="modal">داخستن</button>
</div>