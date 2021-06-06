var id = parseURLParams(window.location.href).id[0];

var sequence;
$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../action/student/GetListNewFeed.php",
    data: {},
    dataType: "json",
    success: function (response) {
      sequence = response;
      var maxIndex = response[0].NewFeedID;
      for (let i = 0; i < response.length; i++) {
        if(response[i].NewFeedID == id) {
          $("#title").text(sequence[i].Title);
          $("#date").text(convertDate(sequence[i].CreatedDate));
          $("#content").html(sequence[i].Content);
        }else{
          $("#notice-list").append('<li><a href="displayNotice.php?id='+response[i].NewFeedID+'">'+
            '['+convertDate(sequence[i].CreatedDate)+'] '+titleProcessLarge(sequence[i].Title)+
            '</a></li>');
        }
      }
      setPrevLink(id);
      setNextLink(id, maxIndex);
    },
    complete: function (xhr, status) {  
      if (status != "success") {
        alert("Có lỗi xảy ra, vui lòng thử lại");
      }
    }
  });
});

setPrevLink = index => {
  if (index == 1) {
    $("#prev").hide();
  }else{
    $("#prev").attr("href", "displayNotice.php?id="+(parseInt(index)-1));
  }
}

setNextLink = (index, maxIndex) => {
  if (index == maxIndex) {
    $("#next").hide();
  }else{
    $("#next").attr("href", "displayNotice.php?id="+(parseInt(index)+1));
  }
}