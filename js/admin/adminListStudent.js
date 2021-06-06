function myAccFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function moveHandler(stuid) {  
	window.location.href = "adminProfileStudent.php?"+stuid;
}

$().ready(function () {
    $.ajax({
        type: "GET",
        url: "../../action/center/GetGroupDateAccount.php",
        data: {},
        dataType: "json",
        success: function (response) {
            var year = "";
            for (let i = 0; i < response.length; i++) {
                var date = response[i].GroupDate.split("/");
                if(date[1]!=year){
                    year = date[1];
                    $("#folder").append('<button class="w3-button w3-block w3-left-align" onclick="myAccFunc('+ year +')">Năm '+ year +'<i class="fa fa-caret-down"></i></button>');
                    $("#folder").append('<div id='+ year +' class="w3-hide w3-white w3-card"></div>');
                    for(i=1; i<13; i++){
                        var n = String(i<10 ? ("0"+i) : i);
                        var id = String(n + "/" + year);
                        $("#folder").find("#"+year).append('<a id='+id+' class="w3-bar-item w3-button" onclick="fetchStuList(this.id)">Tháng '+n+'</a>');
                    }
                }
            }
        },
        error: function (err) {  
          console.log(err);
          $("#participantList").append('<h1 style="text-align: center">Chưa có thí sinh nào đăng ký vào hệ thống</h1>');
        }
    });

    if (localStorage.getItem("lastSearchTerm")!="") {
        var lastSearch = localStorage.getItem("lastSearchTerm");
				$("#participantList").empty();
				$("#participantList").append('<table id='+lastSearch+' class="card-table"></table>');
				$.ajax({
					type: "POST",
					url: "../../action/center/GetListRegistAccount.php",
					data: {"GroupDate":lastSearch},
					dataType: "json",
					success: function (response) {
						for (let i = 0; i < response.length; i++) {
							if(i%4==0){
								$("#participantList").find(".card-table").append('<tr></tr>');
							}
							var _birthday = response[i].DateOfBirth.split("-");
							var birthday = _birthday[2] + "/" + _birthday[1] + "/" +_birthday[0];
							var accID = response[i].AccountID;
							var btnID = "id="+accID;
							$("#participantList").find(".card-table tr:last").append('<td><div id='+accID+' class="w3-card-4" style="width:100%"></div></td>');
							$("#participantList").find("#"+ accID).append('<header class="w3-container w3-blue"><h3>'+response[i].FullName+'</h3></header>');
							$("#participantList").find("#"+ accID).append('<div class="w3-container"><p>Ngày sinh: '+birthday+'<br>ID:<br> '+accID+'</p></div>');
							$("#participantList").find("#"+ accID).append('<button id='+btnID+' class="w3-button w3-block w3-indigo" onclick="moveHandler(this.id)">Xem chi tiết ></button>');
						}   
					},
					error: function() { 
						$("#participantList").append('<p style="text-align: center">Không có thí sinh nào</p>');
					}  
				});
    }else{
        $("#participantList").append('<h1 style="text-align: center">Chọn một thư mục để truy vấn</h1>');
    }
});

function fetchStuList(searchTerm) { 
	$("#participantList").empty();
  localStorage.setItem("lastSearchTerm", searchTerm);
	$("#participantList").append('<table id='+searchTerm+' class="card-table"></table>');
  $.ajax({
    type: "POST",
    url: "../../action/center/GetListRegistAccount.php",
    data: {"GroupDate":searchTerm},
    dataType: "json",
    success: function (response) {
      for (let i = 0; i < response.length; i++) {
				if(i%4==0){
					$("#participantList").find(".card-table").append('<tr></tr>');
				}
        var _birthday = response[i].DateOfBirth.split("-");
        var birthday = _birthday[2] + "/" + _birthday[1] + "/" +_birthday[0];
				var accID = response[i].AccountID;
				var btnID = "id="+accID;
        $("#participantList").find(".card-table tr:last").append('<td><div id='+accID+' class="w3-card-4" style="width:100%"></div></td>');
        $("#participantList").find("#"+ accID).append('<header class="w3-container w3-blue"><h3>'+response[i].FullName+'</h3></header>');
        $("#participantList").find("#"+ accID).append('<div class="w3-container"><p>Ngày sinh: '+birthday+'<br>ID:<br> '+accID+'</p></div>');
        $("#participantList").find("#"+ accID).append('<button id='+btnID+' class="w3-button w3-block w3-indigo" onclick="moveHandler(this.id)">Xem chi tiết ></button>');
      }   
    },
    error: function() { 
      $("#participantList").append('<p style="text-align: center">Không có thí sinh nào</p>');
    }  
  });
}