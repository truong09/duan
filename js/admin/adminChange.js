var INDEX_TREE = {}; /* Row's index will be saved in this object */

/* Array for submitting */
var JDetailUpdate = [];
var JDetailInsert = [];
var JDetailDelete = [];

var hasAnyExam = true;
$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../action/center/RegistExam/GetListRegistExamDetail.php",
    data: [],
    dataType: "json",
    success: function (response) {
      response.sort(function (a, b) {  
        return parseInt(a.CreateYear) - parseInt(b.CreateYear) || parseInt(b.UnitRegist) - parseInt(a.UnitRegist);
      });
      var current = "";
      var index = 1;
      for (let i = 0; i < response.length; i++) {
        if (response[i].IsRegist !=0 ) continue;
        if (response[i].RegistExamID != current) {
          current = response[i].RegistExamID;
          index = 1;
          createFrame(current, response[i].UnitRegist, response[i].CreateYear);
          createContentForOldExam(
            index,
            current, 
            response[i].RegistExamDetailID, 
            response[i].Location, 
            convertDate(response[i].ExamDate), 
            response[i].UnitExam, 
            response[i].ExamTime,
            response[i].ExameeMax
          );
        }else{
          index++;
          createContentForOldExam(
            index, 
            current,
            response[i].RegistExamDetailID, 
            response[i].Location, 
            convertDate(response[i].ExamDate), 
            response[i].UnitExam, 
            response[i].ExamTime,
            response[i].ExameeMax
          );
        } 
      }
      if ($(".wrapper").length == 0) {
        $("#container").append('<div class="empty-background" id="empty-background"><h1>Nhấn nút <strong>+</strong> để thêm đợt thi </h1></div>');
        $("#addExam").css("width", "20%")
      }
    },
    error: function (err) {  
      console.log(err);
      hasAnyExam = false;
      $("#addExam").css("width", "20%");
      $("#container").append('<div class="empty-background" id="empty-background"><h1>Nhấn <strong>+</strong> để thêm đợt thi mới</h1></div>');
    }
  });
});

/* ******************************************************************************************** */
/* ******************    COMMON   *********************** */
/* ******************************************************************************************** */

createFrame = (id, examNumber = "", examYear = "") => {
  /* Create element id */
  var containerId = "containerOf_" + id;
  var formId = "formOf_" + id;
  var tableId = "tableOf_" + id;
  var addBtnId = "addBtnOf_" + id;
  var saveBtnID = "saveBtnOf_" + id;
  /* Config element according to new and old  */
  var header = (examYear==""||examNumber=="") ? createHeaderForNewExam(id) : createHeaderForOldExam(examNumber, examYear);
  var tableHeader = (examYear==""||examNumber=="") ? tableHeadForNewExam : tableHeadForOldExam;
  var submitHandler = (examYear==""||examNumber=="") ? 'onclick="submitNew(this.id)"' : 'onclick="submitOld(this.id)"'
  var addHandler = (examYear==""||examNumber=="") ? 'onclick="addNewRow(this.id)"' : 'onclick="addNewRowForOldExam(this.id)"';
  $("#container").append('<div class="wrapper clearfix" id='+containerId+'>'+
    '<form id='+formId+'>'+
      header+
      '<div class="form-container">'+
        '<table class="w3-table-all w3-striped w3-hoverable" id='+tableId+'>'+
          tableHeader+
        '</table>'+
      '</div>'+
      '<div class="button-shelf">'+
        '<button type="button" class="w3-button w3-green w3-ripple" id='+saveBtnID+' '+submitHandler+'>Lưu</button>'+
        '<button type="button" class="w3-button w3-indigo w3-ripple addbtn" id='+addBtnId+' '+addHandler+'>+</button>'+
      '</div>'+
    '</form>'+
  '</div>');
}

reIndex = (tableId) => {
  var newIndex = 1;
  $.each($("#tableOf_"+tableId+" tr"), function (indexInArray, valueOfElement) { 
    if (indexInArray!=0 && $("#tableOf_"+tableId+" tr")[indexInArray].className !="ignore") {
      $("#tableOf_"+tableId+" tr")[indexInArray].firstChild.innerHTML=newIndex;
      newIndex++;
    }
  });
}

