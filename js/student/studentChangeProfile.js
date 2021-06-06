const elementList = ["fullName", "year", "month", "day", "gender", "race", "cmnd", "PermanentResidence", "ProvinceName", 
                    "email", "phone", "address",
                    "IsPrioritize", "Area", 
                    "HKIGrade10", "HKIIGrade10", "TBGrade10", "HKIGrade11", "HKIIGrade11", "TBGrade11", "HKIGrade12", "HKIIGrade12", "TBGrade12",
                    "GraduatingYear", 
                    "Math", "Literature", "English", "Physics", "Chemistry", "Biology", "History", "Geography", "GDCD"];

validateForm = () => {
    var x = document.forms["profileForm"];
    for(let i=0; i<elementList.length-12; i++){
        if (x[elementList[i]].value == "") {
            alert("Bạn cần điền đầy đủ thông tin");
            return false;
        }
    }
    if(!validateCitizenID(x["cmnd"].value)){
        alert("Chứng minh nhân dân/Căn cước công dân không hợp lệ");
        return false;
    }
    if(!validateEmail(x["email"].value)){
        alert("Sai định dạng email");
        return false;
    }
    if(!validatePhoneNumber(x["phone"].value)){
        alert("Số điện thoại không hợp lệ");
        return false;
    }
    for(let i = 14; i<elementList.length; i++){
        if(i!=23) {
            if(!validateCompulsoryScore(x[elementList[i]].value)){
                alert("Điểm học tập không hợp lệ");
                return false;
            }
        }
    } 
    return true;
}

validateEmail = email => {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

validateCitizenID = id =>{
    if(id.length != 9 && id.length != 12)
    return false;
    for(let i = 0; i<id.length; i++){
        if(isNaN(id[i])) return false;
    }
    return true;
} 

validatePhoneNumber = phone => {
    if(phone.length != 10)
    return false;
    for(let i = 0; i<phone.length; i++){
        if(isNaN(phone[i])) return false;
    }
    return true;
}

validateCompulsoryScore = (score) => {
    if(score<0 || score>10) return false;
    return true;
}

$(function () {
    $.ajax({
        method: "GET",
        url: "../../action/center_student/GetListProvinceName.php",
        data: {},
        dataType: "json",
        success: function (response) {
            for(i=0; i<63; i++){
                $("#placeOfBirth").append($('<option/>', { 
                    value: response[i].ProvinceName ,
                    text : response[i].ProvinceName
                }));
            }
        }
    });

    $.ajax({
        url : "../../action/student/GetAccountDetail.php",
            method: 'GET',
                data: {},
                dataType: "json",
                success: function(data){
                   var dateOfBirth = new Date(data.DateOfBirth);
                   $("#fullname").val(data.FullName);
                   $("#"+data.Gender).prop("checked", true);
                   $("#year").val(dateOfBirth.getFullYear());
                   $("#month").val(dateOfBirth.getMonth()+1);
                   $("#day").val(dateOfBirth.getDate());
                   $("#race").val(data.Nation);
                   $("#cmnd").val(data.Identification);
                   $("#residence").val(data.PermanentResidence);
                   $("#placeOfBirth").val(data.ProvinceName);
                   $("#email").val(data.Email); 
                   $("#phone").val(data.PhoneNumber); 
                   $("#address").val(data.Address);
                   $("#priority").val(data.IsPrioritize);
                   $("#area").val(data.Area);
                   $("#10hk1").val(data.HKIGrade10);
                   $("#10hk2").val(data.HKIIGrade10);   
                   $("#10all").val(data.TBGrade10);   
                   $("#11hk1").val(data.HKIGrade11);   
                   $("#11hk2").val(data.HKIIGrade11);            
                   $("#11all").val(data.TBGrade11);   
                   $("#12hk1").val(data.HKIGrade12);   
                   $("#12hk2").val(data.HKIIGrade12);   
                   $("#12all").val(data.TBGrade12);   
                   $("#gradYear").val(data.GraduatingYear);   
                   $("#math").val(data.Math); 
                   $("#literature").val(data.Literature); 
                   $("#foreignLan").val(data.English); 
                   $("#physic").val(data.Physics); 
                   $("#chemistry").val(data.Chemistry); 
                   $("#biology").val(data.Biology); 
                   $("#history").val(data.History); 
                   $("#geography").val(data.Geography); 
                   $("#morality").val(data.GDCD);   
                }
    });  
});

