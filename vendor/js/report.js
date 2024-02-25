function add_menu_baocao(e) {
  $("#ds_menu_baocao").html(`
  <div class="dropdown">
        <button type="button" class="btn dropdown-toggle" style="background-color: #fff;color: #000; padding: 5px 20px;" data-toggle="dropdown">
            Xuất kho
        </button>
        <div class="dropdown-menu">
            <a href="report-cus-item" class="dropdown-item" style='font-size:16px'>KH-SP</a>
            <a href="report-sale" class="dropdown-item" style='font-size:16px'>CT-XK</a>
        </div>
    </div>
    <div class="dropdown">
        <button type="button" class="btn dropdown-toggle" style="background-color: #fff;color: #000; padding: 5px 20px;" data-toggle="dropdown">
            Nhập kho
        </button>
        <div class="dropdown-menu" >
            <a href="report-supplier-item" class="dropdown-item" style='font-size:16px'>NCC-SP</a>
            <a href="report-import" class="dropdown-item" style='font-size:16px'>CT-NK</a>
        </div>
    </div>
    <div class="dropdown">
        <button type="button" class="btn dropdown-toggle" style="background-color: #fff;color: #000; padding: 5px 20px;" data-toggle="dropdown">
            Khác
        </button>
        <div class="dropdown-menu">
            <a href="report-warehouse" class="dropdown-item" style='font-size:16px'>NXT</a>
            <a href="report-accouting" class="dropdown-item" style='font-size:16px'>Thu chi</a>
        </div>
    </div>
    <div class="dropdown">
        <button type="button" class="btn dropdown-toggle" style="background-color: #fff;color: #000; padding: 5px 20px;" data-toggle="dropdown">
            Công nợ
        </button>
        <div class="dropdown-menu">
            <a href="report-summary-receivable" class="dropdown-item" style='font-size:16px'>Phải thu - TH</a>
            <a href="report-detail-receivable" class="dropdown-item" style='font-size:16px'>Phải thu - CT</a>
            <a href="report-detail-pay" class="dropdown-item" style='font-size:16px'>Phải trả - CT</a>
        </div>
    </div>
  `);
}

