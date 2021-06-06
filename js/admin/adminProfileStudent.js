var id = parseURLParams(window.location.href).id[0];

convertData = (data) => {
    if(data!="" && data!="0") return data;
    else return "(Trống)";
} 

$.ajax({
    type: "POST",
    url: "../../action/center/GetRegistAccountDetail.php",
    data: {"accountID": id},
    dataType: "json",
    success: function (response) {
        $("#fullName").text(convertData(response.FullName));
        $("#gender").text(convertData(response.Gender));
        var _birthday = response.DateOfBirth.split("-");
        var birthday = _birthday[2] + "/" + _birthday[1] + "/" +_birthday[0];
        $("#birthday").text(convertData(birthday));
        $("#nation").text(convertData(response.Nation));
        $("#CMND").text(convertData(response.Identification));
        $("#residence").text(convertData(response.PermanentResidence));
        $("#placeOfBirth").text(convertData(response.ProvinceName));
        $("#email").text(convertData(response.Email));
        $("#phone").text(convertData(response.PhoneNumber));
        $("#address").text(convertData(response.Address));
        var isPrioritized;
        switch (response.IsPrioritize) {
            case "0":
                isPrioritized ="(Trống)";
                break;
            case "1":
                isPrioritized ="Không ưu tiên";
                break;
            case "2":
                isPrioritized ="Có ưu tiên";
                break;
            default:
                break;
        }
        $("#priority").text(convertData(isPrioritized));
        var area;
        switch (response.Area) {
            case "0":
                area ="(Trống)";
                break;
            case "1":
                area ="KV1";
                break;
            case "2":
                area ="KV2-NT";
                break;
            case "3":
                area ="KV2";
                break;
            case "4":
                area ="KV3";
                break;        
            default:
                break;
        }
        $("#area").text(convertData(area));
        $("#hk1L10").text(convertData(response.HKIGrade10));
        $("#hk2L10").text(convertData(response.HKIIGrade10));
        $("#l10").text(convertData(response.TBGrade10));
        $("#hk1L11").text(convertData(response.HKIGrade11));
        $("#hk2L11").text(convertData(response.HKIIGrade11));
        $("#l11").text(convertData(response.TBGrade11));
        $("#hk1L12").text(convertData(response.HKIGrade12));
        $("#hk2L12").text(convertData(response.HKIIGrade12));
        $("#l12").text(convertData(response.TBGrade12));
        $("#gradYear").text(convertData(response.GraduatingYear));
        $("#math").text(convertData(response.Math));
        $("#liter").text(convertData(response.Literature));
        $("#eng").text(convertData(response.English));
        $("#physic").text(convertData(response.Physics));
        $("#chem").text(convertData(response.Chemistry));
        $("#bio").text(convertData(response.Biology));
        $("#his").text(convertData(response.History));
        $("#geo").text(convertData(response.Geography));
        $("#GDCD").text(convertData(response.GDCD));
    }
});