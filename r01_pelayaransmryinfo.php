<?php

// Global variable for table object
$r01_pelayaran = NULL;

//
// Table class for r01_pelayaran
//
class crr01_pelayaran extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $id;
	var $pelayaran_id;
	var $pelayaran_nama;
	var $on20;
	var $on40;
	var $on45;
	var $offket;
	var $off20;
	var $off40;
	var $off45;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'r01_pelayaran';
		$this->TableName = 'r01_pelayaran';
		$this->TableType = 'REPORT';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// id
		$this->id = new crField('r01_pelayaran', 'r01_pelayaran', 'x_id', 'id', '`id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;
		$this->id->DateFilter = "";
		$this->id->SqlSelect = "";
		$this->id->SqlOrderBy = "";

		// pelayaran_id
		$this->pelayaran_id = new crField('r01_pelayaran', 'r01_pelayaran', 'x_pelayaran_id', 'pelayaran_id', '`pelayaran_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->pelayaran_id->Sortable = TRUE; // Allow sort
		$this->pelayaran_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pelayaran_id'] = &$this->pelayaran_id;
		$this->pelayaran_id->DateFilter = "";
		$this->pelayaran_id->SqlSelect = "";
		$this->pelayaran_id->SqlOrderBy = "";

		// pelayaran_nama
		$this->pelayaran_nama = new crField('r01_pelayaran', 'r01_pelayaran', 'x_pelayaran_nama', 'pelayaran_nama', '`pelayaran_nama`', 200, EWR_DATATYPE_STRING, -1);
		$this->pelayaran_nama->Sortable = TRUE; // Allow sort
		$this->fields['pelayaran_nama'] = &$this->pelayaran_nama;
		$this->pelayaran_nama->DateFilter = "";
		$this->pelayaran_nama->SqlSelect = "";
		$this->pelayaran_nama->SqlOrderBy = "";

		// on20
		$this->on20 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_on20', 'on20', '`on20`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->on20->Sortable = TRUE; // Allow sort
		$this->on20->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['on20'] = &$this->on20;
		$this->on20->DateFilter = "";
		$this->on20->SqlSelect = "";
		$this->on20->SqlOrderBy = "";

		// on40
		$this->on40 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_on40', 'on40', '`on40`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->on40->Sortable = TRUE; // Allow sort
		$this->on40->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['on40'] = &$this->on40;
		$this->on40->DateFilter = "";
		$this->on40->SqlSelect = "";
		$this->on40->SqlOrderBy = "";

		// on45
		$this->on45 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_on45', 'on45', '`on45`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->on45->Sortable = TRUE; // Allow sort
		$this->on45->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['on45'] = &$this->on45;
		$this->on45->DateFilter = "";
		$this->on45->SqlSelect = "";
		$this->on45->SqlOrderBy = "";

		// offket
		$this->offket = new crField('r01_pelayaran', 'r01_pelayaran', 'x_offket', 'offket', '`offket`', 200, EWR_DATATYPE_STRING, -1);
		$this->offket->Sortable = TRUE; // Allow sort
		$this->fields['offket'] = &$this->offket;
		$this->offket->DateFilter = "";
		$this->offket->SqlSelect = "";
		$this->offket->SqlOrderBy = "";

		// off20
		$this->off20 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_off20', 'off20', '`off20`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->off20->Sortable = TRUE; // Allow sort
		$this->off20->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['off20'] = &$this->off20;
		$this->off20->DateFilter = "";
		$this->off20->SqlSelect = "";
		$this->off20->SqlOrderBy = "";

		// off40
		$this->off40 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_off40', 'off40', '`off40`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->off40->Sortable = TRUE; // Allow sort
		$this->off40->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['off40'] = &$this->off40;
		$this->off40->DateFilter = "";
		$this->off40->SqlSelect = "";
		$this->off40->SqlOrderBy = "";

		// off45
		$this->off45 = new crField('r01_pelayaran', 'r01_pelayaran', 'x_off45', 'off45', '`off45`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->off45->Sortable = TRUE; // Allow sort
		$this->off45->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['off45'] = &$this->off45;
		$this->off45->DateFilter = "";
		$this->off45->SqlSelect = "";
		$this->off45->SqlOrderBy = "";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t03_lift`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, (select pelayaran from t02_pelayaran where pelayaran_id = t02_pelayaran.id) AS `pelayaran_nama` FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Table Level Group SQL
	// First Group Field

	var $_SqlFirstGroupField = "";

	function getSqlFirstGroupField() {
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "";
	}

	function SqlFirstGroupField() { // For backward compatibility
		return $this->getSqlFirstGroupField();
	}

	function setSqlFirstGroupField($v) {
		$this->_SqlFirstGroupField = $v;
	}

	// Select Group
	var $_SqlSelectGroup = "";

	function getSqlSelectGroup() {
		return ($this->_SqlSelectGroup <> "") ? $this->_SqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}

	function SqlSelectGroup() { // For backward compatibility
		return $this->getSqlSelectGroup();
	}

	function setSqlSelectGroup($v) {
		$this->_SqlSelectGroup = $v;
	}

	// Order By Group
	var $_SqlOrderByGroup = "";

	function getSqlOrderByGroup() {
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "";
	}

	function SqlOrderByGroup() { // For backward compatibility
		return $this->getSqlOrderByGroup();
	}

	function setSqlOrderByGroup($v) {
		$this->_SqlOrderByGroup = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
