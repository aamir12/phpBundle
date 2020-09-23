function hidePageLoader(){
    if($("#loading-wrapper").length){
        $("#loading-wrapper").fadeOut(1500);
    }
}

function showPageLoader(){
    if($("#loading-wrapper").length){
     $("#loading-wrapper").show();
    }
}

function redirect(path){
    window.location.replace(path);
}