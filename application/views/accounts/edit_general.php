<?php 
	$edit=$this->general_model->findbyid($this->uri->segment(3));
	 echo form_open('accounts/update_general/'.$edit->id,array('class' => 'form-horizontal')); ?>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-3 control-label">سەردێری هەژمار : </label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" name="title" id="title" value="<?php echo $edit->title; ?>" required>
	    </div>
	</div>
	  <div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	      <button type="submit" class="btn btn-success" id="form_submit">پاشکەوت بکە</button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <?= anchor('accounts/general','پاشگەزبونەوە', array('class'=>'btn btn-primary')); ?>
	    </div>
	  </div>
<?php echo form_close(); ?>