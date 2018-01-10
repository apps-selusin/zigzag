<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(6, "mi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(89, "mci_Master", $Language->MenuPhrase("89", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10009, "mi_t04_depo", $Language->MenuPhrase("10009", "MenuText"), "t04_depolist.php", 89, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t04_depo'), FALSE, FALSE);
$RootMenu->AddMenuItem(64, "mi_t02_pelayaran", $Language->MenuPhrase("64", "MenuText"), "t02_pelayaranlist.php", 89, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t02_pelayaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mci_Dokumen", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(28, "mci_Export", $Language->MenuPhrase("28", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mi_t01_ajudok", $Language->MenuPhrase("1", "MenuText"), "t01_ajudoklist.php", 28, "", AllowListMenu('{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mci_Re2dExport", $Language->MenuPhrase("31", "MenuText"), "cf99_underconstruction.php", 28, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mci_Import", $Language->MenuPhrase("29", "MenuText"), "", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(30, "mci_BC2e12e1", $Language->MenuPhrase("30", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(58, "mci_BC2e12e2", $Language->MenuPhrase("58", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(59, "mci_BC2e22e3", $Language->MenuPhrase("59", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(60, "mci_J2e_Merah", $Language->MenuPhrase("60", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(61, "mci_J2e_Kuning", $Language->MenuPhrase("61", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(62, "mci_J2e_Hijau", $Language->MenuPhrase("62", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(63, "mci_Re2dImport", $Language->MenuPhrase("63", "MenuText"), "cf99_underconstruction.php", 29, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(32, "mci_Karantina", $Language->MenuPhrase("32", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(33, "mci_BPOM", $Language->MenuPhrase("33", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(34, "mci_LS", $Language->MenuPhrase("34", "MenuText"), "cf99_underconstruction.php", 12, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(25, "mci_Depo", $Language->MenuPhrase("25", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(26, "mci_55", $Language->MenuPhrase("26", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(27, "mci_66", $Language->MenuPhrase("27", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10008, "mri_r015fpelayaran", $Language->MenuPhrase("10008", "MenuText"), "r01_pelayaransmry.php", 25, "{77B51533-F1E4-4C23-925C-E363F9E1C0BE}", TRUE, FALSE, FALSE);
$RootMenu->AddMenuItem(36, "mci_80", $Language->MenuPhrase("36", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(37, "mci_MTCON", $Language->MenuPhrase("37", "MenuText"), "cf99_underconstruction.php", 25, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(14, "mci_Status", $Language->MenuPhrase("14", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(38, "mci_TPS", $Language->MenuPhrase("38", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(39, "mci_T2e_Lamong", $Language->MenuPhrase("39", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(40, "mci_Schedule", $Language->MenuPhrase("40", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(41, "mci_Bea_Container", $Language->MenuPhrase("41", "MenuText"), "cf99_underconstruction.php", 14, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(15, "mci_Trucking", $Language->MenuPhrase("15", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(42, "mci_Tarif", $Language->MenuPhrase("42", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(43, "mci_Muatan", $Language->MenuPhrase("43", "MenuText"), "cf99_underconstruction.php", 15, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mci_Lalu_Lintas", $Language->MenuPhrase("16", "MenuText"), "cf99_underconstruction.php", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(17, "mci_Forum", $Language->MenuPhrase("17", "MenuText"), "cf99_underconstruction.php", -1, "", TRUE, FALSE, TRUE);
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
