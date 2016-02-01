<?php
	if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
		$res=$this->ledger_accounts_model->select(array('group_id'=>$this->uri->segment(3)));
			foreach ($res as $key) { ?>
				<div class="btn-group">
				  <button type="button" class="btn btn-info dropdown-toggle btn-sm " data-toggle="dropdown"><?php echo $key->title ?> <span class="caret"></span></button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="<?php echo $key->id ?>" id="ledger_select">هەلبژێرە</a></li>
				    <li class="divider"></li>
				    <li><a href="<?php echo $key->id ?>" id="add_sub">زیاد کردنی ژێر هەژمار</a></li>
				    <li class="divider"></li>
				    <li><a href="<?php echo $key->id ?>" id="edit_ledger">گورانکاری</a></li>
				    <li><a href="<?php echo $key->id ?>" id="delete_ledger">رەش کردنەوە</a></li>
				  </ul>
				</div>
		<?php }
	}else
	{
		echo "<div class='alert alert-info'>Error</div>";
	}
?>