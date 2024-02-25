function _ChangeFormat(e) {
  var soluong = $(e).val().replace(/[.]/g, "");
  soluong = $(e)
    .val()
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $(e).val(soluong);
}
function load_thuchi(e) {
  $(".__chitiet_thuchi").html("");
  const valueSearch = $("#_search").val();
  const tungay = $("#tungay").val();
  const denngay = $("#denngay").val();
  const locloai = $("#trangthai_loc option:selected").val();

  const khoanmuc = $("#khoanmuc_loc option:selected").val();
  $.post(
    "ajax/thuchi/load_thuchi.php",
    {
      valueSearch: valueSearch,
      tungay: tungay,
      denngay: denngay,
      locloai: locloai,
      khoanmuc: khoanmuc,
    },
    function (data) {
      $(".__chitiet_thuchi").html("");
      for (let i = 0; i < data.length; i++) {
        var form_thu_chi;
        if ($("#loaiuser_dangnhap").val() != 1) {
          if (data[i].dieukien2 == "THU") {
            if (data[i].makhoanmuc != "TBH") {
              form_thu_chi = `<td data-target="#form_edit_thu" onclick="open_edit_thu(this)" data-toggle="modal"><img src="./vendor/img/edit16.png"></td>
              <td data-target="#form_delete_thuchi" onclick="open_delete_thuchi(this)" data-toggle="modal"><img src="./vendor/img/xoa16.png"></td>`;
            } else {
              form_thu_chi = `<td data-target="#form_thongbaothu" data-toggle="modal"><img src="./vendor/img/edit16.png"></td>
              <td data-target="#form_delete_thuchi" onclick="open_delete_thuchi(this)" data-toggle="modal"><img src="./vendor/img/xoa16.png"></td>`;
            }
          } else {
            if (data[i].makhoanmuc != "CMH") {
              form_thu_chi = `<td data-target="#form_edit_chi" onclick="open_edit_chi(this)" data-toggle="modal"><img src="./vendor/img/edit16.png"></td>\
              <td data-target="#form_delete_thuchi" onclick="open_delete_thuchi(this)" data-toggle="modal"><img src="./vendor/img/xoa16.png"></td>`;
            } else {
              form_thu_chi = `<td data-target="#form_thongbaochi"  data-toggle="modal"><img src="./vendor/img/edit16.png"></td>
              <td data-target="#form_delete_thuchi" onclick="open_delete_thuchi(this)" data-toggle="modal"><img src="./vendor/img/xoa16.png"></td>`;
            }
          }
        } else {
          form_thu_chi = `<td></td><td></td>`;
        }
        $(".__chitiet_thuchi").append(`
            <tr class='active_items_hover'  onclick="add_active(this)">
                <td>${i + 1}</td>
                <td class="msdv_thuchi" hidden>${data[i].msdv}</td>
                <td class="msdn_thuchi" hidden>${data[i].msdn}</td>
                <td class="nganquy_thuchi" hidden>${data[i].nganquy}</td>
                <td class="khoanmuc_thuchi" hidden>${data[i].makhoanmuc}</td>
                <td class="msnguoinop_thuchi" hidden>${data[i].msnhanvien}</td>
                <td class="soct_thuchi" hidden>${data[i].soct}</td>
                <td class="soct_donhang_thuchi" hidden>${
                  data[i].soct_donhang
                }</td>
                <td class="lastmodify_thuchi">${data[i].lastmodify}</td>
                <td class="ngay_thuchi">${data[i].ngaygio}</td>
                <td class="nd_thuchi">${data[i].noidung}</td>
                <td class="sotien_thuchi">${data[i].sotien
                  .toString()
                  .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")}</td>
                <td class="maso_thuchi" hidden>${data[i].maso}</td>
                <td>${data[i].tenmaso}</td>
                <td class="">${data[i].tenloai}</td>
                <td>${data[i].msdn}</td>
                <td>${data[i].tennhanvien}</td>
                ${form_thu_chi}
                
            </tr>
        `);
      }
    }
  );
}
function load_chitietkhoanmuc() {
  const locloai = $("#trangthai_loc option:selected").val();

  if (locloai == "0") {
    khoanmuc_thu_filter();
  }
  if (locloai == "1") {
    khoanmuc_chi_filter();
  }
  if (locloai == "") {
    load_khoanmuc_filter();
  }
}

