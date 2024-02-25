function logout() {
  $.post("ajax/admin/logout.php", {}, function (t) {
    location.replace("index.html");
  });
}
function login() {
  var msdn = $("#msdn").val(),
    matkhau = $("#matkhau").val();
  if (msdn == "" || matkhau == "") {
    alert("Thông tin không được bỏ trống");
  } else {
    $.post(
      "ajax/admin/login.php",
      {
        msdn: msdn,
        matkhau: matkhau,
      },
      function () {
        location.replace("index.html");
      }
    );
  }
}
function select_navitem() {
  console.log(123);
  $(".nav_item").removeClass("active");
  $(".nav_item").addClass("active");
}
function loai_loaiUser() {
  $.post("ajax/admin/loaiuser.php", {}, function (data) {
    $("#loaiuser_dangnhap").val(data[0].loai_user);
    document.cookie = "loaiuser=" + data[0].loai_user + ";path=/";
  });
}
