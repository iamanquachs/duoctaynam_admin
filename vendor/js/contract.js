function quanlyhopdong_load() {
  var offset = "",
    limit = "",
    songayhethan = "",
    trangthai = $("#trangthai_search option:selected").val();
  $.post(
    "ajax/contract/contract_load.php",
    {
      offset,
      limit,
      songayhethan,
      trangthai,
    },
    function (data, textStatus, jqXHR) {
      $(".contract_tbody").html("");
      let stt = 1;
      for (let i = 0; i < data.length; i++) {
        if (data[i].songay <= 0) {
          var songay = `<td class="right hover_songay" onclick='giahan_kh(this)' style='color:red; '>${data[i].songay} <img src="vendor/img/next_24.png" /></td>`;
        } else {
          var songay = `<td class="right">${data[i].songay}</td>`;
        }
        $(".contract_tbody").append(`<tr class='active_items_hover'  onclick="add_active(this)">
                <th scope="col">${stt}</th>
                <td class='msdv' style="display:none">${data[i].msdv}</td>
                <td class='loaiphanmem search_key' style="display:none">${data[i].loaihinh}</td>
                <td class="right search_key2" style="display:none">${data[i].songay}</td>
                <td class='tendv search_key'>${data[i].tendv}</td>
                <td class='loaiphanmem'>${data[i].loaihinh}</td>
                <td class=" dtdaidien search_key">${data[i].dtdaidien}</td>
                <td class='diachi search_key'>${data[i].diachi}</td>
                <td class="tendaidien search_key">${data[i].tendaidien}</td>
                <td class="ngaykichhoat">${data[i].ngaykichhoat}</td>
                <td class="ngayhethan">${data[i].ngayhethan}</td>
                ${songay}
                <td class="right">${data[i].solan}</td>
            </tr>`);
        stt++;
      }
    }
  );
}

function search() {
  var input, filter, table, tr, td, i, j, cell;
  input = document.getElementById("tenkhachhang_search");
  filter = input.value
    .toUpperCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/[đĐ]/g, (m) => (m === "đ" ? "d" : "D"));
  table = document.getElementById("contract_tbody");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    // Hide the row initially.
    tr[i].style.display = "none";
    td = tr[i].getElementsByClassName("search_key");
    for (var j = 0; j < td.length; j++) {
      cell = tr[i].getElementsByClassName("search_key")[j];
      if (cell) {
        if (
          cell.innerHTML
            .toUpperCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .replace(/[đĐ]/g, (m) => (m === "đ" ? "d" : "D"))
            .indexOf(filter) > -1
        ) {
          tr[i].style.display = "";
          break;
        }
      }
    }
  }
}
function search_songay() {
  var input, filter, table, tr, td, i, j, cell;
  input = document.getElementById("songayhethan_search");
  filter = input.value;
  table = document.getElementById("contract_tbody");
  tr = table.getElementsByTagName("tr");
 
  if (filter == "") {
    quanlyhopdong_load();
  } else {
    for (i = 0; i < tr.length; i++) {
      // Hide the row initially.
      tr[i].style.display = "none";
      td = tr[i].getElementsByClassName("search_key2");
      for (var j = 0; j < td.length; j++) {
        cell = tr[i].getElementsByClassName("search_key2")[j];

        if (cell) {
          cell = cell.innerHTML;
          if (parseFloat(cell) <= parseFloat(filter)) {
            tr[i].style.display = "";
            break;
          }
        }
      }
    }
  }
}
function giahan_kh(e) {
  var tenkh = $(e).parent().find(".tendv").text();
  var loaiphanmem = $(e).parent().find(".loaiphanmem").text();
  var dtdaidien = $(e).parent().find(".dtdaidien").text();
  var diachi = $(e).parent().find(".diachi").text();
  var tendaidien = $(e).parent().find(".tendaidien").text();
  var ngayhethan = $(e).parent().find(".ngayhethan").text();
  var loaihopdong = "RENEW";
  var mskh = $(e).parent().find(".msdv").text();
  $.post(
    "ajax/khachhang/chitiet_khachhang_add.php",
    {
      tenkh: tenkh,
      loaiphanmem: loaiphanmem,
      dtdaidien: dtdaidien,
      diachi: diachi,
      tendaidien: tendaidien,
      tungay: ngayhethan,
      denngay: ngayhethan,
      loaihopdong: loaihopdong,
      thangkm: 0,
      trangthai: 10,
      ghichu: "Hết hạn",
      yeucau: "Gia hạn",
      linktailieu: "",
      gia: 0,
      mskh,
      loaiphanmem,
    },
    function (data, textStatus, jqXHR) {
      console.log(data);
      if (data == "404") {
        alert("Đã tồn tại");
      }
    }
  );
}
