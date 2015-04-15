<?php
	if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
		$res=$this->ledger_accounts_model->select(array('group_id'=>$this->uri->segment(3))); ?>
				<option></option>
			<?php foreach ($res as $key) { ?>
				<option value="<?php echo $key->id ?>"><?php echo $key->title ?></option>
		<?php }
	}else
	{
		echo "<option>Error</option>";
	}
?>