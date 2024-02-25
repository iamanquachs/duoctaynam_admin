function _ChangeFormat(e) {
  var soluong = $(e).val().replace(/[.]/g, "");
  soluong = $(e)
    .val()
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $(e).val(soluong);
}

// Hiển thị đặt hàng chi tiết
function oms_load_line(e) {
  $(".donhanglist_tr").removeClass("active_items");
  var soct = $(e).find(".soct_td").text();
  var trangthaidonhang = $(e).find(".trangthai_td").text();
  $("#tennhathuoc").text($(e).find(".left").text());
  $("#tenkhachhang").text($(e).find(".tendaidien_td").text());
  $("#dienthoai").text($(e).find(".sodienthoai_td").text());
  $("#mskh_line").val($(e).find(".mskh_td").text());
  $("#diachi").text($(e).find(".diachi_td").text());
  var loaiuser = $("#loaiuser_dangnhap").val();
  $.post(
    "ajax/oms/oms_load_line.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $(".chitiet_donhang_tbody").html(data);
      $("#soct_td").val(soct);
      $(e).addClass("active_items");
      if (trangthaidonhang == 0) {
        $("#menu_line_add").html(`
        <button id="btn_xacnhan" onclick="open_oms_xacnhan(this)" data-xacnhan="1" class="btn btn-success ">Duyệt đặt hàng</button>
        `);
      }
      if ((trangthaidonhang == 0 || trangthaidonhang == 1) && loaiuser >= 98) {
        $("#menu_line_huy").html(`
        <button id="btn_huydonhang" onclick="open_oms_huy(this)" data-phanloai='LyDoHuy' data-xacnhan="5" data-target="#form_huy" data-toggle="modal" class="btn btn-danger ">Hủy đặt hàng</button>
        `);
      }
      if (trangthaidonhang == 1) {
        $("#menu_line_add").html(`
        <button id="btn_xacnhan" onclick="open_oms_xuatkho(this)" data-xacnhan="3" class="btn btn-success ">Xuất kho</button>
        `);
      }

      if (trangthaidonhang > 1 && trangthaidonhang < 5) {
        $("#menu_line_add").html(`
        <button id="btn_xacnhan" onclick="" data-target="#form_xacnhan" data-toggle="modal" class="btn btn-info ">Phát hành HĐĐT</button>
        `);
        $("#menu_line_huy").html(``);
      }
    }
  );
}
//Lọc đặt hàng header
function oms_header(e) {
  var tungay = $("#tungay").val();
  var denngay = $("#denngay").val();
  var mstrangthai_select = $("#trangthai_loc option:selected").val();
  $.post(
    "ajax/oms/oms_filter.php",
    {
      mstrangthai_select: mstrangthai_select,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
      var socket = io("https://notication.duoctaynam.vn");
      //ready
      socket.emit("donhang_clear");
    }
  );
}
function oms_header_reload(e) {
  var tungay = $("#tungay").val();
  var denngay = $("#denngay").val();
  var mstrangthai_select = $("#trangthai_loc option:selected").val();
  $.post(
    "ajax/oms/oms_filter.php",
    {
      mstrangthai_select: mstrangthai_select,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
    }
  );
}

// Open Hủy đặt hàng
function open_oms_huy(e) {
  var soct = $("#soct_td").val();
  var PhanLoai = $(e).data("phanloai");
  $("#soct_xacnhan").val(soct);
  $.post(
    "ajax/dmphanloai/list_phanloai.php",
    { PhanLoai: PhanLoai },
    function (data, textStatus, jqXHR) {
      $("#DM_LyDo").html(data);
    }
  );
}
function oms_huy() {
  var nghiepvu = "oms_huy";
  var soct = $("#soct_xacnhan").val();
  var mslydo_select = "0";
  mslydo_select = $("#DM_LyDo option:selected").val();
  if (mslydo_select == "0") {
    document.getElementById("error").innerHTML =
      "<p class='alert-danger' role='alert'> Vui lòng chọn lý do Hủy</p>";
  } else {
    $.post(
      "ajax/oms/oms_xuly.php",
      { soct: soct, mslydo: mslydo_select, nghiepvu: nghiepvu },
      function (data, textStatus, jqXHR) {
        $("#form_huy").modal("hide");
        oms_header();
      }
    );
  }
}

