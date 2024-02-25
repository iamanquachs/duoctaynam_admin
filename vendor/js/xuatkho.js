function tinh_tonkho() {
  $.post(
    "ajax/xuatkho/tinh_tonkho.php",
    {},
    function (data, textStatus, jqXHR) {}
  );
}
function xuatkho_add_header(soct, loaixuat) {
  $.post(
    "ajax/xuatkho/add_xuatkho_header.php",
    { soct: soct, loaixuat: loaixuat },
    function (data, textStatus, jqXHR) {}
  );
}

function find_hosohanghoa(e) {
  const tenhh = $("#tenthuoc_add").val();
  const soluong = $("#soluong_add").val();
  $.post(
    "ajax/xuatkho/find_hosohanghoa.php",
    { tenhh: tenhh, soluong: soluong },
    function (data, textStatus, jqXHR) {
      if (data != "" && tenhh != "") {
        $("#find_hosohanghoa").removeClass("hidden");
        $(".chitiet_hanghoa").html(data);
      }
    }
  );
}
function find_soluong_hosohanghoa(e) {
  const mshh = $("#mshh_add").val();
  const soluong = $("#soluong_add").val();
  const tonkho = $("#tonkho_add").val();
  $("#soluong_err").css("color", "#858796");
  $("#soluong_add").css("border-bottom", "1px solid #000");
  if (Number(soluong) < Number(tonkho)) {
    $.post(
      "ajax/xuatkho/find_soluong_hosohanghoa.php",
      { mshh: mshh, soluong: soluong },
      function (data, textStatus, jqXHR) {
        $("#giaban_add").val(
          data[0].giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
        );
        $("#giagoc_add").val(data[0].giagoc);
        $("#ptgiam_add").val(data[0].ptgiam);
        $("#msctkm_add").val(data[0].msctkm);
      }
    );
  } else {
    $("#soluong_err").css("color", "red");
    $("#soluong_add").css("border-bottom", "1px solid red");
  }
}
function add_hanghoa(
  mshh,
  rowid_tonkho,
  thuesuat,
  pttichluy,
  toncuoi,
  tenhh,
  dvtmin,
  msnpp
) {
  $("#pttichluy_add").val(pttichluy);
  $("#mshh_add").val(mshh);
  $("#tenthuoc_add").val(tenhh);
  $("#dvt_add").val(dvtmin);
  $("#tonkho_add").val(toncuoi);
  $("#thuesuat_add").val(thuesuat);
  $("#rowid_tonkho_add").val(rowid_tonkho);
  $("#msnpp_add").val(msnpp);
  $("#find_hosohanghoa").addClass("hidden");
  find_soluong_hosohanghoa();
}

function add_xuatkho_line_seller() {
  const soct = location.search.split("?")[1];
  var mshh = $("#mshh_add").val();
  var soluong = $("#soluong_add").val(),
    pttichluy = $("#pttichluy_add").val(),
    tenhh = $("#tenthuoc_add").val(),
    dvtmin = $("#dvt_add").val(),
    thuesuat = $("#thuesuat_add").val(),
    giagoc = $("#giagoc_add").val(),
    giaban = $("#giaban_add").val().replaceAll(".", ""),
    ptgiam = $("#ptgiam_add").val(),
    tonkho = $("#tonkho_add").val(),
    msctkm = $("#msctkm_add").val(),
    msnpp = $("#msnpp_add").val();
  if (Number(soluong) > Number(tonkho)) {
    $("#tensp_warning").html(tenhh);
    $("#form_thongbao_tonkho").modal("show");
  } else {
    $.post(
      "ajax/xuatkho/add_xuatkho_line.php",
      {
        soct: soct,
        mshh: mshh,
        soluong: soluong,
        pttichluy: pttichluy,
        tenhh: tenhh,
        dvtmin: dvtmin,
        thuesuat: thuesuat,
        giagoc: giagoc,
        ptgiam: ptgiam,
        msctkm: msctkm,
        giaban: giaban,
        msnpp: msnpp,
      },
      function (data, textStatus, jqXHR) {
        load_xuatkho_line();
        $("#tenthuoc_add").val("");
      }
    );
  }
}

function load_xuatkho_line() {
  const soct = location.search.split("?")[1];

  $.post(
    "ajax/xuatkho/load_xuatkho_line.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      load_tinhtong_thanhtien();
      $("#chitiet_xuatkho_line").html(data);
    }
  );
}
function open_modal_delete(mshh, rowid, tenhh, msctkm) {
  $("#tensp_delete").html(tenhh);
  $("#rowid_delete").val(rowid);
  $("#mshh_delete").val(mshh);
  $("#msctkm_delete").val(msctkm);
  $("#form_delete_line").modal("show");
}

