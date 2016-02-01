
  <?php  $edit_item=$this->customer_model->findbyid($edit_id); ?>
<?php echo form_open('define/update_customer/'.$edit_id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێو :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="f_name" value="<?php echo $edit_item->f_name ?>" >
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باب:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="m_name" value="<?php echo $edit_item->m_name ?>" >
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باپیر:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="l_name" value="<?php echo $edit_item->l_name ?>" >
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone"  value="<?php echo $edit_item->phone ?>">
    </div>
  </div>
  <div class="form-group">
	 <label  class="col-sm-4 control-label">جوری موشتەری : </label>
	 <div class="col-sm-8">
		 <select class="form-control" name="type">
			 <option value="buyer" <?php if($edit_item->type == 'buyer') echo 'selected'; ?>>کڕیار</option>
			 <option value="saler" <?php if($edit_item->type == 'saler') echo 'selected'; ?>>فرۆشیار</option>
			 <option value="double" <?php if($edit_item->type == 'double') echo 'selected'; ?>>کڕیار و فرۆشیار</option>
		 </select>
	 </div>
 </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">شوێن : </label>
    <div class="col-sm-8">
      <textarea name="address" class="form-control" rows="3"><?php echo $edit_item->address ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">ئیمەیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="email" value="<?php echo $edit_item->email ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">کەفیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="suporter" value="<?php echo $edit_item->suporter ?>" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('define/customer','پاشگەز بۆنەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div >
<?php echo form_close (); ?>
<?php echo form_close (); ?>
</div>
