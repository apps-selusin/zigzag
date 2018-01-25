<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(6, "mmi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(89, "mmci_Master", $Language->MenuPhrase("89", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10009, "mmi_t04_depo", $Language->MenuPhrase("10009", "MenuText"), "t04_depolist.php", 89, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t04_depo'), FALSE, FALSE);
$RootMenu->AddMenuItem(64, "mmi_t02_pelayaran", $Language->MenuPhrase("64", "MenuText"), "t02_pelayaranlist.php", 89, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t02_pelayaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mmci_Dokumen", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(28, "mmci_Export", $Language->MenuPhrase("28", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mmi_t01_ajudok", $Language->MenuPhrase("1", "MenuText"), "t01_ajudoklist.php", 28, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mmci_Re2dExport", $Language->MenuPhrase("31", "MenuText"), "cf99_underconstruction.php", 28, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mmci_Import", $Language->MenuPhrase("29", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(30, "mmci_BC2e12e1", $Language->MenuPhrase("30", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(58, "mmci_BC2e12e2", $Language->MenuPhrase("58", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(59, "mmci_BC2e22e3", $Language->MenuPhrase("59", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(60, "mmci_J2e_Merah", $Language->MenuPhrase("60", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(61, "mmci_J2e_Kuning", $Language->MenuPhrase("61", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(62, "mmci_J2e_Hijau", $Language->MenuPhrase("62", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(63, "mmci_Re2dImport", $Language->MenuPhrase("63", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(32, "mmci_Karantina", $Language->MenuPhrase("32", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(33, "mmci_BPOM", $Language->MenuPhrase("33", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(34, "mmci_LS", $Language->MenuPhrase("34", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10010, "mmri_r015fdepo", $Language->MenuPhrase("10010", "MenuText"), "r01_deposmry.php", -1, "{77B51533-F1E4-4C23-925C-E363F9E1C0BE}", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mmci_Pelabuhan", $Language->MenuPhrase("14", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(38, "mmci_TPS", $Language->MenuPhrase("38", "MenuText"), "www.tps.co.id:81/webaccess/", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(39, "mmci_Teluk_Lamong", $Language->MenuPhrase("39", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(40, "mmci_Schedule", $Language->MenuPhrase("40", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(41, "mmci_Bea_Container", $Language->MenuPhrase("41", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(15, "mmci_Trucking", $Language->MenuPhrase("15", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(42, "mmci_Tarif", $Language->MenuPhrase("42", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(43, "mmci_Muatan", $Language->MenuPhrase("43", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mmci_Lalu_Lintas", $Language->MenuPhrase("16", "MenuText"), "cf99_underconstruction.php", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(17, "mmci_Forum", $Language->MenuPhrase("17", "MenuText"), "cf99_underconstruction.php", -1, "", TRUE, FALSE, TRUE);
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
