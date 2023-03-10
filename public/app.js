//Contact form 
$(document).ready(function () {
    $('.submit').click(function (event) {

        var email = $('.email').val()
        var subject = $('.subject').val()
        var message = $('.message').val()
        var status = $('.status')
        status.empty()

        if (email.length > 5 && email.includes('@') && email.includes('.')) {
            status.append('<div>Email is valid</div>')
        }
        else {
            event.preventDefault()
            status.append('<div>Email is not valid</div>')
        }

        if (subject.length >= 1) {
            status.append('<div>Subject is valid</div>')
        }
        else {
            event.preventDefault()
            status.append('<div>Subject is not valid</div>')
        }

        if (message.length >= 1) {
            status.append('<div>Message is valid</div>')
        }
        else {
            event.preventDefault()
            status.append('<div>Message is not valid</div>')
        }
    })
})

// const menuButton = document.getElementById(".menu-button");
// const menu = document.getElementById(".nav");

//menu button
function menu() {
    document.querySelector(".nav ul").classList.toggle("show");
    // menuButton.addEventListener("click", () => {
    //     menu.style.display = "block";
    // });
}


//menu hide 
function menu_hide() {
    document.querySelector(".nav ul").classList.toggle("show");
    // menuButton.addEventListener("click", () => {
    //     menu.style.display = "none";
    // });

}



