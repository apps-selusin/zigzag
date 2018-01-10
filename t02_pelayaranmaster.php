<?php

// pelayaran
?>
<?php if ($t02_pelayaran->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t02_pelayaran->TableCaption() ?></h4> -->
<table id="tbl_t02_pelayaranmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t02_pelayaran->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t02_pelayaran->pelayaran->Visible) { // pelayaran ?>
		<tr id="r_pelayaran">
			<td><?php echo $t02_pelayaran->pelayaran->FldCaption() ?></td>
			<td<?php echo $t02_pelayaran->pelayaran->CellAttributes() ?>>
<span id="el_t02_pelayaran_pelayaran">
<span<?php echo $t02_pelayaran->pelayaran->ViewAttributes() ?>>
<?php echo $t02_pelayaran->pelayaran->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
