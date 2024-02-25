function load_theothang() {
  const date = $("#get_month").val().split("-");
  const thang = date[1] != 10 ? date[1].split("0")[1] : date[1];
  const nam = date[0];
  load_doanhthu(thang, nam);
  load_loinhuan(thang, nam);
  load_donhang(thang, nam);
  load_khachhangmoi(thang, nam);
  load_donhangchuanhan(thang, nam);
  load_congnophaithu(thang, nam);
  load_congnophaitra(thang, nam);
  load_hanghoabanchay(thang, nam);
  load_hanghoaloinhuancao(thang, nam);
  load_doanhthutheokhachhang(thang, nam);
  load_loinhuantheokhachhang(thang, nam);
  load_tuoinokhachhang(thang, nam);
}
function load_doanhthu(thang, nam) {
  $.post(
    "ajax/home/load_doanhthu.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#tongxuatkho").html(
        (data[0].tongxuatkho ? data[0].tongxuatkho : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#tongdoanhthu").html(
        (data[0].tongdoanhthu ? data[0].tongdoanhthu : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#phantram").html(
        "(" + (data[0].phantram ? data[0].phantram : 0) + "%)"
      );
    }
  );
}
function load_loinhuan(thang, nam) {
  $.post(
    "ajax/home/load_loinhuan.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#tongtienxuatkho").html(
        (data[0].tongtienxuatkho ? data[0].tongtienxuatkho : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#loinhuan").html(
        (data[0].loinhuan ? data[0].loinhuan : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#phantram_loinhuan").html(
        "(" + (data[0].phantram ? data[0].phantram : 0) + "%)"
      );
    }
  );
}
function load_donhangchuanhan(thang, nam) {
  $.post(
    "ajax/home/load_donhangchuanhan.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#donhangchuanhan").html(
        data[0].donhangchuanhan ? data[0].donhangchuanhan : 0
      );
    }
  );
}
function load_congnophaithu(thang, nam) {
  $.post(
    "ajax/home/load_congnophaithu.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#congnophaithu").html(
        (data[0].congnophaithu ? data[0].congnophaithu : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}
function load_congnophaitra(thang, nam) {
  $.post(
    "ajax/home/load_congnophaitra.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#congnophaitra").html(
        (data[0].congnophaitra ? data[0].congnophaitra : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
    }
  );
}
function load_donhang(thang, nam) {
  $.post(
    "ajax/home/load_donhang.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#donhang").html(data[0].donhang);
    }
  );
}
function load_khachhangmoi(thang, nam) {
  $.post(
    "ajax/home/load_khachhangmoi.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $("#tongkhachhang").html(
        (data[0].tongkhachhang ? data[0].tongkhachhang : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#khachhangmoi").html(
        (data[0].khachhangmoi ? data[0].khachhangmoi : 0)
          .toString()
          .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      );
      $("#phantram_khachhang").html(
        "(" + (data[0].phantram ? data[0].phantram : 0) + "%)"
      );
    }
  );
}

function load_hanghoabanchay(thang, nam) {
  $.post(
    "ajax/home/load_hanghoabanchay.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_hanghoabanchay").html(data);
    }
  );
}
function load_hanghoaloinhuancao(thang, nam) {
  $.post(
    "ajax/home/load_hanghoaloinhuancao.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_hanghoaloinhuancao").html(data);
    }
  );
}
function load_doanhthutheokhachhang(thang, nam) {
  $.post(
    "ajax/home/load_doanhthutheokhachhang.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_doanhthutheokhachhang").html(data);
    }
  );
}
function load_loinhuantheokhachhang(thang, nam) {
  $.post(
    "ajax/home/load_loinhuantheokhachhang.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_loinhuantheokhachhang").html(data);
    }
  );
}
function load_tuoinokhachhang(thang, nam) {
  $.post(
    "ajax/home/load_tuoinokhachhang.php",
    { thang: thang, nam: nam },
    function (data, textStatus, jqXHR) {
      $(".__chitiet_tuoinokhachhang").html(data);
    }
  );
}
