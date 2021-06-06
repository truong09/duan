var active = 0;
$("#sideBarBtn").click(function () { 
    console.log($("#sideBarBtn").attr("class"));
    if (active==0) {
        $(".slideButton").css("width", "37vw");
        active=1;
    }else{
        $(".slideButton").css("width", "47vw");
        active=0;
    }
});