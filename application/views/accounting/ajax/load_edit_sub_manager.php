   <?php 
   		$res=$this->sub_accounts_model->select_row(array('id'=>$this->uri->segment(3)));
    ?>
<div class="form-group">
		<label class="col-sm-4 control-label">سەردێری ژێر هەژمار :</label>
		  <div class="col-sm-8">
		    <input type="text" class="form-control" name="title" value="<?php echo $res->title; ?>">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-sm-4 control-label">جوری وردە هەژمار :</label>
		  <div class="col-sm-8">
			<select class="form-control" name="detail_kind">
				<option value="0" <?php if($res->detail_kind == 0) echo "selected"; ?> >هیچ</option>
				<option value="1" <?php if($res->detail_kind == 1) echo "selected"; ?> >هەژماری سەربەخۆ</option>
				<option value="2" <?php if($res->detail_kind == 2) echo "selected"; ?> >موشتەرێکان</option>
				<option value="3" <?php if($res->detail_kind == 3) echo "selected"; ?> >کاسی مەسروفات</option>
				<option value="4" <?php if($res->detail_kind == 4) echo "selected"; ?> >کارمەندان</option>
				<option value="5" <?php if($res->detail_kind == 5) echo "selected"; ?> >خاوەنەکان</option>
				<option value="6" <?php if($res->detail_kind == 6) echo "selected"; ?> >کەل و پەل</option>
				<option value="7" <?php if($res->detail_kind == 7) echo "selected"; ?> >هەژمارە بانکێکان</option>
				<option value="8" <?php if($res->detail_kind == 8) echo "selected"; ?> >هەژمارە گشتیەکان</option>
			</select>
		  </div>
		</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-primary" value="پاشکەوت کردن">
<button type="button" class="btn btn-default" data-dismiss="modal">داخستن</button>
</div>