function delete_xuatkho_line() {
  const soct = location.search.split("?")[1];
  const rowid = $("#rowid_delete").val();
  const mshh = $("#mshh_delete").val();
  const msctkm = $("#msctkm_delete").val();
  $.post(
    "ajax/xuatkho/delete_xuatkho_line.php",
    { soct: soct, mshh: mshh, rowid: rowid, msctkm: msctkm },
    function (data, textStatus, jqXHR) {
      load_xuatkho_line();
      $("#form_delete_line").modal("hide");
    }
  );
}

function load_nhanvien() {
  $.post(
    "ajax/xuatkho/load_nhanvien.php",
    {},
    function (data, textStatus, jqXHR) {
      if (data != "") {
        $("#hoten_nhanvien_add").html(data);
      }
    }
  );
}
function load_khachhang() {
  const sodienthoai = $("#hoten_khachang_add").val();
  $.post(
    "ajax/xuatkho/load_khachhang.php",
    { sodienthoai: sodienthoai },
    function (data, textStatus, jqXHR) {
      if (data != "") {
        $("#hoten_khachang_add").val(data[0].hotennguoinhan);
        $("#sodienthoai_add").val(data[0].sodienthoai);
        $("#diachi_add").val(data[0].diachi);
        $("#mskh_add").val(data[0].msdv);
      }
    }
  );
}
function load_tinhtong_thanhtien() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/xuatkho/load_tinhtong_thanhtien.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $("#thanhtien_add").val(
        data[0].thanhtien.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#khuyemai_add").val(
        data[0].khuyenmai.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#thanhtoan_add").val(
        data[0].thanhtoan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}

function xuatkho_update() {
  const soct = location.search.split("?")[1];
  var nhanvienbanhang = $("#hoten_nhanvien_add option:selected").val(),
    tenkhachhang = $("#hoten_khachang_add").val(),
    mskh = $("#mskh_add").val(),
    sodienthoai = $("#sodienthoai_add").val(),
    diachi = $("#diachi_add").val(),
    thanhtoan = $("#thanhtoan_add").val().replaceAll(".", ""),
    ghichu = $("#ghichu_add").val();
  if (mskh == "" || nhanvienbanhang == "") {
    $("#form_chuadu_thongtin").modal("show");
  } else {
    $.post(
      "ajax/xuatkho/xuatkho_update.php",
      {
        soct: soct,
        nhanvienbanhang: nhanvienbanhang,
        tenkhachhang: tenkhachhang,
        mskh: mskh,
        sodienthoai: sodienthoai,
        diachi: diachi,
        thanhtoan: thanhtoan,
        ghichu: ghichu,
        loai_xuat: "XBB",
      },
      function (data, textStatus, jqXHR) {
        $("#form_xuatkho_success").modal("show");
        setTimeout(() => {
          location.href = "https://erp.duoctaynam.vn/ims";
        }, 1000);
      }
    );
  }
}
function xuatkho_update_xuat() {
  const soct = location.search.split("?")[1];
  const loai_xuat = $("#loai_xuat option:selected").val();
  const nhacc = $("#nhacc_add option:selected").val();
  const tennhacc = $("#nhacc_add option:selected").text();
  var nhanvienbanhang = "",
    tenkhachhang = "",
    mskh = "",
    sodienthoai = "",
    diachi = "",
    thanhtoan = $("#thanhtoan_add").val().replaceAll(".", ""),
    ghichu = "";
  if (loai_xuat != "") {
    if (loai_xuat == "XTC") {
      if (nhacc != "") {
        $.post(
          "ajax/xuatkho/xuatkho_update.php",
          {
            soct: soct,
            nhanvienbanhang: nhanvienbanhang,
            tenkhachhang: tennhacc,
            mskh: nhacc,
            sodienthoai: sodienthoai,
            diachi: diachi,
            thanhtoan: thanhtoan,
            ghichu: ghichu,
            loai_xuat: loai_xuat,
          },
          function (data, textStatus, jqXHR) {
            $("#form_xuatkho_success").modal("show");
            setTimeout(() => {
              location.href = "https://erp.duoctaynam.vn/export";
            }, 1000);
          }
        );
      } else {
        $("#form_chuadu_thongtin").modal("show");
      }
    } else {
      $.post(
        "ajax/xuatkho/xuatkho_update.php",
        {
          soct: soct,
          nhanvienbanhang: nhanvienbanhang,
          tenkhachhang: tenkhachhang,
          mskh: mskh,
          sodienthoai: sodienthoai,
          diachi: diachi,
          thanhtoan: thanhtoan,
          ghichu: ghichu,
          loai_xuat: loai_xuat,
        },
        function (data, textStatus, jqXHR) {
          $("#form_xuatkho_success").modal("show");
          setTimeout(() => {
            location.href = "https://erp.duoctaynam.vn/export";
          }, 1000);
        }
      );
    }
  } else {
    $("#form_chuachon_loaixuat").modal("show");
  }
}

