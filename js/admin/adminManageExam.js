/* Render exam schedule */
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
            createTable(response);

        },
        error: function (err) { 
            console.log(err);
            $("#tableList").append('<div class="empty-background"><h1>Chưa có đợt thi nào được tạo</h1></div>'+
            '<div class="redirect-wrapper">'+
                '<a class="redirect-button w3-button w3-green" href="adminChange.php">Chuyển đến trang tạo lịch thi</a>'+
            '</div>'); 
        }
    });
});

createTable = (data) => {
    var current = "";
    for (let i = 0; i < data.length; i++) {
        if (data[i].RegistExamID!=current) {
            current = data[i].RegistExamID;
            $("#tableList").append('<div data-examination = '+current+' class="table-container top-rounded"></div>');
            createHeader(current, data[i].UnitRegist, data[i].CreateYear, data[i].StartedDate.split(" ")[0], data[i].FinishDate.split(" ")[0]);
            createBody(data[i], i);
        }else{
            createBody(data[i], i);
        }    
    }  
}

createHeader = (id, examNumber, year, startDate, finishDate) => {
    /* CREATE ID */
    var openFormId = "openFormOf_" + id;
    var formId = "formOf_" + id;
    var openButtonId = "openButtonOf_" + id;
    var stopContainerId = "stopContainerOf_" + id;
    var closeButtonId = "closeButtonOf_" + id;
    var deleteButtonId = "deleteButtonOf_" + id;
    var tableId = "tableOf_"+id;
    /* VARIABLE FOR CONTROLLER */
    var now = new Date().toISOString().split('T')[0];
    var openDisplay = compareDate(finishDate, now) ? "none" : "block";
    var closeDisplay = compareDate(finishDate, now) ? "block" : "none";
    var period = "Mở đăng ký từ " + convertDate(startDate)+ " đến " + convertDate(finishDate);
    var isDisabled = compareDate(finishDate, now) ? "disabled" : "";
    /* APPEND ELEMENT */
    $("#tableList").find(".table-container[data-examination="+id+"]").append('<div class="w3-green top-rounded table-header clearfix">'+
        '<h3>Đợt '+examNumber+' năm '+year+'</h3>'+
        '<a href="adminChange.php" class="config-btn"><img src="../../images/config.svg" alt="Sửa"></a>'+
        '<div class="single-button-container"><button class="hide-button w3-button w3-red" id='+deleteButtonId+' onclick="hideRegistry(this.id)" '+isDisabled+'>Xóa</button></div>'+
        '<div class="single-button-container"><button class="close-button w3-button w3-deep-orange" id='+closeButtonId+' onclick="closeRegistryHandler(this.id)" '+isDisabled+'>Đánh SBD</button></div>'+
        '<div class="openForm" id='+openFormId+' style="display:'+openDisplay+'">'+
        '<form id='+formId+'>'+
            '<input type="text" name="RegistExamID" value='+id+' style="display:none;">'+
            '<label>Từ: </label>'+
            '<input type="date" name="startedDate">'+
            '<label>Đến: </label>'+
            '<input type="date" name="finishDate">'+
            '<button type="button" class="mybutton w3-button w3-indigo" id='+openButtonId+' name="openRegistry" onclick="openRegistryHandler(this.id)">Mở</button>'+
        '</form>'+
        '</div>'+
        '<div class="afterOpen" id='+stopContainerId+' style="display:'+closeDisplay+'">'+
            '<div>'+period+'</div>'+
        '</div>'+
    '</div>');
    $("#tableList").find(".table-container[data-examination="+id+"]").append('<table id='+tableId+' class="w3-table-all w3-hoverable w3-striped">'+
        '<tr>'+
        '<th style="width:5%">STT</th>'+
        '<th style="width:35%">Địa điểm</th>'+
        '<th style="width:24%">Ngày thi</th>'+
        '<th style="width:18%">Ca thi</th>'+
        '<th style="width:14%">Số lượng</th>'+
        '<th style="width:4%">DS</th>'+
        '</tr>'+
    '</table>');
}

