  const text = "HI. I'm <span id='name'></span> ...";
  const speed = 100;
  let i = 0;

  function typewriter() {
    if (i < text.length) {
      let currentChar = text.charAt(i);

      if (currentChar === "<") {
        let tag = "";
        while (i < text.length && text.charAt(i) !== ">") {
          tag += text.charAt(i);
          i++;
        }
        if (i < text.length) {
          tag += ">";
          i++;
        }

        document.getElementById("autotext1").innerHTML += tag;
        document.getElementById("name").textContent = "NAMERAID";
      } else {
        document.getElementById("autotext1").innerHTML += currentChar;
        i++;
      }

      setTimeout(typewriter, speed);
    }
  }

  // Start the typewriter effect when the page loads
  window.addEventListener('DOMContentLoaded', () => {
    typewriter();
  });

  const roles = ["Full-Stack ", "Backend ", "DevOps ", "UI/UX "];
  let roleIndex = 0;
  let charIndex = 0;
  let typingSpeed = 100;
  let deletingSpeed = 100;
  let isDeleting = false;
  
  function typeLoop() {
    const currentRole = roles[roleIndex];
    const display = document.getElementById("roleText");
  
    if (isDeleting) {
      display.textContent = currentRole.substring(0, charIndex--);
    } else {
      display.textContent = currentRole.substring(0, charIndex++);
    }
  
    if (!isDeleting && charIndex === currentRole.length) {
      isDeleting = true;
      setTimeout(typeLoop, 1000); // delay before deleting
      return;
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      roleIndex = (roleIndex + 1) % roles.length;
    }
  
    setTimeout(typeLoop, isDeleting ? deletingSpeed : typingSpeed);
  }
  
  typeLoop();
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('desktop-nav');
    const scrollTop = window.scrollY;
    const docHeight = document.body.scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;

    if (scrollPercent >= 30) {
      navbar.classList.add('scrolled');
      navbar.classList.remove('normal');
    } else {
      navbar.classList.remove('scrolled');
      navbar.classList.add('normal');
    }

  });
