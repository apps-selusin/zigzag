<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(6, "mi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(12, "mci_Dokumen", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mi_t01_ajudok", $Language->MenuPhrase("1", "MenuText"), "t01_ajudoklist.php", 12, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok'), FALSE, FALSE);
$RootMenu->AddMenuItem(13, "mci_Depo", $Language->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mci_Status", $Language->MenuPhrase("14", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(15, "mci_Trucking", $Language->MenuPhrase("15", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mci_Lalu_Lintas", $Language->MenuPhrase("16", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(17, "mci_Forum", $Language->MenuPhrase("17", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(18, "mci_Setting", $Language->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(2, "mi_t99_audittrail", $Language->MenuPhrase("2", "MenuText"), "t99_audittraillist.php", 18, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mi_t98_employees", $Language->MenuPhrase("3", "MenuText"), "t98_employeeslist.php", 18, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t98_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(4, "mi_t96_userlevelpermissions", $Language->MenuPhrase("4", "MenuText"), "t96_userlevelpermissionslist.php", 18, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(5, "mi_t97_userlevels", $Language->MenuPhrase("5", "MenuText"), "t97_userlevelslist.php", 18, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
