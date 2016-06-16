$(document).ready(function () { // The document is ready now. Place your javascript inside these brackets...
    console.log("document loaded");
    var select = $("#selectMode");
    var difficult = $("#difficulty");
    difficult.hide();
    select.change(function () {
        if (select.val() == "initiatePvCom") {
            difficult.fadeIn(300);
        } else {
            difficult.fadeOut(300);
        }
    })

}); // End of the "document-ready"-block