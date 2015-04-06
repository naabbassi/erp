<?php if (isset($_SESSION['payment'])) { ?>
<table class="table table-striped table-condensed table-hover">
	<thead>
		<th>شێواز</th>
		<th>بڕی پارە</th>
		<th>رێکەوت</th>
		<th>تێبینی</th>
		<th></th>

	</thead>

		<?php
					echo "<tr>";
					echo "<td class='text-warning'>".$_SESSION['payment']['type']."</td>";
					echo "<td class='text-info'>".$_SESSION['payment']['amount']."</td>";
					echo "<td class='text-info'>".$_SESSION['payment']['date']."</td>";
					echo "<td class='text-info'>".$_SESSION['payment']['description']."</td>";
					echo "<td class='text-info'><a href='' id='payment_delete'>X</a></td>";
					echo "</tr>";
		 ?>
	</tr>
	<tr class="success">

	</tr>
</table>
<?php }else {
	echo "<p class='text-info' >هیچ بڕی پارەیەک تۆمار نەکراوە.</p>";
} ?>