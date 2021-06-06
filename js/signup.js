validate = () => {
    if($("#password").val().length < 8){
        alert("Mật khẩu phải chứa tối thiểu 8 kí tự");
        return false;
    }
    if($("#password").val() != $("#enterpassword").val()){
        alert("Xác nhận mật khẩu không trùng khớp");
        return false;
    }
    if(!validatePhoneNumber($("#phone").val()) && $("#phone").val() != ""){
        alert("Số điện thoại không hợp lệ");
        return false; 
    }
    if(!validateEmail($("#email").val()) && $("#email").val() != ""){
        alert("Sai định dạng email");
        return false;   
    }
    if(!validateCitizenID($("#cmnd").val()) && $("#cmnd").val() != ""){
        alert("Chứng minh nhân dân/ Căn cước công dân không hợp lệ");
        return false   
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

$("#exitbtn").click(function (e) { 
    window.location.href = "signin.php";
});