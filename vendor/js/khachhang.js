//! Hàm change number
function _ChangeFormat(e) {
  var soluong = $(e).val().replace(/[.]/g, "");
  soluong = $(e)
    .val()
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $(e).val(soluong);
}
khachhang_search = () => {
  var input, filter, table, tr, td, i, j;
  input = document.getElementById("tenkhachhang_search");
  filter = input.value
    .toUpperCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/[đĐ]/g, (m) => (m === "đ" ? "d" : "D"));
  table = document.getElementById("khachhang_table_header");
  tr = table.getElementsByClassName("khachhang_tr");
  for (i = 0; i < tr.length; i++) {
    tr[i].style.display = "none";
    td = tr[i].getElementsByClassName("search_key");
    for (var j = 0; j < td.length; j++) {
      cell = tr[i].getElementsByClassName("search_key")[j];
      cell_html = cell.innerHTML
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[đĐ]/g, (m) => (m === "đ" ? "d" : "D"));
      if (cell_html) {
        if (cell_html.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        }
      }
    }
  }
};
khachhang_filter = () => {
  $(".chitiet_khachhang_tbody").html("");
  var tungay = $(".khachhang_tungay").val(),
    denngay = $(".khachhang_denngay").val(),
    trangthai = $("#trangthai_khachhang_loc option:selected").val(),
    msdn = $("#msdn_khachhang_loc option:selected").val();
  $.post(
    "ajax/khachhang/khachhang_filter.php",
    {
      tungay: tungay,
      denngay: denngay,
      trangthai: trangthai,
      msdn: msdn,
    },
    function (data, textStatus, jqXHR) {
      $(".khachhang_tbody").html(data);
    }
  );
};

khachhang_add = () => {
  var tenkh = $("#tenkh_add").val(),
    dienthoai = $("#dienthoai_add").val(),
    diachi = $("#diachi_add").val(),
    ngay = $("#ngay_add").val(),
    maxa = $("#active_xa option:selected").val(),
    trangthai = $("#trangthai_khachhang_add option:selected").val(),
    lydo = $("#lydo_khachhang_add option:selected").val();
  if (tenkh == "" || dienthoai == "" || diachi == "" || maxa == "") {
    document.getElementById("check_input_add").innerHTML =
      "<div class='alert alert-danger' role='alert'>Vui lòng nhập đầy đủ thông tin</div>";
  } else {
    $.post(
      "ajax/khachhang/khachhang_add.php",
      {
        tenkh: tenkh,
        dienthoai: dienthoai,
        diachi: diachi,
        ngay: ngay,
        maxa: maxa,
        trangthai: trangthai,
        lydo: lydo,
      },
      function (data, textStatus, jqXHR) {
        $("#tenkh_add, #dienthoai_add, #diachi_add").val("");
        $("#trangthai_khachhang_add").prop("selectedIndex", 0);
        $("#lydo_khachhang_add").prop("selectedIndex", 0);
        khachhang_filter();
        $("#form_add").modal("hide");
      }
    );
  }
};
open_khachhang_edit = (e) => {
  $("#mskh_edit").val($(e).parent().find(".mskh_td").text());
  $("#tenkh_edit").val($(e).parent().find(".tenkh_td").text());
  $("#dienthoai_edit").val($(e).parent().find(".dienthoai_td").text());
  $("#diachi_edit").val($(e).parent().find(".diachi_td").text());
  var diachi = $(e).parent().find(".msxa_td").text();
  $.post(
    "ajax/khachhang/load_diachi_edit.php",
    {
      diachi: diachi,
    },
    function (data, textStatus, jqXHR) {
      $("#active_tinh_edit").val(data[0].matinh);
      Load_Huyen_edit(data[0].mahuyen);
      Load_Xa_edit(data[0].maxa);
    }
  );
  $("#ngay_edit").val($(e).parent().find(".ngay_td").text());
  $("#trangthai_khachhang_edit").val(
    $(e).parent().find(".trangthai_td").text()
  );
  $("#lydo_khachhang_edit").val($(e).parent().find(".lydo_td").text());
};
khachhang_edit = () => {
  var mskh = $("#mskh_edit").val(),
    tenkh = $("#tenkh_edit").val(),
    dienthoai = $("#dienthoai_edit").val(),
    diachi = $("#diachi_edit").val(),
    ngay = $("#ngay_edit").val(),
    maxa = $("#active_xa_edit").val(),
    trangthai = $("#trangthai_khachhang_edit option:selected").val(),
    lydo = $("#lydo_khachhang_edit option:selected").val();
  if (tenkh == "" || dienthoai == "" || diachi == "") {
    document.getElementById("check_input_edit").innerHTML =
      "<div class='alert alert-danger' role='alert'>Vui lòng nhập đầy đủ thông tin</div>";
  } else {
    $.post(
      "ajax/khachhang/khachhang_edit.php",
      {
        mskh: mskh,
        tenkh: tenkh,
        dienthoai: dienthoai,
        diachi: diachi,
        ngay: ngay,
        maxa: maxa,
        trangthai: trangthai,
        lydo: lydo,
      },
      function (data, textStatus, jqXHR) {
        khachhang_filter();
        $("#form_edit").modal("hide");
      }
    );
  }
};
open_khachhang_delete = (e) => {
  $("#mskh_delete").val($(e).parent().find(".mskh_td").text());
  document.getElementById("khachhang_delete").innerHTML = $(e)
    .parent()
    .find(".tenkh_td")
    .text();
};
khachhang_delete = () => {
  var mskh = $("#mskh_delete").val();
  $.post(
    "ajax/khachhang/khachhang_delete.php",
    {
      mskh: mskh,
    },
    function (data, textStatus, jqXHR) {
      khachhang_filter();
      $("#form_delete").modal("hide");
    }
  );
};

