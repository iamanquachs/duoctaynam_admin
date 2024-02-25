function load_yeucau() {
  $.post("ajax/yeucau/load_yeucau.php", {}, function (data) {
    $(".__chitiet_yeucau").html(data);
  });
}
function open_edit_yeucau(e) {
  $("#msdn_yeucau_edit").val($(e).parent().find(".msdn_yeucau").text());
  $("#msdv_yeucau_edit").val($(e).parent().find(".msdv_yeucau").text());
  $("#rowid_yeucau_edit").val($(e).parent().find(".rowid_yeucau").text());
}
function open_delete_yeucau(e) {
  $("#msdn_yeucau_delete").val($(e).parent().find(".msdn_yeucau").text());
  $("#msdv_yeucau_delete").val($(e).parent().find(".msdv_yeucau").text());
  $("#rowid_yeucau_delete").val($(e).parent().find(".rowid_yeucau").text());
}

function edit_yeucau(e) {
  const msdn_yeucau = $("#msdn_yeucau_edit").val();
  const msdv_yeucau = $("#msdv_yeucau_edit").val();
  const rowid_yeucau = $("#rowid_yeucau_edit").val();
  const link_yeucau = $("#link_sanpham").val();
  $.post(
    "ajax/yeucau/edit_yeucau.php",
    {
      msdn: msdn_yeucau,
      msdv: msdv_yeucau,
      rowid: rowid_yeucau,
      link: link_yeucau,
    },
    function (data) {
      $("#form_edit_yeucau").modal("hide");
      load_yeucau();
    }
  );
}
function delete_yeucau(e) {
  const msdn_yeucau = $("#msdn_yeucau_delete").val();
  const msdv_yeucau = $("#msdv_yeucau_delete").val();
  const rowid_yeucau = $("#rowid_yeucau_delete").val();
  $.post(
    "ajax/yeucau/delete_yeucau.php",
    {
      msdn: msdn_yeucau,
      msdv: msdv_yeucau,
      rowid: rowid_yeucau,
    },
    function (data) {
      $("#form_delete_yeucau").modal("hide");
      load_yeucau();
    }
  );
}