pushJDetailDelete = (shiftId, tableId) => {
  var buffer = {};
  buffer["RegistExamDetailID"] = shiftId;
  buffer["Location"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[1].innerHTML;
  buffer["ExamDate"] = revertDate($("#rowNum_"+shiftId+"_Of_"+tableId+" td")[2].innerHTML);
  buffer["UnitExam"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[3].innerHTML;
  buffer["ExamTime"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[4].innerHTML;
  buffer["ExameeMax"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[5].innerHTML;
  JDetailDelete.push(buffer);
}

validateFill = formId => {
  var isValid = true;
  var now = new Date().toISOString().split("T")[0];
  $.each($("#"+formId+" input"), function (indexInArray, valueOfElement) { 
    var inputValue = valueOfElement.value
    if(inputValue == "" || inputValue == null || inputValue < 0){
        isValid = false;
        return false;
    }
    if(valueOfElement.type == "date" && compareDate(now, inputValue)) {
      isValid = false;
        return false;
    }
  });
  return isValid;
}

validateChange = formId => {
  var isValid = true;
  if ($("#"+formId+" input").length == 0) {
    isValid = false;
  }
  $.each($("#"+formId+" tr[data-interact='edit']"), function (indexInArray, valueOfElement) { 
    /* Get old input value */
    var rowId = valueOfElement.id.split("_")[1];
    var i = JDetailDelete.findIndex(function (item) { return item.RegistExamDetailID == rowId; });
    var originalData = JDetailDelete[i];
    /* Get new input value */
    var location = valueOfElement.childNodes[1].firstChild.value;
    var date = valueOfElement.childNodes[2].firstChild.value;
    var shift = valueOfElement.childNodes[3].firstChild.value;
    var time = valueOfElement.childNodes[4].firstChild.value;
    var amount = valueOfElement.childNodes[5].firstChild.value;
    if (location == originalData.Location 
      && date == revertDate(originalData.ExamDate) 
      && shift == originalData.UnitExam 
      && time == originalData.ExamTime 
      && amount == originalData.ExameeMax) {
      if(isValid) isValid = false;
      return false;
    }
  });
  if (!isValid) {
    $.each($("#"+formId+" tr"), function (indexInArray, valueOfElement) { 
      if (valueOfElement.className=="ignore") {
        isValid = true;
        return false;
      }
    });
  }
  return isValid;
}

/* ******************************************************************************************** */
/* ******************    OLD EXAM    *********************** */
/* ******************************************************************************************** */

/* OLD'S PIECES */
createHeaderForOldExam = (examNumber, examYear) => {
  return '<div class="w3-green header">' + 
    '<h3>Đợt '+examNumber+' năm '+examYear+'</h3>' + 
  '</div>';
}

const tableHeadForOldExam = '<tr>'+
  '<td style="width: 5%;">STT</td>'+
  '<td style="width: 35%;">Địa điểm</td>'+
  '<td style="width: 20%;">Ngày thi</td>'+
  '<td style="width: 6%;">Ca thi</td>'+
  '<td style="width: 9%;">Giờ thi</td>'+
  '<td style="width: 15%;">Số lượng tối đa</td>'+
  '<td style="width: 5%;">Sửa</td>'+
  '<td style="width: 5%;">Xóa</td>'+
'</tr>';

createContentForOldExam = (index, id, shiftId, place, date, shift, time, amount) => {
  /* Create element id */
  var rowId = "rowNum_"+shiftId+"_Of_"+id;
  var editBtnId = "editBtnNum_"+shiftId+"_Of_" + id;
  var deleteShiftBtnId = "deleteShiftBtnNum_"+shiftId+"_Of_" + id;
  $("#tableOf_"+id+" tr:last").after('<tr id='+rowId+' data-interact="none">'+
    '<td>'+index+'</td>'+
    '<td>'+place+'</td>'+
    '<td>'+date+'</td>'+
    '<td>'+shift+'</td>'+
    '<td>'+time+'</td>'+
    '<td>'+amount+'</td>'+
    '<td><button type="button" class="interactbtn" id='+editBtnId+' onclick="editRow(this.id)"><img src="../../images/pen.svg" alt="edit"></button></td>'+
    '<td><button type="button" class="interactbtn" id='+deleteShiftBtnId+' onclick="removeRowForOldExam(this.id)"><img src="../../images/recycle-bin.svg" alt="delete"></button></td>'+
  '</tr>');
}

addNewRowForOldExam = id => {
  var tableId = id.split("_")[1];
  /* Save current index */
  INDEX_TREE[tableId] = $("#tableOf_"+tableId+" tr").length;
  /* Create element id */
  var shiftId = "rowNum_"+INDEX_TREE[tableId]+"_Of_" + tableId;
  var deleteShiftBtnId = "deleteShiftBtnNum_"+INDEX_TREE[tableId]+"_Of_" + tableId;
  $("#tableOf_"+tableId+" tr:last").after('<tr id='+shiftId+' data-interact="add">'+
    '<td>'+INDEX_TREE[tableId]+'</td>'+
    '<td><input type="text" name="Location"></td>'+
    '<td><input type="date" name="ExamDate"></td>'+
    '<td><input type="number" name="UnitExam" min="1"></td>'+
    '<td><input type="text" name="ExamTime"></td>'+
    '<td><input type="number" name="ExameeMax" min="0"></td>'+
    '<td></td>'+
    '<td><button type="button" class="interactbtn" id='+deleteShiftBtnId+' onclick="removeRowForOldExam(this.id)"><img src="../../images/recycle-bin.svg" alt="delete"></button></td>'+
  '</tr>');
}

removeRowForOldExam = id => {
  var tableId = id.split("_")[3];
  var shiftId = id.split("_")[1];
  var interaction = $("#rowNum_"+shiftId+"_Of_"+tableId).attr("data-interact");
  if (interaction == "add") {
    $("#rowNum_"+shiftId+"_Of_"+tableId).remove();
    reIndex(tableId);
  }
  if (interaction == "none"){
    /* Save data */
    var buffer = {};
    buffer["RegistExamDetailID"] = shiftId;
    buffer["Location"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[1].innerHTML;
    buffer["ExamDate"] = revertDate($("#rowNum_"+shiftId+"_Of_"+tableId+" td")[2].innerHTML);
    buffer["UnitExam"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[3].innerHTML;
    buffer["ExamTime"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[4].innerHTML;
    buffer["ExameeMax"] = $("#rowNum_"+shiftId+"_Of_"+tableId+" td")[5].innerHTML;
    JDetailDelete.push(buffer);
    /* Create element id */
    var undoBtnId = "undoBtnNum_"+shiftId+"_Of_"+tableId;
    var rowId = "rowNum_"+shiftId+"_Of_"+tableId;
    /* Rerender table */
    $("#rowNum_"+shiftId+"_Of_"+tableId).replaceWith('<tr id='+rowId+' class="ignore">'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td><button type="button" class="interactbtn" id='+undoBtnId+' onclick="undoRemove(this.id)"><img src="../../images/undo-arrow.svg" alt="undo"></button></td>'+
    '</tr>');
    reIndex(tableId);
  }
  if (interaction == "edit") {
    /* Create element id */
    var undoBtnId = "undoBtnNum_"+shiftId+"_Of_"+tableId;
    var rowId = "rowNum_"+shiftId+"_Of_"+tableId;
    /* Rerender table */
    $("#rowNum_"+shiftId+"_Of_"+tableId).replaceWith('<tr id='+rowId+' data-interact="none" class="ignore">'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td></td>'+ 
      '<td><button type="button" class="interactbtn" id='+undoBtnId+' onclick="undoRemove(this.id)"><img src="../../images/undo-arrow.svg" alt="undo"></button></td>'+
    '</tr>');
    reIndex(tableId);
  }
}

undoRemove = id => {
  var tableId = id.split("_")[3];
  var shiftId = id.split("_")[1];
  var rowId = "rowNum_"+shiftId+"_Of_"+tableId;
  var editBtnId = "editBtnNum_"+shiftId+"_Of_" + tableId;
  var deleteShiftBtnId = "deleteShiftBtnNum_"+shiftId+"_Of_" + tableId;
  var i = JDetailDelete.findIndex(function (item) { return item.RegistExamDetailID == shiftId; });
  $("#rowNum_"+shiftId+"_Of_"+tableId).replaceWith('<tr id='+rowId+' data-interact="none">'+
    '<td></td>'+
    '<td>'+JDetailDelete[i].Location+'</td>'+
    '<td>'+convertDate(JDetailDelete[i].ExamDate)+'</td>'+
    '<td>'+JDetailDelete[i].UnitExam+'</td>'+
    '<td>'+JDetailDelete[i].ExamTime+'</td>'+
    '<td>'+JDetailDelete[i].ExameeMax+'</td>'+
    '<td><button type="button" class="interactbtn" id='+editBtnId+' onclick="editRow(this.id)"><img src="../../images/pen.svg" alt="edit"></button></td>'+
    '<td><button type="button" class="interactbtn" id='+deleteShiftBtnId+' onclick="removeRowForOldExam(this.id)"><img src="../../images/recycle-bin.svg" alt="delete"></button></td>'+
  '</tr>');
  reIndex(tableId);
  JDetailDelete.splice(i, 1);
}

editRow = id => {
  var tableId = id.split("_")[3];
  var shiftId = id.split("_")[1];
  var rowId = "rowNum_"+shiftId+"_Of_"+tableId;
  var redoBtnId = "redoBtnNum_"+shiftId+"_Of_"+tableId;
  var deleteShiftBtnId = "deleteShiftBtnNum_"+shiftId+"_Of_" + tableId;
  pushJDetailDelete(shiftId, tableId);
  var i = JDetailDelete.findIndex(function (item) { return item.RegistExamDetailID == shiftId; });
  $("#"+rowId).replaceWith('<tr id='+rowId+' data-interact="edit">'+
    '<td></td>'+
    '<td><input type="text" name="Location" value="'+JDetailDelete[i].Location+'"></td>'+
    '<td><input type="date" name="ExamDate" value='+JDetailDelete[i].ExamDate+'></td>'+
    '<td><input type="number" name="UnitExam" min="1" value='+JDetailDelete[i].UnitExam+'></td>'+
    '<td><input type="text" name="ExamTime" value='+JDetailDelete[i].ExamTime+'></td>'+
    '<td><input type="number" name="ExameeMax" min="0" value='+JDetailDelete[i].ExameeMax+'></td>'+
    '<td><button type="button" class="interactbtn" id='+redoBtnId+' onclick="undoRemove(this.id)"><img src="../../images/undo-arrow.svg" alt="redo"></button></td>'+
    '<td><button type="button" class="interactbtn" id='+deleteShiftBtnId+' onclick="removeRowForOldExam(this.id)"><img src="../../images/recycle-bin.svg" alt="delete"></button></td>'+
  '</tr>');
  reIndex(tableId);
}

submitOld = id => {
  var tableId = id.split("_")[1];
  var formId = "formOf_" + tableId;
  var r = confirm("Bạn chắc chắn muốn lưu bản ghi này");
  if (r) {
    if (validateFill(formId)) {
      if (validateChange(formId)) {
        $.each($("#"+formId+" tr"), function (indexInArray, valueOfElement) { 
          var interaction = valueOfElement.getAttribute("data-interact");
          var shiftId = valueOfElement.id.split("_")[1];
          /* Get new input value */
          if (interaction!=null && interaction!="none") {
            var location = valueOfElement.childNodes[1].firstChild.value;
            var date = valueOfElement.childNodes[2].firstChild.value;
            var shift = valueOfElement.childNodes[3].firstChild.value;
            var time = valueOfElement.childNodes[4].firstChild.value;
            var amount = valueOfElement.childNodes[5].firstChild.value;   
          }
          if (interaction == "add") { 
            /* Package new row data */
            var jsonInsertItem = {RegistExamID: tableId, Location: location, ExamDate: date, UnitExam: shift, ExamTime: time, ExameeMax: amount};
            JDetailInsert.push(jsonInsertItem);
          }
          if (interaction == "edit") {
            var jsonEditItem = {RegistExamID: tableId, Location: location, ExamDate: date, UnitExam: shift, ExamTime: time, ExameeMax: amount, RegistExamDetailID: shiftId};
            var i = JDetailDelete.findIndex(function (item) { return item.RegistExamDetailID == shiftId; });
            JDetailDelete.splice(i, 1);
            JDetailUpdate.push(jsonEditItem);
          }
        });
        /* Submit to server */
        var stringUpdate = JDetailUpdate.length > 0 ? JSON.stringify(JDetailUpdate) : "";
        var stringInsert = JDetailInsert.length > 0 ? JSON.stringify(JDetailInsert) : "";
        var stringDelete = JDetailDelete.length > 0 ? JSON.stringify(JDetailDelete) : "";
        $.ajax({
          type: "POST",
          url: "../../action/center/RegistExam/UpdateRegistExam.php",
          data: {"JDetailUpdate": stringUpdate, "JDetailInsert": stringInsert, "JDetailDelete": stringDelete},
          dataType: "json",
          success: function (response) {
            
          },
          error: function (err) {
            console.log(err); 
            alert("Có lỗi xảy ra, vui lòng thử lại");
          },
          complete: function (xhr, status) { 
            if (status=="success") {
              alert("Thay đổi thành công")
              location.reload()
            }
          }
        });
      } else {
        alert("Không có sự thay đổi nào");
      }
    }else{
      alert("Thông tin không hợp lệ");
    }
  }
}

/* ******************************************************************************************** */
/* ******************    NEW EXAM    *********************** */
/* ******************************************************************************************** */

/* NEW'S PIECES */
createHeaderForNewExam = (id) => {
  var now = new Date().getFullYear();
  var deleteExamBtnId = "deleteExamBtnOf_" + id;
  return '<div class="w3-green header w3-row">'+
    '<div class="w3-col m6 l6">'+
      '<h3>Đợt <input type="number" name="UnitRegist" min="1"> năm <input type="number" name="CreateYear" min='+now+'></h3>'+
    '</div>'+
    '<div class="w3-col m6 l6 clearfix delete-container">'+
      '<a id='+deleteExamBtnId+' onclick="removeExamHandler(this.id)">&times;</a>'+
    '</div>'+
  '</div>';
}

const tableHeadForNewExam = '<tr>'+
  '<td style="width: 5%;">STT</td>'+
  '<td style="width: 35%;">Địa điểm</td>'+
  '<td style="width: 20%;">Ngày thi</td>'+
  '<td style="width: 6%;">Ca thi</td>'+
  '<td style="width: 9%;">Giờ thi</td>'+
  '<td style="width: 15%;">Số lượng tối đa</td>'+
  '<td style="width: 10%;">Xóa</td>'+
'</tr>';

createContentForNewExam = (index, id) => {
  /* Create element id */
  var rowId = "rowNum_"+index+"_Of_" + id
  var deleteShiftBtnId = "deleteShiftBtnNum_"+index+"_Of_" + id;
  $("#tableOf_"+id+" tr:last").after('<tr id='+rowId+'>'+
    '<td>'+index+'</td>'+
    '<td><input type="text" name="Location"></td>'+
    '<td><input type="date" name="ExamDate"></td>'+
    '<td><input type="number" name="UnitExam" min="1"></td>'+
    '<td><input type="text" name="ExamTime"></td>'+
    '<td><input type="number" name="ExameeMax" min="0"></td>'+
    '<td><button type="button" class="interactbtn" id='+deleteShiftBtnId+' onclick="removeRow(this.id)"><img src="../../images/recycle-bin.svg" alt="delete"></button></td>'+
  '</tr>');
}

var idForNew = 1;
/* OPEN NEW EXAM */
$("#addExam").click(function (e) { 
  e.preventDefault();
  if ($("#empty-background")) {
    $("#empty-background").remove();
  }
  INDEX_TREE[idForNew]=1;
  createFrame(idForNew);
  createContentForNewExam(INDEX_TREE[idForNew], idForNew);
  idForNew++;
  $(this).css("width", "100%");
});

removeExamHandler = id => {
  var containerId = "containerOf_" + id.split("_")[1];
  $("#" + containerId).remove();
  if ($(".wrapper").length == 0) {
    $("#container").append('<div class="empty-background" id="empty-background"><h1>Nhấn nút <strong>+</strong> để thêm đợt thi </h1></div>');
    $("#addExam").css("width", "20%")
  }
}

addNewRow = (id) => {
  var tableId = id.split("_")[1];
  INDEX_TREE[tableId]++;
  createContentForNewExam(INDEX_TREE[tableId], tableId);
}

removeRow = (id) => {
  var tableId = id.split("_")[3];
  var rowId = id.split("_")[1]
  $("#rowNum_"+rowId+"_Of_"+tableId).remove();
  var newIndex = 1;
  $.each($("#tableOf_"+tableId+" tr"), function (indexInArray, valueOfElement) { 
    if (indexInArray!=0) {
      $("#tableOf_"+tableId+" tr")[indexInArray].firstChild.innerHTML=newIndex;
      newIndex++;
    }
  });
  INDEX_TREE[tableId] = newIndex-1;
}

submitNew = id => {
  var formId = "formOf_" + id.split("_")[1];
  var data = $("#"+ formId).serialize().split(/&|=/);
  var r = confirm("Bạn chắc chắn muốn lưu bản ghi này?");
  var jdetail = [];
  if (r) {
    if (validateFill(formId) && validateYear(data[3])) {
      var jsonItem = {};
      var count = 1;
      for (let i = 4; i < data.length; i+=2) {
        jsonItem[data[i]] = decodeURIComponent(data[i+1]);
        if (count == 5) {
          count = 1;
          jdetail.push(jsonItem);
          jsonItem = {};
        }else{ count++; }
      }
      $.ajax({
        type: "POST",
        url: "../../action/center/RegistExam/InsertRegistExam.php",
        data: {"UnitRegist": data[1],"CreateYear":data[3], "JDetail": JSON.stringify(jdetail)},
        dataType: "json",
        success: function (response) {
          
        },
        error: function (err) { 
          console.log(err);
          alert("Có lỗi xảy ra, vui lòng thử lại"); 
        },
        complete: function (xhr, status) { 
          if(status=="success") {
            alert("Tạo thành công");
            location.reload();
          } 
        }
      });
    }else{
      alert("Thông tin không hợp lệ");
    }
  }
}

validateYear = (createYear) => {
  var thisYear = new Date().getFullYear();
  if(createYear<thisYear) return false;
  else return true;
}
