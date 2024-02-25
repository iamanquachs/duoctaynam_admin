//! format số tiền và chặn nhập chữ
function _ChangeFormat(e) {
  var soluong = $(e).val().replace(/[.]/g, "");
  soluong = $(e)
    .val()
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  $(e).val(soluong.replace(/[^0-9\.\,]/g, ""));
}

//Lọc items
function item_fillter() {
  var msnhom = $("#filter_nhom option:selected").val();
  var msncc = $("#filter_ncc option:selected").val();
  var tieuchuan = $("#filter_tieuchuan option:selected").val();
  var msnsx = $("#filter_nsx option:selected").val();
  var loaihh = $("#filter_loaihh option:selected").val();
  var trangthai = $("#filter_trangthai option:selected").val();
  var group_sp = $("#filter_nhomnoibat option:selected").val();
  $.post(
    "ajax/items/items_filter.php",
    {
      msnhom: msnhom,
      msncc: msncc,
      tieuchuan: tieuchuan,
      msnsx: msnsx,
      loaihh: loaihh,
      trangthai: trangthai,
      group_sp: group_sp,
    },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
    }
  );
}
//Lọc items Trạng thái
function item_fillter_trangthai() {
  var trangthai = $("#filter_trangthai option:selected").val();
  $.post(
    "ajax/items/items_filter_trangthai.php",
    {
      trangthai: trangthai,
    },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
    }
  );
}
function item_search() {
  const value = $("#hanghoa_search").val();
  $.post(
    "ajax/items/items_search.php",
    {
      value: value,
    },
    function (data, textStatus, jqXHR) {
      $(".donhang_tbody").html(data);
    }
  );
}
function open_modal_xacnhan(e) {
  const tensp = $(e).parent().find(".tenhh_td").text();
  const mshh = $(e).parent().find(".mshh_td").text();
  var trangthai = $(e).parent().find(".trangthai_edit").text();
  document.getElementById("tensp").innerText = "Kích hoạt sản phẩm " + tensp;
  document.getElementById("trangthai_kichhoat").value = trangthai;
  document.getElementById("mshh_kichhoat").value = mshh;
  $("#chonkichhoat").val(trangthai);
}
function handleEditTrangThai() {
  const trangthai = $("#chonkichhoat option:selected").val();
  const mshh = $("#mshh_kichhoat").val();
  $.post(
    "ajax/items/items_edit_trangthai.php",
    { mshh: mshh, trangthai: trangthai },
    function (data, textStatus, jqXHR) {
      item_fillter();
      $("#form_xacnhan").modal("hide");
    }
  );
}
function handleLoad_dvtNhoNhat() {
  const mshh = location.search.slice(1);
  $.post(
    "ajax/items/items_load_dvt_edit.php",
    { mshh: mshh },
    function (data, textStatus, jqXHR) {
      $("#dvtnhonhat_edit").val(data[0].dvt);
    }
  );
}
function item_load_edit() {
  const mshh = location.search.slice(1);
  const link = "./upload/sanpham/";
  const link_child = "./upload/anhmota/";
  $.post(
    "ajax/items/items_load_edit.php",
    { mshh: mshh },
    function (data, textStatus, jqXHR) {
      $("#nuocsx_edit").val(data[0].country);
      $("#tieuchuan_edit").val(data[0].standard);
      $("#nhasx_edit").val(data[0].producer);
      $("#nhomhh_edit").val(data[0].groupproduct);
      $("#dvtmin_edit").val(data[0].dvtmin);
      $("#bantheodon_edit").val(data[0].bantheodon);
      $("#loaihh_edit").val(data[0].loaihh);
      $("#trangthaihh_edit").val(data[0].trangthai);
      $("#all_img_mota").val(data[0].path_image_child);
      $("#nhomweb_edit").val(data[0].group_sp);
      $("#img_sanpham_edit").attr(
        "src",
        link + data[0].path_image + "?r=" + data[0].lastmodify
      );
      const path_image_child = data[0].path_image_child.split("|");
      if (path_image_child.length > 1) {
        $("#img_sanphammota_edit1").attr("src", "");
        $("#img_sanphammota_edit2").attr("src", "");
        $("#img_sanphammota_edit3").attr("src", "");
        $("#img_sanphammota_edit4").attr("src", "");
        $("#form_add_img1").css("display", "none");
        $("#form_add_img2").css("display", "none");
        $("#form_add_img3").css("display", "none");
        $("#form_add_img4").css("display", "none");
        $("#path_child1").val("");
        $("#path_child2").val("");
        $("#path_child3").val("");
        $("#path_child4").val("");

        for (let i = 0; i < path_image_child.length; i++) {
          console.log(path_image_child[i]);
          if (path_image_child[i] != "") {
            $("#img_sanphammota_edit" + (i + 1)).attr(
              "src",
              link_child + path_image_child[i] + "?r=" + data[0].lastmodify
            );
            $("#path_child" + (i + 1)).val(path_image_child[i]);
          } else {
            $("#form_add_img" + (i + 1)).css("display", "none");
          }
          $("#form_add_img" + (i + 1)).css("display", "block");
        }
      } else {
        $("#img_sanphammota_edit1").attr("src", "");
        $("#form_add_img2").css("display", "none");
      }
    }
  );
}
function tao_mshh() {
  const d = new Date();
  const ngay =
    d.getDay().toString() +
    Math.floor(Math.random() * 10).toString() +
    (d.getMonth() + 1).toString() +
    d.getFullYear().toString();
  const mshh =
    "ID" +
    ngay +
    Math.floor(Math.random() * 10).toString() +
    Math.floor(Math.random() * 10).toString() +
    Math.floor(Math.random() * 10).toString() +
    Math.floor(Math.random() * 10).toString();
  $("#mshh_add").val(mshh);
}
function item_add() {
  var form_data = new FormData();
  var path_img = $("#anhsanpham_add")[0].files[0];
  const path_img_mota1 = $("#anhsanphammota1_add")[0].files;
  const path_img_mota2 = $("#anhsanphammota2_add")[0].files;
  const path_img_mota3 = $("#anhsanphammota3_add")[0].files;
  const path_img_mota4 = $("#anhsanphammota4_add")[0].files;
  if (path_img_mota1.length > 1) {
    for (let i = 0; i < path_img_mota1.length; i++) {
      form_data.append("filemota" + (i + 1), path_img_mota1[i]);
    }
  } else {
    form_data.append("filemota1", path_img_mota1[0]);
  }
  if (path_img_mota2.length > 1) {
    for (let i = 0; i < path_img_mota2.length; i++) {
      form_data.append("filemota" + (i + 2), path_img_mota2[i]);
    }
  } else {
    form_data.append("filemota2", path_img_mota2[0]);
  }
  if (path_img_mota3.length > 1) {
    for (let i = 0; i < path_img_mota3.length; i++) {
      form_data.append("filemota" + (i + 3), path_img_mota3[i]);
    }
  } else {
    form_data.append("filemota3", path_img_mota3[0]);
  }
  if (path_img_mota4.length > 1) {
    for (let i = 0; i < path_img_mota4.length; i++) {
      form_data.append("filemota" + (i + 4), path_img_mota4[i]);
    }
  } else {
    form_data.append("filemota4", path_img_mota4[0]);
  }
  var msncc = $("#msncc_add").val(),
    msncchh = $("#msncchh_add").val(),
    msnpp = $("#msnpp_add").val(),
    mshhnpp = $("#mshhnpp_add").val(),
    mshh = $("#mshh_add").val(),
    tenhh = $("#tenhh_add").val(),
    tenhc = CKEDITOR.instances["tenhc_add"].getData(),
    tenbd = $("#tenbd_add").val(),
    hamluong = $("#hamluong_add").val(),
    thuesuat = $("#thuesuat_add").val(),
    tonkhotoithieu = $("#tonkhotoithieu_add").val();
  if (
    msnpp == "" ||
    mshhnpp == "" ||
    tenhh == "" ||
    tenhc == "" ||
    tenbd == "" ||
    hamluong == "" ||
    thuesuat == "" ||
    tonkhotoithieu == ""
  ) {
    if (msncc == "") {
      $("#msncc_err").addClass("_err");
    }
    if (msncchh == "") {
      $("#msncchh_err").addClass("_err");
    }
    if (msnpp == "") {
      $("#msnpp_err").addClass("_err");
    }
    if (mshhnpp == "") {
      $("#mshhnpp_err").addClass("_err");
    }
    if (mshh == "") {
      $("#mshh_err").addClass("_err");
    }
    if (tenhh == "") {
      $("#tenhh_err").addClass("_err");
    }
    if (tenhc == "") {
      $("#tenhc_err").addClass("_err");
    }
    if (tenbd == "") {
      $("#tenbd_err").addClass("_err");
    }
    if (hamluong == "") {
      $("#hamluong_err").addClass("_err");
    }
    if (thuesuat == "") {
      $("#thuesuat_err").addClass("_err");
    }
    if (tonkhotoithieu == "") {
      $("#tonkhotoithieu_err").addClass("_err");
    }
    $("#warn_hanghoa_form").modal("show");
  } else {
    form_data.append("file", path_img);
    form_data.append("nhasx", $("#nhasx option:selected").val());
    form_data.append("nuocsx", $("#nuocsx option:selected").val());
    form_data.append("tieuchuan", $("#tieuchuan_add option:selected").val());
    form_data.append("msnhom", $("#nhomhh_add option:selected").val());
    form_data.append("dvt", $("#dvtmin_add option:selected").text());
    form_data.append("msncc", $("#msncc_add").val());
    form_data.append("msncchh", $("#msncchh_add").val());
    form_data.append("msnpp", $("#msnpp_add").val());
    form_data.append("mshhnpp", $("#mshhnpp_add").val());
    form_data.append("mshh", $("#mshh_add").val());
    form_data.append("tenhh", $("#tenhh_add").val());
    form_data.append("tenhc", CKEDITOR.instances["tenhc_add"].getData());
    form_data.append("ghichu", CKEDITOR.instances["ghichu_add"].getData());
    form_data.append("tenbd", $("#tenbd_add").val());
    form_data.append("hamluong", $("#hamluong_add").val());
    form_data.append("thuesuat", $("#thuesuat_add").val());
    form_data.append("tonkhotoithieu", $("#tonkhotoithieu_add").val());
    form_data.append("loaihh", $("#loaihh_add option:selected").val());
    form_data.append("bantheodon", $("#bantheodon_add option:selected").val());
    form_data.append(
      "trangthaihh",
      $("#trangthaihh_add option:selected").val()
    );
    form_data.append("nhomnoibat", $("#nhomweb_add option:selected").val());
    $.ajax({
      type: "POST",
      data: form_data,
      url: "ajax/items/item_add.php",
      contentType: false,
      processData: false,
      headers: {
        "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
      },
      success: function (data) {
        add_mota();
        tao_mshh();
        $("#anhsanpham_add").val("");
        $("#nhomweb_add").val(0);
        $("#anhsanphammota_add").val("");
        $("#tenhh_add").val("");
        $("#msnpp_add").val("");
        $("#mshhnpp_add").val("");
        $("#tenhc_add").val("");
        $("#ghichu_add").val("");
        $("#tenbd_add").val("");
        $("#hamluong_add").val("");
        $("#thuesuat_add").val("");
        $("#tonkhotoithieu_add").val("");
        $("#success_hanghoa_form").modal("show");
        setTimeout(function return_nhapkho() {
          location.href = "https://erp.duoctaynam.vn/items";
        }, 1000);
      },
      error: function (data) {
        console.log(data);
      },
    });
  }
}
// Get MSHH
function item_get_mshh(e) {
  $(".donhanglist_tr").removeClass("active_items");
  var mshh = $(e).find(".mshh_td").text();
  var rowid = $(e).find(".rowid_td").text();
  $(e).addClass("active_items");
}
function item_edit_img_chinh() {
  var form_data = new FormData();
  const mshh = location.search.slice(1);
  var path_img = $("#anhsanpham_edit")[0].files[0];
  form_data.append("path_image", path_img);
  form_data.append("mshh", mshh);
  $.ajax({
    type: "POST",
    data: form_data,
    url: "ajax/items/items_edit_img_chinh.php",
    contentType: false,
    processData: false,
    headers: {
      "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      item_fillter();
    },
    error: function (data) {
      console.log(data);
    },
  });
}
function item_edit_img_phu(e, vitri) {
  var form_data = new FormData();
  const mshh = location.search.slice(1);
  var path_img_child = $(e)[0].files;
  for (let i = 0; i < path_img_child.length; i++) {
    const path = $("#path_child" + (i + vitri)).val();
    form_data.append("path_image_child", path_img_child[i]);
    form_data.append("mshh", mshh);
    form_data.append("path_old", path);
    $.ajax({
      type: "POST",
      data: form_data,
      url: "ajax/items/items_edit_img_phu.php",
      contentType: false,
      processData: false,
      headers: {
        "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
      },
      success: function (data) {
        item_load_edit();
        $("#form_add_img" + (i + vitri)).css("display", "block");
      },
      error: function (data) {
        console.log(data);
      },
    });
  }
}
function item_edit() {
  var form_data = new FormData();
  var nhaxsx = $("#nhasx_edit option:selected").val(),
    nuocsx = $("#nuocsx_edit option:selected").val(),
    tieuchuan = $("#tieuchuan_edit option:selected").val(),
    msnhom = $("#nhomhh_edit option:selected").val(),
    dvt = $("#dvtmin_edit option:selected").val(),
    msncc = $("#msncc_edit").val(),
    msncchh = $("#msncchh_edit").val(),
    msnpp = $("#msnpp_edit").val(),
    mshhnpp = $("#mshhnpp_edit").val(),
    mshh = $("#mshh_edit").val(),
    tenhh = $("#tenhh_edit").val(),
    tenhc = CKEDITOR.instances["tenhc_edit"].getData(),
    ghichu = CKEDITOR.instances["ghichu_edit"].getData(),
    tenbd = $("#tenbd_edit").val(),
    hamluong = $("#hamluong_edit").val(),
    thuesuat = $("#thuesuat_edit").val(),
    tonkhotoithieu = $("#tonkhotoithieu_edit").val(),
    loaihh = $("#loaihh_edit option:selected").val(),
    bantheodon = $("#bantheodon_edit option:selected").val(),
    trangthaihh = $("#trangthaihh_edit option:selected").val();
  if (
    msnpp == "" ||
    mshhnpp == "" ||
    tenhh == "" ||
    tenhc == "" ||
    tenbd == "" ||
    hamluong == "" ||
    thuesuat == "" ||
    tonkhotoithieu == "" ||
    loaihh == ""
  ) {
    if (msncc == "") {
      $("#msncc_err").addClass("_err");
    }
    if (msncchh == "") {
      $("#msncchh_err").addClass("_err");
    }
    if (msnpp == "") {
      $("#msnpp_err").addClass("_err");
    }
    if (mshhnpp == "") {
      $("#mshhnpp_err").addClass("_err");
    }
    if (mshh == "") {
      $("#mshh_err").addClass("_err");
    }
    if (tenhh == "") {
      $("#tenhh_err").addClass("_err");
    }
    if (tenhc == "") {
      $("#tenhc_err").addClass("_err");
    }
    if (tenbd == "") {
      $("#tenbd_err").addClass("_err");
    }
    if (hamluong == "") {
      $("#hamluong_err").addClass("_err");
    }
    if (thuesuat == "") {
      $("#thuesuat_err").addClass("_err");
    }
    if (tonkhotoithieu == "") {
      $("#tonkhotoithieu_err").addClass("_err");
    }
    if (loaihh == "") {
      $("#loaihh_err").addClass("_err");
    }

    $("#warn_hanghoa_form").modal("show");
  } else {
    form_data.append("nhasx", nhaxsx);
    form_data.append("nuocsx", nuocsx);
    form_data.append("tieuchuan", tieuchuan);
    form_data.append("msnhom", msnhom);
    form_data.append("msncc", msncc);
    form_data.append("msncchh", msncchh);
    form_data.append("msnpp", msnpp);
    form_data.append("mshhnpp", mshhnpp);
    form_data.append("mshh", mshh);
    form_data.append("dvt", dvt);
    form_data.append("tenhh", tenhh);
    form_data.append("tenhc", tenhc);
    form_data.append("ghichu", ghichu);
    form_data.append("tenbd", tenbd);
    form_data.append("hamluong", hamluong);
    form_data.append("thuesuat", thuesuat);
    form_data.append("tonkhotoithieu", tonkhotoithieu);
    form_data.append("loaihh", loaihh);
    form_data.append("bantheodon", bantheodon);
    form_data.append("trangthaihh", trangthaihh);
    form_data.append("nhomnoibat", $("#nhomweb_edit option:selected").val());
    edit_mota();
    $.ajax({
      type: "POST",
      data: form_data,
      url: "ajax/items/items_edit.php",
      contentType: false,
      processData: false,
      headers: {
        "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
      },
      success: function (data) {
        setTimeout(function return_nhapkho() {
          location.href = "https://erp.duoctaynam.vn/items";
        }, 1000);
      },
      error: function (data) {
        console.log(data);
      },
    });
  }
}
function delete_img_mota(e, key) {
  const mshh = location.search.slice(1);
  const all_img = $("#all_img_mota").val();
  const id_img = $(e)
    .parent()
    .find("#img_sanphammota_edit" + key)
    .attr("src")
    .split("/")[3];
  $.post(
    "ajax/items/items_edit_delete_img_mota.php",
    { id_img: id_img, mshh: mshh, all_img: all_img },
    function (data, textStatus, jqXHR) {
      item_load_edit();
    }
  );
}

