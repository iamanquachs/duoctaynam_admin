function load_work() {
  const nd_timkiem = $("#_search").val();
  const ngaykt = $("#_search_ngaykt").val();
  const nhom = $("#nhom_loc option:selected").val();
  const nhanvien = $("#nhanvien_loc option:selected").val();
  const trangthai = $("#trangthai_loc option:selected").val();
  $.post(
    "ajax/work/load_work.php",
    {
      nd_timkiem: nd_timkiem,
      ngaykt: ngaykt,
      nhom: nhom,
      nhanvien: nhanvien,
      trangthai: trangthai,
    },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_congviec").html(data);
    }
  );
}
function add_nhomcv(e) {
  const tencongviec = $("#tencongviec_add").val();

  if (tencongviec == "") {
    $("#tennguoinop_add").css("border-bottom", "1px solid red");
  }

  if (tencongviec != "") {
    $.post(
      "ajax/work/add_dmcongviec.php",
      { tencongviec: tencongviec },
      function (data) {
        load_nhomcv();
        $("#tencongviec_add").val("");
      }
    );
  }
}
function delete_nhomcv(e) {
  $.post("ajax/work/delete_dmcongviec.php", { mscongviec: e }, function (data) {
    load_nhomcv();
  });
}
function load_nhomcv() {
  $("#nhom_loc").html("");
  $("#nhom_edit").html("");
  $("#nhom_add").html("");
  $(".__chitiet_dscongviec").html("");

  $.post("ajax/work/load_nhomcv.php", {}, function (data, textStatus, jqXHR) {
    $("#nhom_loc").append(`<option value=''>Nhóm</option>`);
    $("#nhom_edit").append(`<option value='CPL'>Chưa phân loai</option>`);
    $("#nhom_add").append(`<option value='CPL'>Chưa phân loai</option>`);
    for (let i = 0; i < data.length; i++) {
      $("#nhom_loc").append(
        `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
      );
      if (data[i].msloai != "CPL") {
        $("#nhom_edit").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
        $("#nhom_add").append(
          `<option value='${data[i].msloai}'>${data[i].tenloai}</option>`
        );
      }
      $(".__chitiet_dscongviec").append(`
        <tr>
          <td>${data[i].tenloai}</td>
          <td onclick='delete_nhomcv(${data[i].msloai})'><img src='vendor/img/xoa16.png'></td>
        </tr>
        `);
    }
  });
}
function add_nhanvien(e) {
  const manhanvien = $("#manhanvien_add").val();
  const tennhanvien = $("#tennhanvien_add").val();
  if (manhanvien == "") {
    $("#manhanvien_add").css("border-bottom", "1px solid red");
  }
  if (tennhanvien == "") {
    $("#tennhanvien_add").css("border-bottom", "1px solid red");
  }

  if (manhanvien != "" && tennhanvien != "") {
    $.post(
      "ajax/work/add_nhanvien.php",
      { manhanvien: manhanvien, tennhanvien: tennhanvien },
      function (data) {
        load_nhanvien();
        $("#manhanvien_add").val("");
        $("#tennhanvien_add").val("");
      }
    );
  }
}
function delete_nhanvien(e) {
  $.post(
    "ajax/work/delete_nhanvien.php",
    { msdn: e.toString() },
    function (data) {
      load_nhanvien();
    }
  );
}
function load_nhanvien() {
  $("#nhanvien_loc").html("");
  $("#nhanvien_edit").html("");
  $("#nhanvien_add").html("");
  $(".__chitiet_nhanvien").html("");
  $.post("ajax/work/load_nhanvien.php", {}, function (data, textStatus, jqXHR) {
    $("#nhanvien_loc").append(`<option value=''>Nhân viên</option>`);
    $("#nhanvien_edit").append(`<option value='CPL'>Chưa phân loai</option>`);
    $("#nhanvien_add").append(`<option value='CPL'>Chưa phân loai</option>`);

    for (let i = 0; i < data.length; i++) {
      $("#nhanvien_loc").append(
        `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
      );
      if (data[i].msdn != "CPL") {
        $("#nhanvien_edit").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
        $("#nhanvien_add").append(
          `<option value='${data[i].msdn}'>${data[i].hoten}</option>`
        );
      }
      $(".__chitiet_nhanvien").append(`
    <tr>
    <td>${data[i].msdn}</td>
    <td>${data[i].hoten}</td>
    <td onclick='delete_nhanvien("${data[i].msdn}")'><img src='vendor/img/xoa16.png'></td>
    </tr>
    `);
    }
  });
}
function open_form_edit(e) {
  $("#nhom_edit").val($(e).parent().find(".td_msnhom").text());
  $("#mscongviec_edit").val($(e).parent().find(".td_mscongviec").text());
  $("#trangthai_edit").val($(e).parent().find(".td_mstrangthai").text());
  $("#nhanvien_edit").val($(e).parent().find(".td_msnhanvien").text());
  $("#tenkh_edit").val($(e).parent().find(".td_tenkh").text());
  $("#nd_edit").html($(e).parent().find(".td_ndcongviec").text());
  $("#dienthoai_edit").val($(e).parent().find(".td_dienthoai").text());
  $("#ngaybd_edit").val($(e).parent().find(".td_ngaybatdau").text());
  $("#ngaykt_edit").val($(e).parent().find(".td_ngayketthuc").text());
  $("#ghichu_edit").val($(e).parent().find(".td_ghichu").text());
}
function open_form_add() {
  $("#tenkh_add_err").css("color", "#9b9da9");
  $("#tenkh_add").css("border-bottom", " 1px #9b9da9 solid");
  $("#nd_add_err").css("color", "#9b9da9");
  $("#add_add").css("border-bottom", " 1px #9b9da9 solid");
  $("#dienthoai_add_err").css("color", "#9b9da9");
  $("#dienthoai_add").css("border-bottom", " 1px #9b9da9 solid");
}
function add_congviec() {
  var tenkhachhang = $("#tenkh_add").val(),
    ndcongviec = $("#nd_add").val(),
    dienthoai = $("#dienthoai_add").val(),
    ngaybatdau = $("#ngaybd_add").val(),
    ngayketthuc = $("#ngaykt_add").val(),
    ghichu = $("#ghichu_add").val(),
    msnhanvien = $("#nhanvien_add").val(),
    mstrangthai = $("#trangthai_add").val(),
    msnhom = $("#nhom_add").val();
  if (msnhanvien == "") {
    $("#nhanvien_add").css("border-bottom", "1px solid red");
  }
  if (msnhom == "") {
    $("#nhom_add").css("border-bottom", "1px solid red");
  }
  if (msnhanvien != "" && msnhom != "") {
    $.post(
      "ajax/work/add_congviec.php",
      {
        tenkhachhang: tenkhachhang,
        ndcongviec: ndcongviec,
        dienthoai: dienthoai,
        ngaybatdau: ngaybatdau,
        ngayketthuc: ngayketthuc,
        ghichu: ghichu,
        msnhanvien: msnhanvien,
        mstrangthai: mstrangthai,
        msnhom: msnhom,
      },
      function (data, textStatus, jqXHR) {
        load_work();
        $("#form_add_congviec").modal("hide");
        $("#tenkh_add").val("");
        $("#nd_add").val("");
        $("#dienthoai_add").val("");
        $("#ngaybd_add").val("");
        $("#ngaykt_add").val("");
        $("#ghichu_add").val("");
        $("#nhanvien_add").val("");
        $("#nhom_add").val("");
      }
    );
  }
}
function edit_congviec() {
  var tenkh = $("#tenkh_edit").val(),
    noidung = $("#nd_edit").val(),
    dienthoai = $("#dienthoai_edit").val(),
    ngaybd = $("#ngaybd_edit").val(),
    ngaykt = $("#ngaykt_edit").val(),
    ghichu = $("#ghichu_edit").val(),
    nhanvien = $("#nhanvien_edit").val(),
    trangthai = $("#trangthai_edit").val(),
    nhom = $("#nhom_edit").val(),
    mscongviec = $("#mscongviec_edit").val();
  $.post(
    "ajax/work/edit_congviec.php",
    {
      tenkh: tenkh,
      noidung: noidung,
      dienthoai: dienthoai,
      ngaybd: ngaybd,
      ngaykt: ngaykt,
      ghichu: ghichu,
      nhanvien: nhanvien,
      trangthai: trangthai,
      nhom: nhom,
      mscongviec: mscongviec,
    },
    function (data, textStatus, jqXHR) {
      load_work();
      $("#form_edit_congviec").modal("hide");
    }
  );
}