function load_xuatkho_chua_luu() {
  $.post(
    "ajax/xuatkho/load_xuatkho_chua_luu.php",
    {},
    function (data, textStatus, jqXHR) {
      if (data.length > 0) {
        $("#form_danhsach_xuatkho_chua_luu").modal("show");
        for (let i = 0; i < data.length; i++) {
          $("#item_xuatkho_chua_thanhcong").append(`
            <div class="item_hoadon_chuanhap">
            <a  href='update-seller?${data[i].soct}'>
                Hóa đơn chưa xuất
            </a>
            <input hidden class='soct_delete' value='${data[i].soct}' >
            <span onclick='delete_xuatkho_header("${data[i].soct}")'>Xóa</span>
        </div>
            `);
        }
      }
    }
  );
}

function delete_xuatkho_header_chua_luu(soct) {
  $.post(
    "ajax/xuatkho/huy_xuatkho.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $("#form_danhsach_xuatkho_chua_luu").modal("hide");
      load_xuatkho_header();
    }
  );
}

function open_huy_xuatkho() {
  $("#form_huy_xuatkho").modal("show");
}

function huy_xuatkho() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/xuatkho/huy_xuatkho.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      location.href = "https://erp.duoctaynam.vn/ims";
    }
  );
}

function huy_xuatkho_export() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/xuatkho/huy_xuatkho.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      location.href = "https://erp.duoctaynam.vn/export";
    }
  );
}

function capnhat_xuatkho(e) {
  const soct = $("#soct_td").val();
  const xuatkho = document.getElementById("btn_capnhat");
  xuatkho.href = "update-seller?" + soct;
  $.post(
    "ajax/xuatkho/update_tam_xuatkho_line.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {}
  );
}

function load_xuatkhoheader_update() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/xuatkho/load_xuatkhoheader_chitiet.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $("#hoten_nhanvien_add").val(data[0].msnvbh);
      $("#mskh_add").val(data[0].mskh);
      $("#hoten_khachang_add").val(data[0].hotennguoinhan);
      $("#sodienthoai_add").val(data[0].sodienthoai);
      $("#diachi_add").val(data[0].diachi);
      $("#ghichu_add").val(data[0].ghichu);
    }
  );
}
//!-------------------- Xuất kho trả, hết hạn, hư bể
function load_xuatkho_chua_luu_export() {
  $.post(
    "ajax/xuatkho/load_xuatkho_chua_luu_export.php",
    {},
    function (data, textStatus, jqXHR) {
      if (data.length > 0) {
        $("#form_danhsach_xuatkho_chua_luu").modal("show");
        for (let i = 0; i < data.length; i++) {
          $("#item_xuatkho_chua_thanhcong").append(`
            <div class="item_hoadon_chuanhap">
            <a  href='update-export?${data[i].soct}'>
                Hóa đơn chưa xuất
            </a>
            <input hidden class='soct_delete' value='${data[i].soct}' >
            <span onclick='delete_xuatkho_header_chua_luu("${data[i].soct}")'>Xóa</span>
        </div>
            `);
        }
      }
      load_xuatkho_header();
    }
  );
}
//Lọc đơn hàng header
function load_xuatkho_header(e) {
  var tungay = $("#tungay").val();
  var denngay = $("#denngay").val();
  const loai_xuat = $("#loai_xuat option:selected").val();
  $.post(
    "ajax/xuatkho/load_xuatkho_header.php",
    { tungay: tungay, denngay: denngay, loai_xuat: loai_xuat },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_xuatkho").html(data);
    }
  );
}
function load_xuatkho_line_xuat(e) {
  $(".items_xuatkho_header").removeClass("active_items");
  var soct = $(e).find(".soct_td").text();
  var soctdh = $(e).find(".soctdh_td").text();

  $(e).addClass("active_items");
  $.post(
    "ajax/ims/ims_load_line.php",
    { soct },
    function (data, textStatus, jqXHR) {
      $("#chitiet_ims_tbody").html(data);
      $(".__soct_xuatkho").val(soct);
      $("#soct_dathang").val(soctdh);
    }
  );
}
function open_capnhat_xuatkho(e) {
  const soct = $(e).parent().find(".__soct_xuatkho").val();
  if (soct != "") {
    const capnhat = document.getElementById("capnhat__");
    capnhat.href = "update-export?" + soct;
    $.post(
      "ajax/xuatkho/open_capnhat_xuatkho.php",
      { soct: soct },
      function (data) {}
    );
  }
}

