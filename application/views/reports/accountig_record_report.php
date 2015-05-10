<title>Empty</title>
<?php
	if ($this->uri->segment(3)) {
		$count=$this->accounting_record_model->count(array('id'=>$this->uri->segment(3)));
		if ($count==1) {
			$record=$this->accounting_record_model->findbyid($this->uri->segment(3));
			$user=$this->user_model->select_row(array('user_id'=>$record->user_id));
			$company=$this->company_model->get_first()->row();
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Accounting Record : <?php echo $record->id ?></title>
	<style type="text/css">
	@font-face {
	font-family: 'droid';
	src: url('<?php echo base_url(); ?>asset/fonts/droidnaskh-regular.ttf');
	font-weight: bold;
	}
	*{
		padding:0;
		margin: 0;
		font-family:'droid';
		font-size-adjust: 0.5 !important;
		letter-spacing:0.5px;
		direction:rtl;
	}
	.container{
		width:980px;
		margin:0 auto;
		position: relative;
		overflow:hidden;
	}
	.title{
		text-align:center;
		top:110px;
		width:100%;
		font-size:24px;
		margin-top:10px;
		color:#555;
	}
	.details{
		position:absolute;
		top:25px;
		left:0px;
		width:22%;
	}
	.details p{
		width:100%;
		font-size:14px;
		line-height:22px;
		margin:0;	
		padding:0;
		text-align:right;
	}
	.clear{
		clear:both;
	}
	.success{
		color:green;
	}
	.danger{
		color:red;
	}
	.items{
		width:50%;
		display:inline-block;
		margin-top:7px;
		line-height:28px; 
		font-size:16px;
		text-align:left;
		float:left;
		padding-bottom:12px;
	}
	.items img{
		max-width:200px;
		min-width:200px;
		float:right;
	}.items label{
		color:#333;
		width:175px;
		display:inline-block;
	}
	.items p{
		border-bottom:1px dotted #3399cc;
		margin-right:20px;
		color:brown;
	}
	.payable{
		background:#3399cc;
		padding-left:10px;
	}
	.payable label, .payable span{
		color:#fff;
		font-family:'eras-bold';
	}
	.sign{
		text-align:left;
	}
	p{
		padding:2px 7px;
		font-size:15px;
	}
	hr{
		height:0;
		margin:10px 0 10px -10px;
		border-top:1px solid #3399cc;
	}
	h4{
		font-size:18px;
		text-align:center;
		padding-top:10px;
		color:#3399cc;
	}
	table{
		width:100%;
		border-collapse:collapse;
		font-size:16px;
	}
	table tr td{
		border:1px solid #777;
		text-align:center;
		padding:3px 0;
	}
	table tr:first-child td{
		height:36px;
		background:#dcdcdc;
		color:#333 !important;

	}
	.small{
		font-size:12px !important;
		width:50px !important;
	}
	.green{
		color:green;
	}
	.red{
		color:red;
	}
	.brown{
		color:#712f00;
	}
	.blue2{
		color:#00576d;
	}
	.blue{
		color:#3399cc;
	}
	.ledger{
		text-align:right;
		font-size:16px;
		padding:3px 10px;
	}
	.sub{
		text-align:right;
		font-size:14px;
	}
	.item_details{
		text-align:right;
		padding-left:10px;
		font-size:12px;
	}

	</style>
</head>
<body>
<div class="container">
	<div class="details">
		<p>ژمارەی بەڵگە : <span class="red"><?php echo $record->id; ?></span></p>
		<?php $date = date_create($record->record_date); ?>
		<p>بەروار : <?php echo date_format($date,"Y/m/d"); ?></p>
		<p>بەکارهێنەر : <?php echo $user->f_name.' '.$user->m_name; ?></p>
	</div>
	<h2 class="title"><?php echo $company->title; ?></h2>
	<h4 >بەڵگەی ژمێریاری</h4>
	<br><br>
	<p>سەردێر : <?php echo $record->title; ?></p>
	<p>شرۆڤە : <?php echo $record->description; ?></p>
	<table>
		<tr>
			<td class="small" >ژمارەی</td>
			<td class="small" >کۆدی هەژمار</td>
			<td>ناوەرۆک</td>
			<td>قەرزدار ($)</td>
			<td>قەرزدەری ($)</td>
		</tr>
		<?php
		$debit=0;$credit=0;
		$items=$this->accounting_record_items_model->select(array('record_id'=>$record->id));
		foreach ($items as $key) {
		$debit=$debit+$key->debit;
		$credit=$credit+$key->credit;
		$ledger=$this->ledger_accounts_model->findbyid($key->ledger_id);
		$sub=$this->sub_accounts_model->findbyid($key->sub_id); ?>
			<tr>
				<td class="small"><?php echo $key->id; ?></td>
				<td class="small"><?php echo $key->group_id.$key->ledger_id.'<br>'; echo $key->sub_id.'<br>'; echo $this->details->get_code($key->sub_id,$key->detail_id);?></td>
				<td> 
					 <p class="ledger"><?php echo $ledger->title;?></p>
					 <p class="sub"><span class="brown"><?php echo $sub->title.' - ';?></span><span class="blue2"><?php echo $this->details->get_title($key->sub_id,$key->detail_id); ?></span></p>
					 <p class="item_details"><?php if(!empty($key->title)){ echo '('.$key->title.')';} ?></p>
				</td>
				<td ><?php echo number_format($key->debit,2); ?> $</td>
				<td ><?php echo number_format($key->credit,2); ?> $</td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="3">کۆ : </td>
			<td><?php echo number_format($debit,2); ?> $</td>
			<td><?php echo number_format($credit,2); ?> $</td>
		</tr>
	</table>
	<br><br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;پەسەند کرا لە لایەن :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ئامادە کراوە لە لایەن :<br>
</div>
</body>
</html>
<?php			
		}
	}
 ?>