<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
$db_donhang = new DonHang();
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$delete_xuatkho_rac = $db_donhang->delete_xuatkho_rac($msdv, $msdn);
$danhsach_donhang = $db_donhang->ims_header($tungay, $denngay);
foreach ($danhsach_donhang as $r) {
    $dathanhtoan = str_replace(',', '.', number_format($r->dathanhtoan));
    $conno = ($r->tongcongvat) - ($r->dathanhtoan);
    $soctdh = $r->soctdh;
    $trangthaidonhang = $db_donhang->load_trangthaiDH_header($soctdh);

?>
    <tr class="donhanglist_tr active_items_hover">
        <td class="stt_td" onclick="ims_load_line(this)"> <?= $r->stt ?></td>
        <td class="soct_td" style="display: none;"><?= $r->soct ?></td>
        <td class="mskh_td" style="display: none;"><?= $r->mskh ?></td>
        <td class="conno_td" style="display: none;"><?= str_replace(',', '.', number_format($conno)) ?></td>
        <td class="sohd_td" style="display: none;"><?= $r->sohd ?></td>
        <td class="soctdh_td" style="display: none;"><?= $r->soctdh ?></td>
        <td class="trangthai_td" style="display: none;"><?= $trangthaidonhang[0]->trangthaidonhang ?></td>
        <td class="ngay_td" onclick="ims_load_line(this)"> <?= $r->ngaygio ?></td>
        <td class="left tenkh_td" onclick="ims_load_line(this)"><?= $r->tenkhachhang ?></td>
        <td class="right" onclick="ims_load_line(this)"><?= str_replace(',', '.', number_format($r->tongcongvat)) ?></td>
        <td class="dathanhtoan" style="display: none;"><?= $r->dathanhtoan ?></td>

        <?php
        if ($r->dathanhtoan == $r->tongcongvat && $r->tongcongvat > 0 ) {
            echo ('<td class="dathanhtoan_td" onclick="ims_load_line(this)"><img src="vendor/img/check16.png"></td>');
        } else {
            echo ('<td class="dathanhtoan_td" onclick="ims_load_line(this)"><p style="color:red">' . $dathanhtoan . '</p></td>');
        }
        ?>
        </td>
        <td class="nguon" onclick="ims_load_line(this)"><?= $r->nguon ?></td>

    </tr>
<?php
}
