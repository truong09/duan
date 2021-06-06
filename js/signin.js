function validate() {
	var arr = document.getElementsByTagName('input');
	var username = arr[0].value;
	var password = arr[1].value;
	if(username == "" || password == "") {
		return false;
	}
	return true;
}

$("form").submit(function (e) {
	try {
		if(!validate()){
			alert("Bạn chưa nhập tài khoản hoặc mật khẩu!");
			e.preventDefault();
			e.stopPropagation();
		}
	} catch (error) {
		console.log(error);
		e.preventDefault();
		e.stopPropagation();
	} 
});

$(".closebtn").click(function () { 
	console.log($(".closebtn"));
	var div = this.parentElement;
	div.style.opacity = "0";
	setTimeout(function(){ div.style.display = "none"; }, 600);
});