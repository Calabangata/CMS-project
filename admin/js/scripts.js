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

let userRole = document.getElementById('userRole').value;

if(userRole == 'Admin'){
setInterval(function(){
    loadOnlineusers();
}, 500);
}

$(document).ready(function(){

    $(".deleteLink").on('click', function(){


        let id = "";
        let delLink = "";

        switch ($(this).attr("id")) {

            case 'postDeletelink':
                id = $(this).attr("rel");
                delLink = "Posts.php?delete=" + id + " ";
                break;

                case 'postDeletelinkSub':
                id = $(this).attr("rel");
                delLink = "Posts.php?delete=" + id + " ";
                break;

            case 'userDeletelink':
                id = $(this).attr("rel");
                delLink = "Users.php?delete=" + id + " ";
                break;

            case 'commentDeletelink':
                id = $(this).attr("rel");
                delLink = "comments.php?delete=" + id + " ";
                break;

            case 'commentDeletelinkSub':
                id = $(this).attr("rel");
                delLink = "comments.php?delete=" + id + " ";
                break;

            case 'categoryDeletelink':
                id = $(this).attr("rel");
                delLink = "Categories.php?delete=" + id + " ";
                break;
        
            default:
                break;
        }
        

        $(".modal_delete").attr("href", delLink);

        $("#myModal").modal('show');

        // if($(this).attr("id") == "postDeletelink")
        // console.log($(this).attr("id"));
        
    });

});




