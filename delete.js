$(document).ready(function (e) {
    
    var mLst = $("#main");

    
    mLst.on("click", "button.delete", function (e) {
        e.preventDefault();
        //Show confirm button when delete is clicked
        $(this).hide();
        $(this).prev().show();
        
        //Revert back in 1.8 seconds
        setTimeout(()=>{
            $(this).show();
            $(this).prev().hide();
        }, 1800)
    });
});