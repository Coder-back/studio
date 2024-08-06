// imagePreview 
let preview = document.querySelector(".imgDisplay");
let imgSelect = document.querySelector(".imageSelect");

preview.addEventListener('click', ()=>{
    imgSelect.click();
});

function imagePreview (e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = (e)=>{
            preview.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}

/*Contact form 
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
})*/
let isMenuActive = false;

//menu button
function menu() {

      document.querySelector(".nav ul").classList.toggle("show_menu");

}

//menu hide 
function menu_hide() {
    document.querySelector(".nav ul").classList.toggle("show_menu");
}