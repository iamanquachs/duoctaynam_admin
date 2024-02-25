function load_voucher() {
  const value = $("#_search").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  const loaivoucher = $("#loaivoucher_loc option:selected").val();
  const trangthai = $("#trangthai_loc option:selected").val();
  $.post(
    "ajax/voucher/load_voucher.php",
    {
      value: value,
      tungay: tungay,
      denngay: denngay,
      loaivoucher: loaivoucher,
      trangthai: trangthai,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_voucher").html(data);
    }
  );
}
function add_voucher() {
  const loaikh = $("#loaikh_add option:selected").val();
  const loaivoucher = $("#loaivoucher_add option:selected").val();
  const mskh = $("#mskh_add").val();
  const tenvoucher = $("#tenvoucher_add").val();
  const sotien = $("#sotien_add").val().replaceAll(".", "");
  const thoihan = $("#thoihan_add").val();
  if (loaikh == "1") {
    if (mskh != "" && tenvoucher != "" && sotien != "") {
      $.post(
        "ajax/voucher/add_voucher.php",
        {
          loaikh: loaikh,
          loaivoucher: loaivoucher,
          mskh: mskh,
          tenvoucher: tenvoucher,
          sotien: sotien,
          thoihan: thoihan,
        },
        function (data, textStatus, jqXHR) {
          load_voucher();
          $("#form_add_voucher").modal("hide");
        }
      );
    }
  } else {
    if (tenvoucher != "" && sotien != "") {
      $.post(
        "ajax/voucher/add_voucher.php",
        {
          loaikh: loaikh,
          loaivoucher: loaivoucher,
          mskh: mskh,
          tenvoucher: tenvoucher,
          sotien: sotien,
          thoihan: thoihan,
        },
        function (data, textStatus, jqXHR) {
          load_voucher();
          $("#form_add_voucher").modal("hide");
        }
      );
    }
  }
}
function change_loaikh(e) {
  $("#mskh_form").addClass("hidden");
  $("#tenkh_form").addClass("hidden");
  const loaikh = $("#loaikh_add option:selected").val();
  if (loaikh == 1) {
    $("#mskh_form").removeClass("hidden");
    $("#tenkh_form").removeClass("hidden");
  }
}
function open_delete_voucher(rowid, mskh) {
  $("#mavoucher_delete").val(rowid);
  $("#title_xoavoucher").text(mskh);
  $("#form_delete_voucher").modal("show");
}
function delete_voucher(e) {
  const rowid = $(e).parent().find("#mavoucher_delete").val();
  $.post(
    "ajax/voucher/delete_voucher.php",
    { rowid: rowid },
    function (data, textStatus, jqXHR) {
      load_voucher();
    }
  );
}
function filter_kh() {
  const value = $("#mskh_add").val();
  $.post(
    "ajax/voucher/filter_kh.php",
    { value: value },
    function (data, textStatus, jqXHR) {
      $("#tenkhachhang_add").val(data[0].tenkhachhang);
    }
  );
}
