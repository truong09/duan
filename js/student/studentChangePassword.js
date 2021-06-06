validatePassword = () => {
    if($("#newpw").val() == $("#renewpw").val()) return true;
    return false;
}

validatePasswordLength = () => {
    if($("#newpw").val().length >= 8) return true;
    return false;
}

validateInput = () => {
    if($("#oldpw").val()=="" || $("#newpw").val()=="" || $("#renewpw").val()=="") return false;
    return true;
}

validateDuplicate = () => {
    if($("#newpw").val() == $("#oldpw").val()) return false;
    return true;
}

validateForm = () => {
    if(!validateInput()){
        alert("Vui lòng điền đủ thông tin");
        return false;
    }
    if (!validatePasswordLength()) {
        alert("Mật khẩu phải bao gồm ít nhất 8 kí tự");
        return false;
    }
    if (!validateDuplicate()) {
        alert("Mật khẩu mới trùng với mật khẩu cũ");
        return false;
    }
    if(!validatePassword()){
        alert("Nhập lại mật khẩu không trùng khớp");
        return false;
    }
    return true;
}