function chon_loaixuat() {
  const loai_xuat = $("#loai_xuat option:selected").val();
  const tenloai_xuat = $("#loai_xuat option:selected").text();
  $("#xuattra_ncc").addClass("hidden");
  if (loai_xuat != "") {
    $("#title_loai_xuat").html(tenloai_xuat);
  }
  if (loai_xuat == "XTC") {
    $("#xuattra_ncc").removeClass("hidden");
  } else {
    $("#xuattra_ncc").addClass("hidden");
  }
}
function load_hosohanghoa_xuat(e) {
  const tenhh = $(e).val();
  const soluong = $("#soluong_add").val();
  const loai = $("#loai_xuat option:selected").val();
  if (tenhh == "") {
    $("#load_hosohanghoa_xuat").html("");
  } else {
    $("#load_hosohanghoa_xuat").removeClass("hidden");
    $.post(
      "ajax/xuatkho/find_hosohanghoa_xuat.php",
      { tenhh: tenhh, soluong: soluong, loai: loai },
      function (data, textStatus, jqXHR) {
        if (data != "" && tenhh != "") {
          $("#load_hosohanghoa_xuat").html(data);
        }
      }
    );
  }
}
function add_hanghoa_xuat(mshh, tenhh, dvt, solo, handung, gianhapcothue) {
  $("#mshh_add").val(mshh);
  $("#tenthuoc_add").val(tenhh);
  $("#dvt_add").val(dvt);
  $("#solo_add").val(solo);
  $("#handung_add").val(handung);
  $("#gianhap_add").val(
    gianhapcothue.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
  $.post(
    "ajax/xuatkho/get_tonkho_xuat.php",
    {
      mshh: mshh,
      solo: solo,
      handung: handung,
    },
    function (data, textStatus, jqXHR) {
      $("#tonkho_add").val(
        (data[0] != undefined ? data[0].toncuoi : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#pttichluy_add").val(data[0] != undefined ? data[0].pttichluy : 0);
      $("#msnpp_add").val(data[0] != undefined ? data[0].msnpp : "");
      $("#thuesuat_add").val(data[0] != undefined ? data[0].thuesuat : 0);
      $("#load_hosohanghoa_xuat").addClass("hidden");
    }
  );
}

function add_xuatkho_line_export() {
  const soct = location.search.split("?")[1];
  var mshh = $("#mshh_add").val();
  var soluong = $("#soluong_add").val(),
    pttichluy = $("#pttichluy_add").val(),
    tenhh = $("#tenthuoc_add").val(),
    dvtmin = $("#dvt_add").val(),
    thuesuat = $("#thuesuat_add").val(),
    giagoc = $("#gianhap_add").val().replaceAll(".", ""),
    giaban = $("#gianhap_add").val().replaceAll(".", ""),
    ptgiam = $("#ptgiam_add").val(),
    tonkho = $("#tonkho_add").val().replaceAll(".", ""),
    msctkm = $("#msctkm_add").val(),
    loai_xuat = $("#loai_xuat option:selected").val(),
    msnpp = $("#msnpp_add").val();
  if (Number(soluong) > Number(tonkho)) {
    $("#tensp_warning").html(tenhh);
    $("#form_thongbao_tonkho").modal("show");
  } else {
    $.post(
      "ajax/xuatkho/add_xuatkho_line_export.php",
      {
        soct: soct,
        mshh: mshh,
        soluong: soluong,
        pttichluy: pttichluy,
        tenhh: tenhh,
        dvtmin: dvtmin,
        thuesuat: thuesuat,
        giagoc: giagoc,
        ptgiam: ptgiam,
        msctkm: msctkm,
        giaban: giaban,
        msnpp: msnpp,
        loai_xuat: loai_xuat,
      },
      function (data, textStatus, jqXHR) {
        $("#tenthuoc_add").val("");
        load_xuatkho_line();
      }
    );
  }
}
function load_nhacc_update() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/xuatkho/load_nhacc_loaixuat_export.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $("#loai_xuat").val(data[0].loaixuat);
      $("#nhacc_add").val(data[0].mskh);
    }
  );
}
function open_delete_xuatkho_header(e) {
  const soct = $(e).parent().find(".__soct_xuatkho").val();
  $("#soct_delete").val(soct);
  if (soct != "") {
    $("#form_xuatkho_delete").modal("show");
  }
}
function delete_xuatkho_header_export(e) {
  const soct = $(e).parent().find("#soct_delete").val();
  $.post(
    "ajax/xuatkho/huy_xuatkho.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      load_xuatkho_header();
      tinh_tonkho();
      $("#chitiet_ims_tbody").html("");
    }
  );
}
