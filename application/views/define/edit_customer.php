
  <?php  $edit_item=$this->customers_model->findbyid($edit_id); ?>
<?php echo form_open('file/update_customer/'.$edit_id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی بنکە :</label>
    <div class="col-sm-8">
      <select name="center_id" class="form-control" required> 
      <option></option>       
        <?php $centers=$this->centers_model->all();
              $select='';
              foreach ($centers as $item) {
                if ($item->id==$edit_item->center_id) $select='selected';
                echo "<option value='$item->id' $select >$item->title</option>";
              }
         ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێو سێ یانی :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="name" value="<?php echo $edit_item->name ?>" required />
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone"  value="<?php echo $edit_item->phone ?>" required />
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">شوێن : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="address"  value="<?php echo $edit_item->address ?>" required />
    </div>
  </div>
     <div class="form-group">
    <label class="col-sm-4 control-label">کەفیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="suporter" value="<?php echo $edit_item->suporter ?>" required />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('file/customers','پاشگەز بۆنەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>
<?php echo form_close (); ?>
</div>
