<?php $data=$this->product_model->findbyid($edit_id); ?>
<?php echo form_open('define/update_product/'.$edit_id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
        <label  class="col-sm-4 control-label">گرۆپ :</label>
        <div class="col-sm-8">
          <select class="form-control" name='cat_id' id='cat_id' required>
            <option></option>
          <?php $cats=$this->cat_model->all();
              foreach ($cats as $item) { 
                if ($item->id == $data->cat_id) { $selected = 'selected'; }
                echo "<option value='$item->id' $selected >$item->title</option>"  ;
                $selected='';
              }
           ?></select>
        </div>
      </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی کاڵا :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title" value="<?php echo $data->title ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">قیاسی یەکە :</label>
    <div class="col-sm-8">
      <input class="form-control" type="number" name="scale" value="<?php echo $data->unit_scale ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نرخ :</label>
    <div class="col-sm-8">
      <input class="form-control" type="number" name="price" value="<?php echo $data->price ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button class="btn btn-success" type="submit">پاشکەوت کردن</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('define/product','پاشگەز بۆنەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>
<?php echo form_close (); ?>