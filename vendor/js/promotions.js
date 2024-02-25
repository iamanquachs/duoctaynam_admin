function load_header() {
  const tenctkm_search = $("#tenctkm_search").val();
  const songayhethan = $("#songayhethan_filter").val();
  const tronghan = $("#tronghan_filter option:selected").val();
  const loai_filter = $("#loai_filter option:selected").val();
  const ctkm_tungay = $("#tungay").val();
  const ctkm_denngay = $("#denngay").val();
  $.post(
    "ajax/promotions/load_header.php",
    {
      tenctkm_search: tenctkm_search,
      loai_filter: loai_filter,
      songayhethan: songayhethan,
      tronghan: tronghan,
      ctkm_tungay: ctkm_tungay,
      ctkm_denngay: ctkm_denngay,
    },
    function (data, textStatus, jqXHR) {
      $(".promotions_tbody").html(data);
      $("#chitiet_ctmk_tbody").html("");
    }
  );
}

function load_CTKM(msctkm, tenctkm, loaikm) {
  const songayhethan = $("#songayhethan_filter").val();
  const tronghan = $("#tronghan_filter option:selected").val();
  const loai_filter = $("#loai_filter option:selected").val();
  const ctkm_tungay = $("#tungay").val();
  const ctkm_denngay = $("#denngay").val();
  $.post(
    "ajax/promotions/load_CTKM.php",
    {
      msctkm: msctkm,
      loai_filter: loai_filter,
      songayhethan: songayhethan,
      tronghan: tronghan,
      ctkm_tungay: ctkm_tungay,
      ctkm_denngay: ctkm_denngay,
    },
    function (data, textStatus, jqXHR) {
      $("#chitiet_ctmk_tbody").html(data);
      $("#chitiet_msctkm").val(msctkm);
      $("#chitiet_ten_msctkm").val(tenctkm);
      $("#chitiet_loai_msctkm").val(loaikm);
      $("#show_add_chitiet_ctkm_theopt").css("display", "none");
      $("#show_add_chitiet_ctkm").css("display", "none");

      if (loaikm == 1) {
        $("#show_add_chitiet_ctkm_theopt").css("display", "block");
      } else {
        $("#show_add_chitiet_ctkm").css("display", "block");
      }
    }
  );
}
function open_delete_form(rowid, msctkm, e) {
  $("#form_delete_ctkm").modal("show");
  $("#title_delete_ctkm").html(
    "Xóa CTKM " + $(e).parent().find(".stt_td").text()
  );
  $("#rowid_delete").val(rowid);
  $("#msctkm_delete").val(msctkm);
}

function delete_CTKM() {
  const rowid = $("#rowid_delete").val();
  const msctkm = $("#msctkm_delete").val();
  $.post(
    "ajax/promotions/delete_CTKM.php",
    { rowid: rowid },
    function (data, textStatus, jqXHR) {
      load_header();
      $("#form_delete_ctkm").modal("hide");
      load_CTKM(msctkm);
    }
  );
}
function edit_CTKM(khoa, rowid, msctkm) {
  $.post(
    "ajax/promotions/edit_CTKM.php",
    { rowid: rowid, khoa: khoa },
    function (data, textStatus, jqXHR) {
      load_CTKM(msctkm);
    }
  );
}

function add_ctkm_header() {
  const ten_ctkm = $("#ten_ctkm").val();
  const loai_ctkm = $("#loai_ctkm option:selected").val();
  $.post(
    "ajax/promotions/add_ctkm_header.php",
    { ten_ctkm: ten_ctkm, loai_ctkm: loai_ctkm },
    function (data, textStatus, jqXHR) {
      $("#form_add_ctkm_header").modal("hide");
      $("#ten_ctkm").val("");
      load_header();
    }
  );
}

function find_hanghoa_tangkem(e, loai) {
  const mshh = $(e).val();
  $.post(
    "ajax/promotions/find_hanghoa_tangkem.php",
    { mshh: mshh },
    function (data, textStatus, jqXHR) {
      console.log(data);
      if (data.length != 0) {
        if (loai == "hh") {
          $("#mshh_chitiet_ctkm_add").val(data[0].mshh);
          $("#tenhh_ctkm").val(data[0].tenhh);
        } else if (loai == "hhtangkem") {
          $("#mshh_tangkem_chitiet_ctkm_add").val(data[0].mshh);
          $("#tenhhtangkem_ctkm").val(data[0].tenhh);
        } else if (loai == "hh_theopt") {
          $("#mshh_chitiet_ctkm_add_theopt").val(data[0].mshh);
          $("#tenhh_ctkm_theopt").val(data[0].tenhh);
        }
      }
    }
  );
}

function add_chitiet_ctkm() {
  const msctkm = $("#chitiet_msctkm").val();
  const tenctkm = $("#chitiet_ten_msctkm").val();
  const loaikm = $("#chitiet_loai_msctkm").val();
  const mshh = $("#mshh_chitiet_ctkm_add").val();
  const sl_mua = $("#sl_mua_ctkm").val();
  const mshh_tangkem = $("#mshh_tangkem_chitiet_ctkm_add").val();
  const sl_tangkem = $("#sl_tangkem_ctkm").val();
  const pt_tangkem = $("#pt_tangkem_ctkm").val();
  const tungay = $("#tungay_add").val();
  const denngay = $("#denngay_add").val();
  $.post(
    "ajax/promotions/add_chitiet_ctkm.php",
    {
      msctkm: msctkm,
      tenctkm: tenctkm,
      loaikm: loaikm,
      mshh: mshh,
      sl_mua: sl_mua,
      mshh_tangkem: mshh_tangkem,
      sl_tangkem: sl_tangkem,
      pt_tangkem: pt_tangkem,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      load_CTKM(tenctkm, msctkm, loaikm);
      $("#form_add_chitiet_ctkm").modal("hide");
      $("#mshh_chitiet_ctkm_add").val("");
      $("#tenhh_ctkm").val("");
      $("#sl_mua_ctkm").val("");
      $("#tenhhtangkem_ctkm").val("");
      $("#mshh_tangkem_chitiet_ctkm_add").val("");
      $("#sl_tangkem_ctkm").val("");
      $("#pt_tangkem_ctkm").val("");
    }
  );
}

function add_chitiet_ctkm_theopt() {
  const msctkm = $("#chitiet_msctkm").val();
  const tenctkm = $("#chitiet_ten_msctkm").val();
  const loaikm = $("#chitiet_loai_msctkm").val();
  const mshh = $("#mshh_chitiet_ctkm_add_theopt").val();
  const pt_tangkem = $("#pt_tangkem_ctkm_theopt").val();
  const tungay = $("#tungay_add_theopt").val();
  const denngay = $("#denngay_add_theopt").val();
  $.post(
    "ajax/promotions/add_chitiet_ctkm_theopt.php",
    {
      msctkm: msctkm,
      tenctkm: tenctkm,
      loaikm: loaikm,
      mshh: mshh,
      pt_tangkem: pt_tangkem,
      tungay: tungay,
      denngay: denngay,
    },
    function (data, textStatus, jqXHR) {
      load_CTKM(tenctkm, msctkm, loaikm);
      $("#chitiet_ten_msctkm").val("");
      $("#mshh_chitiet_ctkm_add_theopt").val("");
      $("#tenhh_ctkm_theopt").val("");
      $("#pt_tangkem_ctkm_theopt").val(0);
      $("#form_add_chitiet_ctkm_theopt").modal("hide");
      if (data == "error") {
        $("#form_trung_ngay").modal("show");
      }
    }
  );
}
