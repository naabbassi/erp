<?php 
  $edit=$this->fix_assets_model->findbyid($this->uri->segment(3));
echo form_open_multipart('accounts/update_fix_asset/'.$edit->id,array('class' => 'form-horizontal')); ?>

  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێر :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title" value="<?php echo $edit->title ?>" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">شوێنی بە کار هێنان:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="position" value="<?php echo $edit->position ?>" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">بەرپرس:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="responsible" value="<?php echo $edit->responsible ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">بەرواری کڕین : </label>
    <div class="col-sm-8">
      <input class="form-control" type="date" name="purchase_date" value="<?php echo $edit->purchase_date ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">جوری استهلاک : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="depreciation_method"  value="<?php echo $edit->depreciation_method ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نرخی کڕین </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="asset_purchase_price" value="<?php echo $edit->asset_purchase_price ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تەمەنی کەرەستە </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="asset_life"  value="<?php echo $edit->asset_life ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">استهلاک کۆبووە </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="accumulated_depreciation"  value="<?php echo $edit->accumulated_depreciation ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تێبینی </label>
    <div class="col-sm-8">
      <textarea name="description" class="form-control" rows="4"><?php echo $edit->description ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('accounts/fix_assets','پاشگەزبونەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div >
<?php echo form_close (); ?>