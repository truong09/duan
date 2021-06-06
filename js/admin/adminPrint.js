var id = parseURLParams(window.location.href).id[0];

$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "../../action/center/RegistExam/GetListRegistExamInfor.php",
    data: {"RegistExamDetailID": id},
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response[0].IdentificationNumber != 0) {
        response.sort(function (a, b) {
          return parseInt(a.IdentificationNumber) - parseInt(b.IdentificationNumber); 
        })
      }
      for (let i = 0; i < response.length; i++) {
        $("#infoTable tr:last").after('<tr>'+
          '<td>'+(i+1)+'</td>'+
          '<td>'+response[i].AccountID+'</td>'+
          '<td>'+response[i].FullName+'</td>'+
          '<td>'+convertDate(response[i].DateOfBirth)+'</td>'+
          '<td>'+response[i].Gender+'</td>'+
          '<td>'+response[i].Nation+'</td>'+
          '<td>'+response[i].Identification+'</td>'+
          '<td>'+response[i].PermanentResidence+'</td>'+
          '<td>'+response[i].ProvinceName+'</td>'+
          '<td>'+response[i].Email+'</td>'+
          '<td>'+response[i].PhoneNumber+'</td>'+
          '<td>'+response[i].Address+'</td>'+
          '<td>'+response[i].IsPrioritize+'</td>'+
          '<td>'+response[i].Area+'</td>'+
          '<td>'+response[i].HKIGrade10+'</td>'+
          '<td>'+response[i].HKIIGrade10+'</td>'+
          '<td>'+response[i].TBGrade10+'</td>'+
          '<td>'+response[i].HKIGrade11+'</td>'+
          '<td>'+response[i].HKIIGrade11+'</td>'+
          '<td>'+response[i].TBGrade11+'</td>'+
          '<td>'+response[i].HKIGrade12+'</td>'+
          '<td>'+response[i].HKIIGrade12+'</td>'+
          '<td>'+response[i].TBGrade12+'</td>'+
          '<td>'+response[i].GraduatingYear+'</td>'+
          '<td>'+response[i].Math+'</td>'+
          '<td>'+response[i].Literature+'</td>'+
          '<td>'+response[i].English+'</td>'+
          '<td>'+response[i].Physics+'</td>'+
          '<td>'+response[i].Chemistry+'</td>'+
          '<td>'+response[i].Biology+'</td>'+
          '<td>'+response[i].History+'</td>'+
          '<td>'+response[i].Geography+'</td>'+
          '<td>'+response[i].GDCD+'</td>'+
        '</tr>');
      }
    },
    complete: function (xhr, status) {  
      exportTableToExcel('infoTable', 'Danh sách thí sinh');
    }
  });
});

function exportTableToExcel(tableID, filename = ''){
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
  
  // Specify file name
  filename = filename?filename+'.xls':'excel_data.xls';
  
  // Create download link element
  downloadLink = document.createElement("a");
  
  document.body.appendChild(downloadLink);
  
  if(navigator.msSaveOrOpenBlob){
      var blob = new Blob(['\ufeff', tableHTML], {
          type: dataType
      });
      navigator.msSaveOrOpenBlob( blob, filename);
  }else{
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
      // Setting the file name
      downloadLink.download = filename;
      
      //triggering the function
      downloadLink.click();
  }
}