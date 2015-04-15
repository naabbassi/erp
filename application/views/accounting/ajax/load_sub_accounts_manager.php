<?php
	if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
		$res=$this->sub_accounts_model->select(array('ledger_id'=>$this->uri->segment(3)));
			foreach ($res as $key) { ?>
				<div class="btn-group">
				  <button type="button" class="btn btn-danger dropdown-toggle btn-sm " data-toggle="dropdown"><?php echo $key->title ?> <span class="caret"></span></button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="<?php echo $key->id ?>" id="sub_select">هەلبژێرە</a></li>
				    <li class="divider"></li>
				    <li><a href="<?php echo $key->id ?>" id="edit_sub">گورانکاری</a></li>
				    <li><a href="<?php echo $key->id ?>" id="sub_delete">رەش کردنەوە</a></li>
				  </ul>
				</div>

    <?php }	} else
	{
		echo "<option value='0'>Select Ledger Account</option>";
	}
?>