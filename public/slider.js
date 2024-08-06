
var slides = document.querySelectorAll('.card_slide');
let btns_container = document.querySelector('.manual_nav');

let div_no = 0;
while(div_no < slides.length) {
    btns_container.innerHTML += "<div class='manual_btn'></div>";
    div_no++;
}
 
//js for image slider autoplay nav
let btns = document.querySelectorAll('.manual_btn');

btns[0].classList.add('active');

function manualNavigate(randomBtn){
    slides.forEach((cardSlide) => {
        cardSlide.classList.remove('active');
    
        btns.forEach((btn) => {
        btn.classList.remove('active');
        });
    });

    slides[randomBtn].classList.add('active');
    btns[randomBtn].classList.add('active');
}

btns.forEach((button, i)=>{
    button.addEventListener("click", ()=>{
        manualNavigate(i);
    });
});

function repeat(){
	let active = document.getElementsByClassName('active');
	let i = 0;

	function repeater(){
	setTimeout(function(){
	[...active].forEach((activeSlide) =>{
activeSlide.classList.remove('active');
	});

slides[i].classList.add('active');
btns[i].classList.add('active');
i++;

/*if(slides.length === 1){
	i = 0;
}*/

if(i >= slides.length){
	i = 0;
}
repeater();
	}, 5000);
	}
	repeater();
}
repeat();
