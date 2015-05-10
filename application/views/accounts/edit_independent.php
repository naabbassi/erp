<?php $edit=$this->independent_model->findbyid($this->uri->segment(3));
echo form_open('accounts/update_independent/'.$edit->id,array('class' => 'form-horizontal')); ?>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">ژێر هەژمارەکان : </label>
    <div class="col-sm-9">
      <select class="form-control" name="sub_id">
      	<?php
      		$sub_accounts=$this->sub_accounts_model->select(array('detail_kind'=>'1'));
      		foreach ($sub_accounts as $key) {
      			if($key->id == $edit->sub_id){ $selected="selected"; } else { $selected=""; }
      			echo "<option value='$key->id' $selected>$key->title</option>";
      		}
      	 ?>
      </select>
    </div>
</div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">سەردێری هەژماری سەربەخۆ : </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="title" id="title" value="<?php echo $edit->title ?>" required>
    </div>
</div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-success" id="form_submit">پاشکەوت کردن</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('accounts/independent','پاشگەز بونەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>
<?php echo form_close(); ?>