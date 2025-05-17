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
  let roles = [];

  let roleIndex = 0;
  let charIndex = 0;
  let typingSpeed = 100;
  let deletingSpeed = 50;
  let isDeleting = false;
  
  function typeLoop() {
    const currentRole = roles[roleIndex];
    const display = document.getElementById("roleText");
  
    if (!currentRole) return; // jika role kosong, hentikan
  
    if (isDeleting) {
      charIndex--;
      display.textContent = currentRole.substring(0, charIndex--);
    } else {
      charIndex++;
      display.textContent = currentRole.substring(0, charIndex++);
    }
  
    if (!isDeleting && charIndex >= currentRole.length) {
      isDeleting = true;
      setTimeout(typeLoop, 1000); // delay sebelum menghapus
      return;
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      roleIndex = (roleIndex + 1) % roles.length;
    }
  
    setTimeout(typeLoop, isDeleting ? deletingSpeed : typingSpeed);
  }
  
  // Fetch roles dari server dan mulai animasi
  fetch('resource/api/roles.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      roles = data.roles.map(item => item.role);
console.log(data);
      if (roles.length > 0) {
        typeLoop();
      } else {
        console.warn("Daftar role kosong");
      }
    })
    .catch(error => {
      console.error("Terjadi kesalahan:", error);
      // Fallback roles jika fetch gagal
      roles = ["Web Developer", "Cybersecurity Enthusiast"];
      typeLoop();
    });
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
