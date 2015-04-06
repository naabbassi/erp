<?php $data=$this->storage_model->findbyid($edit_id); ?>
<?php echo form_open('define/update_storage/'.$edit_id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی بنکە :</label>
    <div class="col-sm-8">
      <input  class="form-control" type="text" name="title"  value="<?php echo $data->title; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">بەرێوەبەری بنکە :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="manager" value="<?php echo $data->manager; ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone"  value="<?php echo $data->phone; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('define/storage','پاشگەز بۆنەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>