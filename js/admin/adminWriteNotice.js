const config = {language: 'fr', htmlEncodeOutput: false, entities: false, entities_latin: false, ForceSimpleAmpersand: true}
CKEDITOR.replace( 'content', config );

noticeSubmitHandler = () => {
    var title = $("#title").val();
    var content = CKEDITOR.instances["content"].getData();
    var r = confirm("Bạn chắc chắn đăng tải thông báo này");
    if (r) {
        if (validateWriteNotice(title, content)) {
            $.ajax({
                type: "POST",
                url: "../../action/center/InsertNewFeed.php",
                data: {"title": title, "content": content},
                dataType: "json",
                success: function (response) {
                    location.reload();
                },
                error: function (err) {console.log(err);}
            });
        } else {
           alert("Thiếu thông tin"); 
        }
    }
}

validateWriteNotice = (title, content) => {
    if(title=="" || content=="") return false;
    return true;
}