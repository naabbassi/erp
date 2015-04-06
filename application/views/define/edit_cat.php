<?php $data=$this->cat_model->findbyid($edit_id); ?>
<?php echo form_open('define/update_cat/'.$edit_id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێری گرۆپ :</label>
    <div class="col-sm-8">
      <input  class="form-control" type="text" name="title"  value="<?php echo $data->title; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('define/cat','پاشگەز بۆنەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>