//! Chi tiết khách hàng
chitiet_khachhang_load = (mskh, tenkh, e) => {
  $(".khachhang_tr").removeClass("active_items");

  try {
    e.classList.add("active_items");
  } catch (error) {}
  $("#ctkh_mskh").val(mskh);
  $("#ctkh_tenkh").val(tenkh);
  $("#tendv").val(tenkh);
  $.post(
    "ajax/khachhang/chitiet_khachhang_load.php",
    {
      mskh: mskh,
    },
    function (data, textStatus, jqXHR) {
      $(".chitiet_khachhang_tbody").html(data);
      $("#mskh_form").val(mskh);
      $("#tendaidien").val("");
      $("#dtdaidien").val($(e).find(".dienthoai_td").text());
      $("#diachi").val($(e).find(".diachi_td").text());
      $("#msxa").val($(e).find(".msxa_td").text());
      $("#dtcongtacvien").val("");
      $("#ngaykichhoat").val($(e).find(".ngay_td").text());
      $("#btn_add_chitiet").removeClass("hidden");
    }
  );
};
khachhang_chitiet_add = () => {
  var ngay = $("#ctkh_ngay_add").val(),
    mskh = $("#ctkh_mskh").val(),
    tenkh = $("#ctkh_tenkh").val(),
    ghichu = $("#ctkh_note_add").val(),
    linktailieu = $("#ctkh_link_add").val(),
    yeucau = $("#ctkh_yeucau_add").val(),
    tungay = $("#ctkh_tungay_add").val(),
    thangkm = $("#ctkh_thangkm_add").val(),
    denngay = $("#ctkh_denngay_add").val(),
    gia = $("#ctkh_gia_add").val().replace(/[.]/g, ""),
    loaiphanmem = $("#loaiphanmem_ctkh_add option:selected").val(),
    trangthai = $("#trangthai_ctkh_add option:selected").val(),
    loaihopdong = "",
    loai_hopdong_new = document.getElementById("new");
  if (loai_hopdong_new.checked) {
    loaihopdong = "NEW";
  } else {
    loaihopdong = "RENEW";
  }
  if (gia == 0 || trangthai == "" || mskh == "") {
    document.getElementById("check_input_add_ct").innerHTML =
      "<div class='alert alert-danger' role='alert'>Vui lòng chọn khách hàng và nhập đầy đủ thông tin</div>";
  } else {
    $.post(
      "ajax/khachhang/chitiet_khachhang_add.php",
      {
        ngay: ngay,
        mskh: mskh,
        tenkh: tenkh,
        ghichu: ghichu,
        linktailieu: linktailieu,
        yeucau: yeucau,
        gia: gia,
        tungay: tungay,
        thangkm: thangkm,
        denngay: denngay,
        loaiphanmem: loaiphanmem,
        loaihopdong: loaihopdong,
        trangthai: trangthai,
      },
      function (data, textStatus, jqXHR) {
        $("#ctkh_note_add, #ctkh_yeucau_add").val("");
        $("#trangthai_ctkh_add").prop("selectedIndex", 0);
        chitiet_khachhang_load(mskh, tenkh);
        $("#form_chitiet_add").modal("hide");
      }
    );
  }
};
open_ctkh_edit = (e) => {
  $("#ctkh_mskh_edit").val($(e).parent().find(".ctkh_mskh_td").text());
  $("#ctkh_msct_edit").val($(e).parent().find(".ctkh_msct_td").text());
  $("#ctkh_ngay_edit").val($(e).parent().find(".ctkh_ngay_td").text());
  $("#ctkh_note_edit").val($(e).parent().find(".ctkh_note_td").text());
  $("#ctkh_yeucau_edit").val($(e).parent().find(".ctkh_yeucau_td").text());
  $("#trangthai_ctkh_edit").val(
    $(e).parent().find(".ctkh_trangthai_td").text()
  );
  $("#ctkh_gia_edit").val($(e).parent().find(".ctkh_gia_td").text());
  $("#ctkh_link_edit").val($(e).parent().find(".ctkh_link_td").text());
  document.getElementById("ctkh_tungay_edit").value = $(e)
    .parent()
    .find(".ctkh_tungay_td")
    .text();
  $("#ctkh_thangkm_edit").val($(e).parent().find(".ctkh_sothangkm_td").text());
  document.getElementById("ctkh_denngay_edit").value = $(e)
    .parent()
    .find(".ctkh_denngay_td")
    .text();
  $("#loaiphanmem_ctkh_edit").val(
    $(e).parent().find(".ctkh_loaiphanmem_td").text()
  );
  const loaihopdong = $(e).parent().find(".ctkh_loaihopdong_td").text();
  if (loaihopdong === "NEW") {
    document.querySelector("#loai_hopdong_edit #renew_edit").checked = false;
    document.querySelector("#loai_hopdong_edit #new_edit").checked = true;
  } else {
    document.querySelector("#loai_hopdong_edit #new_edit").checked = false;
    document.querySelector("#loai_hopdong_edit #renew_edit").checked = true;
  }
};
khachhang_chitiet_edit = () => {
  var mskh = $("#ctkh_mskh_edit").val(),
    msct = $("#ctkh_msct_edit").val(),
    ngay = $("#ctkh_ngay_edit").val(),
    note = $("#ctkh_note_edit").val(),
    linktailieu = $("#ctkh_link_edit").val(),
    yeucau = $("#ctkh_yeucau_edit").val(),
    tungay = $("#ctkh_tungay_edit").val(),
    thangkm = $("#ctkh_thangkm_edit").val(),
    denngay = $("#ctkh_denngay_edit").val(),
    newedit = document.querySelector("#loai_hopdong_edit #new_edit"),
    loaihopdong = "",
    gia = $("#ctkh_gia_edit").val().replace(/[.]/g, ""),
    loaiphanmem = $("#loaiphanmem_ctkh_edit option:selected").val(),
    trangthai = $("#trangthai_ctkh_edit option:selected").val();
  if (newedit.checked) {
    loaihopdong = "NEW";
  } else {
    loaihopdong = "RENEW";
  }
  if (gia == 0 || trangthai == "") {
    document.getElementById("check_input_edit_ct").innerHTML =
      "<div class='alert alert-danger' role='alert'>Vui lòng nhập đầy đủ thông tin</div>";
  } else {
    $.post(
      "ajax/khachhang/chitiet_khachhang_edit.php",
      {
        mskh: mskh,
        msct: msct,
        ngay: ngay,
        note: note,
        yeucau: yeucau,
        linktailieu: linktailieu,
        gia: gia,
        tungay: tungay,
        thangkm: thangkm,
        denngay: denngay,
        loaihopdong: loaihopdong,
        loaiphanmem: loaiphanmem,
        trangthai: trangthai,
      },
      function (data, textStatus, jqXHR) {
        chitiet_khachhang_load(mskh);
        $("#form_chitiet_edit").modal("hide");
      }
    );
  }
};
open_ctkh_delete = (e) => {
  $("#ctkh_mskh_delete").val($(e).parent().find(".ctkh_mskh_td").text());
  $("#ctkh_msct_delete").val($(e).parent().find(".ctkh_msct_td").text());
  document.getElementById("ctkh_stt_td").innerHTML = $(e)
    .parent()
    .find(".ctkh_stt_td")
    .text();
};

