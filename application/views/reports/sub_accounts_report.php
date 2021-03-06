<html>
<head>
	<meta charset="utf-8">
	<title>Sub Accounts Report</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/trial_balance.css">
	<style type="text/css">
		*{
			font-size:14px !important;
		}
		table tr td,p{
			line-height:22px;
		}
		.left{
			text-align:left;
			padding-right:15px;
		}
		.blue{
			color:#8b4d28;
		}
	</style>
</head>
<body>
<div class="container">
	<div style="padding:15px 15px 10px 0; text-align:right;top:15px;width:500px !important;height:80px !important;">
		<?php
			$group=$this->group_accounts_model->findbyid($this->input->post('group_id'));
			$ledger=$this->ledger_accounts_model->findbyid($this->input->post('ledger_id'));
			$sub=$this->sub_accounts_model->findbyid($this->input->post('sub_id'));
		 ?>
		<p>گروپی هەژمار : <?php echo $group->title; ?></p>
		<p>هەژماری سەڕەکی : <?php echo $ledger->title.' ('.$this->input->post('ledger_id').')'; ?></p>
		<p style="width: 100%">ژێر هەژمار : <?php echo $sub->title.' ('.$this->input->post('sub_id').')'; ?></p>
	</div>
		<div class="clearfix">
	<table>
		<tr>
			<td class="bold">Record ID</td>
			<td class="bold">Item ID</td>
			<td class="bold">Describtion</td>
			<td class="bold">Debit</td>
			<td class="bold">Credit</td>
			<td class="bold" style="min-width:80px;">Item Date</td>
		</tr>
		<?php
		$items=$this->accounting_record_items_model->select(array('group_id'=>$this->input->post('group_id'),'ledger_id'=>$this->input->post('ledger_id'),'sub_id'=>$this->input->post('sub_id')));
		$debit=0;
		$credit=0;
		foreach ($items as $key) {
			$debit=$debit + $key->debit;
			$credit=$credit + $key->credit;
			$sub=$this->sub_accounts_model->findbyid($key->sub_id);
		 ?>
			<tr>
				<td class="bold"><?php echo $key->record_id ?></td>
				<td><?php echo $key->id ?></td>
				<td class="left">
					<p><?php echo $key->title ?></p>
					<p class="blue">(<?php echo $this->details->get_title($key->sub_id,$key->detail_id); ?>)</p>
				</td>
				<td><?php echo number_format($key->debit,2); ?>$</td>
				<td><?php echo number_format($key->credit,2); ?>$</td>
				<td><?php echo $key->item_date; ?></td>
			</tr>
		<?php }
		 ?>
		 <tr>
		 	<td class="bold" colspan="3">Balance :</td>
		 	<td class="bold"><?php echo number_format($debit,2); ?>$</td>
		 	<td class="bold"><?php echo number_format($credit,2); ?>$</td>

		 </tr>
	</table>
</div>
</body>
</html>