$(document).ready(function() {
    $('#summernote').summernote();
  });

$(document).ready(function () {
    
    $('#selectAllBoxes').click(function(event){

        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            })
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            })
        }

    });

    //var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    var div_box = "<div id='load-screen'>\
                        <div class='Loadcontainer'>\
                            <div class='ring'></div>\
                            <div class='ring'></div>\
                            <div class='ring'></div>\
                        </div>\
                        <div class='text-container'>\
                            <div class='loading-text'>Loading</div>\
                                <div class='dots'>\
                                    <span>.</span>\
                                    <span>.</span>\
                                    <span>.</span>\
                                </div>\
                            </div>\
                    </div>";
    

    $("body").prepend(div_box);

    window.onload = function() {
        $('body').fadeIn(600);
        console.log('FULLY LOADED');
        $('#load-screen').fadeOut(600, function(){
            $(this).remove();
        });
    };

    // $('#load-screen').delay(5000).fadeOut(600, function(){
    //     $(this).remove();
    // });

});

function loadOnlineusers(){

    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });

}

setInterval(function(){
    loadOnlineusers();
}, 500);




