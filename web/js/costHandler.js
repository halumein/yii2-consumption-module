$(function() {

    var $tst = $('[data-role=test]');

    console.log($tst);


    $tst.on('click', function(){
        console.log('test click');
    });

    $("#selectall").on('click', function () {
        var self = this;
        console.log("selectAll clicked");
        $(".case").attr("checked", self.checked);
    });

    $(".case").click(function(){
        console.log("case clicked");

        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").attr("checked", false);
        }

    });
});