//! Khách hàng - Sản phẩm
function load_report_cus_item() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  const loaiSearch = $("#loaiSearch option:selected").val();
  $.post(
    "ajax/report/load_report_cus_item.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
      loaiSearch: loaiSearch,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_report_cus_item").html(data);
    }
  );
}
//! Nhà cung cấp - Sản phẩm
function load_report_supplier_item() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  const loaiSearch = $("#loaiSearch option:selected").val();
  $.post(
    "ajax/report/load_report_supplier_item.php",
    {
      valueSearch: valueSearch,
      loaiSearch: loaiSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      console.log(123);

      $(".__chitiet_report_supplier_item").html(data);
    }
  );
}
//! Chi tiết xuất kho
function load_report_sale() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_sale.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_report_sale").html(data);
    }
  );
}
//! Chi tiết nhập kho
function load_report_import() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_import.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_report_import").html(data);
    }
  );
}
//!Chi tiết Công nợ
function load_report_detail_receivable() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_detail_receivable.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      load_tong_phaithu();
      $(".__chitiet_report_detail_receivable").html(data);
    }
  );
}
//!Tổng hợp Công nợ
function load_report_summary_receivable() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_summary_receivable.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_report_summary_receivable").html(data);
    }
  );
}
//!Chi tiết tồn kho
function load_warehouse() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_warehouse.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_warehouse").html(data);
    }
  );
}
function show_search(e) {
  const placeholder = $("#loaiSearch option:selected").text();
  document.getElementById("valueSearch").placeholder = placeholder;
}
//! tổng phải thu
function load_tong_phaithu() {
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_tong_phaithu.php",
    { tungay: tungay, denngay: denngay },
    function (data, textStatus, jqXHR) {
      $("#tongdauky").html(
        data[0].sumdauky.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongcongvat").html(
        data[0].tongcongvat
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongdathanhtoan").html(
        data[0].dathanhtoan
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongno").html(
        data[0].tongno.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}
//! tổng phải trả
function load_tong_phaitra() {
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_tong_phaitra.php",
    { tungay: tungay, denngay: denngay },
    function (data, textStatus, jqXHR) {
      $("#tongdauky").html(
        data[0].sumdauky.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongcongvat").html(
        data[0].tongcongvat
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongdathanhtoan").html(
        data[0].dathanhtoan
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongno").html(
        data[0].tongno.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}
//!Chi tiết phải trả
function load_report_detail_pay() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_detail_pay.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      load_tong_phaitra();
      $(".__chitiet_report_detail_pay").html(data);
    }
  );
}
function open_modal_thanhtoan(e) {
  $("#form_post_thuchi").modal("show");
  const conno = $(e).parent().find(".conno_td").text();
  const soct = $(e).parent().find(".soct_td").text();
  const soctdh = $(e).parent().find(".soctdh_td").text();
  const ten_ncc = $(e).parent().find(".tenkh_td").text();
  const msnccc = $(e).parent().find(".mskh_td").text();
  const sohd = $(e).parent().find(".sohd_td").text();
  const dathanhtoan = $(e).parent().find(".dathanhtoan").text();
  $("#sotien_conno").val(conno);
  $("#ma_soct").text(soct);
  $("#soct_thanhtoan").val(soct);
  $("#soctdh_thanhtoan").val(soctdh);
  $("#ten_ncc_thanhtoan").val(ten_ncc);
  $("#ms_ncc_thanhtoan").val(msnccc);
  $("#sohd_thanhtoan").val(sohd);
  $("#dathanhtoan_thanhtoan").val(dathanhtoan);
}
function xuatkho_post_thuchi() {
  const maso = $("#ms_ncc_thanhtoan").val();
  const tenmaso = $("#ten_ncc_thanhtoan").val();
  const soct_donhang = $("#soct_thanhtoan").val();
  const soctdathang = $("#soctdh_thanhtoan").val();
  const sohd = $("#sohd_thanhtoan").val();
  const dathanhtoan = $("#dathanhtoan_thanhtoan").val().replaceAll(".", "");
  const sotien = $("#sotien_conno").val().replaceAll(".", "");
  const nganquythu = $("#nganquy_post_thuchi option:selected").val();
  $.post(
    "ajax/ims/xuatkho_post_thuchi.php",
    {
      maso: maso,
      tenmaso: tenmaso,
      soct_donhang: soct_donhang,
      soctdathang: soctdathang,
      sohd: sohd,
      sotienthu: sotien,
      nganquythu: nganquythu,
      dathanhtoan: dathanhtoan,
    },
    function (data) {
      $("#form_post_thuchi").modal("hide");
      load_report_detail_receivable();
    }
  );
}

function open_form_chitet_phieuthu(phieuthu, e) {
  $(".body_thongtin_phieuthu").html("");
  $("#ma_soct_chitiet_phieuthu").val($(e).find(".soct_td").text());
  $("#form_chitiet_phieuthu").modal("show");
  const sophieuthu = phieuthu.split("|");
  for (let i = 0; i < sophieuthu.length; i++) {
    if (sophieuthu[i] != "") {
      $.post(
        "ajax/report/load_chitiet_phieuthu.php",
        { sophieuthu: sophieuthu[i] },
        function (data, textStatus, jqXHR) {
          for (let i = 0; i < data.length; i++) {
            $(".body_thongtin_phieuthu").append(`
            <div style='border: 1px solid #ddd; padding: 10px; margin-bottom:10px'>
              <div class="row" style="display: flex;">
              <span class="col-4" style="color: #000;">Ngày</span>
              <span class="col-8" id="ngay_chitiet_phieuthu" style="color: #000;">${
                data[i].ngay
              }</span>
              </div>
              <div class="row" style="display: flex;">
                  <span class="col-4" style="color: #000;">Số tiền</span>
                  <span class="col-8" id="sotien_chitiet_phieuthu" style="color: red;">${data[
                    i
                  ].sotien
                    .toString()
                    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")}</span>
              </div>
              <div class="row" style="display: flex;">
                  <span class="col-4" style="color: #000;">Hình thức</span>
                  <span class="col-8" id="hinhthuc_chitiet_phieuthu" style="color: #000;">${
                    data[i].nganquy
                  }</span>
              </div>
              <div class="row" style="display: flex;">
                  <span class="col-4" style="color: #000;">NV Thu</span>
                  <span class="col-8" id="nv_chitiet_phieuthu" style="color: #000;">${
                    data[i].tennhanvien
                  }</span>
              </div>
          </div>

          `);
          }
        }
      );
    }
  }
}
// thanh toán tiền nhập kho còn nợ
function open_post_thuchi(e) {
  $("#form_post_thuchi").modal("show");
  const conno = $(e).parent().find(".conno_td").text();
  const soct = $(e).parent().find(".soct_td").text();
  const ten_ncc = $(e).parent().find(".tenncc_td").text();
  const msnccc = $(e).parent().find(".msncc_td").text();
  const sohd = $(e).parent().find(".sohd_td").text();
  const dathanhtoan = $(e).parent().find(".dathanhtoan").text();
  $("#sotien_conno").val(conno);
  $("#soct_phieu").html(soct);
  $("#soct_thanhtoan").val(soct);
  $("#ten_ncc_thanhtoan").val(ten_ncc);
  $("#ms_ncc_thanhtoan").val(msnccc);
  $("#sohd_thanhtoan").val(sohd);
  $("#dathanhtoan_thanhtoan").val(dathanhtoan);
}

function nhapkho_post_thuchi() {
  const maso = $("#ms_ncc_thanhtoan").val();
  const tenmaso = $("#ten_ncc_thanhtoan").val();
  const soct_donhang = $("#soct_thanhtoan").val();
  const sohd = $("#sohd_thanhtoan").val();
  const dathanhtoan = $("#dathanhtoan_thanhtoan").val();
  const sotien = $("#sotien_conno").val().replaceAll(".", "");
  const nganquythu = $("#nganquy_post_thuchi option:selected").val();
  $.post(
    "ajax/nhapkho/nhapkho_post_thuchi.php",
    {
      maso: maso,
      tenmaso: tenmaso,
      soct_donhang: soct_donhang,
      sohd: sohd,
      sotienthu: sotien,
      nganquythu: nganquythu,
      dathanhtoan: dathanhtoan,
    },
    function (data) {
      $("#form_post_thuchi").modal("hide");
      load_report_detail_pay();
    }
  );
}

//!Báo cáo thu chi
function load_report_accouting() {
  const valueSearch = $("#valueSearch").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  $.post(
    "ajax/report/load_report_accouting.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_report_accouting").html(data);
    }
  );
}

