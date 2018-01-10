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

$t03_lift_edit = NULL; // Initialize page object first

class ct03_lift_edit extends ct03_lift {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}";

	// Table name
	var $TableName = 't03_lift';

	// Page object name
	var $PageObjName = 't03_lift_edit';

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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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

		// Create form object
		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
			$this->RecKey["id"] = $this->id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t03_liftlist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t03_liftlist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t03_liftlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->depo_id->FldIsDetailKey) {
			$this->depo_id->setFormValue($objForm->GetValue("x_depo_id"));
		}
		if (!$this->pelayaran_id->FldIsDetailKey) {
			$this->pelayaran_id->setFormValue($objForm->GetValue("x_pelayaran_id"));
		}
		if (!$this->on20->FldIsDetailKey) {
			$this->on20->setFormValue($objForm->GetValue("x_on20"));
		}
		if (!$this->on40->FldIsDetailKey) {
			$this->on40->setFormValue($objForm->GetValue("x_on40"));
		}
		if (!$this->on45->FldIsDetailKey) {
			$this->on45->setFormValue($objForm->GetValue("x_on45"));
		}
		if (!$this->offket->FldIsDetailKey) {
			$this->offket->setFormValue($objForm->GetValue("x_offket"));
		}
		if (!$this->off20->FldIsDetailKey) {
			$this->off20->setFormValue($objForm->GetValue("x_off20"));
		}
		if (!$this->off40->FldIsDetailKey) {
			$this->off40->setFormValue($objForm->GetValue("x_off40"));
		}
		if (!$this->off45->FldIsDetailKey) {
			$this->off45->setFormValue($objForm->GetValue("x_off45"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->depo_id->CurrentValue = $this->depo_id->FormValue;
		$this->pelayaran_id->CurrentValue = $this->pelayaran_id->FormValue;
		$this->on20->CurrentValue = $this->on20->FormValue;
		$this->on40->CurrentValue = $this->on40->FormValue;
		$this->on45->CurrentValue = $this->on45->FormValue;
		$this->offket->CurrentValue = $this->offket->FormValue;
		$this->off20->CurrentValue = $this->off20->FormValue;
		$this->off40->CurrentValue = $this->off40->FormValue;
		$this->off45->CurrentValue = $this->off45->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// depo_id
			$this->depo_id->EditAttrs["class"] = "form-control";
			$this->depo_id->EditCustomAttributes = "";
			if ($this->depo_id->getSessionValue() <> "") {
				$this->depo_id->CurrentValue = $this->depo_id->getSessionValue();
			$this->depo_id->ViewValue = $this->depo_id->CurrentValue;
			$this->depo_id->ViewCustomAttributes = "";
			} else {
			$this->depo_id->EditValue = ew_HtmlEncode($this->depo_id->CurrentValue);
			$this->depo_id->PlaceHolder = ew_RemoveHtml($this->depo_id->FldCaption());
			}

			// pelayaran_id
			$this->pelayaran_id->EditCustomAttributes = "";
			if (trim(strval($this->pelayaran_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->pelayaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t02_pelayaran`";
			$sWhereWrk = "";
			$this->pelayaran_id->LookupFilters = array("dx1" => '`nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pelayaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->pelayaran_id->ViewValue = $this->pelayaran_id->DisplayValue($arwrk);
			} else {
				$this->pelayaran_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pelayaran_id->EditValue = $arwrk;

			// on20
			$this->on20->EditAttrs["class"] = "form-control";
			$this->on20->EditCustomAttributes = "";
			$this->on20->EditValue = ew_HtmlEncode($this->on20->CurrentValue);
			$this->on20->PlaceHolder = ew_RemoveHtml($this->on20->FldCaption());
			if (strval($this->on20->EditValue) <> "" && is_numeric($this->on20->EditValue)) $this->on20->EditValue = ew_FormatNumber($this->on20->EditValue, -2, -1, -2, 0);

			// on40
			$this->on40->EditAttrs["class"] = "form-control";
			$this->on40->EditCustomAttributes = "";
			$this->on40->EditValue = ew_HtmlEncode($this->on40->CurrentValue);
			$this->on40->PlaceHolder = ew_RemoveHtml($this->on40->FldCaption());
			if (strval($this->on40->EditValue) <> "" && is_numeric($this->on40->EditValue)) $this->on40->EditValue = ew_FormatNumber($this->on40->EditValue, -2, -1, -2, 0);

			// on45
			$this->on45->EditAttrs["class"] = "form-control";
			$this->on45->EditCustomAttributes = "";
			$this->on45->EditValue = ew_HtmlEncode($this->on45->CurrentValue);
			$this->on45->PlaceHolder = ew_RemoveHtml($this->on45->FldCaption());
			if (strval($this->on45->EditValue) <> "" && is_numeric($this->on45->EditValue)) $this->on45->EditValue = ew_FormatNumber($this->on45->EditValue, -2, -1, -2, 0);

			// offket
			$this->offket->EditAttrs["class"] = "form-control";
			$this->offket->EditCustomAttributes = "";
			$this->offket->EditValue = ew_HtmlEncode($this->offket->CurrentValue);
			$this->offket->PlaceHolder = ew_RemoveHtml($this->offket->FldCaption());

			// off20
			$this->off20->EditAttrs["class"] = "form-control";
			$this->off20->EditCustomAttributes = "";
			$this->off20->EditValue = ew_HtmlEncode($this->off20->CurrentValue);
			$this->off20->PlaceHolder = ew_RemoveHtml($this->off20->FldCaption());
			if (strval($this->off20->EditValue) <> "" && is_numeric($this->off20->EditValue)) $this->off20->EditValue = ew_FormatNumber($this->off20->EditValue, -2, -1, -2, 0);

			// off40
			$this->off40->EditAttrs["class"] = "form-control";
			$this->off40->EditCustomAttributes = "";
			$this->off40->EditValue = ew_HtmlEncode($this->off40->CurrentValue);
			$this->off40->PlaceHolder = ew_RemoveHtml($this->off40->FldCaption());
			if (strval($this->off40->EditValue) <> "" && is_numeric($this->off40->EditValue)) $this->off40->EditValue = ew_FormatNumber($this->off40->EditValue, -2, -1, -2, 0);

			// off45
			$this->off45->EditAttrs["class"] = "form-control";
			$this->off45->EditCustomAttributes = "";
			$this->off45->EditValue = ew_HtmlEncode($this->off45->CurrentValue);
			$this->off45->PlaceHolder = ew_RemoveHtml($this->off45->FldCaption());
			if (strval($this->off45->EditValue) <> "" && is_numeric($this->off45->EditValue)) $this->off45->EditValue = ew_FormatNumber($this->off45->EditValue, -2, -1, -2, 0);

			// Edit refer script
			// depo_id

			$this->depo_id->LinkCustomAttributes = "";
			$this->depo_id->HrefValue = "";

			// pelayaran_id
			$this->pelayaran_id->LinkCustomAttributes = "";
			$this->pelayaran_id->HrefValue = "";

			// on20
			$this->on20->LinkCustomAttributes = "";
			$this->on20->HrefValue = "";

			// on40
			$this->on40->LinkCustomAttributes = "";
			$this->on40->HrefValue = "";

			// on45
			$this->on45->LinkCustomAttributes = "";
			$this->on45->HrefValue = "";

			// offket
			$this->offket->LinkCustomAttributes = "";
			$this->offket->HrefValue = "";

			// off20
			$this->off20->LinkCustomAttributes = "";
			$this->off20->HrefValue = "";

			// off40
			$this->off40->LinkCustomAttributes = "";
			$this->off40->HrefValue = "";

			// off45
			$this->off45->LinkCustomAttributes = "";
			$this->off45->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->depo_id->FldIsDetailKey && !is_null($this->depo_id->FormValue) && $this->depo_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->depo_id->FldCaption(), $this->depo_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->depo_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->depo_id->FldErrMsg());
		}
		if (!$this->pelayaran_id->FldIsDetailKey && !is_null($this->pelayaran_id->FormValue) && $this->pelayaran_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pelayaran_id->FldCaption(), $this->pelayaran_id->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->on20->FormValue)) {
			ew_AddMessage($gsFormError, $this->on20->FldErrMsg());
		}
		if (!ew_CheckNumber($this->on40->FormValue)) {
			ew_AddMessage($gsFormError, $this->on40->FldErrMsg());
		}
		if (!ew_CheckNumber($this->on45->FormValue)) {
			ew_AddMessage($gsFormError, $this->on45->FldErrMsg());
		}
		if (!ew_CheckNumber($this->off20->FormValue)) {
			ew_AddMessage($gsFormError, $this->off20->FldErrMsg());
		}
		if (!ew_CheckNumber($this->off40->FormValue)) {
			ew_AddMessage($gsFormError, $this->off40->FldErrMsg());
		}
		if (!ew_CheckNumber($this->off45->FormValue)) {
			ew_AddMessage($gsFormError, $this->off45->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// depo_id
			$this->depo_id->SetDbValueDef($rsnew, $this->depo_id->CurrentValue, 0, $this->depo_id->ReadOnly);

			// pelayaran_id
			$this->pelayaran_id->SetDbValueDef($rsnew, $this->pelayaran_id->CurrentValue, 0, $this->pelayaran_id->ReadOnly);

			// on20
			$this->on20->SetDbValueDef($rsnew, $this->on20->CurrentValue, NULL, $this->on20->ReadOnly);

			// on40
			$this->on40->SetDbValueDef($rsnew, $this->on40->CurrentValue, NULL, $this->on40->ReadOnly);

			// on45
			$this->on45->SetDbValueDef($rsnew, $this->on45->CurrentValue, NULL, $this->on45->ReadOnly);

			// offket
			$this->offket->SetDbValueDef($rsnew, $this->offket->CurrentValue, NULL, $this->offket->ReadOnly);

			// off20
			$this->off20->SetDbValueDef($rsnew, $this->off20->CurrentValue, NULL, $this->off20->ReadOnly);

			// off40
			$this->off40->SetDbValueDef($rsnew, $this->off40->CurrentValue, NULL, $this->off40->ReadOnly);

			// off45
			$this->off45->SetDbValueDef($rsnew, $this->off45->CurrentValue, NULL, $this->off45->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
			$this->setSessionWhere($this->GetDetailFilter());

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
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pelayaran_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_pelayaran`";
			$sWhereWrk = "{filter}";
			$this->pelayaran_id->LookupFilters = array("dx1" => '`nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pelayaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t03_lift_edit)) $t03_lift_edit = new ct03_lift_edit();

// Page init
$t03_lift_edit->Page_Init();

// Page main
$t03_lift_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_lift_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft03_liftedit = new ew_Form("ft03_liftedit", "edit");

// Validate form
ft03_liftedit.Validate = function() {
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
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft03_liftedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_liftedit.ValidateRequired = true;
<?php } else { ?>
ft03_liftedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_liftedit.Lists["x_pelayaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_pelayaran"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t03_lift_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t03_lift_edit->ShowPageHeader(); ?>
<?php
$t03_lift_edit->ShowMessage();
?>
<?php if (!$t03_lift_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t03_lift_edit->Pager)) $t03_lift_edit->Pager = new cPrevNextPager($t03_lift_edit->StartRec, $t03_lift_edit->DisplayRecs, $t03_lift_edit->TotalRecs) ?>
<?php if ($t03_lift_edit->Pager->RecordCount > 0 && $t03_lift_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_lift_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_lift_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_lift_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_lift_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_lift_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_lift_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft03_liftedit" id="ft03_liftedit" class="<?php echo $t03_lift_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_lift_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_lift_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_lift">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t03_lift_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t03_lift->getCurrentMasterTable() == "t04_depo") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t04_depo">
<input type="hidden" name="fk_id" value="<?php echo $t03_lift->depo_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t03_lift->depo_id->Visible) { // depo_id ?>
	<div id="r_depo_id" class="form-group">
		<label id="elh_t03_lift_depo_id" for="x_depo_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->depo_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->depo_id->CellAttributes() ?>>
<?php if ($t03_lift->depo_id->getSessionValue() <> "") { ?>
<span id="el_t03_lift_depo_id">
<span<?php echo $t03_lift->depo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t03_lift->depo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_depo_id" name="x_depo_id" value="<?php echo ew_HtmlEncode($t03_lift->depo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t03_lift_depo_id">
<input type="text" data-table="t03_lift" data-field="x_depo_id" name="x_depo_id" id="x_depo_id" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->depo_id->getPlaceHolder()) ?>" value="<?php echo $t03_lift->depo_id->EditValue ?>"<?php echo $t03_lift->depo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $t03_lift->depo_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->pelayaran_id->Visible) { // pelayaran_id ?>
	<div id="r_pelayaran_id" class="form-group">
		<label id="elh_t03_lift_pelayaran_id" for="x_pelayaran_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->pelayaran_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->pelayaran_id->CellAttributes() ?>>
<span id="el_t03_lift_pelayaran_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_pelayaran_id"><?php echo (strval($t03_lift->pelayaran_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_lift->pelayaran_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_lift->pelayaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_pelayaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_lift" data-field="x_pelayaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_lift->pelayaran_id->DisplayValueSeparatorAttribute() ?>" name="x_pelayaran_id" id="x_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->CurrentValue ?>"<?php echo $t03_lift->pelayaran_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t02_pelayaran")) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t03_lift->pelayaran_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_pelayaran_id',url:'t02_pelayaranaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_pelayaran_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t03_lift->pelayaran_id->FldCaption() ?></span></button>
<?php } ?>
<input type="hidden" name="s_x_pelayaran_id" id="s_x_pelayaran_id" value="<?php echo $t03_lift->pelayaran_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_lift->pelayaran_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->on20->Visible) { // on20 ?>
	<div id="r_on20" class="form-group">
		<label id="elh_t03_lift_on20" for="x_on20" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->on20->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->on20->CellAttributes() ?>>
<span id="el_t03_lift_on20">
<input type="text" data-table="t03_lift" data-field="x_on20" name="x_on20" id="x_on20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on20->EditValue ?>"<?php echo $t03_lift->on20->EditAttributes() ?>>
</span>
<?php echo $t03_lift->on20->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->on40->Visible) { // on40 ?>
	<div id="r_on40" class="form-group">
		<label id="elh_t03_lift_on40" for="x_on40" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->on40->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->on40->CellAttributes() ?>>
<span id="el_t03_lift_on40">
<input type="text" data-table="t03_lift" data-field="x_on40" name="x_on40" id="x_on40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on40->EditValue ?>"<?php echo $t03_lift->on40->EditAttributes() ?>>
</span>
<?php echo $t03_lift->on40->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->on45->Visible) { // on45 ?>
	<div id="r_on45" class="form-group">
		<label id="elh_t03_lift_on45" for="x_on45" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->on45->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->on45->CellAttributes() ?>>
<span id="el_t03_lift_on45">
<input type="text" data-table="t03_lift" data-field="x_on45" name="x_on45" id="x_on45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->on45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->on45->EditValue ?>"<?php echo $t03_lift->on45->EditAttributes() ?>>
</span>
<?php echo $t03_lift->on45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->offket->Visible) { // offket ?>
	<div id="r_offket" class="form-group">
		<label id="elh_t03_lift_offket" for="x_offket" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->offket->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->offket->CellAttributes() ?>>
<span id="el_t03_lift_offket">
<input type="text" data-table="t03_lift" data-field="x_offket" name="x_offket" id="x_offket" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_lift->offket->getPlaceHolder()) ?>" value="<?php echo $t03_lift->offket->EditValue ?>"<?php echo $t03_lift->offket->EditAttributes() ?>>
</span>
<?php echo $t03_lift->offket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->off20->Visible) { // off20 ?>
	<div id="r_off20" class="form-group">
		<label id="elh_t03_lift_off20" for="x_off20" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->off20->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->off20->CellAttributes() ?>>
<span id="el_t03_lift_off20">
<input type="text" data-table="t03_lift" data-field="x_off20" name="x_off20" id="x_off20" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off20->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off20->EditValue ?>"<?php echo $t03_lift->off20->EditAttributes() ?>>
</span>
<?php echo $t03_lift->off20->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->off40->Visible) { // off40 ?>
	<div id="r_off40" class="form-group">
		<label id="elh_t03_lift_off40" for="x_off40" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->off40->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->off40->CellAttributes() ?>>
<span id="el_t03_lift_off40">
<input type="text" data-table="t03_lift" data-field="x_off40" name="x_off40" id="x_off40" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off40->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off40->EditValue ?>"<?php echo $t03_lift->off40->EditAttributes() ?>>
</span>
<?php echo $t03_lift->off40->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_lift->off45->Visible) { // off45 ?>
	<div id="r_off45" class="form-group">
		<label id="elh_t03_lift_off45" for="x_off45" class="col-sm-2 control-label ewLabel"><?php echo $t03_lift->off45->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t03_lift->off45->CellAttributes() ?>>
<span id="el_t03_lift_off45">
<input type="text" data-table="t03_lift" data-field="x_off45" name="x_off45" id="x_off45" size="30" placeholder="<?php echo ew_HtmlEncode($t03_lift->off45->getPlaceHolder()) ?>" value="<?php echo $t03_lift->off45->EditValue ?>"<?php echo $t03_lift->off45->EditAttributes() ?>>
</span>
<?php echo $t03_lift->off45->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t03_lift" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t03_lift->id->CurrentValue) ?>">
<?php if (!$t03_lift_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_lift_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php if (!isset($t03_lift_edit->Pager)) $t03_lift_edit->Pager = new cPrevNextPager($t03_lift_edit->StartRec, $t03_lift_edit->DisplayRecs, $t03_lift_edit->TotalRecs) ?>
<?php if ($t03_lift_edit->Pager->RecordCount > 0 && $t03_lift_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_lift_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_lift_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_lift_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_lift_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_lift_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_lift_edit->PageUrl() ?>start=<?php echo $t03_lift_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_lift_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft03_liftedit.Init();
</script>
<?php
$t03_lift_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t03_lift_edit->Page_Terminate();
?>
