<?php

// Global variable for table object
$t03_lift = NULL;

//
// Table class for t03_lift
//
class ct03_lift extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $id;
	var $depo_id;
	var $pelayaran_id;
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
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't03_lift';
		$this->TableName = 't03_lift';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t03_lift`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('t03_lift', 't03_lift', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// depo_id
		$this->depo_id = new cField('t03_lift', 't03_lift', 'x_depo_id', 'depo_id', '`depo_id`', '`depo_id`', 3, -1, FALSE, '`depo_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->depo_id->Sortable = TRUE; // Allow sort
		$this->depo_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['depo_id'] = &$this->depo_id;

		// pelayaran_id
		$this->pelayaran_id = new cField('t03_lift', 't03_lift', 'x_pelayaran_id', 'pelayaran_id', '`pelayaran_id`', '`pelayaran_id`', 3, -1, FALSE, '`EV__pelayaran_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'SELECT');
		$this->pelayaran_id->Sortable = TRUE; // Allow sort
		$this->pelayaran_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pelayaran_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->pelayaran_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pelayaran_id'] = &$this->pelayaran_id;

		// on20
		$this->on20 = new cField('t03_lift', 't03_lift', 'x_on20', 'on20', '`on20`', '`on20`', 4, -1, FALSE, '`on20`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->on20->Sortable = TRUE; // Allow sort
		$this->on20->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['on20'] = &$this->on20;

		// on40
		$this->on40 = new cField('t03_lift', 't03_lift', 'x_on40', 'on40', '`on40`', '`on40`', 4, -1, FALSE, '`on40`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->on40->Sortable = TRUE; // Allow sort
		$this->on40->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['on40'] = &$this->on40;

		// on45
		$this->on45 = new cField('t03_lift', 't03_lift', 'x_on45', 'on45', '`on45`', '`on45`', 4, -1, FALSE, '`on45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->on45->Sortable = TRUE; // Allow sort
		$this->on45->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['on45'] = &$this->on45;

		// offket
		$this->offket = new cField('t03_lift', 't03_lift', 'x_offket', 'offket', '`offket`', '`offket`', 200, -1, FALSE, '`offket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->offket->Sortable = TRUE; // Allow sort
		$this->fields['offket'] = &$this->offket;

		// off20
		$this->off20 = new cField('t03_lift', 't03_lift', 'x_off20', 'off20', '`off20`', '`off20`', 4, -1, FALSE, '`off20`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off20->Sortable = TRUE; // Allow sort
		$this->off20->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['off20'] = &$this->off20;

		// off40
		$this->off40 = new cField('t03_lift', 't03_lift', 'x_off40', 'off40', '`off40`', '`off40`', 4, -1, FALSE, '`off40`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off40->Sortable = TRUE; // Allow sort
		$this->off40->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['off40'] = &$this->off40;

		// off45
		$this->off45 = new cField('t03_lift', 't03_lift', 'x_off45', 'off45', '`off45`', '`off45`', 4, -1, FALSE, '`off45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->off45->Sortable = TRUE; // Allow sort
		$this->off45->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['off45'] = &$this->off45;
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
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			if ($ctrl) {
				$sOrderByList = $this->getSessionOrderByList();
				if (strpos($sOrderByList, $sSortFieldList . " " . $sLastSort) !== FALSE) {
					$sOrderByList = str_replace($sSortFieldList . " " . $sLastSort, $sSortFieldList . " " . $sThisSort, $sOrderByList);
				} else {
					if ($sOrderByList <> "") $sOrderByList .= ", ";
					$sOrderByList .= $sSortFieldList . " " . $sThisSort;
				}
				$this->setSessionOrderByList($sOrderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "t04_depo") {
			if ($this->depo_id->getSessionValue() <> "")
				$sMasterFilter .= "`id`=" . ew_QuotedValue($this->depo_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "t04_depo") {
			if ($this->depo_id->getSessionValue() <> "")
				$sDetailFilter .= "`depo_id`=" . ew_QuotedValue($this->depo_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_t04_depo() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_t04_depo() {
		return "`depo_id`=@depo_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t03_lift`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `nama` FROM `t02_pelayaran` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`id` = `t03_lift`.`pelayaran_id` LIMIT 1) AS `EV__pelayaran_id` FROM `t03_lift`" .
			") `EW_TMP_TABLE`";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
		return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
		$this->_SqlSelectList = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->pelayaran_id->AdvancedSearch->SearchValue <> "" ||
			$this->pelayaran_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->pelayaran_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->pelayaran_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "t03_liftlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t03_liftlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t03_liftview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t03_liftview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t03_liftadd.php?" . $this->UrlParm($parm);
		else
			$url = "t03_liftadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("t03_liftedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("t03_liftadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t03_liftdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "t04_depo" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->depo_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = ew_StripSlashes($_POST["id"]);
			elseif (isset($_GET["id"]))
				$arKeys[] = ew_StripSlashes($_GET["id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->depo_id->setDbValue($rs->fields('depo_id'));
		$this->pelayaran_id->setDbValue($rs->fields('pelayaran_id'));
		$this->on20->setDbValue($rs->fields('on20'));
		$this->on40->setDbValue($rs->fields('on40'));
		$this->on45->setDbValue($rs->fields('on45'));
		$this->offket->setDbValue($rs->fields('offket'));
		$this->off20->setDbValue($rs->fields('off20'));
		$this->off40->setDbValue($rs->fields('off40'));
		$this->off45->setDbValue($rs->fields('off45'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id
		// depo_id
		// pelayaran_id
		// on20
		// on40
		// on45
		// offket
		// off20
		// off40
		// off45
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// depo_id
		$this->depo_id->ViewValue = $this->depo_id->CurrentValue;
		$this->depo_id->ViewCustomAttributes = "";

		// pelayaran_id
		if ($this->pelayaran_id->VirtualValue <> "") {
			$this->pelayaran_id->ViewValue = $this->pelayaran_id->VirtualValue;
		} else {
		if (strval($this->pelayaran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->pelayaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_pelayaran`";
		$sWhereWrk = "";
		$this->pelayaran_id->LookupFilters = array("dx1" => '`nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pelayaran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pelayaran_id->ViewValue = $this->pelayaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pelayaran_id->ViewValue = $this->pelayaran_id->CurrentValue;
			}
		} else {
			$this->pelayaran_id->ViewValue = NULL;
		}
		}
		$this->pelayaran_id->ViewCustomAttributes = "";

		// on20
		$this->on20->ViewValue = $this->on20->CurrentValue;
		$this->on20->ViewCustomAttributes = "";

		// on40
		$this->on40->ViewValue = $this->on40->CurrentValue;
		$this->on40->ViewCustomAttributes = "";

		// on45
		$this->on45->ViewValue = $this->on45->CurrentValue;
		$this->on45->ViewCustomAttributes = "";

		// offket
		$this->offket->ViewValue = $this->offket->CurrentValue;
		$this->offket->ViewCustomAttributes = "";

		// off20
		$this->off20->ViewValue = $this->off20->CurrentValue;
		$this->off20->ViewCustomAttributes = "";

		// off40
		$this->off40->ViewValue = $this->off40->CurrentValue;
		$this->off40->ViewCustomAttributes = "";

		// off45
		$this->off45->ViewValue = $this->off45->CurrentValue;
		$this->off45->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// depo_id
		$this->depo_id->LinkCustomAttributes = "";
		$this->depo_id->HrefValue = "";
		$this->depo_id->TooltipValue = "";

		// pelayaran_id
		$this->pelayaran_id->LinkCustomAttributes = "";
		$this->pelayaran_id->HrefValue = "";
		$this->pelayaran_id->TooltipValue = "";

		// on20
		$this->on20->LinkCustomAttributes = "";
		$this->on20->HrefValue = "";
		$this->on20->TooltipValue = "";

		// on40
		$this->on40->LinkCustomAttributes = "";
		$this->on40->HrefValue = "";
		$this->on40->TooltipValue = "";

		// on45
		$this->on45->LinkCustomAttributes = "";
		$this->on45->HrefValue = "";
		$this->on45->TooltipValue = "";

		// offket
		$this->offket->LinkCustomAttributes = "";
		$this->offket->HrefValue = "";
		$this->offket->TooltipValue = "";

		// off20
		$this->off20->LinkCustomAttributes = "";
		$this->off20->HrefValue = "";
		$this->off20->TooltipValue = "";

		// off40
		$this->off40->LinkCustomAttributes = "";
		$this->off40->HrefValue = "";
		$this->off40->TooltipValue = "";

		// off45
		$this->off45->LinkCustomAttributes = "";
		$this->off45->HrefValue = "";
		$this->off45->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// depo_id
		$this->depo_id->EditAttrs["class"] = "form-control";
		$this->depo_id->EditCustomAttributes = "";
		if ($this->depo_id->getSessionValue() <> "") {
			$this->depo_id->CurrentValue = $this->depo_id->getSessionValue();
		$this->depo_id->ViewValue = $this->depo_id->CurrentValue;
		$this->depo_id->ViewCustomAttributes = "";
		} else {
		$this->depo_id->EditValue = $this->depo_id->CurrentValue;
		$this->depo_id->PlaceHolder = ew_RemoveHtml($this->depo_id->FldCaption());
		}

		// pelayaran_id
		$this->pelayaran_id->EditAttrs["class"] = "form-control";
		$this->pelayaran_id->EditCustomAttributes = "";

		// on20
		$this->on20->EditAttrs["class"] = "form-control";
		$this->on20->EditCustomAttributes = "";
		$this->on20->EditValue = $this->on20->CurrentValue;
		$this->on20->PlaceHolder = ew_RemoveHtml($this->on20->FldCaption());
		if (strval($this->on20->EditValue) <> "" && is_numeric($this->on20->EditValue)) $this->on20->EditValue = ew_FormatNumber($this->on20->EditValue, -2, -1, -2, 0);

		// on40
		$this->on40->EditAttrs["class"] = "form-control";
		$this->on40->EditCustomAttributes = "";
		$this->on40->EditValue = $this->on40->CurrentValue;
		$this->on40->PlaceHolder = ew_RemoveHtml($this->on40->FldCaption());
		if (strval($this->on40->EditValue) <> "" && is_numeric($this->on40->EditValue)) $this->on40->EditValue = ew_FormatNumber($this->on40->EditValue, -2, -1, -2, 0);

		// on45
		$this->on45->EditAttrs["class"] = "form-control";
		$this->on45->EditCustomAttributes = "";
		$this->on45->EditValue = $this->on45->CurrentValue;
		$this->on45->PlaceHolder = ew_RemoveHtml($this->on45->FldCaption());
		if (strval($this->on45->EditValue) <> "" && is_numeric($this->on45->EditValue)) $this->on45->EditValue = ew_FormatNumber($this->on45->EditValue, -2, -1, -2, 0);

		// offket
		$this->offket->EditAttrs["class"] = "form-control";
		$this->offket->EditCustomAttributes = "";
		$this->offket->EditValue = $this->offket->CurrentValue;
		$this->offket->PlaceHolder = ew_RemoveHtml($this->offket->FldCaption());

		// off20
		$this->off20->EditAttrs["class"] = "form-control";
		$this->off20->EditCustomAttributes = "";
		$this->off20->EditValue = $this->off20->CurrentValue;
		$this->off20->PlaceHolder = ew_RemoveHtml($this->off20->FldCaption());
		if (strval($this->off20->EditValue) <> "" && is_numeric($this->off20->EditValue)) $this->off20->EditValue = ew_FormatNumber($this->off20->EditValue, -2, -1, -2, 0);

		// off40
		$this->off40->EditAttrs["class"] = "form-control";
		$this->off40->EditCustomAttributes = "";
		$this->off40->EditValue = $this->off40->CurrentValue;
		$this->off40->PlaceHolder = ew_RemoveHtml($this->off40->FldCaption());
		if (strval($this->off40->EditValue) <> "" && is_numeric($this->off40->EditValue)) $this->off40->EditValue = ew_FormatNumber($this->off40->EditValue, -2, -1, -2, 0);

		// off45
		$this->off45->EditAttrs["class"] = "form-control";
		$this->off45->EditCustomAttributes = "";
		$this->off45->EditValue = $this->off45->CurrentValue;
		$this->off45->PlaceHolder = ew_RemoveHtml($this->off45->FldCaption());
		if (strval($this->off45->EditValue) <> "" && is_numeric($this->off45->EditValue)) $this->off45->EditValue = ew_FormatNumber($this->off45->EditValue, -2, -1, -2, 0);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->depo_id->Exportable) $Doc->ExportCaption($this->depo_id);
					if ($this->pelayaran_id->Exportable) $Doc->ExportCaption($this->pelayaran_id);
					if ($this->on20->Exportable) $Doc->ExportCaption($this->on20);
					if ($this->on40->Exportable) $Doc->ExportCaption($this->on40);
					if ($this->on45->Exportable) $Doc->ExportCaption($this->on45);
					if ($this->offket->Exportable) $Doc->ExportCaption($this->offket);
					if ($this->off20->Exportable) $Doc->ExportCaption($this->off20);
					if ($this->off40->Exportable) $Doc->ExportCaption($this->off40);
					if ($this->off45->Exportable) $Doc->ExportCaption($this->off45);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->depo_id->Exportable) $Doc->ExportCaption($this->depo_id);
					if ($this->pelayaran_id->Exportable) $Doc->ExportCaption($this->pelayaran_id);
					if ($this->on20->Exportable) $Doc->ExportCaption($this->on20);
					if ($this->on40->Exportable) $Doc->ExportCaption($this->on40);
					if ($this->on45->Exportable) $Doc->ExportCaption($this->on45);
					if ($this->offket->Exportable) $Doc->ExportCaption($this->offket);
					if ($this->off20->Exportable) $Doc->ExportCaption($this->off20);
					if ($this->off40->Exportable) $Doc->ExportCaption($this->off40);
					if ($this->off45->Exportable) $Doc->ExportCaption($this->off45);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->depo_id->Exportable) $Doc->ExportField($this->depo_id);
						if ($this->pelayaran_id->Exportable) $Doc->ExportField($this->pelayaran_id);
						if ($this->on20->Exportable) $Doc->ExportField($this->on20);
						if ($this->on40->Exportable) $Doc->ExportField($this->on40);
						if ($this->on45->Exportable) $Doc->ExportField($this->on45);
						if ($this->offket->Exportable) $Doc->ExportField($this->offket);
						if ($this->off20->Exportable) $Doc->ExportField($this->off20);
						if ($this->off40->Exportable) $Doc->ExportField($this->off40);
						if ($this->off45->Exportable) $Doc->ExportField($this->off45);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->depo_id->Exportable) $Doc->ExportField($this->depo_id);
						if ($this->pelayaran_id->Exportable) $Doc->ExportField($this->pelayaran_id);
						if ($this->on20->Exportable) $Doc->ExportField($this->on20);
						if ($this->on40->Exportable) $Doc->ExportField($this->on40);
						if ($this->on45->Exportable) $Doc->ExportField($this->on45);
						if ($this->offket->Exportable) $Doc->ExportField($this->offket);
						if ($this->off20->Exportable) $Doc->ExportField($this->off20);
						if ($this->off40->Exportable) $Doc->ExportField($this->off40);
						if ($this->off45->Exportable) $Doc->ExportField($this->off45);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 't03_lift';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't03_lift';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 't03_lift';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 't03_lift';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
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
}
?>