createBody = (data, index) => {
    $("#tableList").find("#tableOf_"+data.RegistExamID+" tr:last").after('<tr>'+
        '<td>'+(index+1)+'</td>'+
        '<td>'+data.Location+'</td>'+
        '<td>'+convertDate(data.ExamDate)+'</td>'+
        '<td>'+data.UnitExam+'('+data.ExamTime+')'+'</td>'+
        '<td>'+data.Examee+'/'+data.ExameeMax+'</td>'+
        '<td>'+
          '<a id='+data.RegistExamDetailID+' onclick="printHandler(this.id)" class="btn-link">'+
            '<img src="../../images/export.svg" alt="In">'+
          '</a>'+
        '</td>'+
    '</tr>');
} 

openRegistryHandler = (id) => {
    var i = id.split("_")[1];
    if (validateOpenForm(i)) {
       $.ajax({
            type: "POST",
            url: "../../action/center/RegistExam/OpenRegistExam.php",
            data: $("#formOf_"+i).serialize(),
            dataType: "json",
            success: function (response) {
                var newStartDate = $("#formOf_"+i).find('input[name="startedDate"]').val();
                var newFinishDate = $("#formOf_"+i).find('input[name="finishDate"]').val();
                var newPeriod = "Mở đăng ký từ " + convertDate(newStartDate)+ " đến " + convertDate(newFinishDate);
                $("#stopContainerOf_"+i).find("div").text(newPeriod);
                $("#formOf_"+i).css("display", "none");
                $("#stopContainerOf_"+i).css("display", "block");
            },
            error: function (err) {
                console.log(err.responseText);
                alert("Có lỗi xảy ra, vui lòng thử lại");   
            } 
        }); 
    }else{
        alert("Ngày mở hoặc ngày đóng đăng ký không hợp lệ");
    }
}

closeRegistryHandler = (id) => {
    var i = id.split("_")[1];
    var now = new Date().toISOString().split("T")[0];
    var deadline = revertDate($("#stopContainerOf_"+i).text().split(" ")[6]);
    var confirmText = compareDate(deadline, now) ? 
        "Chưa hết hạn đăng ký, bạn có thể phải đánh số báo danh lại trong tương lai. Bạn xác nhận vẫn đánh số báo danh?" 
        :
        "Xác nhận đánh số báo danh?"
    var r = confirm(confirmText);
    if (r) {
       $.ajax({
            type: "POST",
            url: "../../action/center/RegistExam/CreateIdentificationNumber.php",
            data: {"RegistExamID":i},
            dataType: "json",
            success: function (response) {
                alert("Đánh số báo danh thành công");
            },
            error: function (err) {
                console.log(err.responseText);
                alert("Có lỗi xảy ra, vui lòng thử lại");    
            }
        }); 
    }
}

hideRegistry = id => {
    var i = id.split("_")[1];
    var r = confirm("Đợt thi đã xóa sẽ không hiển thị lại. Bạn có chắc chắn muốn xóa đợt thi này không?");
    if (r) {
       $.ajax({
            type: "POST",
            url: "../../action/center/RegistExam/CloseRegistExam.php",
            data: {"RegistExamID":i},
            dataType: "json",
            success: function (response) {
                $(".table-container[data-examination="+i+"]").remove();
                if ($(".table-container").length == 0) {
                    $("#tableList").append('<div class="empty-background"><h1>Chưa có đợt thi nào được tạo</h1></div>'+
                    '<div class="redirect-wrapper">'+
                        '<a class="redirect-button w3-button w3-green" href="adminChange.php">Chuyển đến trang tạo lịch thi</a>'+
                    '</div>'); 
                }
            },
            error: function (err) {
                console.log(err.responseText);
                alert("Có lỗi xảy ra, vui lòng thử lại");    
            }
        }); 
    }
}

validateOpenForm = (id) => {
    var now = new Date().toISOString().split("T")[0];
    var newStartDate = $("#formOf_"+id).find('input[name="startedDate"]').val();
    var newFinishDate = $("#formOf_"+id).find('input[name="finishDate"]').val();
    if (compareDate(newStartDate, now)) {
        if (compareDate(newFinishDate, now)) {
            if (compareDate(newFinishDate, newStartDate)) {
                return true;
            }
        }
    }
    return false;
}

printHandler = id => {
    window.open("adminPrint.php?id="+id);
}
