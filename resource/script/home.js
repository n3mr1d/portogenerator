
const text = "Im full stack dev";
const speed =100;
let i =0;
function typewrit(){
    if(i< text.length){
        document.getElementById("typewriting").innerHTML += text.charAt(i);
        i++;
        setTimeout(typewrit, speed);
    }

}
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('desktop-nav');
    const scrollTop = window.scrollY;
    const docHeight = document.body.scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;

    if (scrollPercent >= 30) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
typewrit();