<?php


if (_check_loai_user($_COOKIE['msdn']) != "") {
	$active = 99;
}
// --------------------------------------------------
switch ($components) {

	case "customers":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "customers.php";
		}
		break;
	case "oms":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "oms.php";
		}
		break;
	case "ims":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "ims.php";
		}
		break;
	case "items":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "items.php";
		}
		break;
	case "import":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "import.php";
		}
		break;
	case "export":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "export.php";
		}
		break;
	case "accounting":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "accounting.php";
		}
		break;
	case "voucher":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "voucher.php";
		}
		break;
	case "work":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "work.php";
		}
		break;
	case "report-warehouse":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-warehouse.php";
		}
		break;
	case "report-cus-item":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-cus-item.php";
		}
		break;
	case "report-sale":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-sale.php";
		}
		break;
	case "report-accouting":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-accouting.php";
		}
		break;
	case "report-supplier-item":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-supplier-item.php";
		}
		break;
	case "report-import":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-import.php";
		}
		break;
	case "report-detail-pay":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-detail-pay.php";
		}
		break;
	case "report-detail-receivable":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-detail-receivable.php";
		}
		break;
	case "report-summary-receivable":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "report-summary-receivable.php";
		}
		break;
	case "contract":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "contract.php";
		}
		break;
	case "product-inquiry":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "product-inquiry.php";
		}
		break;
	case "create-import":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "create-import.php";
		}
		break;
	case "update-import":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "update-import.php";
		}
		break;
	case "create-export":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "create-export.php";
		}
		break;
	case "update-export":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "update-export.php";
		}
		break;
	case "create-seller":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "create-seller.php";
		}
		break;
	case "update-seller":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "update-seller.php";
		}
		break;
	case "items-add":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "items-add.php";
		}
		break;
	case "items-edit":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "items-edit.php";
		}
		break;
	case "promotions":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "promotions.php";
		}
		break;
	case "change-banner":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "change-banner.php";
		}
		break;
	case "DangNhap":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "dangnhap.php";
		}
		break;
	case "phantich":
		if (isset($active) && $active == 99) {
			require_once CONTROLS . "phantich.php";
		}
		break;
	default:
		require('modules/home2Class.php');
		$db = new Home2();
		$tonkho = $db->tonkho();
		//tồn kho
		$tongtientonkho = $tonkho[0]->tongtientonkho;
		//
		$filename = "home";
		break;
}
