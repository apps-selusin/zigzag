<?php include_once "t98_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t03_lift_grid)) $t03_lift_grid = new ct03_lift_grid();

// Page init
$t03_lift_grid->Page_Init();

// Page main
$t03_lift_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_lift_grid->Page_Render();
?>
<?php if ($t03_lift->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft03_liftgrid = new ew_Form("ft03_liftgrid", "grid");
ft03_liftgrid.FormKeyCountName = '<?php echo $t03_lift_grid->FormKeyCountName ?>';

// Validate form
ft03_liftgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_depo_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_lift->depo_id->FldCaption(), $t03_lift->depo_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_depo_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->depo_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_pelayaran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_lift->pelayaran_id->FldCaption(), $t03_lift->pelayaran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_on20");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->on20->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_on40");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->on40->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_on45");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->on45->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_off20");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->off20->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_off40");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->off40->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_off45");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t03_lift->off45->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft03_liftgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "depo_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pelayaran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "on20", false)) return false;
	if (ew_ValueChanged(fobj, infix, "on40", false)) return false;
	if (ew_ValueChanged(fobj, infix, "on45", false)) return false;
	if (ew_ValueChanged(fobj, infix, "offket", false)) return false;
	if (ew_ValueChanged(fobj, infix, "off20", false)) return false;
	if (ew_ValueChanged(fobj, infix, "off40", false)) return false;
	if (ew_ValueChanged(fobj, infix, "off45", false)) return false;
	return true;
}

