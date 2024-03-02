$(document).ready(function (e) {
    var mLst = $("#main");

    //Remove "active" class when a new sort option is selected
    mLst.on("click", "button.sort:not(.active)", function (e) {
        mLst.find("button.active").removeClass("active");
    })
});
