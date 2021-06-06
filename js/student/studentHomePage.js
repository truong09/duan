var now = new Date().toISOString();
var thisYear = now.split("-")[0];
$("#time").text("Tuyển sinh "+ thisYear);

var hasAnyNotice = true;

// Original title
var ORIGINAL_TEXT = {};
// Pagination variable
pageSize = 4;
slideSize = 5;
startPage = 0;
currentSlide = 0;

var pageCount;
var totalSlidepPage;

var prev = $("<a/>").addClass("prev w3-button w3-bar-item").html("&laquo;").click(function(){
    startPage-=5;
    slideSize-=5;
    currentSlide--;
    slide();
});

prev.hide();

var next = $("<a/>").addClass("next w3-button w3-bar-item").html("&raquo;").click(function(){
    startPage+=5;
    slideSize+=5;
    currentSlide++;
    slide();
});

next.hide();

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "../../action/student/GetListNewFeed.php",
        data: [],
        dataType: "json",
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                var date = convertDate(response[i].CreatedDate);
                ORIGINAL_TEXT[i] = response[i].Title;
                $("#notice-list").append('<div class="notice" id="link-'+response[i].NewFeedID+'">'+
                    '<div class="w3-card-4" style="width:100%">'+
                        '<header class="w3-container w3-indigo">'+
                            '<h3>'+titleProcessSmall(response[i].Title)+'</h3>'+
                            '<p>'+date+'</p>'+
                        '</header>'+
                        '<div class="w3-container">'+
                            '<div style="overflow:hidden; height:200px">'+response[i].Content+'</div>'+
                        '</div>'+
                        '<button class="w3-button w3-block w3-indigo" id='+response[i].NewFeedID+' onclick="noticeClickHandler(this.id)">Xem chi tiết</button>'+
                '</div></div>');
            }
        },
        error: function (err) {
            console.log(err);
            hasAnyNotice = false;
        },
        complete: function () {  
            if (hasAnyNotice) {
                pageCount =  $(".notice").length / pageSize;
                totalSlidepPage = Math.ceil(pageCount / slideSize);
                if(totalSlidepPage>slideSize) next.show();
                for(var i = 0 ; i<pageCount;i++){
                    $("#numList").append('<a id="item-'+i+'" class="w3-button w3-bar-item" onclick="pageClickHandler(this.id)">'+(i+1)+'</a>');
                    if(i>=slideSize){
                        $("#numList a").eq(i).hide();
                    }
                }
                $("#numList").prepend(prev).append(next);
                $("#item-0").addClass("w3-green");
                showPage(1);
            }else{
                $("#notice-list").append('<p class="empty-notice">Không có thông báo nào</p>');
            }
        }
    });
});

$(window).resize(function () { 
    if (hasAnyNotice) {
        $.each($(".notice").find("h3"), function (indexInArray, valueOfElement) { 
            var text = ORIGINAL_TEXT[indexInArray];
            $(".notice").find("h3")[indexInArray].childNodes[0].nodeValue = titleProcessSmall(text);
        });
    }
});

slide = function(){
    $("#numList a").hide();
    for(t=startPage;t<slideSize;t++){
      $("#numList a").eq(t+1).show();
    }
    if(startPage == 0){
      next.show();
      prev.hide();
    }else if(currentSlide == totalSlidepPage ){
      next.hide();
      prev.show();
    }else{
      next.show();
      prev.show();
    }   
}

showPage = function(page) {
    $(".notice").hide();
    $(".notice").each(function(n) {
        if (n >= pageSize * (page - 1) && n < pageSize * page)
            $(this).show();
    });        
}

pageClickHandler = (id) => {
    $("#numList a").removeClass("w3-green");
    $("#"+id).addClass("w3-green");
    showPage(parseInt($("#"+id).text()));
}

noticeClickHandler = (id) => {
    window.location.href = "displayNotice.php?id=" + id;
}