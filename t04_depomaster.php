<?php

// nama
// alamat
// kota
// propinsi
// no_telp
// no_fax

?>
<?php if ($t04_depo->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t04_depo->TableCaption() ?></h4> -->
<table id="tbl_t04_depomaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t04_depo->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t04_depo->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td><?php echo $t04_depo->nama->FldCaption() ?></td>
			<td<?php echo $t04_depo->nama->CellAttributes() ?>>
<span id="el_t04_depo_nama">
<span<?php echo $t04_depo->nama->ViewAttributes() ?>>
<?php echo $t04_depo->nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t04_depo->alamat->Visible) { // alamat ?>
		<tr id="r_alamat">
			<td><?php echo $t04_depo->alamat->FldCaption() ?></td>
			<td<?php echo $t04_depo->alamat->CellAttributes() ?>>
<span id="el_t04_depo_alamat">
<span<?php echo $t04_depo->alamat->ViewAttributes() ?>>
<?php echo $t04_depo->alamat->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t04_depo->kota->Visible) { // kota ?>
		<tr id="r_kota">
			<td><?php echo $t04_depo->kota->FldCaption() ?></td>
			<td<?php echo $t04_depo->kota->CellAttributes() ?>>
<span id="el_t04_depo_kota">
<span<?php echo $t04_depo->kota->ViewAttributes() ?>>
<?php echo $t04_depo->kota->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t04_depo->propinsi->Visible) { // propinsi ?>
		<tr id="r_propinsi">
			<td><?php echo $t04_depo->propinsi->FldCaption() ?></td>
			<td<?php echo $t04_depo->propinsi->CellAttributes() ?>>
<span id="el_t04_depo_propinsi">
<span<?php echo $t04_depo->propinsi->ViewAttributes() ?>>
<?php echo $t04_depo->propinsi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t04_depo->no_telp->Visible) { // no_telp ?>
		<tr id="r_no_telp">
			<td><?php echo $t04_depo->no_telp->FldCaption() ?></td>
			<td<?php echo $t04_depo->no_telp->CellAttributes() ?>>
<span id="el_t04_depo_no_telp">
<span<?php echo $t04_depo->no_telp->ViewAttributes() ?>>
<?php echo $t04_depo->no_telp->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t04_depo->no_fax->Visible) { // no_fax ?>
		<tr id="r_no_fax">
			<td><?php echo $t04_depo->no_fax->FldCaption() ?></td>
			<td<?php echo $t04_depo->no_fax->CellAttributes() ?>>
<span id="el_t04_depo_no_fax">
<span<?php echo $t04_depo->no_fax->ViewAttributes() ?>>
<?php echo $t04_depo->no_fax->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