ctkh_delete = () => {
  var mskh = $("#ctkh_mskh_delete").val(),
    msct = $("#ctkh_msct_delete").val();
  $.post(
    "ajax/khachhang/chitiet_khachhang_delete.php",
    {
      mskh: mskh,
      msct: msct,
    },
    function (data, textStatus, jqXHR) {
      chitiet_khachhang_load(mskh);
      $("#form_chitiet_delete").modal("hide");
    }
  );
};
function Load_Huyen_edit(e) {
  var matinh = $("#active_tinh_edit option:selected").val();
  if (e == "" || e == undefined) {
    matinh = matinh;
  } else {
    matinh = "";
  }
  $.post(
    "ajax/khachhang/load_huyen_edit.php",
    {
      matinh: matinh,
      mahuyen: e,
    },
    function (data, textStatus, jqXHR) {
      $("#active_huyen_edit").html(data);
    }
  );
}
function Load_Xa_edit(e) {
  var mahuyen = $("#active_huyen_edit option:selected").val();
  if (e == "" || e == undefined) {
    mahuyen = mahuyen;
  } else {
    mahuyen = "";
  }
  $.post(
    "ajax/khachhang/load_xa_edit.php",
    {
      mahuyen: mahuyen,
      maxa: e,
    },
    function (data, textStatus, jqXHR) {
      $("#active_xa_edit").html(data);
    }
  );
}
function Load_Huyen() {
  var matinh = $("#active_tinh").val();
  $.post(
    "ajax/khachhang/load_huyen.php",
    {
      matinh: matinh,
    },
    function (data, textStatus, jqXHR) {
      $("#active_huyen").html(data);
    }
  );
}
function Load_Xa() {
  var mahuyen = $("#active_huyen").val();
  $.post(
    "ajax/khachhang/load_xa.php",
    {
      mahuyen: mahuyen,
    },
    function (data, textStatus, jqXHR) {
      $("#active_xa").html(data);
    }
  );
}
// Hiển thị danh sách ảnh sản sản phẩm
function load_hinhanh(e) {
  var mskh = $("#mskh_form").val();
  $.post(
    "ajax/khachhang/hinhanh/load_hinhanh.php",
    { mskh: mskh },
    function (data, textStatus, jqXHR) {
      $("#img_kh").html(data);
    }
  );
}

