$(document).ready(function () {
    var thisYear = new Date().getFullYear();
    for(i=thisYear; i>1969; i--){
        $("#year").append($('<option/>', { 
            value: i,
            text : i 
        }));
    }
    for(i=1; i<13; i++){
        $("#month").append($('<option/>', { 
            value: i,
            text : i 
        }));
    }
    if($("#month").val() == 1 || 
    $("#month").val() == 3 || 
    $("#month").val() == 5 || 
    $("#month").val() == 7 || 
    $("#month").val() == 8 || 
    $("#month").val() == 10 || 
    $("#month").val() == 12) {
        for(i=1; i<32; i++){
            $("#day").append($('<option/>', { 
                value: i,
                text : i 
            }));
        }
    }else if($("#month").val() == 4 ||
    $("#month").val() == 6 ||
    $("#month").val() == 9 ||
    $("#month").val() == 11){
        for(i=1; i<31; i++){
            $("#day").append($('<option/>', { 
                value: i,
                text : i 
            }));
        }
    }else{
        for(i=1; i<29; i++){
            $("#day").append($('<option/>', { 
                value: i,
                text : i 
            }));
        }
    }
    if(isLeapYear($("#year").val()) && $("#month").val() == 2){
        $("#day").append($('<option/>', { 
            value: 29,
            text : 29 
        }));
    }
});

isLeapYear = (year) => {
    if((year % 4===0 &&year%100 !==0 && year % 400 !==0)||(year%100===0 && year % 400===0)) return true;
    else return false;
}

$().ready(function () {  

    $("#month").change(function () { 
        $("#day option[value='29']").remove();
        $("#day option[value='30']").remove();
        $("#day option[value='31']").remove();
        if($("#month").val() == 1 || 
        $("#month").val() == 3 || 
        $("#month").val() == 5 || 
        $("#month").val() == 7 || 
        $("#month").val() == 8 || 
        $("#month").val() == 10 || 
        $("#month").val() == 12) {
            for(i=29; i<32; i++){
                $("#day").append($('<option/>', { 
                    value: i,
                    text : i 
                }));
            }
        }else if($("#month").val() == 4 ||
        $("#month").val() == 6 ||
        $("#month").val() == 9 ||
        $("#month").val() == 11){
            for(i=29; i<31; i++){
                $("#day").append($('<option/>', { 
                    value: i,
                    text : i 
                }));
            }
        }else{
            if(isLeapYear($("#year").val())){
                $("#day").append($('<option/>', { 
                    value: 29,
                    text : 29 
                }));
            } 
        }
        
    });

    $("#year").change(function () {
        if($("#month").val() == 2){
            if(isLeapYear($("#year").val())){
                $("#day option[value='29']").remove();
                $("#day").append($('<option/>', { 
                    value: 29,
                    text : 29 
                }));
            }else{
                $("#day option[value='29']").remove();
            }   
        }
    });
});