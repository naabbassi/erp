<table class="table table-striped table-condensed table-hover">
	<thead>
		<th>#</th>
		<th>کۆگا</th>
		<th>بەرهەم</th>
		<th>هەژمار</th>
		<th>یەکە</th>
		<th>نرخ</th>
		<th>نرخی گشتی</th>
		<th>کارگێری</th>
	</thead>

		<?php $no=1;
				foreach ($this->cart->contents() as $items) {
					echo "<tr>";
					$options=$this->cart->product_options($items['rowid']);
					$storage=$this->storage_model->findbyid($options['storage_id']);
					$product=$this->product_model->findbyid($items['id']);
					$unit=$this->unit_model->findbyid($items['name']);
					echo "<td class='text-info'>$no</td>";
					echo "<td class='text-primary'>$storage->title</td>";
					echo "<td class='text-primary'>$product->title</td>";
					echo "<td class='text-warning'>$items[qty]</td>";
					echo "<td class='text-info'>$unit->title</td>";
					echo "<td class='text-danger'>$items[price] $</td>";
					echo "<td class='text-success'>$items[subtotal] $</td>";
					echo "<td><a href='$items[rowid]' id='delete'>ڕەش کردنەوە</a>";
					echo "</tr>";
					$no++;
				}
		 ?>
	</tr>
	<tr class="success">
		<td colspan="5" class="text-center">کوی گشتی :</td>
		<td><?php echo $this->cart->total_items(); ?></td>
		<td class="text-info"><?php echo $this->cart->total(); ?> $</td>
	</tr>
</table>