// Form_CustomValidate event
ft03_liftgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_liftgrid.ValidateRequired = true;
<?php } else { ?>
ft03_liftgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_liftgrid.Lists["x_pelayaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_pelayaran"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t03_lift->CurrentAction == "gridadd") {
	if ($t03_lift->CurrentMode == "copy") {
		$bSelectLimit = $t03_lift_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t03_lift_grid->TotalRecs = $t03_lift->SelectRecordCount();
			$t03_lift_grid->Recordset = $t03_lift_grid->LoadRecordset($t03_lift_grid->StartRec-1, $t03_lift_grid->DisplayRecs);
		} else {
			if ($t03_lift_grid->Recordset = $t03_lift_grid->LoadRecordset())
				$t03_lift_grid->TotalRecs = $t03_lift_grid->Recordset->RecordCount();
		}
		$t03_lift_grid->StartRec = 1;
		$t03_lift_grid->DisplayRecs = $t03_lift_grid->TotalRecs;
	} else {
		$t03_lift->CurrentFilter = "0=1";
		$t03_lift_grid->StartRec = 1;
		$t03_lift_grid->DisplayRecs = $t03_lift->GridAddRowCount;
	}
	$t03_lift_grid->TotalRecs = $t03_lift_grid->DisplayRecs;
	$t03_lift_grid->StopRec = $t03_lift_grid->DisplayRecs;
} else {
	$bSelectLimit = $t03_lift_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t03_lift_grid->TotalRecs <= 0)
			$t03_lift_grid->TotalRecs = $t03_lift->SelectRecordCount();
	} else {
		if (!$t03_lift_grid->Recordset && ($t03_lift_grid->Recordset = $t03_lift_grid->LoadRecordset()))
			$t03_lift_grid->TotalRecs = $t03_lift_grid->Recordset->RecordCount();
	}
	$t03_lift_grid->StartRec = 1;
	$t03_lift_grid->DisplayRecs = $t03_lift_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t03_lift_grid->Recordset = $t03_lift_grid->LoadRecordset($t03_lift_grid->StartRec-1, $t03_lift_grid->DisplayRecs);

	// Set no record found message
	if ($t03_lift->CurrentAction == "" && $t03_lift_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t03_lift_grid->setWarningMessage(ew_DeniedMsg());
		if ($t03_lift_grid->SearchWhere == "0=101")
			$t03_lift_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t03_lift_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t03_lift_grid->RenderOtherOptions();
?>
<?php $t03_lift_grid->ShowPageHeader(); ?>
<?php
$t03_lift_grid->ShowMessage();
?>
<?php if ($t03_lift_grid->TotalRecs > 0 || $t03_lift->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t03_lift">
<div id="ft03_liftgrid" class="ewForm form-inline">
<?php if ($t03_lift_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t03_lift_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t03_lift" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t03_liftgrid" class="table ewTable">
<?php echo $t03_lift->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t03_lift_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t03_lift_grid->RenderListOptions();

// Render list options (header, left)
$t03_lift_grid->ListOptions->Render("header", "left");
?>
<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
	<?php if ($t03_lift->SortUrl($t03_lift->depo_id) == "") { ?>
		<th data-name="depo_id"><div id="elh_t03_lift_depo_id" class="t03_lift_depo_id"><div class="ewTableHeaderCaption"><?php echo $t03_lift->depo_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="depo_id"><div><div id="elh_t03_lift_depo_id" class="t03_lift_depo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->depo_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->depo_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->depo_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
	<?php if ($t03_lift->SortUrl($t03_lift->pelayaran_id) == "") { ?>
		<th data-name="pelayaran_id"><div id="elh_t03_lift_pelayaran_id" class="t03_lift_pelayaran_id"><div class="ewTableHeaderCaption"><?php echo $t03_lift->pelayaran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pelayaran_id"><div><div id="elh_t03_lift_pelayaran_id" class="t03_lift_pelayaran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->pelayaran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->pelayaran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->pelayaran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->on20->Visible) { // on20 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->on20) == "") { ?>
		<th data-name="on20"><div id="elh_t03_lift_on20" class="t03_lift_on20"><div class="ewTableHeaderCaption"><?php echo $t03_lift->on20->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="on20"><div><div id="elh_t03_lift_on20" class="t03_lift_on20">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->on20->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->on20->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->on20->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->on40->Visible) { // on40 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->on40) == "") { ?>
		<th data-name="on40"><div id="elh_t03_lift_on40" class="t03_lift_on40"><div class="ewTableHeaderCaption"><?php echo $t03_lift->on40->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="on40"><div><div id="elh_t03_lift_on40" class="t03_lift_on40">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->on40->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->on40->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->on40->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->on45->Visible) { // on45 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->on45) == "") { ?>
		<th data-name="on45"><div id="elh_t03_lift_on45" class="t03_lift_on45"><div class="ewTableHeaderCaption"><?php echo $t03_lift->on45->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="on45"><div><div id="elh_t03_lift_on45" class="t03_lift_on45">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->on45->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->on45->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->on45->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->offket->Visible) { // offket ?>
	<?php if ($t03_lift->SortUrl($t03_lift->offket) == "") { ?>
		<th data-name="offket"><div id="elh_t03_lift_offket" class="t03_lift_offket"><div class="ewTableHeaderCaption"><?php echo $t03_lift->offket->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="offket"><div><div id="elh_t03_lift_offket" class="t03_lift_offket">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->offket->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->offket->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->offket->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->off20->Visible) { // off20 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->off20) == "") { ?>
		<th data-name="off20"><div id="elh_t03_lift_off20" class="t03_lift_off20"><div class="ewTableHeaderCaption"><?php echo $t03_lift->off20->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off20"><div><div id="elh_t03_lift_off20" class="t03_lift_off20">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->off20->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->off20->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->off20->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->off40->Visible) { // off40 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->off40) == "") { ?>
		<th data-name="off40"><div id="elh_t03_lift_off40" class="t03_lift_off40"><div class="ewTableHeaderCaption"><?php echo $t03_lift->off40->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off40"><div><div id="elh_t03_lift_off40" class="t03_lift_off40">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->off40->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->off40->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->off40->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t03_lift->off45->Visible) { // off45 ?>
	<?php if ($t03_lift->SortUrl($t03_lift->off45) == "") { ?>
		<th data-name="off45"><div id="elh_t03_lift_off45" class="t03_lift_off45"><div class="ewTableHeaderCaption"><?php echo $t03_lift->off45->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="off45"><div><div id="elh_t03_lift_off45" class="t03_lift_off45">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t03_lift->off45->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t03_lift->off45->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t03_lift->off45->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t03_lift_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t03_lift_grid->StartRec = 1;
$t03_lift_grid->StopRec = $t03_lift_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t03_lift_grid->FormKeyCountName) && ($t03_lift->CurrentAction == "gridadd" || $t03_lift->CurrentAction == "gridedit" || $t03_lift->CurrentAction == "F")) {
		$t03_lift_grid->KeyCount = $objForm->GetValue($t03_lift_grid->FormKeyCountName);
		$t03_lift_grid->StopRec = $t03_lift_grid->StartRec + $t03_lift_grid->KeyCount - 1;
	}
}
$t03_lift_grid->RecCnt = $t03_lift_grid->StartRec - 1;
if ($t03_lift_grid->Recordset && !$t03_lift_grid->Recordset->EOF) {
	$t03_lift_grid->Recordset->MoveFirst();
	$bSelectLimit = $t03_lift_grid->UseSelectLimit;
	if (!$bSelectLimit && $t03_lift_grid->StartRec > 1)
		$t03_lift_grid->Recordset->Move($t03_lift_grid->StartRec - 1);
} elseif (!$t03_lift->AllowAddDeleteRow && $t03_lift_grid->StopRec == 0) {
	$t03_lift_grid->StopRec = $t03_lift->GridAddRowCount;
}

// Initialize aggregate
$t03_lift->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t03_lift->ResetAttrs();
$t03_lift_grid->RenderRow();
if ($t03_lift->CurrentAction == "gridadd")
	$t03_lift_grid->RowIndex = 0;
if ($t03_lift->CurrentAction == "gridedit")
	$t03_lift_grid->RowIndex = 0;
while ($t03_lift_grid->RecCnt < $t03_lift_grid->StopRec) {
	$t03_lift_grid->RecCnt++;
	if (intval($t03_lift_grid->RecCnt) >= intval($t03_lift_grid->StartRec)) {
		$t03_lift_grid->RowCnt++;
		if ($t03_lift->CurrentAction == "gridadd" || $t03_lift->CurrentAction == "gridedit" || $t03_lift->CurrentAction == "F") {
			$t03_lift_grid->RowIndex++;
			$objForm->Index = $t03_lift_grid->RowIndex;
			if ($objForm->HasValue($t03_lift_grid->FormActionName))
				$t03_lift_grid->RowAction = strval($objForm->GetValue($t03_lift_grid->FormActionName));
			elseif ($t03_lift->CurrentAction == "gridadd")
				$t03_lift_grid->RowAction = "insert";
			else
				$t03_lift_grid->RowAction = "";
		}

		// Set up key count
		$t03_lift_grid->KeyCount = $t03_lift_grid->RowIndex;

		// Init row class and style
		$t03_lift->ResetAttrs();
		$t03_lift->CssClass = "";
		if ($t03_lift->CurrentAction == "gridadd") {
			if ($t03_lift->CurrentMode == "copy") {
				$t03_lift_grid->LoadRowValues($t03_lift_grid->Recordset); // Load row values
				$t03_lift_grid->SetRecordKey($t03_lift_grid->RowOldKey, $t03_lift_grid->Recordset); // Set old record key
			} else {
				$t03_lift_grid->LoadDefaultValues(); // Load default values
				$t03_lift_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t03_lift_grid->LoadRowValues($t03_lift_grid->Recordset); // Load row values
		}
		$t03_lift->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t03_lift->CurrentAction == "gridadd") // Grid add
			$t03_lift->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t03_lift->CurrentAction == "gridadd" && $t03_lift->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t03_lift_grid->RestoreCurrentRowFormValues($t03_lift_grid->RowIndex); // Restore form values
		if ($t03_lift->CurrentAction == "gridedit") { // Grid edit
			if ($t03_lift->EventCancelled) {
				$t03_lift_grid->RestoreCurrentRowFormValues($t03_lift_grid->RowIndex); // Restore form values
			}
			if ($t03_lift_grid->RowAction == "insert")
				$t03_lift->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t03_lift->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t03_lift->CurrentAction == "gridedit" && ($t03_lift->RowType == EW_ROWTYPE_EDIT || $t03_lift->RowType == EW_ROWTYPE_ADD) && $t03_lift->EventCancelled) // Update failed
			$t03_lift_grid->RestoreCurrentRowFormValues($t03_lift_grid->RowIndex); // Restore form values
		if ($t03_lift->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t03_lift_grid->EditRowCnt++;
		if ($t03_lift->CurrentAction == "F") // Confirm row
			$t03_lift_grid->RestoreCurrentRowFormValues($t03_lift_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t03_lift->RowAttrs = array_merge($t03_lift->RowAttrs, array('data-rowindex'=>$t03_lift_grid->RowCnt, 'id'=>'r' . $t03_lift_grid->RowCnt . '_t03_lift', 'data-rowtype'=>$t03_lift->RowType));

		// Render row
		$t03_lift_grid->RenderRow();

		// Render list options
		$t03_lift_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t03_lift_grid->RowAction <> "delete" && $t03_lift_grid->RowAction <> "insertdelete" && !($t03_lift_grid->RowAction == "insert" && $t03_lift->CurrentAction == "F" && $t03_lift_grid->EmptyRow())) {
?>
	<tr<?php echo $t03_lift->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t03_lift_grid->ListOptions->Render("body", "left", $t03_lift_grid->RowCnt);
?>
	<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
		<td data-name="depo_id"<?php echo $t03_lift->depo_id->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t03_lift->depo_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->depo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<input type="text" data-table="t03_lift" data-field="x_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->depo_id->getPlaceHolder()) ?>" value="<?php echo $t03_lift->depo_id->EditValue ?>"<?php echo $t03_lift->depo_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t03_lift->depo_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->depo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<input type="text" data-table="t03_lift" data-field="x_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->depo_id->getPlaceHolder()) ?>" value="<?php echo $t03_lift->depo_id->EditValue ?>"<?php echo $t03_lift->depo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_depo_id" class="t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<?php echo $t03_lift->depo_id->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t03_lift_grid->PageObjName . "_row_" . $t03_lift_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t03_lift" data-field="x_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t03_lift->id->CurrentValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t03_lift->id->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT || $t03_lift->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t03_lift->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
		<td data-name="pelayaran_id"<?php echo $t03_lift->pelayaran_id->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_pelayaran_id" class="form-group t03_lift_pelayaran_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><?php echo (strval($t03_lift->pelayaran_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_lift->pelayaran_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_lift->pelayaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_lift->pelayaran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->CurrentValue ?>"<?php echo $t03_lift->pelayaran_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_pelayaran")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t03_lift->pelayaran_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',url:'t02_pelayaranaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t03_lift->pelayaran_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_pelayaran_id" class="form-group t03_lift_pelayaran_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><?php echo (strval($t03_lift->pelayaran_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_lift->pelayaran_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_lift->pelayaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_lift->pelayaran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->CurrentValue ?>"<?php echo $t03_lift->pelayaran_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_pelayaran")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t03_lift->pelayaran_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',url:'t02_pelayaranaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t03_lift->pelayaran_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_pelayaran_id" class="t03_lift_pelayaran_id">
<span<?php echo $t03_lift->pelayaran_id->ViewAttributes() ?>>
<?php echo $t03_lift->pelayaran_id->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->on20->Visible) { // on20 ?>
		<td data-name="on20"<?php echo $t03_lift->on20->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on20" class="form-group t03_lift_on20">
<input type="text" data-table="t03_lift" data-field="x_on20" name="x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="x<?php echo $t03_lift_grid->RowIndex ?>_on20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on20->EditValue ?>"<?php echo $t03_lift->on20->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="o<?php echo $t03_lift_grid->RowIndex ?>_on20" id="o<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on20" class="form-group t03_lift_on20">
<input type="text" data-table="t03_lift" data-field="x_on20" name="x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="x<?php echo $t03_lift_grid->RowIndex ?>_on20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on20->EditValue ?>"<?php echo $t03_lift->on20->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on20" class="t03_lift_on20">
<span<?php echo $t03_lift->on20->ViewAttributes() ?>>
<?php echo $t03_lift->on20->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="x<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="o<?php echo $t03_lift_grid->RowIndex ?>_on20" id="o<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on20" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->on40->Visible) { // on40 ?>
		<td data-name="on40"<?php echo $t03_lift->on40->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on40" class="form-group t03_lift_on40">
<input type="text" data-table="t03_lift" data-field="x_on40" name="x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="x<?php echo $t03_lift_grid->RowIndex ?>_on40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on40->EditValue ?>"<?php echo $t03_lift->on40->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="o<?php echo $t03_lift_grid->RowIndex ?>_on40" id="o<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on40" class="form-group t03_lift_on40">
<input type="text" data-table="t03_lift" data-field="x_on40" name="x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="x<?php echo $t03_lift_grid->RowIndex ?>_on40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on40->EditValue ?>"<?php echo $t03_lift->on40->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on40" class="t03_lift_on40">
<span<?php echo $t03_lift->on40->ViewAttributes() ?>>
<?php echo $t03_lift->on40->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="x<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="o<?php echo $t03_lift_grid->RowIndex ?>_on40" id="o<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on40" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->on45->Visible) { // on45 ?>
		<td data-name="on45"<?php echo $t03_lift->on45->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on45" class="form-group t03_lift_on45">
<input type="text" data-table="t03_lift" data-field="x_on45" name="x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="x<?php echo $t03_lift_grid->RowIndex ?>_on45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on45->EditValue ?>"<?php echo $t03_lift->on45->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="o<?php echo $t03_lift_grid->RowIndex ?>_on45" id="o<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on45" class="form-group t03_lift_on45">
<input type="text" data-table="t03_lift" data-field="x_on45" name="x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="x<?php echo $t03_lift_grid->RowIndex ?>_on45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on45->EditValue ?>"<?php echo $t03_lift->on45->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_on45" class="t03_lift_on45">
<span<?php echo $t03_lift->on45->ViewAttributes() ?>>
<?php echo $t03_lift->on45->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="x<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="o<?php echo $t03_lift_grid->RowIndex ?>_on45" id="o<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on45" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->offket->Visible) { // offket ?>
		<td data-name="offket"<?php echo $t03_lift->offket->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_offket" class="form-group t03_lift_offket">
<input type="text" data-table="t03_lift" data-field="x_offket" name="x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="x<?php echo $t03_lift_grid->RowIndex ?>_offket" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_lift->offket->getPlaceHolder()) ?>" value="<?php echo $t03_lift->offket->EditValue ?>"<?php echo $t03_lift->offket->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="o<?php echo $t03_lift_grid->RowIndex ?>_offket" id="o<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_offket" class="form-group t03_lift_offket">
<input type="text" data-table="t03_lift" data-field="x_offket" name="x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="x<?php echo $t03_lift_grid->RowIndex ?>_offket" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_lift->offket->getPlaceHolder()) ?>" value="<?php echo $t03_lift->offket->EditValue ?>"<?php echo $t03_lift->offket->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_offket" class="t03_lift_offket">
<span<?php echo $t03_lift->offket->ViewAttributes() ?>>
<?php echo $t03_lift->offket->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="x<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="o<?php echo $t03_lift_grid->RowIndex ?>_offket" id="o<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_offket" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->off20->Visible) { // off20 ?>
		<td data-name="off20"<?php echo $t03_lift->off20->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off20" class="form-group t03_lift_off20">
<input type="text" data-table="t03_lift" data-field="x_off20" name="x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="x<?php echo $t03_lift_grid->RowIndex ?>_off20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off20->EditValue ?>"<?php echo $t03_lift->off20->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="o<?php echo $t03_lift_grid->RowIndex ?>_off20" id="o<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off20" class="form-group t03_lift_off20">
<input type="text" data-table="t03_lift" data-field="x_off20" name="x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="x<?php echo $t03_lift_grid->RowIndex ?>_off20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off20->EditValue ?>"<?php echo $t03_lift->off20->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off20" class="t03_lift_off20">
<span<?php echo $t03_lift->off20->ViewAttributes() ?>>
<?php echo $t03_lift->off20->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="x<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="o<?php echo $t03_lift_grid->RowIndex ?>_off20" id="o<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off20" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->off40->Visible) { // off40 ?>
		<td data-name="off40"<?php echo $t03_lift->off40->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off40" class="form-group t03_lift_off40">
<input type="text" data-table="t03_lift" data-field="x_off40" name="x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="x<?php echo $t03_lift_grid->RowIndex ?>_off40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off40->EditValue ?>"<?php echo $t03_lift->off40->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="o<?php echo $t03_lift_grid->RowIndex ?>_off40" id="o<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off40" class="form-group t03_lift_off40">
<input type="text" data-table="t03_lift" data-field="x_off40" name="x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="x<?php echo $t03_lift_grid->RowIndex ?>_off40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off40->EditValue ?>"<?php echo $t03_lift->off40->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off40" class="t03_lift_off40">
<span<?php echo $t03_lift->off40->ViewAttributes() ?>>
<?php echo $t03_lift->off40->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="x<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="o<?php echo $t03_lift_grid->RowIndex ?>_off40" id="o<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off40" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t03_lift->off45->Visible) { // off45 ?>
		<td data-name="off45"<?php echo $t03_lift->off45->CellAttributes() ?>>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off45" class="form-group t03_lift_off45">
<input type="text" data-table="t03_lift" data-field="x_off45" name="x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="x<?php echo $t03_lift_grid->RowIndex ?>_off45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off45->EditValue ?>"<?php echo $t03_lift->off45->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="o<?php echo $t03_lift_grid->RowIndex ?>_off45" id="o<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->OldValue) ?>">
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off45" class="form-group t03_lift_off45">
<input type="text" data-table="t03_lift" data-field="x_off45" name="x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="x<?php echo $t03_lift_grid->RowIndex ?>_off45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off45->EditValue ?>"<?php echo $t03_lift->off45->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t03_lift->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t03_lift_grid->RowCnt ?>_t03_lift_off45" class="t03_lift_off45">
<span<?php echo $t03_lift->off45->ViewAttributes() ?>>
<?php echo $t03_lift->off45->ListViewValue() ?></span>
</span>
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="x<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="o<?php echo $t03_lift_grid->RowIndex ?>_off45" id="o<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="ft03_liftgrid$x<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->FormValue) ?>">
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off45" id="ft03_liftgrid$o<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t03_lift_grid->ListOptions->Render("body", "right", $t03_lift_grid->RowCnt);
?>
	</tr>
<?php if ($t03_lift->RowType == EW_ROWTYPE_ADD || $t03_lift->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft03_liftgrid.UpdateOpts(<?php echo $t03_lift_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t03_lift->CurrentAction <> "gridadd" || $t03_lift->CurrentMode == "copy")
		if (!$t03_lift_grid->Recordset->EOF) $t03_lift_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t03_lift->CurrentMode == "add" || $t03_lift->CurrentMode == "copy" || $t03_lift->CurrentMode == "edit") {
		$t03_lift_grid->RowIndex = '$rowindex$';
		$t03_lift_grid->LoadDefaultValues();

		// Set row properties
		$t03_lift->ResetAttrs();
		$t03_lift->RowAttrs = array_merge($t03_lift->RowAttrs, array('data-rowindex'=>$t03_lift_grid->RowIndex, 'id'=>'r0_t03_lift', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t03_lift->RowAttrs["class"], "ewTemplate");
		$t03_lift->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t03_lift_grid->RenderRow();

		// Render list options
		$t03_lift_grid->RenderListOptions();
		$t03_lift_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t03_lift->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t03_lift_grid->ListOptions->Render("body", "left", $t03_lift_grid->RowIndex);
?>
	<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
		<td data-name="depo_id">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<?php if ($t03_lift->depo_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->depo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<input type="text" data-table="t03_lift" data-field="x_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->depo_id->getPlaceHolder()) ?>" value="<?php echo $t03_lift->depo_id->EditValue ?>"<?php echo $t03_lift->depo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_depo_id" class="form-group t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->depo_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_depo_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
		<td data-name="pelayaran_id">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_pelayaran_id" class="form-group t03_lift_pelayaran_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><?php echo (strval($t03_lift->pelayaran_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_lift->pelayaran_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_lift->pelayaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_lift->pelayaran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->CurrentValue ?>"<?php echo $t03_lift->pelayaran_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_pelayaran")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t03_lift->pelayaran_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id',url:'t02_pelayaranaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t03_lift->pelayaran_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="s_x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_pelayaran_id" class="form-group t03_lift_pelayaran_id">
<span<?php echo $t03_lift->pelayaran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->pelayaran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="x<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" name="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" id="o<?php echo $t03_lift_grid->RowIndex ?>_pelayaran_id" value="<?php echo ew_HtmlEncode($t03_lift->pelayaran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->on20->Visible) { // on20 ?>
		<td data-name="on20">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_on20" class="form-group t03_lift_on20">
<input type="text" data-table="t03_lift" data-field="x_on20" name="x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="x<?php echo $t03_lift_grid->RowIndex ?>_on20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on20->EditValue ?>"<?php echo $t03_lift->on20->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_on20" class="form-group t03_lift_on20">
<span<?php echo $t03_lift->on20->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->on20->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="x<?php echo $t03_lift_grid->RowIndex ?>_on20" id="x<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_on20" name="o<?php echo $t03_lift_grid->RowIndex ?>_on20" id="o<?php echo $t03_lift_grid->RowIndex ?>_on20" value="<?php echo ew_HtmlEncode($t03_lift->on20->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->on40->Visible) { // on40 ?>
		<td data-name="on40">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_on40" class="form-group t03_lift_on40">
<input type="text" data-table="t03_lift" data-field="x_on40" name="x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="x<?php echo $t03_lift_grid->RowIndex ?>_on40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on40->EditValue ?>"<?php echo $t03_lift->on40->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_on40" class="form-group t03_lift_on40">
<span<?php echo $t03_lift->on40->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->on40->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="x<?php echo $t03_lift_grid->RowIndex ?>_on40" id="x<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_on40" name="o<?php echo $t03_lift_grid->RowIndex ?>_on40" id="o<?php echo $t03_lift_grid->RowIndex ?>_on40" value="<?php echo ew_HtmlEncode($t03_lift->on40->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->on45->Visible) { // on45 ?>
		<td data-name="on45">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_on45" class="form-group t03_lift_on45">
<input type="text" data-table="t03_lift" data-field="x_on45" name="x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="x<?php echo $t03_lift_grid->RowIndex ?>_on45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on45->EditValue ?>"<?php echo $t03_lift->on45->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_on45" class="form-group t03_lift_on45">
<span<?php echo $t03_lift->on45->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->on45->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="x<?php echo $t03_lift_grid->RowIndex ?>_on45" id="x<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_on45" name="o<?php echo $t03_lift_grid->RowIndex ?>_on45" id="o<?php echo $t03_lift_grid->RowIndex ?>_on45" value="<?php echo ew_HtmlEncode($t03_lift->on45->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->offket->Visible) { // offket ?>
		<td data-name="offket">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_offket" class="form-group t03_lift_offket">
<input type="text" data-table="t03_lift" data-field="x_offket" name="x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="x<?php echo $t03_lift_grid->RowIndex ?>_offket" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_lift->offket->getPlaceHolder()) ?>" value="<?php echo $t03_lift->offket->EditValue ?>"<?php echo $t03_lift->offket->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_offket" class="form-group t03_lift_offket">
<span<?php echo $t03_lift->offket->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->offket->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="x<?php echo $t03_lift_grid->RowIndex ?>_offket" id="x<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_offket" name="o<?php echo $t03_lift_grid->RowIndex ?>_offket" id="o<?php echo $t03_lift_grid->RowIndex ?>_offket" value="<?php echo ew_HtmlEncode($t03_lift->offket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->off20->Visible) { // off20 ?>
		<td data-name="off20">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_off20" class="form-group t03_lift_off20">
<input type="text" data-table="t03_lift" data-field="x_off20" name="x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="x<?php echo $t03_lift_grid->RowIndex ?>_off20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off20->EditValue ?>"<?php echo $t03_lift->off20->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_off20" class="form-group t03_lift_off20">
<span<?php echo $t03_lift->off20->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->off20->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="x<?php echo $t03_lift_grid->RowIndex ?>_off20" id="x<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_off20" name="o<?php echo $t03_lift_grid->RowIndex ?>_off20" id="o<?php echo $t03_lift_grid->RowIndex ?>_off20" value="<?php echo ew_HtmlEncode($t03_lift->off20->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->off40->Visible) { // off40 ?>
		<td data-name="off40">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_off40" class="form-group t03_lift_off40">
<input type="text" data-table="t03_lift" data-field="x_off40" name="x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="x<?php echo $t03_lift_grid->RowIndex ?>_off40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off40->EditValue ?>"<?php echo $t03_lift->off40->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_off40" class="form-group t03_lift_off40">
<span<?php echo $t03_lift->off40->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->off40->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="x<?php echo $t03_lift_grid->RowIndex ?>_off40" id="x<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_off40" name="o<?php echo $t03_lift_grid->RowIndex ?>_off40" id="o<?php echo $t03_lift_grid->RowIndex ?>_off40" value="<?php echo ew_HtmlEncode($t03_lift->off40->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t03_lift->off45->Visible) { // off45 ?>
		<td data-name="off45">
<?php if ($t03_lift->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t03_lift_off45" class="form-group t03_lift_off45">
<input type="text" data-table="t03_lift" data-field="x_off45" name="x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="x<?php echo $t03_lift_grid->RowIndex ?>_off45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off45->EditValue ?>"<?php echo $t03_lift->off45->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t03_lift_off45" class="form-group t03_lift_off45">
<span<?php echo $t03_lift->off45->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->off45->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="x<?php echo $t03_lift_grid->RowIndex ?>_off45" id="x<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t03_lift" data-field="x_off45" name="o<?php echo $t03_lift_grid->RowIndex ?>_off45" id="o<?php echo $t03_lift_grid->RowIndex ?>_off45" value="<?php echo ew_HtmlEncode($t03_lift->off45->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t03_lift_grid->ListOptions->Render("body", "right", $t03_lift_grid->RowCnt);
?>
<script type="text/javascript">
ft03_liftgrid.UpdateOpts(<?php echo $t03_lift_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t03_lift->CurrentMode == "add" || $t03_lift->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t03_lift_grid->FormKeyCountName ?>" id="<?php echo $t03_lift_grid->FormKeyCountName ?>" value="<?php echo $t03_lift_grid->KeyCount ?>">
<?php echo $t03_lift_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t03_lift->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t03_lift_grid->FormKeyCountName ?>" id="<?php echo $t03_lift_grid->FormKeyCountName ?>" value="<?php echo $t03_lift_grid->KeyCount ?>">
<?php echo $t03_lift_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t03_lift->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft03_liftgrid">
</div>
<?php

// Close recordset
if ($t03_lift_grid->Recordset)
	$t03_lift_grid->Recordset->Close();
?>
<?php if ($t03_lift_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t03_lift_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t03_lift_grid->TotalRecs == 0 && $t03_lift->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t03_lift_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t03_lift->Export == "") { ?>
<script type="text/javascript">
ft03_liftgrid.Init();
</script>
<?php } ?>
<?php
$t03_lift_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t03_lift_grid->Page_Terminate();
?>
