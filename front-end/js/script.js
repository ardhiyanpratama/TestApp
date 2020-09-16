$.ajax({
  type: "POST",
  url: "http:localhost:4000/",
    success: function (data) {
      alert("Connect Server" + data)
  },
  error: function (jqXHR, textStatus, err) {
    alert("text status " + textStatus + ", err " + err);
  },
});

// function showData(json) {
//     let tr = '';
//     $('#databody').html('');
//     let no;
//     for (let i = 0; i < json.length; i++) {
//         no = i + 1;
//         tr = $('<tr/>');
//         tr.append("<td>" + no + "</td>");
//         tr.append("<td>" + json[i].Name_user + "</td>");
//         tr.append("<td>" + json[i].Address_user + "</td>");
//         tr.append("<td>" + json[i].Phone_user + "</td>");
//         tr.append(`
//             <td>
//                 <button type="button" class="badge badge-primary badge-pill btnEdit" data-Id_user="`+ json[i].Id_user + `">
//                     Edit
//                 </button>
//                 <button type="button" class="badge badge-danger badge-pill btnHapus" data-Id_user="`+ json[i].Id_user + `">
//                     Hapus
//                 </button>
//             </td>`
//         );
//         $('#databody').append(tr);
//     }
// }
