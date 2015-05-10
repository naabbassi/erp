<?php
    $sale_back=$this->sale_back_model->findbyid($this->uri->segment(3));
    $sale=$this->sale_model->findbyid($sale_back->sale_id);
    echo form_open('operation/sale_back_update/'.$sale_back->id,array('class'=>'form-horizontal','id'=>'sales')) ?>
      <div class="form-group">
        <label  class="col-sm-4 control-label">موشتەری :</label>
        <div class="col-sm-8">
          <select class="form-control" name='customer_id' id='customer'  required>
            <option></option>
          <?php $customer=$this->customer_model->all();
              foreach ($customer as $item) {
                if ($item->id == $sale->customer_id) { $selected = "selected"; $customer_id= $item->id; } else {$selected = "";}
              echo "<option value='$item->id' $selected>$item->f_name $item->m_name  $item->l_name</option>"  ;
              }
           ?></select>
      </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">فاکتور :</label>
        <div class="col-sm-8" id="invoice">
          <select class="form-control" name='sale_id' id='invoice_list'  required>
            <option></option>
          <?php $sales=$this->sale_model->select(array('customer_id'=>$sale->customer_id));
              foreach ($sales as $item) {
                if ($item->id == $sale->id) { $selected = "selected"; } else {$selected = "";}
              echo "<option value='$item->id' $selected>$item->id  $item->date_time</option>"  ;
              }
           ?></select>
      </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">کاڵا :</label>
        <div class="col-sm-8" id="invoice_products">
        <?php $sales=$this->sale_details_model->select(array('sale_id'=>$sale->id)); ?>
        <select class="form-control" name='product_id' id="product_id" required>
          <option></option><?php 
            foreach ($sales as $item) { 
              if ($item->product_id == $sale_back->product_id) { $selected = "selected";} else {$selected = "";}
              $product=$this->product_model->findbyid($item->product_id);
            echo "<option value='$product->id' $selected>$product->title</option>"  ;
            }
         ?>
         </select>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="unit_loader">
        <?php $units=$this->unit_model->select(array('product_id'=>$sale_back->product_id)); ?>
        <select class="form-control" name='unit_id' required>
          <option></option><?php 
            foreach ($units as $item) { 
              if ($item->id == $sale_back->unit_id) { $selected = "selected";} else {$selected = "";}
            echo "<option value='$item->id' $selected>$item->title</option>"  ;
            }
         ?>
         </select>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">هەژمار :</label>
        <div class="col-sm-8">
          <input type="number" class="form-control"  name="quantity" value="<?php echo $sale_back->quantity; ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">رێکەوت :</label>
        <div class="col-sm-8">
          <input type="date" class="form-control"  data-date-format="YYYY-MM-DD" value="<?php echo $sale_back->date_time; ?>" name="date_time" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">تێبینی:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="description" rows="5"><?php echo $sale_back->description; ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-md-10">
          <button type="submit" class="btn btn-success">پاشەکەوت کردن <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span></button>&nbsp;&nbsp;&nbsp;&nbsp;
         <?= anchor('operation/sale_back','پاشگەزبونەوە',array('class'=>'btn btn-primary')); ?>
        </div>
      </div>
    <?php echo form_close(); ?>