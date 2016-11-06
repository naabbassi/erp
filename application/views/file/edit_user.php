 <?php  $edit_item=$this->user_model->findbyid($edit_id); ?>
<div id="form">
<?php echo form_open_multipart('file/update_user/'.$edit_id,array('class' => 'form-horizontal')); ?>

  <div class="form-group">
    <label class="col-sm-4 control-label">نێو :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="f_name" value="<?= $edit_item->f_name ?>" placeholder="نێوی یەکەم" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باب:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="m_name" value="<?= $edit_item->m_name ?>" placeholder="نێوی دووەم" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باپیر:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="l_name" value="<?= $edit_item->l_name ?>" placeholder="نێوی سێیەم" required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون: </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone" value="<?= $edit_item->phone ?>"  placeholder="ژمارە تلفون  " required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">شوێن : </label>
    <div class="col-sm-8">
      <textarea name="address" class="form-control" rows="3"><?= $edit_item->address ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">ئیمەیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="email" value="<?= $edit_item->email ?>" placeholder="ئیمەیل"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی بەکارهێنەر </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="username" value="<?= $edit_item->username ?>" placeholder="username"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">وشەی نەهێنی </label>
    <div class="col-sm-8">
      <input class="form-control" type="password" name="password" value="" placeholder="وشەی نەهێنی"  required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-info ">گۆرانکاری ئەنجام بدە </button>
    </div>
  </div >
<?php echo form_close (); ?>
</div>