function load_quycach(e) {
  const dvtmin = $("#dvtmin_add option:selected").text();
  const dvtmax = $("#dvtmax_add option:selected").text();
  const dvtnhonhat = $("#dvtnhonhat_add option:selected").text();
  const slquydoiminmax = $("#slquydoi_add").val();
  const slquydoinhonhat = $("#qdnhonhat_min_add").val().replaceAll(".", "");
  const slquydoi = slquydoinhonhat
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  const quycach =
    dvtmin +
    " " +
    slquydoi +
    " " +
    dvtnhonhat +
    " | " +
    dvtmax +
    " " +
    slquydoiminmax +
    " " +
    dvtmin;
  $("#quycach_add").val(quycach);
  $("#slquydoimin_err_add").html("Số lượng" + " " + dvtnhonhat + "/" + dvtmin);
  $("#slquydoimax_err_add").html("Số lượng" + " " + dvtnhonhat + "/" + dvtmax);
  $("#slquydoi_err_add").html("SL quy đổi" + " " + dvtmin + "/" + dvtmax);
  _ChangeFormat(e);
}

function load_quycach_edit(e) {
  const dvtmin = $("#dvtmin_edit option:selected").text();
  const dvtmax = $("#dvtmax_edit option:selected").text();
  const dvtnhonhat = $("#dvtnhonhat_edit option:selected").text();
  const slquydoiminmax = $("#slquydoi_edit").val();
  const qdnhonhat = $("#qdnhonhat_min_edit").val().replaceAll(".", "");
  const slquydoi = qdnhonhat
    .replace(/[.]/g, "")
    .toString()
    .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
  const quycach =
    dvtmin +
    " " +
    slquydoi +
    " " +
    dvtnhonhat +
    " | " +
    dvtmax +
    " " +
    slquydoiminmax +
    " " +
    dvtmin;
  $("#quycach_edit").val(quycach);

  $("#slquydoimin_err").html("Số lượng" + " " + dvtnhonhat + "/" + dvtmin);
  $("#slquydoimax_err").html("Số lượng" + " " + dvtnhonhat + "/" + dvtmax);
  $("#slquydoi_err").html("SL quy đổi" + " " + dvtmin + "/" + dvtmax);
  _ChangeFormat(e);
}

