<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_liftinfo.php" ?>
<?php include_once "t04_depoinfo.php" ?>
<?php include_once "t98_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_lift_delete = NULL; // Initialize page object first

class ct03_lift_delete extends ct03_lift {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}";

	// Table name
	var $TableName = 't03_lift';

	// Page object name
	var $PageObjName = 't03_lift_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t03_lift)
		if (!isset($GLOBALS["t03_lift"]) || get_class($GLOBALS["t03_lift"]) == "ct03_lift") {
			$GLOBALS["t03_lift"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t03_lift"];
		}

		// Table object (t04_depo)
		if (!isset($GLOBALS['t04_depo'])) $GLOBALS['t04_depo'] = new ct04_depo();

		// Table object (t98_employees)
		if (!isset($GLOBALS['t98_employees'])) $GLOBALS['t98_employees'] = new ct98_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_lift', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t98_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct98_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t03_liftlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->depo_id->SetVisibility();
		$this->pelayaran_id->SetVisibility();
		$this->on20->SetVisibility();
		$this->on40->SetVisibility();
		$this->on45->SetVisibility();
		$this->offket->SetVisibility();
		$this->off20->SetVisibility();
		$this->off40->SetVisibility();
		$this->off45->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t03_lift;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t03_lift);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t03_liftlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t03_lift class, t03_liftinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t03_liftlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->depo_id->setDbValue($rs->fields('depo_id'));
		$this->pelayaran_id->setDbValue($rs->fields('pelayaran_id'));
		if (array_key_exists('EV__pelayaran_id', $rs->fields)) {
			$this->pelayaran_id->VirtualValue = $rs->fields('EV__pelayaran_id'); // Set up virtual field value
		} else {
			$this->pelayaran_id->VirtualValue = ""; // Clear value
		}
		$this->on20->setDbValue($rs->fields('on20'));
		$this->on40->setDbValue($rs->fields('on40'));
		$this->on45->setDbValue($rs->fields('on45'));
		$this->offket->setDbValue($rs->fields('offket'));
		$this->off20->setDbValue($rs->fields('off20'));
		$this->off40->setDbValue($rs->fields('off40'));
		$this->off45->setDbValue($rs->fields('off45'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->depo_id->DbValue = $row['depo_id'];
		$this->pelayaran_id->DbValue = $row['pelayaran_id'];
		$this->on20->DbValue = $row['on20'];
		$this->on40->DbValue = $row['on40'];
		$this->on45->DbValue = $row['on45'];
		$this->offket->DbValue = $row['offket'];
		$this->off20->DbValue = $row['off20'];
		$this->off40->DbValue = $row['off40'];
		$this->off45->DbValue = $row['off45'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->on20->FormValue == $this->on20->CurrentValue && is_numeric(ew_StrToFloat($this->on20->CurrentValue)))
			$this->on20->CurrentValue = ew_StrToFloat($this->on20->CurrentValue);

		// Convert decimal values if posted back
		if ($this->on40->FormValue == $this->on40->CurrentValue && is_numeric(ew_StrToFloat($this->on40->CurrentValue)))
			$this->on40->CurrentValue = ew_StrToFloat($this->on40->CurrentValue);

		// Convert decimal values if posted back
		if ($this->on45->FormValue == $this->on45->CurrentValue && is_numeric(ew_StrToFloat($this->on45->CurrentValue)))
			$this->on45->CurrentValue = ew_StrToFloat($this->on45->CurrentValue);

		// Convert decimal values if posted back
		if ($this->off20->FormValue == $this->off20->CurrentValue && is_numeric(ew_StrToFloat($this->off20->CurrentValue)))
			$this->off20->CurrentValue = ew_StrToFloat($this->off20->CurrentValue);

		// Convert decimal values if posted back
		if ($this->off40->FormValue == $this->off40->CurrentValue && is_numeric(ew_StrToFloat($this->off40->CurrentValue)))
			$this->off40->CurrentValue = ew_StrToFloat($this->off40->CurrentValue);

		// Convert decimal values if posted back
		if ($this->off45->FormValue == $this->off45->CurrentValue && is_numeric(ew_StrToFloat($this->off45->CurrentValue)))
			$this->off45->CurrentValue = ew_StrToFloat($this->off45->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t04_depo") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t04_depo"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->depo_id->setQueryStringValue($GLOBALS["t04_depo"]->id->QueryStringValue);
					$this->depo_id->setSessionValue($this->depo_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t04_depo"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t04_depo") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t04_depo"]->id->setFormValue($_POST["fk_id"]);
					$this->depo_id->setFormValue($GLOBALS["t04_depo"]->id->FormValue);
					$this->depo_id->setSessionValue($this->depo_id->FormValue);
					if (!is_numeric($GLOBALS["t04_depo"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t04_depo") {
				if ($this->depo_id->CurrentValue == "") $this->depo_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t03_liftlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t03_lift_delete)) $t03_lift_delete = new ct03_lift_delete();

// Page init
$t03_lift_delete->Page_Init();

// Page main
$t03_lift_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_lift_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft03_liftdelete = new ew_Form("ft03_liftdelete", "delete");

// Form_CustomValidate event
ft03_liftdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_liftdelete.ValidateRequired = true;
<?php } else { ?>
ft03_liftdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_liftdelete.Lists["x_pelayaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_pelayaran"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $t03_lift_delete->ShowPageHeader(); ?>
<?php
$t03_lift_delete->ShowMessage();
?>
<form name="ft03_liftdelete" id="ft03_liftdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_lift_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_lift_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_lift">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t03_lift_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t03_lift->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
		<th><span id="elh_t03_lift_depo_id" class="t03_lift_depo_id"><?php echo $t03_lift->depo_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
		<th><span id="elh_t03_lift_pelayaran_id" class="t03_lift_pelayaran_id"><?php echo $t03_lift->pelayaran_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->on20->Visible) { // on20 ?>
		<th><span id="elh_t03_lift_on20" class="t03_lift_on20"><?php echo $t03_lift->on20->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->on40->Visible) { // on40 ?>
		<th><span id="elh_t03_lift_on40" class="t03_lift_on40"><?php echo $t03_lift->on40->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->on45->Visible) { // on45 ?>
		<th><span id="elh_t03_lift_on45" class="t03_lift_on45"><?php echo $t03_lift->on45->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->offket->Visible) { // offket ?>
		<th><span id="elh_t03_lift_offket" class="t03_lift_offket"><?php echo $t03_lift->offket->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->off20->Visible) { // off20 ?>
		<th><span id="elh_t03_lift_off20" class="t03_lift_off20"><?php echo $t03_lift->off20->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->off40->Visible) { // off40 ?>
		<th><span id="elh_t03_lift_off40" class="t03_lift_off40"><?php echo $t03_lift->off40->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_lift->off45->Visible) { // off45 ?>
		<th><span id="elh_t03_lift_off45" class="t03_lift_off45"><?php echo $t03_lift->off45->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t03_lift_delete->RecCnt = 0;
$i = 0;
while (!$t03_lift_delete->Recordset->EOF) {
	$t03_lift_delete->RecCnt++;
	$t03_lift_delete->RowCnt++;

	// Set row properties
	$t03_lift->ResetAttrs();
	$t03_lift->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t03_lift_delete->LoadRowValues($t03_lift_delete->Recordset);

	// Render row
	$t03_lift_delete->RenderRow();
?>
	<tr<?php echo $t03_lift->RowAttributes() ?>>
<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
		<td<?php echo $t03_lift->depo_id->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_depo_id" class="t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<?php echo $t03_lift->depo_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
		<td<?php echo $t03_lift->pelayaran_id->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_pelayaran_id" class="t03_lift_pelayaran_id">
<span<?php echo $t03_lift->pelayaran_id->ViewAttributes() ?>>
<?php echo $t03_lift->pelayaran_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->on20->Visible) { // on20 ?>
		<td<?php echo $t03_lift->on20->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_on20" class="t03_lift_on20">
<span<?php echo $t03_lift->on20->ViewAttributes() ?>>
<?php echo $t03_lift->on20->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->on40->Visible) { // on40 ?>
		<td<?php echo $t03_lift->on40->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_on40" class="t03_lift_on40">
<span<?php echo $t03_lift->on40->ViewAttributes() ?>>
<?php echo $t03_lift->on40->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->on45->Visible) { // on45 ?>
		<td<?php echo $t03_lift->on45->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_on45" class="t03_lift_on45">
<span<?php echo $t03_lift->on45->ViewAttributes() ?>>
<?php echo $t03_lift->on45->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->offket->Visible) { // offket ?>
		<td<?php echo $t03_lift->offket->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_offket" class="t03_lift_offket">
<span<?php echo $t03_lift->offket->ViewAttributes() ?>>
<?php echo $t03_lift->offket->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->off20->Visible) { // off20 ?>
		<td<?php echo $t03_lift->off20->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_off20" class="t03_lift_off20">
<span<?php echo $t03_lift->off20->ViewAttributes() ?>>
<?php echo $t03_lift->off20->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->off40->Visible) { // off40 ?>
		<td<?php echo $t03_lift->off40->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_off40" class="t03_lift_off40">
<span<?php echo $t03_lift->off40->ViewAttributes() ?>>
<?php echo $t03_lift->off40->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_lift->off45->Visible) { // off45 ?>
		<td<?php echo $t03_lift->off45->CellAttributes() ?>>
<span id="el<?php echo $t03_lift_delete->RowCnt ?>_t03_lift_off45" class="t03_lift_off45">
<span<?php echo $t03_lift->off45->ViewAttributes() ?>>
<?php echo $t03_lift->off45->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t03_lift_delete->Recordset->MoveNext();
}
$t03_lift_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_lift_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft03_liftdelete.Init();
</script>
<?php
$t03_lift_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t03_lift_delete->Page_Terminate();
?>
