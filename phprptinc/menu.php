<!-- Begin Main Menu -->
<div class="ewMenu">
<?php $RootMenu = new crMenu(EWR_MENUBAR_ID); ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(8, "mi_r01_pelayaran", $ReportLanguage->Phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("8", "MenuText") . $ReportLanguage->Phrase("DetailSummaryReportMenuItemSuffix"), "r01_pelayaransmry.php", -1, "", AllowList("{77B51533-F1E4-4C23-925C-E363F9E1C0BE}r01_pelayaran"), FALSE);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(-1, "mi_logout", $ReportLanguage->Phrase("Logout"), "rlogout.php", -1, "", TRUE);
} elseif (substr(ewr_ScriptName(), 0 - strlen("rlogin.php")) <> "rlogin.php") {
	$RootMenu->AddMenuItem(-1, "mi_login", $ReportLanguage->Phrase("Login"), "rlogin.php", -1, "", TRUE);
}
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