function add_mota() {
  var form_data = new FormData();
  const mshh = $("#mshh_add").val();
  form_data.append("mshh", mshh);
  form_data.append("chidinh", CKEDITOR.instances["chidinh_add"].getData());
  form_data.append(
    "chongchidinh",
    CKEDITOR.instances["chongchidinh_add"].getData()
  );
  form_data.append("lieudung", CKEDITOR.instances["lieudung_add"].getData());
  form_data.append(
    "tacdungphu",
    CKEDITOR.instances["tacdungphu_add"].getData()
  );
  form_data.append("thantrong", CKEDITOR.instances["thantrong_add"].getData());
  form_data.append(
    "tuongtacthuoc",
    CKEDITOR.instances["tuongtacthuoc_add"].getData()
  );
  form_data.append("baoquan", CKEDITOR.instances["baoquan_add"].getData());
  $.ajax({
    type: "POST",
    data: form_data,
    url: "ajax/items/mota/add_mota.php",
    contentType: false,
    processData: false,
    headers: {
      "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      $("#chidinh_add").val("");
      $("#chongchidinh_add").val("");
      $("#lieudung_add").val("");
      $("#tacdungphu_add").val("");
      $("#thantrong_add").val("");
      $("#tuongtacthuoc_add").val("");
      $("#baoquan_add").val("");
    },
    error: function (data) {
      console.log(data);
    },
  });
}
function load_mota_edit() {
  const mshh = location.search.slice(1);
  $.post(
    "ajax/items/mota/load_mota_edit.php",
    { mshh: mshh },
    function (data, textStatus, jqXHR) {
      $("#chidinh_edit").text(data[0].chidinh);
      $("#chongchidinh_edit").text(data[0].chongchidinh);
      $("#lieudung_edit").text(data[0].lieudung);
      $("#tacdungphu_edit").text(data[0].tacdungphu);
      $("#thantrong_edit").text(data[0].thantrong);
      $("#tuongtacthuoc_edit").text(data[0].tuongtacthuoc);
      $("#baoquan_edit").text(data[0].baoquan);
    }
  );
}
function edit_mota() {
  var form_data = new FormData();
  const mshh = location.search.slice(1);
  form_data.append("mshh", mshh);
  form_data.append("chidinh", CKEDITOR.instances["chidinh_edit"].getData());
  form_data.append(
    "chongchidinh",
    CKEDITOR.instances["chongchidinh_edit"].getData()
  );
  form_data.append("lieudung", CKEDITOR.instances["lieudung_edit"].getData());
  form_data.append(
    "tacdungphu",
    CKEDITOR.instances["tacdungphu_edit"].getData()
  );
  form_data.append("thantrong", CKEDITOR.instances["thantrong_edit"].getData());
  form_data.append(
    "tuongtacthuoc",
    CKEDITOR.instances["tuongtacthuoc_edit"].getData()
  );
  form_data.append("baoquan", CKEDITOR.instances["baoquan_edit"].getData());
  $.ajax({
    type: "POST",
    data: form_data,
    url: "ajax/items/mota/edit_mota.php",
    contentType: false,
    processData: false,
    headers: {
      "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      $("#chidinh_edit").val("");
      $("#chongchidinh_edit").val("");
      $("#lieudung_edit").val("");
      $("#tacdungphu_edit").val("");
      $("#thantrong_edit").val("");
      $("#tuongtacthuoc_edit").val("");
      $("#baoquan_edit").val("");
    },
    error: function (data) {
      console.log(data);
    },
  });
}
function add_phanloai(e, loai) {
  var phanloai = "";
  const msloai = $(e).parent().parent().find(".msloai_add").val();
  const tenloai = $(e).parent().parent().find(".tenloai_add").val();
  if (loai == "nhasx") {
    phanloai = "producer";
  }
  if (loai == "nuocsx") {
    phanloai = "country";
  }
  if (loai == "tieuchuan") {
    phanloai = "standard";
  }
  if (loai == "nhom") {
    phanloai = "groupproduct";
  }
  if (loai == "loai") {
    phanloai = "loaihh";
  }
  if (loai == "dvt") {
    phanloai = "dvt";
  }
  $.post(
    "ajax/items/add_phanloai.php",
    { phanloai: phanloai, msloai: msloai, tenloai: tenloai },
    function (data, textStatus, jqXHR) {
      console.log(data);
      if (data != "err") {
        console.log("davao");
        if (loai == "nhasx") {
          load_nhasx();
          $("#add_nhasx_form").modal("hide");
        }
        if (loai == "nuocsx") {
          load_nuocsx();
          $("#add_nuocsx_form").modal("hide");
        }
        if (loai == "tieuchuan") {
          load_tieuchuan();
          $("#add_tieuchuan_form").modal("hide");
        }
        if (loai == "nhom") {
          load_nhom();
          $("#add_nhomhh_form").modal("hide");
        }
        if (loai == "loai") {
          load_loai();
          $("#add_loaihh_form").modal("hide");
        }
        if (loai == "dvt") {
          load_dvt();
          $("#add_dvt_form").modal("hide");
        }
      } else {
        $("#form_msloai_trung").modal("show");
      }
    }
  );
}