//Add ảnh mô tả
function add_hinhanh() {
  const mskh = $("#mskh_form").val();
  var form_data = new FormData();
  var hinhanh = document.getElementById("file_img").files;
  for (let i = 0; i < hinhanh.length; i++) {
    form_data.append("file", hinhanh[i]);
    form_data.append("mskh", mskh);
    $.ajax({
      type: "POST",
      data: form_data,
      url: "ajax/khachhang/hinhanh/add_hinhanh.php",
      contentType: false,
      processData: false,
      headers: { "X-CSRF-Token": $("meta[name='csrf-token']").attr("content") },
      success: function (data) {
        $("#file_img").val("");
        // $("#img_url").attr("src", "");
        $("#error_img").html(data);
        load_hinhanh();
      },
      error: function (data) {
        console.log(data);
      },
    });
  }
}

//Delete ảnh mô tả
function delete_hinhanh(e) {
  var url_img = $(e).parent().find(".__img").data("img"),
    mskh = $("#mskh_form").val();
  $.post(
    "ajax/khachhang/hinhanh/delete_hinhanh.php",
    { url_img: url_img, mskh: mskh },
    function (data, textStatus, jqXHR) {
      load_hinhanh();
    }
  );
}

open_form_chot = (e) => {
  $("#tendv_form").val($("#tendv").val());
  $("#dtdaidien_form").val($("#dtdaidien").val());
  $("#tendaidien_form").val($("#tendaidien").val());
  $("#diachi_form").val($("#diachi").val());
  $("#msxa_form").val($("#msxa").val());
  $("#dtcongtacvien_form").val($("#dtcongtacvien").val());
  $("#ngaykichhoat_form").val($("#ngaykichhoat").val());
};
function chot_khachhang() {
  $("#thongbao_form").html("");
  var tendv = $("#tendv_form").val(),
    dtdaidien = $("#dtdaidien_form").val(),
    tendaidien = $("#tendaidien_form").val(),
    diachi = $("#diachi_form").val(),
    msxa = $("#msxa_form").val(),
    dtcongtacvien = $("#dtcongtacvien_form").val(),
    ngaykichhoat = $("#ngaykichhoat_form").val(),
    mskh = $("#mskh_form").val();
  $.post(
    "ajax/khachhang/chot_khachhang.php",
    {
      tendv: tendv,
      dtdaidien: dtdaidien,
      tendaidien: tendaidien,
      diachi: diachi,
      msxa: msxa,
      dtcongtacvien: dtcongtacvien,
      ngaykichhoat: ngaykichhoat,
    },
    function (data, textStatus, jqXHR) {
      if (data == "404") {
        document.getElementById("thongbao_form").style.color = "red";
        $("#thongbao_form").html("Tài khoản khách hàng đã tồn tại");
        document.getElementById("__btn_success").style.display = "none";
      } else {
        $.post(
          "ajax/khachhang/update_mskh.php",
          { mskh: mskh, mskh_new: data },
          function (data, textStatus, jqXHR) {
            khachhang_filter();
            document.getElementById("thongbao_form").style.color = "green";
            document.getElementById("__btn_success").style.display = "none";
            $("#thongbao_form").html(
              "Xác nhận tài khoản khách hàng thành công"
            );
          }
        );
      }
    }
  );
}
function put_thangkm_edit() {
  var date = $("#ctkh_tungay_edit").val().split("/").reverse().join("-");
  var datedenngay = $("#ctkh_denngay_edit")
    .val()
    .split("/")
    .reverse()
    .join("-");
  var sothangkm = $("#ctkh_thangkm_edit").val();
  var denngay = new Date(datedenngay);
  denngay.setMonth(denngay.getMonth() + Number(sothangkm));
  var day = denngay.getDate();
  var month = denngay.getMonth() + 1;
  var year = denngay.getFullYear();
  if (sothangkm == 0) {
    var tungay = new Date(date);
    tungay.setMonth(tungay.getMonth() + 12);
    var day = tungay.getDate();
    var month = tungay.getMonth() + 1;
    var year = tungay.getFullYear();
    document.getElementById("ctkh_denngay_edit").value =
      day + "/" + month + "/" + year;
  } else {
    document.getElementById("ctkh_denngay_edit").value =
      day + "/" + month + "/" + year;
  }
}
function put_thangkm_add() {
  var date = $("#ctkh_tungay_add").val().split("/").reverse().join("-");
  var datedenngay = $("#ctkh_denngay_add").val().split("/").reverse().join("-");
  var sothangkm = $("#ctkh_thangkm_add").val();
  var denngay = new Date(datedenngay);
  denngay.setMonth(denngay.getMonth() + Number(sothangkm));
  var day = denngay.getDate();
  var month = denngay.getMonth() + 1;
  var year = denngay.getFullYear();
  if (sothangkm == 0) {
    var tungay = new Date(date);
    tungay.setMonth(tungay.getMonth() + 12);
    var day = tungay.getDate();
    var month = tungay.getMonth() + 1;
    var year = tungay.getFullYear();
    document.getElementById("ctkh_denngay_add").value =
      day + "/" + month + "/" + year;
  } else {
    document.getElementById("ctkh_denngay_add").value =
      day + "/" + month + "/" + year;
  }
}