//! load img qr thanh toán
function load_qr_thanhtoan(e) {
  $.post(
    "ajax/report/load_qr_thanhtoan.php",
    {
      soct: e,
    },
    function (data, textStatus, jqXHR) {
      if (data[0].qrthanhtoan == "") {
        $("#form_qr_code").html(``);
      } else {
        $("#form_qr_code")
          .html(`<img style="position: relative;width: 100%;" id="img_qr_thanhtoan" src="./vendor/img/qr_code.png">
        <img onclick="delete_img_qr(this)" style="position: absolute; top: -8px; right: -8px;" src="./vendor/img/xoa16.png">
        <input hidden id='path_img_qr'>`);
      }
    }
  );
}
//! load img qr thanh toán
function upload_qr_thanhtoan(e) {
  var form_data = new FormData();
  const path_file = $("#upload_file_qr")[0].files[0];
  const soct = $(e).parent().parent().parent().find("#soct_thanhtoan").val();
  form_data.append("file", path_file);
  form_data.append("soct", soct);
  $.ajax({
    type: "POST",
    data: form_data,
    url: "ajax/report/upload_qr_thanhtoan.php",
    contentType: false,
    processData: false,
    headers: {
      "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      $("#upload_file_qr").val("");
      load_qr_thanhtoan(soct);
    },
    error: function (data) {
      console.log(data);
    },
  });
}
//! delete img qr thanh toán
function delete_img_qr(e) {
  const soct = $(e).parent().parent().parent().find("#soct_thanhtoan").val();
  const path_img_qr = $(e).parent().find("#path_img_qr").val();
  $.post(
    "ajax/report/delete_qr_thanhtoan.php",
    {
      soct: soct,
      path_img_qr: path_img_qr,
    },
    function (data, textStatus, jqXHR) {
      load_qr_thanhtoan(soct);
    }
  );
}
