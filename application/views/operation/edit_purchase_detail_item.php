<?php $purchase_item=$this->purchase_details_model->findbyid($this->uri->segment(3));
$product=$this->product_model->findbyid($purchase_item->product_id);
echo form_open('operation/update_purchase_item/'.$purchase_item->id,array('class'=>'form-horizontal','id'=>'update_purchase_item')) ?>
<div class="form-group">
        <label  class="col-sm-4 control-label">کۆگا :</label>
        <div class="col-sm-8">
          <select class="form-control" name='storage_id' required>
            <option></option>
          <?php $storage=$this->storage_model->all();
              foreach ($storage as $item) {
                if($item->id == $purchase_item->storage_id){$selected="selected";} else {$selected="";}
              echo "<option value='$item->id' $selected>$item->title</option>"  ;
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
                if($item->id == $product->cat_id){$selected="selected";} else {$selected="";}
              echo "<option value='$item->id' echo $selected>$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">کاڵا :</label>
        <div class="col-sm-8" id="product_loader">
        <select class="form-control" name='product_id' required>
            <option></option>
          <?php $products=$this->product_model->select(array('cat_id'=>$product->cat_id));
              foreach ($products as $item) {
                if($item->id == $purchase_item->product_id){$selected="selected";} else {$selected="";}
              echo "<option value='$item->id' echo $selected>$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="unit_loader">
        <select class="form-control" name='unit_id' required>
            <option></option>
          <?php $units=$this->unit_model->select(array('product_id'=>$purchase_item->product_id));
              foreach ($units as $item) {
                if($item->id == $purchase_item->unit_id){$selected="selected";} else {$selected="";}
              echo "<option value='$item->id' echo $selected>$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">هەژمار :</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $purchase_item->quantity ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">نرخی یەکە :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="price" id="price" value="<?php echo $purchase_item->price ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-md-12">
      <button type="submit" class="btn btn-success ">بگورە <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div>
  </div>
