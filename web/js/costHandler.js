$(function(){
    $("#selectall").click(function () {
        $('.case').prop('checked', this.checked);
    });

    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").prop("checked", true);
        } else {
            $("#selectall").prop("checked", false);
        }
    });
});