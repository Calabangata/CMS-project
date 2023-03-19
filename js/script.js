// const regForm = document.getElementById("login-form");
// const username = document.getElementById("firstname");

// regForm.addEventListener("submit", message);



// function message(event){
     //const message = document.getElementById('message');

//     if(username == ""){
//     message.style.display = 'block';
//     }
// };

$(document).ready(function(){
    
    // $('#btn-login').click(function(){
        

        
    //     $('#message').fadeIn('slow'); 
    // });

    setTimeout(function(){
        $('#message').fadeOut('slow');
    }, 3000);

});

// function validateForm() {
//     var author = document.getElementById("comment_author").value;
//     var email = document.getElementById("comment_email").value;

//     var content = document.getElementById("comment_content").value;

//     if (author == "" && email == "" && content == "") {
//       alert("Name must be filled out");
//       return false;
//     }
//   }