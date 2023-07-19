$(document).ready(function(){
    const message = document.getElementById("message");
    console.log(message);
    if(message.textContent == "This email is already used!" || message.textContent == "The fields cannot be empty!" || message.textContent == "The username you want to use is already taken!"){
        message.style.color = 'orange';
    } else if(message.textContent == "Thank you for the registration!"){
        message.style.color = 'limegreen';
    }
    
    setTimeout(function(){
        $('#message').fadeOut('slow');
    }, 3000);

});
