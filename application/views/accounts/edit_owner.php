<?php 
    $edit=$this->owners_model->findbyid($this->uri->segment(3));
    echo form_open_multipart('accounts/update_stock_holder/'.$edit->id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێر :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title" value="<?php echo $edit->title; ?>" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="name" value="<?php echo $edit->name; ?>" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">پاش ناو:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="family" value="<?php echo $edit->family; ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone" value="<?php echo $edit->phone; ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">رادەی بەشداربون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="equity_percent"  value="<?php echo $edit->equity_percent; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">شوێن </label>
    <div class="col-sm-8">
      <textarea name="address" class="form-control" rows="4"><?php echo $edit->address; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('accounts/stock_holders','پاشگەز بونەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div >
<?php echo form_close (); ?>