function close_load_chitiet() {
  $("#form_chitiet").modal("hide");
}
//Open xác nhận đặt hàng
function open_oms_xacnhan(e) {
  var tenkhachhang = $("#tennhathuoc").text();
  var mskh = $("#mskh_line").val();
  var dienthoai = $("#dienthoai").text();
  var soct = $("#soct_td").val();
  var ttdonhang = $(e).data("xacnhan");
  if (tenkhachhang == mskh) {
    $("#dienthoai_kh").val(dienthoai);
    $("#dienthoai_old_kh").val(dienthoai);
    $("#mskh_kh").val(mskh);
    $("#soct_kh").val(soct);
    $("#form_capnhat_thongtinkh").modal("show");
  } else {
    $("#soct_xacnhan").val(soct);
    $("#trangthai_xacnhan").val(ttdonhang);
    $("#form_xacnhan").modal("show");
  }
}

//cập nhật thông tin khách hàng
function oms_capnhat_thongtin_khachhang() {
  const tenkhachhang = $("#tennhathuoc_kh").val();
  const tendaidien = $("#tendaidien_kh").val();
  const dienthoai_old = $("#dienthoai_old_kh").val();
  const dienthoai = $("#dienthoai_kh").val();
  const soct = $("#soct_kh").val();
  const mskh = $("#mskh_kh").val();
  $.post(
    "ajax/oms/oms_capnhat_thongtin_khachhang.php",
    {
      soct: soct,
      mskh: mskh,
      tenkhachhang: tenkhachhang,
      tendaidien: tendaidien,
      dienthoai: dienthoai,
      dienthoai_old: dienthoai_old,
    },
    function (data, textStatus, jqXHR) {
      oms_header();
      $("#form_capnhat_thongtinkh").modal("hide");
      $(".chitiet_donhang_tbody").html("");
      $("#tennhathuoc").text("");
      $("#tenkhachhang").text("");
      $("#dienthoai").text("");
      $("#diachi").text("");
    }
  );
}

//Open xác nhận đặt hàng
function open_oms_xuatkho(e) {
  const kiemtra_dathang = document.querySelectorAll(
    '#loai_dathang[data-loai="khong"]'
  );
  if (kiemtra_dathang.length != 0) {
    $("#form_kiemtra").modal("show");
  } else {
    $("#form_xuatkho").modal("show");

    var soct = $("#soct_td").val();
    var ttdonhang = $(e).data("xacnhan");
    $("#soct_xacnhan").val(soct);
    $("#trangthai_xacnhan").val(ttdonhang);
  }
}

// Xác nhận đặt hàng
function oms_xacnhan_duyetdon(e) {
  var nghiepvu = "oms_xacnhan_duyetdon";
  var soct = $("#soct_xacnhan").val();
  var ttdonhang = $("#trangthai_xacnhan").val();
  $.post(
    "ajax/oms/oms_xuly.php",
    { soct: soct, ttdonhang: ttdonhang, nghiepvu: nghiepvu },
    function (data, textStatus, jqXHR) {
      $("#form_xacnhan").modal("hide");
      oms_header();
    }
  );
}
// Xác nhận xuất kho

