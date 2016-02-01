<?php
	if ($this->uri->segment(3)) {
		$salary=$this->salary_model->select_row(array('id'=>$this->uri->segment(3)));
		$person=$this->personnels_model->select_row(array('id'=>$salary->personnel_id));
		$month=$this->month_model->select_row(array('id'=>$salary->mon_id));
		$imprest=$this->imprest_model->select(array('personnel_id'=>$salary->personnel_id,'mon_id'=>$salary->mon_id));
	}
 ?>
<html>
<head>
	<title>Salary Report</title>
	<meta charset="utf-8"/>
	<style type="text/css">
	@font-face {
	font-family: 'eras-regular';
	src: url('<?php echo base_url(); ?>asset/fonts/eras_regular.ttf');
	font-weight: bold;
	}
	@font-face {
	font-family: 'eras-bold';
	src: url('<?php echo base_url(); ?>asset/fonts/eras_bold.ttf');
	font-weight: bold;
	}
	@font-face {
	font-family: 'eras-light';
	src: url('<?php echo base_url(); ?>asset/fonts/eras_light.ttf');
	font-weight: bold;
	}
	*{
		padding:0;
		margin: 0;
		font-family:'eras-regular';
		font-size-adjust: 0.5 !important;
		letter-spacing:0.5px;
	}
	.container{
		width:980px;
		height:1290px;
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
		right:0px;
		width:22%;
	}
	.details p{
		width:100%;
		font-size:16px;
		line-height:22px;
		margin:5px 0;
		color:#333;
		padding:0;
		text-align:left;
	}
	.logo{
		left:25px;
		top:0px;
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
		margin-right:30px;
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
	hr{
		height:0;
		margin:10px 0 10px -10px;
		border-top:1px solid #3399cc;
	}
	h4{
		color:#3399cc;
		font-family:'eras-bold';
		font-size:20px;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="details">
			<?php $date=date_create($salary->reg_date); ?>
			<p>Date : <?php echo date_format($date,"Y/F/d") ?></p>
			<p>Salary ID : <span class="danger"><?php echo $salary->id ?></span></p>
		</div>
		<div class="logo"><img src="<?php echo base_url() ?>/asset/img/logo.png"></div>
		<h2 class="title">Salary Payment Document</h2>
		<div class="clear"></div>
		<br><br>
		<h4>Employee Information</h4>
		<hr>
		<div class="items">
			<p><label>Employee ID : </label><?php echo $person->id; ?></p>
			<p><label>Name : </label><?php echo $person->name; ?></p>
			<p><label>Family : </label><?php echo $person->family; ?></p>
			<p><label>Sex : </label><?php echo $person->sex; ?></p>
			<p><label>Birth Date : </label><?php echo $person->birth_date; ?></p>
			<p><label>Position : </label><?php echo $person->position; ?></p>
			<p><label>Nationality : </label><?php echo $person->nation; ?></p>
			<p><label>Identity Certificate : </label><?php echo $person->c_type; ?></p>
			<p><label>Certificate No : </label><?php echo $person->c_details; ?></p>
		</div>
		<div class="items">
			<img src="<?php echo base_url().'asset/personnels/'.$person->image ?>">
		</div>
		<div class="clear"></div>
		<br><br>
		<h4>Salary Details</h4>
		<hr>
		<div class="items">
			<p><label>Month : </label><?php echo $month->title ?></p>
			<p><label>Period Start Date : </label><?php echo $salary->start_date ?></p>
			<p><label>Period End Date : </label><?php echo $salary->end_date ?></p>
			<p><label>Overtime Hours : </label><?php echo $salary->overtime ?></p>
			<p><label>Overtime Hour Price : </label><?php echo $salary->overtime_unitprice ?></p>
			<p><label>Reward Description : </label><?php echo $salary->reward_description ?></p>
			<p><label>Deduction Description:</label><?php echo $salary->deduction_description ?></p>
		</div>
		<div class="items">
			<p><label>Period Salary : </label><span class="success"><?php echo number_format($salary->salary,2) ?> $</span></p>
			<p><label>Period Overtime : </label><span class="success"><?php $overtime=($salary->overtime * $salary->overtime_unitprice); echo number_format($overtime,2) ?> $</span></p>
			<p><label>Period Reward : </label><span class="success"><?php echo number_format($salary->reward,2) ?> $</span></p>
			<p><label>Period Deduction : </label><span class="danger"><?php echo number_format($salary->deduction,2) ?> $</span></p>
			<p><label>Imprests : </label><br>
			<?php $imprest_total =0 ; foreach ($imprest as $imp) { 
				echo 'Date : '.$imp->date_time."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount : <span class='danger'>".number_format($imp->amount,2)." $</span><br>" ;
				$imprest_total =$imprest_total + $imp->amount;
			}
			$plus=$salary->salary + $overtime +$salary->reward;
			$deduct=$salary->deduction + $imprest_total;
			$paymentable=$plus - $deduct;
		?></p>
		<p class="payable" ><label>Total Payable : </label><span class="success"><?php echo number_format($paymentable,2); ?> $</span></p>
		</div>
		<p>All Amount paid by this document is :<?php echo $this->numbertowords->convert_number($paymentable).' dollars'; ?></p>
		<div class="clear"></div>
		<br><br><br><br>
		<div class="sign">
			Approved By :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prepared By :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recived By :&nbsp;
		</div>
	</div>
</body>
</html>