<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(19, "mmi_cf99_underconstruction_php", $Language->MenuPhrase("19", "MenuText"), "cf99_underconstruction.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf99_underconstruction.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(6, "mmi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(12, "mmci_Dokumen", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(28, "mmci_Export", $Language->MenuPhrase("28", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mmi_t01_ajudok", $Language->MenuPhrase("1", "MenuText"), "t01_ajudoklist.php", 28, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mmci_Re2dExport", $Language->MenuPhrase("31", "MenuText"), "", 28, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mmci_Import", $Language->MenuPhrase("29", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(30, "mmci_BC2e12e1", $Language->MenuPhrase("30", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(32, "mmci_Karantina", $Language->MenuPhrase("32", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(33, "mmci_BPOM", $Language->MenuPhrase("33", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(34, "mmci_LS", $Language->MenuPhrase("34", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(25, "mmci_Depo", $Language->MenuPhrase("25", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(26, "mmci_55", $Language->MenuPhrase("26", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(27, "mmci_66", $Language->MenuPhrase("27", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(35, "mmci_57", $Language->MenuPhrase("35", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(36, "mmci_80", $Language->MenuPhrase("36", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(37, "mmci_MTCON", $Language->MenuPhrase("37", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mmci_Status", $Language->MenuPhrase("14", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(38, "mmci_TPS", $Language->MenuPhrase("38", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(39, "mmci_T2e_Lamong", $Language->MenuPhrase("39", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(40, "mmci_Schedule", $Language->MenuPhrase("40", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(41, "mmci_Bea_Container", $Language->MenuPhrase("41", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(15, "mmci_Trucking", $Language->MenuPhrase("15", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(42, "mmci_Tarif", $Language->MenuPhrase("42", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(43, "mmci_Muatan", $Language->MenuPhrase("43", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mmci_Lalu_Lintas", $Language->MenuPhrase("16", "MenuText"), "cf99_underconstruction.php", -1, "", TRUE, FALSE, TRUE);
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
