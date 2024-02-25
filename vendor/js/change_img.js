function load_img_banner() {
  $.post("ajax/change_image/load_img.php", {}, function (data) {
    $(".__chitiet_banner_header").html(data);
  });
}

function load_hinhanh_phu(e, t) {
  $(".item_banner").removeClass("active");
  $(t).addClass("active");
  $.post("ajax/change_image/load_img_line.php", { vitri: e }, function (data) {
    $(".__chitiet_banner_line").html(data);
  });
}
function open_change_image(e, vitri, ten, pdf) {
  $("#vitri_banner").val(vitri);
  $("#ten_banner").val(ten);
  $("#ten_pdf").val(pdf);
  $("#form_change_banner").modal("show");
  $("#vitri_header").val($(e).parent().find(".vitri_header").text());
}

function change_banner(e) {
  var form_data = new FormData();
  var vitri = $(e).parent().find("#vitri_banner").val();
  var vitri_header = $("#vitri_header").val();
  const ten_banner = $(e).parent().find("#ten_banner").val();
  const ten_pdf = $(e).parent().find("#ten_pdf").val();
  const path_file = $("#link_img_change")[0].files[0];
  const path_file_pdf = $("#link_pdf_change")[0].files[0];
  form_data.append("file", path_file);
  form_data.append("file_pdf", path_file_pdf);
  form_data.append("vitri", vitri);
  form_data.append("ten_banner", ten_banner);
  form_data.append("ten_pdf", ten_pdf);
  form_data.append("vitri_header", vitri_header);
  $.ajax({
    type: "POST",
    data: form_data,
    url: "ajax/change_image/change_banner.php",
    contentType: false,
    processData: false,
    headers: {
      "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      console.log(vitri_header);
      function load_hinhanh_phu() {
        $(".item_banner").removeClass("active");
        $.post(
          "ajax/change_image/load_img_line.php",
          { vitri: vitri_header },
          function (data) {
            $(".__chitiet_banner_line").html(data);
            $("#link_img_change").val("");
            $("#img_banner_change")[0].src = "";
            $("#img_pdf_change")[0].src = "";
          }
        );
      }
      load_hinhanh_phu();
      $("#form_change_banner").modal("hide");
    },
    error: function (data) {
      console.log(data);
    },
  });
}
function delete_pdf(vitri_line, pdf, vitri_header) {
  $.post(
    "ajax/change_image/delete_pdf.php",
    { vitri_line: vitri_line, pdf: pdf, vitri_header: vitri_header },
    function (data) {
      load_hinhanh_phu(vitri_header);
    }
  );
}
