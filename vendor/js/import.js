function _ChangeFormat(e) {
  var soluong = $(e).val().replace(/[.]/g, "");
  soluong = $(e)
    .val()
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $(e).val(soluong);
}

function nhapkho_add_header(soct) {
  $.post(
    "ajax/nhapkho/nhapkho_add_header.php",
    { soct: soct },
    function (data, textStatus, jqXHR) {}
  );
}

function nhapkho_add_line() {
  const soct = location.search.split("?")[1];
  let tenthuoc = $("#tenthuoc_add").val(),
    mshh = $("#mshh_add").val(),
    dvt = $("#dvt_add").val(),
    solo = $("#solo_add").val(),
    handung = $("#handung_add").val(),
    gianhap = $("#gianhap_add").val().replaceAll(".", ""),
    chietkhau = $("#chietkhau_add").val(),
    tienchietkhau = $("#tienchietkhau_add").val(),
    gianhapchuathue = $("#gianhapchuathue_add").val(),
    tienthue = $("#tienthue_add").val(),
    vat = $("#vat_add").val(),
    soluong = $("#soluong_add").val(),
    ptgiaban = $("#ptgianban_add").val(),
    giaban = $("#gianban_add").val().replaceAll(".", ""),
    gianhapcothue = $("#gianhapcothue_add").val().replaceAll(".", "");
  const select_chietkhau = $("#select_chietkhau option:selected").val();
  if (select_chietkhau == "vndchietkhau") {
    chietkhau = 0;
  } else if (select_chietkhau == "tongchietkhau") {
    chietkhau = 0;
  }
  const thanhtiencothue = parseInt(gianhapcothue) * soluong;
  $.post(
    "ajax/nhapkho/nhapkho_add_line.php",
    {
      soct: soct,
      tenthuoc: tenthuoc,
      mshh: mshh,
      dvt: dvt,
      solo: solo,
      handung: handung,
      gianhap: gianhap,
      chietkhau: chietkhau,
      tienchietkhau: tienchietkhau,
      gianhapchuathue: gianhapchuathue,
      tienthue: tienthue,
      vat: vat,
      soluong: soluong,
      ptgiaban: ptgiaban,
      giaban: giaban,
      gianhapcothue: gianhapcothue,
      thanhtiencothue: thanhtiencothue,
    },
    function (data, textStatus, jqXHR) {
      nhapkho_load_line();
      tinh_tongcong();
      $("#tenthuoc_add").val("");
      $("#mshh_add").val("");
      $("#solo_add").val("");
      $("#handung_add").val("");
      $("#gianhap_add").val(0);
      $("#chietkhau_add").val(0);
      $("#gianhapchuathue_add").val(0);
      $("#tienthue_add").val(0);
      $("#vat_add").val(5);
      $("#soluong_add").val(1);
      $("#ptgiaban_add").val(0);
      $("#gianban_add").val(0);
      $("#gianhapcothue_add").val(0);
    }
  );
}
function tinh_tongcong() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/nhapkho/nhapkho_tinhtong.php",
    {
      soct: soct,
    },
    function (data) {
      $("#tongcong_add").val(
        data[0].thanhtiencothue.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}
function tinh_ptgiaban() {
  const ptgianban = $("#ptgianban_add").val();
  const gianhapcothue = $("#gianhapcothue_add").val().replaceAll(".", "");
  const giaban =
    parseInt(gianhapcothue) + (parseInt(gianhapcothue) * ptgianban) / 100;
  const replace_giaban = Math.round(parseFloat(giaban) / 1000) * 1000;

  $("#gianban_add").val(
    replace_giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
}

function tinh_gianhapcothue() {
  const select_chietkhau = $("#select_chietkhau option:selected").val();
  var gianhap = $("#gianhap_add")
    .val()
    .replaceAll(".", "")
    .replaceAll(",", ".");
  const ptgianban = $("#ptgianban_add").val();
  const soluong = $("#soluong_add").val();
  var chietkhau = $("#chietkhau_add").val().replaceAll(".", "");
  var vat = $("#vat_add").val();

  if (select_chietkhau == "ptchietkhau") {
    const tienchietkhau = gianhap - (gianhap - (gianhap * chietkhau) / 100);
    const tinhchietkhau = gianhap - (gianhap * chietkhau) / 100;
    const tinhvat = Math.round(tinhchietkhau + (tinhchietkhau * vat) / 100);
    const tienthue = (tinhchietkhau * vat) / 100;
    const giaban = tinhvat + (tinhvat * ptgianban) / 100;
    const replace_giaban = Math.round(parseFloat(giaban) / 1000) * 1000;
    $("#tienthue_add").val(tienthue);
    $("#tienchietkhau_add").val(tienchietkhau);
    $("#gianhapchuathue_add").val(tinhchietkhau);
    $("#gianhapcothue_add").val(
      tinhvat.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
    $("#gianban_add").val(
      replace_giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
  } else if (select_chietkhau == "vndchietkhau") {
    const tienchietkhau = gianhap - (gianhap - chietkhau);
    const tinhchietkhau = parseInt(gianhap) - parseInt(chietkhau);
    const tinhvat = tinhchietkhau + (tinhchietkhau * vat) / 100;
    const giaban = tinhvat + (tinhvat * ptgianban) / 100;
    const replace_giaban = Math.round(parseFloat(giaban) / 1000) * 1000;
    $("#tienthue_add").val(vat);
    $("#tienchietkhau_add").val(tienchietkhau);
    $("#gianhapchuathue_add").val(tinhchietkhau);
    $("#gianhapcothue_add").val(
      tinhvat.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
    $("#gianban_add").val(
      replace_giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
  } else if (select_chietkhau == "tongchietkhau") {
    const tienchietkhau = gianhap - (gianhap - chietkhau);
    const tinhsoluong = parseInt(chietkhau) / soluong;
    const tinhchietkhau = parseInt(gianhap) - tinhsoluong;
    console.log(tinhchietkhau);
    $("#gianhapchuathue_add").val(tinhchietkhau);
    const tinhvat = Math.round(tinhchietkhau + (tinhchietkhau * vat) / 100);
    const giaban = tinhvat + (tinhvat * ptgianban) / 100;
    const replace_giaban = Math.round(parseFloat(giaban) / 1000) * 1000;

    $("#tienthue_add").val(vat);
    $("#tienchietkhau_add").val(tienchietkhau);
    $("#gianhapcothue_add").val(
      tinhvat.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
    $("#gianban_add").val(
      replace_giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
    );
  }
}

function nhapkho_load_line() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/nhapkho/nhapkho_load_line_phieunhap.php",
    {
      soct: soct,
    },
    function (data) {
      $("#chitiet_nhapkho_line").html(data);
    }
  );
}

function nhapkho_update_header() {
  const soct = location.search.split("?")[1];
  var tongcong = $("#tongcong_add").val().replaceAll(".", ""),
    sohoadon = $("#sohoadon_add").val(),
    ngayhd = $("#ngayhd_add").val(),
    msncc = $("#nhacc_add").val(),
    tenncc = $("#nhacc_add option:selected").text();
  // console.log(msncc);
  if (sohoadon == "") {
    $("#sohd_error").css("display", "block");
  }
  if (ngayhd == "0d/mm/yyyy") {
    $("#ngayhd_error").css("display", "block");
  }
  if (msncc == "") {
    $("#ncc_error").css("display", "block");
  }
  if (msncc != "" && sohoadon != "" && ngayhd != "0d/mm/yyyy") {
    $("#ncc_error").css("display", "none");
    $("#ngayhd_error").css("display", "none");
    $("#sohd_error").css("display", "none");
    $.post(
      "ajax/nhapkho/nhapkho_update_header.php",
      {
        soct: soct,
        sohoadon: sohoadon,
        ngayhd: ngayhd,
        msncc: msncc,
        tenncc: tenncc,
        tongcong: tongcong,
      },
      function (data) {
        $("#form_nhapkho_success").modal("show");
        setTimeout(function return_nhapkho() {
          location.href = "https://erp.duoctaynam.vn/import";
        }, 1000);
      }
    );
  }
}
function nhapkho_load_header_taophieu() {
  const soct = location.search.split("?")[1];
  $.post(
    "ajax/nhapkho/nhapkho_load_header_taophieu.php",
    {
      soct: soct,
    },
    function (data) {
      const ngay = data[0].ngayhd.split("-");
      $("#nhacc_add").val(data[0].msncc);
      $("#sohoadon_add").val(data[0].sohd);
      $("#ngayhd_add").val(ngay[2] + "/" + ngay[1] + "/" + ngay[0]);
    }
  );
}

function open_nhapkho_delete_line(e) {
  $("#soct_delete").val($(e).parent().find(".soct").text());
  $("#rowid_delete").val($(e).parent().find(".rowid").text());
  $("#tensp_delete").text($(e).parent().find(".tenhh_line").text());
}

function nhapkho_delete_line(e) {
  const soct = $("#soct_delete").val();
  const rowid = $("#rowid_delete").val();
  $.post(
    "ajax/nhapkho/nhapkho_delete_line.php",
    {
      soct: soct,
      rowid: rowid,
    },
    function (data) {
      $("#form_delete_line").modal("hide");
      nhapkho_load_line();
      tinh_tongcong();
    }
  );
}

function load_hosohanghoa(e) {
  setTimeout(function () {
    const tenhh = $(e).val();
    $.post(
      "ajax/nhapkho/nhapkho_load_hosohanghoa.php",
      {
        tenhh: tenhh,
      },
      function (data) {
        if (tenhh != "") {
          $("#load_hosohanghoa").html(data);
        } else {
          $("#load_hosohanghoa").html("");
        }
      }
    );
  }, 1000);
}
function chon_hanghoa(e) {
  $("#tenthuoc_add").val("");
  const mshh = $(e).find(".mshh").text();
  const tenhh = $(e).find(".tenhh").text();
  const giaban = $(e).find(".gianhap").text();
  const giabanvat = $(e).find(".gianhapvat").text();
  const thuesuat = $(e).find(".thuesuat").text();
  const dvt = $(e).find(".dvt").text();
  const ptgiaban = $(e).find(".ptgiaban").text();
  $("#mshh_add").val(mshh);
  $("#dvt_add").val(dvt);
  $("#gianhap_add").val(
    giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
  $("#vat_add").val(thuesuat);
  $("#tenthuoc_add").val(tenhh);
  $("#ptgianban_add").val(ptgiaban);
  $("#load_hosohanghoa").html("");
  tinh_gianhapcothue();
}

function open_form_edit_line(e) {
  $("#soct_edit_line").val($(e).parent().find(".soct").text());
  $("#mshh_edit_line").val($(e).parent().find(".mshh").text());
  $("#tenhh_line_edit").val($(e).parent().find(".tenhh_line").text());
  $("#dvt_line_edit").val($(e).parent().find(".dvt_line").text());
  $("#solo_line_edit").val($(e).parent().find(".solo_line").text());
  $("#handung_line_edit").val($(e).parent().find(".handung_line").text());
  $("#gianhap_line_edit").val($(e).parent().find(".gianhap_line").text());
  $("#chietkhau_line_edit").val($(e).parent().find(".chietkhau_line").text());
  $("#tienchietkhau_line_edit").val(
    $(e).parent().find(".tienchietkhau_line").text()
  );
  $("#vat_line_edit").val($(e).parent().find(".vat_line").text());
  $("#gianhapvat_line_edit").val($(e).parent().find(".giabanvat_line").text());
  $("#soluong_line_edit").val($(e).parent().find(".soluong_line").text());
  $("#thanhtien_line_edit").val($(e).parent().find(".thanhtien_line").text());
  $("#ptgiaban_line_edit").val($(e).parent().find(".ptgiaban_line").text());
  $("#giaban_line_edit").val($(e).parent().find(".giaban_line").text());
}

function tinh_gianhapcothue_edit() {
  var gianhap = $("#gianhap_line_edit").val().replaceAll(".", "");
  var chietkhau = $("#chietkhau_line_edit").val().replaceAll(".", "");
  var vat = $("#vat_line_edit").val();
  var ptgianban = $("#ptgiaban_line_edit").val();
  var soluong = $("#soluong_line_edit").val();

  const tienchietkhau = gianhap - (gianhap - (gianhap * chietkhau) / 100);
  const tinhchietkhau = gianhap - (gianhap * chietkhau) / 100;
  const tinhvat = tinhchietkhau + (tinhchietkhau * vat) / 100;
  const giaban = tinhvat + (tinhvat * ptgianban) / 100;
  var replace_giaban = Math.round(parseFloat(giaban) / 1000) * 1000;
  const thanhtien = tinhvat * soluong;
  $("#tienchietkhau_line_edit").val(tienchietkhau);
  $("#gianhapvat_line_edit").val(
    tinhvat.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
  $("#giaban_line_edit").val(
    replace_giaban.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
  $("#thanhtien_line_edit").val(
    thanhtien.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
}

function nhapkho_edit_line() {
  const soct = $("#soct_edit_line").val();
  const mshh = $("#mshh_edit_line").val();
  const tenhh = $("#tenhh_line_edit").val();
  const dvt = $("#dvt_line_edit").val();
  const solo = $("#solo_line_edit").val();
  const handung = $("#handung_line_edit").val();
  const gianhap = $("#gianhap_line_edit").val().replaceAll(".", "");
  const chietkhau = $("#chietkhau_line_edit").val();
  const tienchietkhau = $("#tienchietkhau_line_edit").val().replaceAll(".", "");
  const vat = $("#vat_line_edit").val();
  const gianhapvat = $("#gianhapvat_line_edit").val().replaceAll(".", "");
  const soluong = $("#soluong_line_edit").val();
  const ptgiaban = $("#ptgiaban_line_edit").val();
  const giaban = $("#giaban_line_edit").val().replaceAll(".", "");
  const thanhtien = $("#thanhtien_line_edit").val().replaceAll(".", "");
  const gianhapchuathue = gianhap - (gianhap * chietkhau) / 100;
  const tienthue = gianhapvat - gianhapchuathue;

  $.post(
    "ajax/nhapkho/nhapkho_edit_line.php",
    {
      soct: soct,
      mshh: mshh,
      tenhh: tenhh,
      dvt: dvt,
      solo: solo,
      handung: handung,
      gianhap: gianhap,
      chietkhau: chietkhau,
      tienchietkhau: tienchietkhau,
      gianhapchuathue: gianhapchuathue,
      vat: vat,
      tienthue: tienthue,
      gianhapvat: gianhapvat,
      soluong: soluong,
      ptgiaban: ptgiaban,
      giaban: giaban,
      thanhtien: thanhtien,
    },
    function (data) {
      nhapkho_load_line();
      tinh_tongcong();
      $("#form_edit_line").modal("hide");
    }
  );
}
//!function này load ở phần nhập kho bên ngoài
function nhapkho_load_header() {
  $.post("ajax/nhapkho/nhapkho_load_header.php", {}, function (data) {
    $(".__chitiet_nhapkho").html(data);
  });
}
//!function này load ở phần nhập kho bên ngoài

function load_chitiet_line(e) {
  $(".item_nhapkho_header").removeClass("active_items");
  const soct = $(e).parent().find(".soct").text();
  // const capnhat = document.getElementById("capnhat__");
  // capnhat.href = "capnhat?" + soct;
  $(e).parent().addClass("active_items");
  $(".__soct_nhapkho").val(soct);
  $.post(
    "ajax/nhapkho/nhapkho_load_line_nhapkho.php",
    { soct: soct },
    function (data) {
      $(".__chitiet_nhapkho_line").html(data);
    }
  );
}
function get_nhapkho_chua_update() {
  $.post(
    "ajax/nhapkho/nhapkho_load_header_chua_update.php",
    {},
    function (data) {
      if (data.length > 0) {
        $("#form_nhapkho_chua_thanhcong").modal("show");
        for (let i = 0; i <= data.length; i++) {
          $("#item_nhapkho_chua_thanhcong").append(`
            <div class="item_hoadon_chuanhap">
                <a  href='update-import?${data[i].soct}'>
                    Hóa đơn chưa nhập
                </a>
                <input hidden class='soct_delete' value='${data[i].soct}' >
                <span onclick='___delete_nhapkho_header(this)'>Xóa</span>
            </div>
      `);
        }
      }
    }
  );
}
function delete_nhapkho_header(e) {
  const soct = $(e).parent().find("#form_soct_delete").val();
  $.post(
    "ajax/nhapkho/nhapkho_delete_header.php",
    { soct: soct },
    function (data) {
      $(".__chitiet_nhapkho_line").html("");
      nhapkho_load_header();
    }
  );
}

function ___delete_nhapkho_header(e) {
  const soct = $(e).parent().find(".soct_delete").val();
  $.post(
    "ajax/nhapkho/nhapkho_delete_header.php",
    { soct: soct },
    function (data) {
      $("#item_nhapkho_chua_thanhcong").html("");
      get_nhapkho_chua_update();
    }
  );
}
function open_form_delete_nhapkho_header(e) {
  const soct = $(e).parent().find(".__soct_nhapkho").val();
  $("#form_nhapkho_delete").modal("show");
  $("#form_soct_delete").val(soct);
}

function nhapkho_filter() {
  const settungay = $("#tungay").val().split("/");
  const tungay = settungay[2] + "-" + settungay[1] + "-" + settungay[0];
  const setdenngay = $("#denngay").val().split("/");
  const denngay = setdenngay[2] + "-" + setdenngay[1] + "-" + setdenngay[0];

  const loai = $("#loai_filter").val();
  $.post(
    "ajax/nhapkho/nhapkho_filter.php",
    { loai: loai, tungay: tungay, denngay: denngay },
    function (data) {
      $(".__chitiet_nhapkho").html(data);
    }
  );
}

function nhapkho_search(e) {
  $(".__chitiet_nhapkho").html("");

  const value = $(e).val();
  setTimeout(() => {
    $.post(
      "ajax/nhapkho/nhapkho_search.php",
      { value: value },
      function (data) {
        $(".__chitiet_nhapkho").html(data);
      }
    );
  }, 1000);
}

function huy_nhapkho() {
  const soct = location.search.split("?")[1];
  const huy_nhapkho = document.getElementById("huy_nhapkho");
  huy_nhapkho.href = "import";
  $.post("ajax/nhapkho/huy_nhapkho.php", { soct: soct }, function (data) {});
}

function open_capnhatkho(e) {
  const soct = $(e).parent().find(".__soct_nhapkho").val();
  const capnhat = document.getElementById("capnhat__");
  capnhat.href = "update-import?" + soct;
  $.post(
    "ajax/nhapkho/open_capnhatkho.php",
    { soct: soct },
    function (data) {}
  );
}

function add_nhacungcap() {
  const msncc = $("#msncc_add").val(),
    tenncc = $("#tenncc_add").val(),
    tenviettat = $("#tenviettat_ncc_add").val(),
    dienthoai = $("#dienthoai_ncc_add").val(),
    diachi = $("#diachi_ncc_add").val();
  $.post(
    "ajax/nhapkho/add_nhacungcap.php",
    {
      msncc: msncc,
      tenncc: tenncc,
      tenviettat: tenviettat,
      dienthoai: dienthoai,
      diachi: diachi,
    },
    function (data) {
      $("#msncc_add").val("");
      $("#tenncc_add").val("");
      $("#tenviettat_ncc_add").val("");
      $("#dienthoai_ncc_add").val("");
      $("#diachi_ncc_add").val("");
      $("#form_add_ncc").modal("hide");
      load_nhacungcap();
    }
  );
}
function load_nhacungcap() {
  $(".__chitiet_nhacc_line").html("");
  $("#nhacc_add").html("");
  $.post("ajax/nhapkho/load_nhacungcap.php", {}, function (data) {
    $("#nhacc_add").append(`
      <option value="">Chọn nhà cung cấp</option>
      `);
    for (let i = 0; i <= data.length; i++) {
      $("#nhacc_add").append(`
      <option value="${data[i].msnsx}">${data[i].tennsx}</option>
      `);
      $(".__chitiet_nhacc_line").append(`
      <tr>
            <th scope="row">${i}</th>
            <td class="tenhh">${data[i].msnsx}</td>
            <td class="dvt">${data[i].tennsx}</td>
            <td>${data[i].tenviettat}</td>
            <td>${data[i].dienthoai}</td>
            <td>${data[i].diachi}</td>
            <td onclick='delete_ncc("${data[i].msnsx}")'><img src='vendor/img/xoa16.png'></td>
        </tr>
      `);
      nhapkho_load_header_taophieu();
    }
  });
}

function delete_ncc(e) {
  $.post("ajax/nhapkho/delete_nhacungcap.php", { msnsx: e }, function (data) {
    load_nhacungcap();
  });
}

function open_post_thuchi(e) {
  const conno = $(e).parent().find(".conno").text();
  const soct = $(e).parent().find(".soct").text();
  const ten_ncc = $(e).parent().find(".ten_ncc").text();
  const msnccc = $(e).parent().find(".msncc").text();
  const sohd = $(e).parent().find(".sohd").text();
  const dathanhtoan = $(e).parent().find(".dathanhtoan").text();
  $("#sotien_conno").val(conno);
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
      nhapkho_filter();
    }
  );
}