function load_nhasx() {
  $("#nhasx").html("");
  $("#nhasx_table_header").html("");
  $.post(
    "ajax/items/items_load_nhasx.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#nhasx").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nhasx_edit").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nhasx_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>producer</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}
function delete_dmphanloai(e) {
  const msloai = $(e).parent().find(".msnhasx_delete").text();
  const phanloai = $(e).parent().find(".loai_delete").text();
  $.post(
    "ajax/items/xulyphanloai/delete_phanloai.php",
    { msloai: msloai, phanloai: phanloai },
    function (data, textStatus, jqXHR) {
      if (phanloai == "producer") {
        $("#nhasx_table_header").html("");
        $("#nhasx").html("");
        load_nhasx();
      }
      if (phanloai == "country") {
        $("#nuocsx_table_header").html("");
        load_nuocsx();
      }
      if (phanloai == "standard") {
        $("#tieuchuan_table_header").html("");
        load_tieuchuan();
      }
      if (phanloai == "groupproduct") {
        $("#nhomhh_table_header").html("");
        load_nhom();
      }
      if (phanloai == "loaihh") {
        $("#loaihh_table_header").html("");
        load_loai();
      }
      if (phanloai == "dvt") {
        $("#dvt_table_header").html("");
        load_dvt();
      }
    }
  );
}
function load_nuocsx() {
  $("#nuocsx").html("");
  $("#nuocsx_table_header").html("");
  $.post(
    "ajax/items/items_load_nuocsx.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#nuocsx").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nuocsx_edit").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nuocsx_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>country</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}
function load_tieuchuan() {
  $("#tieuchuan_add").html("");
  $("#tieuchuan_table_header").html("");
  $.post(
    "ajax/items/items_load_tieuchuan.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#tieuchuan_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#tieuchuan_edit").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#tieuchuan_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>standard</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}
function load_nhom() {
  $("#nhomhh_add").html("");
  $("#nhomhh_table_header").html("");
  $.post(
    "ajax/items/items_load_nhom.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#nhomhh_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nhomhh_edit").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#nhomhh_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>groupproduct</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}
function load_loai() {
  $("#loaihh_add").html("");
  $("#loaihh_table_header").html("");
  $.post(
    "ajax/items/items_load_loai.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#loaihh_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#loaihh_edit").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#loaihh_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>loaihh</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}
function load_dvt() {
  $("#dvtmin_add").html("");
  $("#dvtmax_add").html("");
  $("#dvtnhonhat_add").html("");
  $("#dvt_table_header").html("");
  $.post(
    "ajax/items/items_load_donvitinh.php",
    {},
    function (data, textStatus, jqXHR) {
      for (let i = 0; i < data.length; i++) {
        $("#dvtmin_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvtmax_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvtnhonhat_add").append(
          `<option value="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvtmin_edit").append(
          `<option value="${data[i].tenloai}" data-dvt="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvtmax_edit").append(
          `<option value="${data[i].tenloai}" data-dvt="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvtnhonhat_edit").append(
          `<option value="${data[i].tenloai}" data-dvt="${data[i].msloai}">${data[i].tenloai}</option>`
        );
        $("#dvt_table_header").append(`
        <tr>
        <td hidden class='msnhasx_delete'>${data[i].msloai}</td>
        <td hidden class='loai_delete'>dvt</td>
        <td>${data[i].tenloai}</td>
        <td onclick='delete_dmphanloai(this)'><img src="./vendor/img/xoa16.png"></td>
    </tr>
        `);
      }
    }
  );
}

function tracuu_giaban(e) {
  let tenhh = "";
  if (e == "add") {
    tenhh = $("#tenhh_add").val();
  } else {
    tenhh = $("#tenhh_edit").val();
  }
  var myHeaders = new Headers();
  myHeaders.append(
    "Authorization",
    "bearer eyJ0eXAi.iJKV1QiLCJhbGci.iJIUzI1NiJ9OeyJtc2R2IjoiMjIwMjIwMTA1NDA2MzciLCJtc2RuIjoiMDkwNzY3.DIzNCIsInRlbmR2IjoiTkhcdTAwYzAgVEhVXHUxZWQwQyBBTiBUXHUwMGMyTSIsImV4cGlyZWQi.jE3MDk2NTE1MDB9OaIWRy7MMe9EF_QpAar-_qFA.SStlFm4NriftyIcNkzU"
  );
  myHeaders.append("Content-Type", "application/json");
  myHeaders.append("Cookie", "PHPSESSID=7cb2896b0f58e4659a30e6ab5b6e66e0");

  var raw = JSON.stringify({
    tenhh: tenhh,
  });

  var requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("https://egpp.vn/api_tmdt/tracuu_gianhap", requestOptions)
    .then((response) => response.text())
    .then((result) => {
      const data = JSON.parse(result);
      if (data != "") {
        $("#form_tracuu_giaban").modal("show");
        for (let i = 0; i < 300; i++) {
          $(".table_tracuu_giaban").append(`
          <tr>
          <td>${i + 1}</td>
          <td hidden >${data[i].mshh}</td>
          <td style='text-align:start'>${data[i].tenhh}</td>
          <td style='text-align:start'>${data[i].dvt}</td>
          <td style='text-align:end'>${data[i].gianhapcothue
            .toString()
            .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")}</td>
          <td style='text-align:start'>${data[i].tenncc}</td>
          </tr>
          `);
        }
      }
    })
    .catch((error) => console.log("error", error));
}

function load_hosogiaban() {
  const mshh = $("#mshh_add").val();
  $.post(
    "ajax/items/load_hosogiaban.php",
    { mshh: mshh },
    function (data, textStatus, jqXHR) {
      $(".table_hoso_giaban").html(data);
    }
  );
}

function set_sl_caonhat() {
  const sl_caonhat = $("#sl_caonhat_hsgb").is(":checked");
  if (sl_caonhat == true) {
    $("#sl_banden_hsgb").val("9999");
  } else {
    $("#sl_banden_hsgb").val("");
  }
}

function open_add_hosogiaban() {
  $("#form_add_hosogiaban").modal("show");
}
function add_hosogiaban() {
  const sl_caonhat = $("#sl_caonhat_hsgb").is(":checked");
  const mshh = $("#mshh_add").val();
  const dvt_ban = $("#dvt_ban_hsgb option:selected").text();
  const sl_bantu = $("#sl_bantu_hsgb").val().replaceAll(".", "");
  const sl_banden = $("#sl_banden_hsgb").val().replaceAll(".", "");
  const giabanvat = $("#giaban_hsgb").val().replaceAll(".", "");
  const sl_quydoi = $("#sl_quydoi_hsgb").val().replaceAll(".", "");
  const dvt_egpp = $("#dvt_egpp_hsgb option:selected").text();

  $.post(
    "ajax/items/add_hosogiaban.php",
    {
      mshh: mshh,
      dvt_ban: dvt_ban,
      sl_bantu: sl_bantu,
      sl_banden: sl_banden,
      giabanvat: giabanvat,
      sl_quydoi: sl_quydoi,
      dvt_egpp: dvt_egpp,
      sl_caonhat: sl_caonhat,
    },
    function (data, textStatus, jqXHR) {
      load_hosogiaban();
      $("#sl_bantu_hsgb").val("");
      $("#sl_banden_hsgb").val("");
      $("#giaban_hsgb").val("");
      $("#form_add_hosogiaban").modal("hide");
      if (data == "dacomax") {
        $("#form_dacomax_hosohanghoa").modal("show");
      }
    }
  );
}

function open_edit_hosogiaban(
  rowid,
  dvt_ban,
  sl_bantu,
  sl_banden,
  giabanvat,
  dvt_egpp,
  sl_quydoi,
  khoa,
  max
) {
  $("#rowid_edit_hsgb").val(rowid);
  $("#dvt_ban_hsgb_edit").val(dvt_ban);
  $("#sl_bantu_hsgb_edit").val(sl_bantu);
  $("#sl_banden_hsgb_edit").val(sl_banden);
  $("#giaban_hsgb_edit").val(
    giabanvat.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
  $("#sl_quydoi_hsgb_edit").val(sl_quydoi);
  $("#dvt_egpp_hsgb_edit").val(dvt_egpp);
  $("#khoa_hsgb_edit").val(khoa);
  if (max == "1") {
    document.getElementById("sl_caonhat_hsgb_edit").checked = true;
  } else {
    document.getElementById("sl_caonhat_hsgb_edit").checked = false;
  }
  $("#form_edit_hosogiaban").modal("show");
}

function edit_hosogiaban() {
  const rowid = $("#rowid_edit_hsgb").val();
  const mshh = $("#mshh_add").val();
  const sl_caonhat = $("#sl_caonhat_hsgb_edit").is(":checked");
  const dvt_ban = $("#dvt_ban_hsgb_edit option:selected").val();
  const sl_bantu = $("#sl_bantu_hsgb_edit").val().replaceAll(".", "");
  const sl_banden = $("#sl_banden_hsgb_edit").val().replaceAll(".", "");
  const giabanvat = $("#giaban_hsgb_edit").val().replaceAll(".", "");
  const sl_quydoi = $("#sl_quydoi_hsgb_edit").val().replaceAll(".", "");
  const dvt_egpp = $("#dvt_egpp_hsgb_edit option:selected").val();
  const khoa = $("#khoa_hsgb_edit option:selected").val();
  $.post(
    "ajax/items/edit_hosogiaban.php",
    {
      rowid: rowid,
      mshh: mshh,
      sl_caonhat: sl_caonhat,
      dvt_ban: dvt_ban,
      sl_bantu: sl_bantu,
      sl_banden: sl_banden,
      giabanvat: giabanvat,
      sl_quydoi: sl_quydoi,
      dvt_egpp: dvt_egpp,
      khoa: khoa,
    },
    function (data, textStatus, jqXHR) {
      load_hosogiaban();
      $("#form_edit_hosogiaban").modal("hide");
      if (data == "dacomax") {
        $("#form_dacomax_hosohanghoa").modal("show");
      }
    }
  );
}

function open_delete_hosogiaban(rowid, stt, mshh) {
  $("#title_delete_hsgb").html(stt);
  $("#id_hosogiaban").val(rowid);
  $("#mshh_hosogiaban").val(mshh);
  $("#delete_hosohanghoa").modal("show");
}
function delete_hosogiaban(e) {
  let rowid = $("#id_hosogiaban").val();
  let mshh = $("#mshh_hosogiaban").val();
  $.post(
    "ajax/items/delete_hosogiaban.php",
    {
      rowid,
      mshh,
    },
    function (data, textStatus, jqXHR) {
      load_hosogiaban();
      $("#form_delete_hosogiaban").modal("hide");
    }
  );
}
