var OLD_REGIST_ID = {};

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../action/student/RegistExam/GetListRegistExamForStudent.php",
    data: [],
    dataType: "json",
    success: function (response) {
      var current = "";
      var isOpen = true;
      var isDisabled = false;
      var isCloseToExpiration = false;
      for (let i = 0; i < response.length; i++) {
        if (response[i].RegistExamID != current) {
          isDisabled = false;
          isCloseToExpiration = false;
          isOpen = true;
          /* Check if expired */ 
          var now = new Date().toISOString().split("T")[0];
          if (compareDate(now, response[i].FinishDate.split(" ")[0])) {
            isDisabled=true;
          }
          /* Check if open */
          if (!compareDate(now, response[i].StartedDate.split(" ")[0])) {
            isOpen = false;
          }
          /* Check if close to expiration */
          var finishDateBack3Day = back3Day(response[i].FinishDate.split(" ")[0]);
          if (compareDate(now, finishDateBack3Day)) {
            isCloseToExpiration = true;
          }
          /* Render */
          current = response[i].RegistExamID;
          createHeader(current, response[i].UnitRegist, response[i].CreateYear, response[i].StartedDate.split(" ")[0], response[i].FinishDate.split(" ")[0], isDisabled, isOpen);
          createContent(
            current, 
            i+1, 
            response[i].
            RegistExamDetailID, 
            response[i].Location, 
            response[i].ExamDate, 
            response[i].UnitExam, 
            response[i].ExamTime, 
            response[i].Examee, 
            response[i].ExameeMax, 
            isDisabled, 
            isCloseToExpiration,
            response[i].IsEqual,
            response[i].IsRegisted,
            isOpen,
          );
        }else{
          createContent(
            current, 
            i+1, 
            response[i].RegistExamDetailID, 
            response[i].Location, 
            response[i].ExamDate, 
            response[i].UnitExam, 
            response[i].ExamTime, 
            response[i].Examee, 
            response[i].ExameeMax, 
            isDisabled, 
            isCloseToExpiration,
            response[i].IsEqual,
            response[i].IsRegisted,
            isOpen,
          );
        }
      }
    },
    error: function (err) {  
      console.log(err);
      $("#container").append('<div class="empty-background"><h1>Hi???n t???i kh??ng c?? ?????t thi n??o</h1></div>')
    }
  });
});

createHeader = (id, examNum, examYear,startDate, finishDate, isDisabled, isOpen) => {
  var formId = "formOf_" + id;
  var tableId = "tableOf_" + id;
  var cfBtnId = "buttonOf_" + id;
  var cancelBtnId = "cancelBtnOf_" + id;
  $("#container").append('<div class="wrapper clearfix">' +
    '<div class="header w3-green w3-row">' +
      '<div class="w3-col m5 l4">' +
        '<h3>?????t '+examNum+' n??m '+examYear+'</h3>' +
      '</div>' +
      '<div class="w3-col m7 l8">' +
        '<p class="timestamp"><img src="../../images/Time-long-icon.svg" alt="clock">'+
          (isOpen ? (isDisabled ? "???? h???t h???n ????ng k??" : (" 24:00 ng??y " + convertDate(finishDate))) : " H??? th???ng s??? m??? v??o ng??y "+startDate)
           +
        '</p>' +
      '</div>' +
    '</div>' +
    '<div class="schedule-container">' +
      '<form id='+formId+'>' +
        '<table class="w3-table-all w3-striped w3-hoverable" id='+tableId+'>' +
          '<tr>' +
            '<th style="width:5%">STT</th>' +
            '<th style="width:33%">?????a ??i???m</th>' +
            '<th style="width:22%">Ng??y thi</th>' +
            '<th style="width:15%">Ca thi</th>' +
            '<th style="width:20%">S??? l?????ng</th>' +
            '<th style="width:5%">??K</th>' +
          '</tr>' +
        '</table>' +
        '<div class="button-shelf">' +
          '<button type="reset" class="w3-button w3-red w3-ripple" '+(isDisabled || !isOpen ? "disabled": "")+'>H???y</button>' +
          '<button type="reset" class="w3-button w3-indigo w3-ripple" id='+cancelBtnId+' data-finishYear='+finishDate+' '+(isDisabled || !isOpen ? "disabled": "")+' onclick="cancelHandler(this.id)">H???y ????ng k??</button>' +
          '<button type="button" class="w3-button w3-green w3-ripple" id='+cfBtnId+' data-finishYear='+finishDate+' '+(isDisabled || !isOpen ? "disabled": "")+' onclick="submitHandler(this.id)">????ng k??</button>' +
        '</div>' +
      '</form>' +
    '</div>' +
  '</div>');
}

