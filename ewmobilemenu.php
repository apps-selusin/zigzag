<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(6, "mmi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(12, "mmci_Dokumen", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mmi_t01_ajudok", $Language->MenuPhrase("1", "MenuText"), "t01_ajudoklist.php", 12, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok'), FALSE, FALSE);
$RootMenu->AddMenuItem(13, "mmci_Depo", $Language->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mmci_Status", $Language->MenuPhrase("14", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(15, "mmci_Trucking", $Language->MenuPhrase("15", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mmci_Lalu_Lintas", $Language->MenuPhrase("16", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(17, "mmci_Forum", $Language->MenuPhrase("17", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(18, "mmci_Setting", $Language->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(2, "mmi_t99_audittrail", $Language->MenuPhrase("2", "MenuText"), "t99_audittraillist.php", 18, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mmi_t98_employees", $Language->MenuPhrase("3", "MenuText"), "t98_employeeslist.php", 18, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t98_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(4, "mmi_t96_userlevelpermissions", $Language->MenuPhrase("4", "MenuText"), "t96_userlevelpermissionslist.php", 18, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(5, "mmi_t97_userlevels", $Language->MenuPhrase("5", "MenuText"), "t97_userlevelslist.php", 18, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
