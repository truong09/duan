$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../action/student/GetAccountDetail.php",
    data: [],
    dataType: "json",
    success: function (response) {
      $("#registryCode").text(response.AccountID);
      $("#name strong").text(convertData(response.FullName.toLocaleUpperCase()));
      $("#birthday").text(convertDate(convertData(response.DateOfBirth)));
      $("#placeOfBirth").text(convertData(response.ProvinceName));
      $("#gender").text(convertData(response.Gender));
      $("#cmnd").text(convertData(response.Identification));
      $("#name2 strong").text(convertData(response.FullName.toLocaleUpperCase()));
      $("#address").text(convertData(response.Address));
      $("#phone").text(convertData(response.PhoneNumber));
      $("#email").text(convertData(response.Email));
    }
  });

  $.ajax({
    type: "GET",
    url: "../../action/student/RegistExam/GetListExamRegisted.php",
    data: [],
    dataType: "json",
    success: function (response) {
      response.reverse();
      $("#examPlace").text(response[0].Location);
      var examTime = "Ca "+ response[0].UnitExam + " ("+ response[0].ExamTime + ") ngày " + convertDate(response[0].ExamDate);
      $("#examDate").text(examTime);
      var participationId = response[0].IdentificationNumber != 0 ? response[0].IdentificationNumber : ""
;      $("#id").text(participationId);
    }
  });
});

convertData = data => {
  return data!="" ? data : "(Trống)";
}

const ORIGINAL_WIDTH = $("body").width();
// Save the PDF
$("#export").click(function (e) { 
  e.preventDefault();
  $("body").width(ORIGINAL_WIDTH-1);
  html2canvas($("#paper-content"), {      
    onrendered: function (canvas) {  
      var img = canvas.toDataURL('image/jpeg', 1.0);           
      var doc = jsPDF();      
      doc.addImage(img, "JPEG", 0, 0);      
      doc.save('Giấy báo dự thi.pdf');      
    }
  });
  setTimeout(function(){ location.reload(); }, 1000);
});