createContent = (examId, index, shiftId, place, date, shiftNum, time, amount, max, isDisabled, isCloseToExpiration, isFull, isRegisted, isOpen) => {
  var inputName = "inputOf_" + examId;
  /* Save the registed shift */
  if (isRegisted == 1) {
    OLD_REGIST_ID[examId] = shiftId;
  }
  $("#container").find("#tableOf_"+examId+" tr:last").after('<tr>'+ 
    '<td>'+index+'</td>'+
    '<td>'+place+'</td>'+
    '<td>'+convertDate(date)+'</td>'+
    '<td>'+shiftNum+' ('+time+')'+'</td>'+
    '<td>'+amountController(amount, max, isCloseToExpiration)+'</td>'+
    '<td><input type="radio" id='+shiftId+' name='+inputName+' '+(isDisabled || !isOpen || isFull == 1 ? "disabled": "")+' '+(isRegisted == 1 ? "checked" : "")+'/></td>'+
  '</tr>');
}

back3Day = day => {
  return day.split("-")[0] + "-" + day.split("-")[1] + "-" + String(day.split("-")[2]-3);
}

amountController = (amount, max, isCloseToExpiration) => {
  if(isCloseToExpiration && amount/max < 0.3) {
    return "S???p h???t ch???";
  }
  return amount+'/'+max;
}

submitHandler = (btnid) => {
  id = btnid.split("_")[1];
  var newshift = $("#formOf_"+id+" input[type='radio']:checked").attr("id");
  var oldshift = OLD_REGIST_ID[id];
  var deadline = $("#"+btnid).attr("data-finishYear");
  var registData = newshift ? [{"FinishDate": deadline, "RegistExamDetailID": newshift}] : [];
  var cancelData = oldshift ? [{"FinishDate": deadline, "RegistExamDetailID": oldshift}] : [];
  var r = confirm("B???n ch???c ch???n mu???n ????ng k???");
  if (r) {
    if (newshift == oldshift) {
      alert("B???n kh??ng c?? s??? thay ?????i ????ng k?? n??o");
    }else {
       $.ajax({
        type: "POST",
        url: "../../action/student/RegistExam/ProceedRegistExam.php",
        data: {"JDetailRegist": JSON.stringify(registData),"JDetailCancel":JSON.stringify(cancelData) },
        dataType: "json",
        success: function (response) {
          alert("????ng k?? th??nh c??ng");
        },
        error: function (err) {  
          alert("????ng k?? th???t b???i, vui l??ng th??? l???i");
        }
      });
      location.reload();
    }
  } 
}

cancelHandler = btnid => {
  id = btnid.split("_")[1];
  var oldshift = OLD_REGIST_ID[id];
  var deadline = $("#"+btnid).attr("data-finishYear");
  var cancelData = oldshift ? [{"FinishDate": deadline, "RegistExamDetailID": oldshift}] : [];
  var r = confirm("B???n ch???c ch???n mu???n h???y ????ng k???");
  if (r) {
    if (oldshift=="") {
      alert("B???n ????ng k?? b???t k?? ca thi n??o");
    }else {
      $.ajax({
        type: "POST",
        url: "../../action/student/RegistExam/ProceedRegistExam.php",
        data: {"JDetailRegist": "","JDetailCancel":JSON.stringify(cancelData) },
        dataType: "json",
        success: function (response) {
        }
      });
      location.reload();
    }
  }
}