function oms_xuatkho(e) {
  var nghiepvu = "oms_xuatkho";
  var soct = $("#soct_xacnhan").val();
  var ttdonhang = $("#trangthai_xacnhan").val();
  $.post(
    "ajax/oms/oms_xuly.php",
    { soct: soct, ttdonhang: ttdonhang, nghiepvu: nghiepvu },
    function (data, textStatus, jqXHR) {
      $("#form_xuatkho").modal("hide");
      oms_header();
      $(".chitiet_donhang_tbody").html("");
    }
  );
}
function close_load_chitiet() {
  $("#form_chitiet").modal("hide");
}
//---------------------XUATKHO----------------------------
//Lọc đơn hàng header
function ims_header(e) {
  var tungay = $("#tungay").val();
  var denngay = $("#denngay").val();
  $.post(
    "ajax/ims/ims_filter.php",
    { tungay: tungay, denngay: denngay },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
    }
  );
}
// Hiển thị đơn hàng chi tiết
function ims_load_line(e) {
  var loaiuser = $("#loaiuser_dangnhap").val();

  $(".donhanglist_tr").removeClass("active_items");
  var soct = $(e).parent().find(".soct_td").text();
  var soctdh = $(e).parent().find(".soctdh_td").text();
  var tenkhachhang = $(e).parent().find(".tenkh_td").text();
  var trangthaidonhang = $(e).parent().find(".trangthai_td").text();
  $("#tennhathuoc").text($(e).parent().find(".left").text());
  $("#tenkhachhang").text($(e).parent().find(".tendaidien_td").text());
  $("#dienthoai").text($(e).parent().find(".sodienthoai_td").text());
  $("#diachi").text($(e).parent().find(".diachi_td").text());
  // if (trangthaidonhang < 4 && loaiuser >= 98) {
    document.getElementById("btn_xacnhan").style.display = "block";
    document.getElementById("btn_capnhat").style.display = "block";
  // } else {
  //   document.getElementById("btn_capnhat").style.display = "none";
  //   document.getElementById("btn_xacnhan").style.display = "none";
  // }
  document.getElementById("btn_guihang").style.display = "none";
  document.getElementById("btn_danhan").style.display = "none";
  $(e).parent().addClass("active_items");

  $.post(
    "ajax/ims/ims_load_line.php",
    { soct },
    function (data, textStatus, jqXHR) {
      $("#chitiet_ims_tbody").html(data);
      $("#soct_td").val(soct);
      $("#soct_dathang").val(soctdh);
      $("#tenkhachhang_chitiet").val(tenkhachhang);
      // if (trangthaidonhang < 4 && loaiuser >= 98) {
      //   document.getElementById("btn_guihang").style.display = "none";
      //   document.getElementById("btn_danhan").style.display = "none";
      // } else {
        document.getElementById("btn_guihang").style.display = "block";
        document.getElementById("btn_danhan").style.display = "block";
      // }
    }
  );
}
//Hủy duyệt
function open_ims_xacnhan(e) {
  var soct = $("#soct_td").val();
  var nghiepvu = "ims_huydonhang";
  var soctdh = $("#soct_dathang").val();
  $("#soct_xacnhan").val(soct);
  $.post(
    "ajax/ims/ims_xuly.php",
    { soct: soct, nghiepvu: nghiepvu, soctdh: soctdh },
    function (data, textStatus, jqXHR) {
      if (data > 0) {
        $("#btn_dongy").html(
          `<button onclick="ims_xacnhan(this)"  class="btn btn-success">Xác nhận</button>`
        );
        $("#title").html(
          `<h5 class="modal-title" id="staticBackdropLabel">Xác nhận hủy duyệt?</h5>`
        );
      } else {
        $("#btn_dongy").html("");
        $("#title").html(
          `<h5 class="modal-title" id="staticBackdropLabel">Đơn hàng đã giao, không thể hủy</h5>`
        );
      }
    }
  );
}

// Xác nhận hủy duyệt
function ims_xacnhan(e) {
  var nghiepvu = "ims_xacnhan_huydonhang";
  var soct = $("#soct_xacnhan").val();
  var soctdh = $("#soct_dathang").val();
  $.post(
    "ajax/ims/ims_xuly.php",
    { soct: soct, soctdh: soctdh, nghiepvu: nghiepvu },
    function (data, textStatus, jqXHR) {
      $("#form_xacnhan").modal("hide");
      ims_header();
    }
  );
}
function open_post_thuchi(e) {
  const conno = $(e).parent().find(".conno_td").text();
  const soct = $(e).parent().find(".soct_td").text();
  const ten_ncc = $(e).parent().find(".tenkh_td").text();
  const msnccc = $(e).parent().find(".mskh_td").text();
  const sohd = $(e).parent().find(".sohd_td").text();
  const dathanhtoan = $(e).parent().find(".dathanhtoan").text();
  $("#sotien_conno").val(conno);
  $("#soct_thanhtoan").val(soct);
  $("#ten_ncc_thanhtoan").val(ten_ncc);
  $("#ms_ncc_thanhtoan").val(msnccc);
  $("#sohd_thanhtoan").val(sohd);
  $("#dathanhtoan_thanhtoan").val(dathanhtoan);
}
function delete_xuatkho_header(soct) {
  $.post(
    "ajax/xuatkho/huy_xuatkho.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {
      $("#form_danhsach_xuatkho_chua_luu").modal("hide");
      ims_header();
    }
  );
}

function open_capnhat_donhang(e, loai) {
  const soct = $(e).parent().parent().find("#soct_dathang").val();
  const tenkhachhang = $(e)
    .parent()
    .parent()
    .find("#tenkhachhang_chitiet")
    .val();
  $("#soct_guihang").val(soct);
  $("#title_tennhathuoc_guihang").html(tenkhachhang);
  $("#form_capnhat_guihang").modal("show");
  if (loai == "guihang") {
    $("#trangthai_donhang").val(2);
    $("#title_donhang").html("Xác nhận gửi đơn hàng");
  } else {
    $("#trangthai_donhang").val(4);
    $("#title_donhang").html("Xác nhận đã nhận đơn hàng");
  }
}

function capnhat_donhang(e, loai) {
  const soct = $(e).parent().find("#soct_guihang").val();
  const trangthai = $(e).parent().find("#trangthai_donhang").val();
  $.post(
    "ajax/ims/capnhat_donhang.php",
    { soct: soct, trangthai: trangthai },
    function (data, textStatus, jqXHR) {
      ims_header();
      $("#chitiet_ims_tbody").html("");
    }
  );
}