function open_add_khoanmuc() {
  $("#makhoanmuc_add").css("border-bottom", "1px solid #ddd");
  $("#tenkhoanmuc_add").css("border-bottom", "1px solid #ddd");
  $("#loai_khoanmuc_add").css("border-bottom", "1px solid #ddd");
}

function add_khoanmuc(e) {
  const tenkhoanmuc = $("#tenkhoanmuc_add").val();
  const loai = $("#loai_khoanmuc_add option:selected").val();

  if (tenkhoanmuc == "") {
    $("#tenkhoanmuc_add").css("border-bottom", "1px solid red");
  }
  if (loai == "") {
    $("#loai_khoanmuc_add").css("border-bottom", "1px solid red");
  }
  if (tenkhoanmuc != "" && loai != "") {
    $.post(
      "ajax/thuchi/add_khoanmuc.php",
      { tenkhoanmuc: tenkhoanmuc, loai: loai },
      function (data) {
        $("#form_them_khoanmuc").modal("hide");
        load_khoanmuc();
        load_khoanmuc_filter();
      }
    );
  }
}
function load_khoanmuc_filter() {
  $("#khoanmuc_loc").html("");

  $.post("ajax/thuchi/load_khoanmuc_all.php", {}, function (data) {
    $("#khoanmuc_loc").append(`<option value=''>Tất cả khoản mục</option>`);
    for (let i = 0; i < data.length; i++) {
      $("#khoanmuc_loc").append(
        `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
      );
    }
    load_thuchi();
  });
}
function khoanmuc_thu_filter() {
  $("#khoanmuc_loc").html("");

  $("#khoanmuc_loc").append(`<option selected value=''>Tất cả thu</option>`);
  $.post("ajax/thuchi/load_khoanmuc.php", {}, function (data) {
    $("#khoanmuc_loc").append(`<option value="TBH">Thu bán hàng</option>`);
    for (let i = 0; i < data.length; i++) {
      if (data[i].dieukien2 == "THU") {
        $("#khoanmuc_loc").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
      }
    }
    load_thuchi();
  });
}
function khoanmuc_chi_filter() {
  $("#khoanmuc_loc").html("");

  $("#khoanmuc_loc").append(`<option selected value="">Tất cả chi</option>`);
  $.post("ajax/thuchi/load_khoanmuc.php", {}, function (data) {
    $("#khoanmuc_loc").append(`<option value="CMH">Chi mua hàng</option>`);
    for (let i = 0; i < data.length; i++) {
      if (data[i].dieukien2 == "CHI") {
        $("#khoanmuc_loc").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
      }
    }

    load_thuchi();
  });
}

function load_khoanmuc() {
  $("#khoangmucthu_add").html("");
  $("#khoangmucchi_add").html("");
  $("#khoanmuc_edit").html("");
  $(".__chitiet_khoanmuc").html("");
  $.post("ajax/thuchi/load_khoanmuc.php", {}, function (data) {
    $("#khoanmuc_edit").append(`<option value="">Chọn khoản mục</option>`);

    $("#khoangmucthu_add").append(
      `<option selected value="">Chọn khoản mục</option>`
    );
    $("#khoangmucchi_add").append(
      `<option selected value="">Chọn khoản mục</option>`
    );
    for (let i = 0; i < data.length; i++) {
      if (data[i].dieukien2 == "THU") {
        $("#khoangmucthu_add").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
        $("#khoanmuc_edit").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
      }
      if (data[i].dieukien2 == "CHI") {
        $("#khoangmucchi_add").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
        $("#khoanmucchi_edit").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
      }

      $(".__chitiet_khoanmuc").append(
        `
        <tr>
        <td>${data[i].tenloai}</td>
        <td class='dieukien2'>${data[i].dieukien2}</td>
        <td onclick='delete_khoanmuc(this)'><img src='vendor/img/xoa16.png'></td>
        </tr>
        `
      );
    }
  });
}
function delete_khoanmuc(e) {
  const msloai = $(e).parent().find(".msloai").text();
  const dieukien2 = $(e).parent().find(".dieukien2").text();
  $.post(
    "ajax/thuchi/delete_khoanmuc.php",
    { msloai: msloai, dieukien2: dieukien2 },
    function (data) {
      load_khoanmuc();
    }
  );
}
function add_nguoinop(e) {
  const manhanvien = $("#manguoinop_add").val();
  const tennhanvien = $("#tennguoinop_add").val();
  if (manhanvien == "") {
    $("#manguoinop_add").css("border-bottom", "1px solid red");
  }
  if (tennhanvien == "") {
    $("#tennguoinop_add").css("border-bottom", "1px solid red");
  }

  if (manhanvien != "" && tennhanvien != "") {
    $.post(
      "ajax/thuchi/add_nhanvien.php",
      { manhanvien: manhanvien, tennhanvien: tennhanvien },
      function (data) {
        $("#form_them_nhanvien").modal("hide");
        load_nhanvien();
      }
    );
  }
}
function delete_nhanvien(e) {
  const msdn = $(e).parent().find(".msdn").text();
  $.post("ajax/thuchi/delete_nhanvien.php", { msdn: msdn }, function (data) {
    load_nhanvien();
  });
}
function load_nhanvien() {
  $("#nguoinop_add").html("");
  $("#nguoinhan_add").html("");
  $("#nguoinop_edit").html("");
  $("#nguoinopchi_edit").html("");
  $(".__chitiet_nguoinop").html("");
  $.post("ajax/thuchi/load_nhanvien.php", {}, function (data) {
    $("#nguoinop_add").append(`<option value=''>Chọn người nộp</option>`);
    $("#nguoinhan_add").append(`<option value=''>Chọn người nhận</option>`);
    $("#nguoinop_edit").append(`<option value=''>Chọn người nộp</option>`);
    $("#nguoinopchi_edit").append(`<option value=''>Chọn người nhận</option>`);
    for (let i = 0; i < data.length; i++) {
      if (data[i].loai_user != 0 && data[i].loai_user != 2) {
        $("#nguoinop_add").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
        $("#nguoinhan_add").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
        $("#nguoinop_edit").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
        $("#nguoinopchi_edit").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
        $(".__chitiet_nguoinop").append(
          `<tr>
        <td class='msdn'>${data[i].msdn}</td>
        <td>${data[i].hoten}</td>
        <td onclick='delete_nhanvien(this)'><img src='vendor/img/xoa16.png'></td>
        </tr>`
        );
      }
    }
  });
}
function open_add_thu() {
  $("#ngaythu_err").css("color", "#90929f");
  $("#ngaythu_add").css("border-bottom", " 1px solid #ddd");
  $("#khoanmucthu_err").css("color", "#90929f");
  $("#khoangmucthu_add").css("border-bottom", " 1px solid #ddd");
  $("#sotienthu_err").css("color", "#90929f");
  $("#sotienthu_add").css("border-bottom", " 1px solid #ddd");
  $("#noidungthu_err").css("color", "#90929f");
  $("#noidungthu_add").css("border-bottom", " 1px solid #ddd");
  $("#nguoinop_err").css("color", "#90929f");
  $("#nguoinop_add").css("border-bottom", " 1px solid #ddd");
}
function open_add_chi() {
  $("#ngaychi_err").css("color", "#90929f");
  $("#ngaychi_add").css("border-bottom", " 1px solid #ddd");
  $("#khoanmucchi_err").css("color", "#90929f");
  $("#khoangmucchi_add").css("border-bottom", " 1px solid #ddd");
  $("#sotienchi_err").css("color", "#90929f");
  $("#sotienchi_add").css("border-bottom", " 1px solid #ddd");
  $("#noidungchi_err").css("color", "#90929f");
  $("#noidungchi_add").css("border-bottom", " 1px solid #ddd");
  $("#nguoinhan_err").css("color", "#90929f");
  $("#nguoinhan_add").css("border-bottom", " 1px solid #ddd");
}
function add_thu(e) {
  const ngaythu = $(e).parent().parent().find("#ngaythu_add").val();
  const khoanmucthu = $("#khoangmucthu_add option:selected").val();
  const sotienthu = $(e)
    .parent()
    .parent()
    .find("#sotienthu_add")
    .val()
    .replaceAll(".", "");
  const noidungthu = $(e).parent().parent().find("#noidungthu_add").val();
  const msnguoinop = $("#nguoinop_add option:selected").val();
  const nguoinop = $("#nguoinop_add option:selected").text();
  const nganquythu = $("#nganquythu_add option:selected").val();
  if (ngaythu == "undefined" || ngaythu == "") {
    $("#ngaythu_err").css("color", "red");
    $("#ngaythu_add").css("border-bottom", " 1px solid red");
  }
  if (khoanmucthu == "") {
    $("#khoanmucthu_err").css("color", "red");
    $("#khoangmucthu_add").css("border-bottom", " 1px solid red");
  }
  if (sotienthu == "") {
    $("#sotienthu_err").css("color", "red");
    $("#sotienthu_add").css("border-bottom", " 1px solid red");
  }
  if (noidungthu == "") {
    $("#noidungthu_err").css("color", "red");
    $("#noidungthu_add").css("border-bottom", " 1px solid red");
  }
  if (msnguoinop == "") {
    $("#nguoinop_err").css("color", "red");
    $("#nguoinop_add").css("border-bottom", " 1px solid red");
  }
  if (
    ngaythu != "undefined" &&
    ngaythu != "" &&
    khoanmucthu != "" &&
    sotienthu != "" &&
    noidungthu != "" &&
    msnguoinop != ""
  ) {
    $.post(
      "ajax/thuchi/add_thu.php",
      {
        ngaythu: ngaythu,
        khoanmucthu: khoanmucthu,
        sotienthu: sotienthu,
        noidungthu: noidungthu,
        msnguoinop: msnguoinop,
        nguoinop: nguoinop,
        nganquythu: nganquythu,
      },
      function (data) {
        load_thuchi();
        $("#sotienthu_add").val("");
        $("#noidungthu_add").val("");
        $("#form_add_thu").modal("hide");
      }
    );
  }
}
function add_chi(e) {
  const ngaythu = $(e).parent().parent().find("#ngaychi_add").val();
  const khoanmucthu = $("#khoangmucchi_add option:selected").val();
  const sotienthu = $(e)
    .parent()
    .parent()
    .find("#sotienchi_add")
    .val()
    .replaceAll(".", "");
  const noidungthu = $(e).parent().parent().find("#noidungchi_add").val();
  const msnguoinop = $("#nguoinhan_add option:selected").val();
  const nguoinop = $("#nguoinhan_add option:selected").text();
  const nganquythu = $("#nganquychi_add option:selected").val();
  if (ngaythu == "undefined" || ngaythu == "") {
    $("#ngaychi_err").css("color", "red");
    $("#ngaychi_add").css("border-bottom", " 1px solid red");
  }
  if (khoanmucthu == "") {
    $("#khoanmucchi_err").css("color", "red");
    $("#khoangmucchi_add").css("border-bottom", " 1px solid red");
  }
  if (sotienthu == "") {
    $("#sotienchi_err").css("color", "red");
    $("#sotienchi_add").css("border-bottom", " 1px solid red");
  }
  if (noidungthu == "") {
    $("#noidungchi_err").css("color", "red");
    $("#noidungchi_add").css("border-bottom", " 1px solid red");
  }
  if (msnguoinop == "") {
    $("#nguoinhan_err").css("color", "red");
    $("#nguoinhan_add").css("border-bottom", " 1px solid red");
  }
  if (
    ngaythu != "undefined" &&
    ngaythu != "" &&
    khoanmucthu != "" &&
    sotienthu != "" &&
    noidungthu != "" &&
    msnguoinop != ""
  ) {
    $.post(
      "ajax/thuchi/add_chi.php",
      {
        ngaythu: ngaythu,
        khoanmucthu: khoanmucthu,
        sotienthu: sotienthu,
        noidungthu: noidungthu,
        msnguoinop: msnguoinop,
        nguoinop: nguoinop,
        nganquythu: nganquythu,
      },
      function (data) {
        load_thuchi();
        $("#sotienchi_add").val("");
        $("#noidungchi_add").val("");
        $("#form_add_chi").modal("hide");
      }
    );
  }
}

function edit_thu(e) {
  const soct = $(e).parent().parent().find("#soct_edit").val();
  const ngaythu = $(e).parent().parent().find("#ngay_edit").val();
  const khoanmucthu = $("#khoanmuc_edit option:selected").val();
  const sotienthu = $(e)
    .parent()
    .parent()
    .find("#sotien_edit")
    .val()
    .replaceAll(".", "");
  const noidungthu = $(e).parent().parent().find("#noidung_edit").val();
  const msnguoinop = $("#nguoinop_edit option:selected").val();
  const nguoinop = $("#nguoinop_edit option:selected").text();
  const nganquythu = $(e).parent().parent().find("#nganquy_edit").val();
  $.post(
    "ajax/thuchi/edit_thuchi.php",
    {
      soct: soct,
      ngaythu: ngaythu,
      khoanmucthu: khoanmucthu,
      sotienthu: sotienthu,
      noidungthu: noidungthu,
      msnguoinop: msnguoinop,
      nguoinop: nguoinop,
      nganquythu: nganquythu,
    },
    function (data) {
      load_thuchi();
      $("#form_edit_thuchi").modal("hide");
    }
  );
}

function edit_chi(e) {
  const soct = $(e).parent().parent().find("#soctchi_edit").val();
  const ngaythu = $(e).parent().parent().find("#ngaychi_edit").val();
  const khoanmucthu = $("#khoanmucchi_edit option:selected").val();
  const sotienthu = $(e)
    .parent()
    .parent()
    .find("#sotienchi_edit")
    .val()
    .replaceAll(".", "");
  const noidungthu = $(e).parent().parent().find("#noidungchi_edit").val();
  const msnguoinop = $("#nguoinopchi_edit option:selected").val();
  const nguoinop = $("#nguoinopchi_edit option:selected").text();
  const nganquythu = $(e).parent().parent().find("#nganquychi_edit").val();
  $.post(
    "ajax/thuchi/edit_thuchi.php",
    {
      soct: soct,
      ngaythu: ngaythu,
      khoanmucthu: khoanmucthu,
      sotienthu: "-" + sotienthu,
      noidungthu: noidungthu,
      msnguoinop: msnguoinop,
      nguoinop: nguoinop,
      nganquythu: nganquythu,
    },
    function (data) {
      load_thuchi();
      $("#form_edit_thuchi").modal("hide");
    }
  );
}

function open_edit_thu(e) {
  $("#soct_edit").val($(e).parent().find(".soct_thuchi").text());
  $("#ngay_edit").val($(e).parent().find(".ngay_thuchi").text());
  $("#noidung_edit").val($(e).parent().find(".nd_thuchi").text());
  $("#sotien_edit").val($(e).parent().find(".sotien_thuchi").text());
  $("#khoanmuc_edit").val($(e).parent().find(".khoanmuc_thuchi").text());
  $("#nguoinop_edit").val($(e).parent().find(".msnguoinop_thuchi").text());
  $("#nganquy_edit").val($(e).parent().find(".nganquy_thuchi").text());
}
function open_edit_chi(e) {
  $("#soctchi_edit").val($(e).parent().find(".soct_thuchi").text());
  $("#ngaychi_edit").val($(e).parent().find(".ngay_thuchi").text());
  $("#noidungchi_edit").val($(e).parent().find(".nd_thuchi").text());
  $("#sotienchi_edit").val($(e).parent().find(".sotien_thuchi").text());
  $("#khoanmucchi_edit").val($(e).parent().find(".khoanmuc_thuchi").text());
  $("#nguoinopchi_edit").val($(e).parent().find(".msnguoinop_thuchi").text());
  $("#nganquychi_edit").val($(e).parent().find(".nganquy_thuchi").text());
}
function open_delete_thuchi(e) {
  $("#soct_delete").val($(e).parent().find(".soct_thuchi").text());
  $("#title_xoathuchi").text($(e).parent().find(".nd_thuchi").text());
  $("#loaithuchi_delete").val($(e).parent().find(".khoanmuc_thuchi").text());
  $("#sotienthuchi_delete").val($(e).parent().find(".sotien_thuchi").text());
  $("#soct_dh_thuchi_delete").val(
    $(e).parent().find(".soct_donhang_thuchi").text()
  );
}
function delete_thuchi(e) {
  const soct = $("#soct_delete").val();
  const loaithuchi = $("#loaithuchi_delete").val();
  const sotien = $("#sotienthuchi_delete").val().replaceAll(".", "");
  const soct_donhang = $("#soct_dh_thuchi_delete").val();
  $.post(
    "ajax/thuchi/delete_thuchi.php",
    {
      soct: soct,
      loaithuchi: loaithuchi,
      sotien: sotien,
      soct_donhang: soct_donhang,
    },
    function (data) {
      $("#form_delete_thuchi").modal("hide");
      load_thuchi();
    }
  );
}
