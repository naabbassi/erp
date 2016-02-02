<?php echo form_open('operation/insert_purchase_item/'.$this->uri->segment(3),array('class'=>'form-horizontal','id'=>'update_purchase_item')) ?>
<div class="form-group">
        <label  class="col-sm-4 control-label">کۆگا :</label>
        <div class="col-sm-8">
          <select class="form-control" name='storage_id' required>
            <option></option>
          <?php $storage=$this->storage_model->all();
              foreach ($storage as $item) {
              echo "<option value='$item->id' >$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">گرۆپی کاڵاکان :</label>
        <div class="col-sm-8">
          <select class="form-control" name='cat_id' id="cat" required>
            <option></option>
          <?php $cat=$this->cat_model->all();
              foreach ($cat as $item) {
              echo "<option value='$item->id' echo >$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">کاڵا :</label>
        <div class="col-sm-8" id="product_loader">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="unit_loader">
        </div>
    </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">هەژمار :</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="quantity" id="quantity"  required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">نرخی یەکە :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="price" id="price" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-md-12">
      <button type="submit" class="btn btn-success ">زیاد بکە <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
  </div>
