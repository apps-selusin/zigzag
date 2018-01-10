<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t04_depoinfo.php" ?>
<?php include_once "t98_employeesinfo.php" ?>
<?php include_once "t03_liftgridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t04_depo_add = NULL; // Initialize page object first

class ct04_depo_add extends ct04_depo {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}";

	// Table name
	var $TableName = 't04_depo';

	// Page object name
	var $PageObjName = 't04_depo_add';

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

		// Table object (t04_depo)
		if (!isset($GLOBALS["t04_depo"]) || get_class($GLOBALS["t04_depo"]) == "ct04_depo") {
			$GLOBALS["t04_depo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t04_depo"];
		}

		// Table object (t98_employees)
		if (!isset($GLOBALS['t98_employees'])) $GLOBALS['t98_employees'] = new ct98_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't04_depo', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t04_depolist.php"));
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
		$this->nama->SetVisibility();
		$this->alamat->SetVisibility();
		$this->kota->SetVisibility();
		$this->propinsi->SetVisibility();
		$this->no_telp->SetVisibility();
		$this->no_fax->SetVisibility();

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

			// Process auto fill for detail table 't03_lift'
			if (@$_POST["grid"] == "ft03_liftgrid") {
				if (!isset($GLOBALS["t03_lift_grid"])) $GLOBALS["t03_lift_grid"] = new ct03_lift_grid;
				$GLOBALS["t03_lift_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $t04_depo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t04_depo);
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

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

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t04_depolist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t04_depolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t04_depoview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetUpDetailParms();
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->alamat->CurrentValue = NULL;
		$this->alamat->OldValue = $this->alamat->CurrentValue;
		$this->kota->CurrentValue = NULL;
		$this->kota->OldValue = $this->kota->CurrentValue;
		$this->propinsi->CurrentValue = NULL;
		$this->propinsi->OldValue = $this->propinsi->CurrentValue;
		$this->no_telp->CurrentValue = NULL;
		$this->no_telp->OldValue = $this->no_telp->CurrentValue;
		$this->no_fax->CurrentValue = NULL;
		$this->no_fax->OldValue = $this->no_fax->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->nama->FldIsDetailKey) {
			$this->nama->setFormValue($objForm->GetValue("x_nama"));
		}
		if (!$this->alamat->FldIsDetailKey) {
			$this->alamat->setFormValue($objForm->GetValue("x_alamat"));
		}
		if (!$this->kota->FldIsDetailKey) {
			$this->kota->setFormValue($objForm->GetValue("x_kota"));
		}
		if (!$this->propinsi->FldIsDetailKey) {
			$this->propinsi->setFormValue($objForm->GetValue("x_propinsi"));
		}
		if (!$this->no_telp->FldIsDetailKey) {
			$this->no_telp->setFormValue($objForm->GetValue("x_no_telp"));
		}
		if (!$this->no_fax->FldIsDetailKey) {
			$this->no_fax->setFormValue($objForm->GetValue("x_no_fax"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->alamat->CurrentValue = $this->alamat->FormValue;
		$this->kota->CurrentValue = $this->kota->FormValue;
		$this->propinsi->CurrentValue = $this->propinsi->FormValue;
		$this->no_telp->CurrentValue = $this->no_telp->FormValue;
		$this->no_fax->CurrentValue = $this->no_fax->FormValue;
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
		$this->nama->setDbValue($rs->fields('nama'));
		$this->alamat->setDbValue($rs->fields('alamat'));
		$this->kota->setDbValue($rs->fields('kota'));
		$this->propinsi->setDbValue($rs->fields('propinsi'));
		$this->no_telp->setDbValue($rs->fields('no_telp'));
		$this->no_fax->setDbValue($rs->fields('no_fax'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->nama->DbValue = $row['nama'];
		$this->alamat->DbValue = $row['alamat'];
		$this->kota->DbValue = $row['kota'];
		$this->propinsi->DbValue = $row['propinsi'];
		$this->no_telp->DbValue = $row['no_telp'];
		$this->no_fax->DbValue = $row['no_fax'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// nama
		// alamat
		// kota
		// propinsi
		// no_telp
		// no_fax

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// alamat
		$this->alamat->ViewValue = $this->alamat->CurrentValue;
		$this->alamat->ViewCustomAttributes = "";

		// kota
		$this->kota->ViewValue = $this->kota->CurrentValue;
		$this->kota->ViewCustomAttributes = "";

		// propinsi
		$this->propinsi->ViewValue = $this->propinsi->CurrentValue;
		$this->propinsi->ViewCustomAttributes = "";

		// no_telp
		$this->no_telp->ViewValue = $this->no_telp->CurrentValue;
		$this->no_telp->ViewCustomAttributes = "";

		// no_fax
		$this->no_fax->ViewValue = $this->no_fax->CurrentValue;
		$this->no_fax->ViewCustomAttributes = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";

			// kota
			$this->kota->LinkCustomAttributes = "";
			$this->kota->HrefValue = "";
			$this->kota->TooltipValue = "";

			// propinsi
			$this->propinsi->LinkCustomAttributes = "";
			$this->propinsi->HrefValue = "";
			$this->propinsi->TooltipValue = "";

			// no_telp
			$this->no_telp->LinkCustomAttributes = "";
			$this->no_telp->HrefValue = "";
			$this->no_telp->TooltipValue = "";

			// no_fax
			$this->no_fax->LinkCustomAttributes = "";
			$this->no_fax->HrefValue = "";
			$this->no_fax->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			$this->nama->EditValue = ew_HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = ew_RemoveHtml($this->nama->FldCaption());

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			$this->alamat->EditValue = ew_HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = ew_RemoveHtml($this->alamat->FldCaption());

			// kota
			$this->kota->EditAttrs["class"] = "form-control";
			$this->kota->EditCustomAttributes = "";
			$this->kota->EditValue = ew_HtmlEncode($this->kota->CurrentValue);
			$this->kota->PlaceHolder = ew_RemoveHtml($this->kota->FldCaption());

			// propinsi
			$this->propinsi->EditAttrs["class"] = "form-control";
			$this->propinsi->EditCustomAttributes = "";
			$this->propinsi->EditValue = ew_HtmlEncode($this->propinsi->CurrentValue);
			$this->propinsi->PlaceHolder = ew_RemoveHtml($this->propinsi->FldCaption());

			// no_telp
			$this->no_telp->EditAttrs["class"] = "form-control";
			$this->no_telp->EditCustomAttributes = "";
			$this->no_telp->EditValue = ew_HtmlEncode($this->no_telp->CurrentValue);
			$this->no_telp->PlaceHolder = ew_RemoveHtml($this->no_telp->FldCaption());

			// no_fax
			$this->no_fax->EditAttrs["class"] = "form-control";
			$this->no_fax->EditCustomAttributes = "";
			$this->no_fax->EditValue = ew_HtmlEncode($this->no_fax->CurrentValue);
			$this->no_fax->PlaceHolder = ew_RemoveHtml($this->no_fax->FldCaption());

			// Add refer script
			// nama

			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// kota
			$this->kota->LinkCustomAttributes = "";
			$this->kota->HrefValue = "";

			// propinsi
			$this->propinsi->LinkCustomAttributes = "";
			$this->propinsi->HrefValue = "";

			// no_telp
			$this->no_telp->LinkCustomAttributes = "";
			$this->no_telp->HrefValue = "";

			// no_fax
			$this->no_fax->LinkCustomAttributes = "";
			$this->no_fax->HrefValue = "";
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
		if (!$this->nama->FldIsDetailKey && !is_null($this->nama->FormValue) && $this->nama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nama->FldCaption(), $this->nama->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t03_lift", $DetailTblVar) && $GLOBALS["t03_lift"]->DetailAdd) {
			if (!isset($GLOBALS["t03_lift_grid"])) $GLOBALS["t03_lift_grid"] = new ct03_lift_grid(); // get detail page object
			$GLOBALS["t03_lift_grid"]->ValidateGridForm();
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// nama
		$this->nama->SetDbValueDef($rsnew, $this->nama->CurrentValue, "", FALSE);

		// alamat
		$this->alamat->SetDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, FALSE);

		// kota
		$this->kota->SetDbValueDef($rsnew, $this->kota->CurrentValue, NULL, FALSE);

		// propinsi
		$this->propinsi->SetDbValueDef($rsnew, $this->propinsi->CurrentValue, NULL, FALSE);

		// no_telp
		$this->no_telp->SetDbValueDef($rsnew, $this->no_telp->CurrentValue, NULL, FALSE);

		// no_fax
		$this->no_fax->SetDbValueDef($rsnew, $this->no_fax->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("t03_lift", $DetailTblVar) && $GLOBALS["t03_lift"]->DetailAdd) {
				$GLOBALS["t03_lift"]->depo_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t03_lift_grid"])) $GLOBALS["t03_lift_grid"] = new ct03_lift_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "t03_lift"); // Load user level of detail table
				$AddRow = $GLOBALS["t03_lift_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["t03_lift"]->depo_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t03_lift", $DetailTblVar)) {
				if (!isset($GLOBALS["t03_lift_grid"]))
					$GLOBALS["t03_lift_grid"] = new ct03_lift_grid;
				if ($GLOBALS["t03_lift_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t03_lift_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t03_lift_grid"]->CurrentMode = "add";
					$GLOBALS["t03_lift_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t03_lift_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t03_lift_grid"]->setStartRecordNumber(1);
					$GLOBALS["t03_lift_grid"]->depo_id->FldIsDetailKey = TRUE;
					$GLOBALS["t03_lift_grid"]->depo_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t03_lift_grid"]->depo_id->setSessionValue($GLOBALS["t03_lift_grid"]->depo_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t04_depolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($t04_depo_add)) $t04_depo_add = new ct04_depo_add();

// Page init
$t04_depo_add->Page_Init();

// Page main
$t04_depo_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t04_depo_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft04_depoadd = new ew_Form("ft04_depoadd", "add");

// Validate form
ft04_depoadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t04_depo->nama->FldCaption(), $t04_depo->nama->ReqErrMsg)) ?>");

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
ft04_depoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft04_depoadd.ValidateRequired = true;
<?php } else { ?>
ft04_depoadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t04_depo_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t04_depo_add->ShowPageHeader(); ?>
<?php
$t04_depo_add->ShowMessage();
?>
<form name="ft04_depoadd" id="ft04_depoadd" class="<?php echo $t04_depo_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t04_depo_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t04_depo_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t04_depo">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t04_depo_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t04_depo->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group">
		<label id="elh_t04_depo_nama" for="x_nama" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->nama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->nama->CellAttributes() ?>>
<span id="el_t04_depo_nama">
<input type="text" data-table="t04_depo" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t04_depo->nama->getPlaceHolder()) ?>" value="<?php echo $t04_depo->nama->EditValue ?>"<?php echo $t04_depo->nama->EditAttributes() ?>>
</span>
<?php echo $t04_depo->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_depo->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group">
		<label id="elh_t04_depo_alamat" for="x_alamat" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->alamat->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->alamat->CellAttributes() ?>>
<span id="el_t04_depo_alamat">
<input type="text" data-table="t04_depo" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t04_depo->alamat->getPlaceHolder()) ?>" value="<?php echo $t04_depo->alamat->EditValue ?>"<?php echo $t04_depo->alamat->EditAttributes() ?>>
</span>
<?php echo $t04_depo->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_depo->kota->Visible) { // kota ?>
	<div id="r_kota" class="form-group">
		<label id="elh_t04_depo_kota" for="x_kota" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->kota->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->kota->CellAttributes() ?>>
<span id="el_t04_depo_kota">
<input type="text" data-table="t04_depo" data-field="x_kota" name="x_kota" id="x_kota" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t04_depo->kota->getPlaceHolder()) ?>" value="<?php echo $t04_depo->kota->EditValue ?>"<?php echo $t04_depo->kota->EditAttributes() ?>>
</span>
<?php echo $t04_depo->kota->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_depo->propinsi->Visible) { // propinsi ?>
	<div id="r_propinsi" class="form-group">
		<label id="elh_t04_depo_propinsi" for="x_propinsi" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->propinsi->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->propinsi->CellAttributes() ?>>
<span id="el_t04_depo_propinsi">
<input type="text" data-table="t04_depo" data-field="x_propinsi" name="x_propinsi" id="x_propinsi" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t04_depo->propinsi->getPlaceHolder()) ?>" value="<?php echo $t04_depo->propinsi->EditValue ?>"<?php echo $t04_depo->propinsi->EditAttributes() ?>>
</span>
<?php echo $t04_depo->propinsi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_depo->no_telp->Visible) { // no_telp ?>
	<div id="r_no_telp" class="form-group">
		<label id="elh_t04_depo_no_telp" for="x_no_telp" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->no_telp->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->no_telp->CellAttributes() ?>>
<span id="el_t04_depo_no_telp">
<input type="text" data-table="t04_depo" data-field="x_no_telp" name="x_no_telp" id="x_no_telp" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t04_depo->no_telp->getPlaceHolder()) ?>" value="<?php echo $t04_depo->no_telp->EditValue ?>"<?php echo $t04_depo->no_telp->EditAttributes() ?>>
</span>
<?php echo $t04_depo->no_telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t04_depo->no_fax->Visible) { // no_fax ?>
	<div id="r_no_fax" class="form-group">
		<label id="elh_t04_depo_no_fax" for="x_no_fax" class="col-sm-2 control-label ewLabel"><?php echo $t04_depo->no_fax->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t04_depo->no_fax->CellAttributes() ?>>
<span id="el_t04_depo_no_fax">
<input type="text" data-table="t04_depo" data-field="x_no_fax" name="x_no_fax" id="x_no_fax" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t04_depo->no_fax->getPlaceHolder()) ?>" value="<?php echo $t04_depo->no_fax->EditValue ?>"<?php echo $t04_depo->no_fax->EditAttributes() ?>>
</span>
<?php echo $t04_depo->no_fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php
	if (in_array("t03_lift", explode(",", $t04_depo->getCurrentDetailTable())) && $t03_lift->DetailAdd) {
?>
<?php if ($t04_depo->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t03_lift", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t03_liftgrid.php" ?>
<?php } ?>
<?php if (!$t04_depo_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t04_depo_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft04_depoadd.Init();
</script>
<?php
$t04_depo_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t04_depo_add->Page_Terminate();
?>
