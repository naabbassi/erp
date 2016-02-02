<?php $payment=$this->purchase_payment_model->findbyid($this->uri->segment(3));
 echo form_open('operation/update_purchase_payment/'.$payment->id,array('class' => 'form-horizontal')); ?>
  <div class="form-group">
      <label  class="col-sm-4 control-label">موشتەری :</label>
      <div class="col-sm-8">
        <select class="form-control" name='customer_id' id='customer' required>
          <option></option>
        <?php $customer=$this->customer_model->all();
            foreach ($customer as $item) {
              if($item->id == $payment->customer_id) { $selected="selected"; } else { $selected=""; }
            echo "<option value='$item->id' $selected >$item->f_name $item->m_name</option>"  ;
            }
         ?></select>
      </div>
  </div>
  <div class="form-group">
        <label  class="col-sm-4 control-label">فاکتور :</label>
        <div class="col-sm-8" id="invoice">
        <select class="form-control" name='purchase_id' required>
          <option></option>
        <?php $sale=$this->purchase_model->select(array('customer_id'=>$payment->customer_id));
            foreach ($sale as $item) {
              if($item->id == $payment->purchase_id) { $selected="selected"; } else { $selected=""; }
                echo "<option value='$item->id' $selected >$item->id - $item->date_time</option>"  ;
            }
         ?></select>
      </div>
      </div>
  <div class="form-group">
    <label  class="col-sm-4 control-label">شێواز :</label>
    <div class="col-sm-8">
      <select name="payment_type" class="form-control" required>
        <option value="نەقد - دەستی" <?php if($payment->type=="نەقد - دەستی") echo "selected"; ?>>نەقد - دەستی</option>
        <option value="نەقد - دەستی" <?php if($payment->type=="نەقد - دەستی") echo "selected"; ?>>نەقد - بانک</option>
        <option value="نەقد - چەک" <?php if($payment->type=="نەقد - چەک") echo "selected"; ?>>نەقد - چەک</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">بڕی پارە :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="payment_amount" value="<?php echo $payment->amount; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">رێکەوت :</label>
    <div class="col-sm-8">
      <input class="form-control" type="date" name="payment_date" value="<?php echo $payment->date_time; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تێبینی :</label>
    <div class="col-sm-8">
      <textarea name="payment_description" class="form-control" rows="4"><?php echo $payment->description; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button class="btn btn-success" type="submit">پاشکەوت کردن</button>&nbsp;&nbsp;&nbsp;&nbsp;
      <?= anchor('operation/purchase_payment', 'پاشگەزبونەوە',array('class'=>'btn btn-primary')); ?>
    </div>
  </div>
<?php echo form_close (); ?>
