$(".note-editable").on("keyup", function(){
    var limitechar = 3000;
    var char = $(this).text();
    var totalchar = char.length;
    var totalCharLeft   =  limitechar - totalchar;
    if (totalCharLeft < 100) {
        $("#total-char").removeClass("text-success");       
        $("#total-char").addClass("text-danger");    
    }
    else{
        $("#total-char").removeClass("text-danger");       
        $("#total-char").addClass("text-success");       
    }
    if(totalCharLeft < 0){
        totalCharLeft = totalCharLeft * -1;
        $("#total-char").text(" Please check! Max "+ limitechar +" characters are allowed. ("+totalCharLeft+" characters are additional)");
        return false;
    }
    $("#total-char").text(" Only "+totalCharLeft+" characters left");
});

$(".count-me").on("keyup",function(){
    var limitechar = $(this).attr("maxLength");
    var char = $(this).val();
    var totalchar = char.length;
    var totalCharLeft   =  limitechar - totalchar;
    if (totalCharLeft < 100) {
        $(this).prev(".total-char").removeClass("text-success");       
        $(this).prev(".total-char").addClass("text-danger");    
    }
    else{
        $(this).prev(".total-char").removeClass("text-danger");       
        $(this).prev(".total-char").addClass("text-success");       
    }
    if(totalCharLeft < 0){
        totalCharLeft = totalCharLeft * -1;
        $("#total-char").text(" Please check! Max "+ limitechar +" characters are allowed. ("+totalCharLeft+" characters are additional)");
        return false;
    }
    $(this).prev(".total-char").text(" Only "+totalCharLeft+" characters are left.");
})