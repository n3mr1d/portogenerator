<?php 
// config db
define("DBHOST","localhost");
define("DBNAME","porto");
define("DBPASS","180406");
define("DBUSER","root");
// autoload config
require_once __DIR__ . '/autoload.php';
/**
 * print start function
 * 
 * @param string $css,$title,$js
 */


function print_start(string $title, string $css=""){
  echo'  <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Portofolio | ' . $title .'</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
        ';
     
   
    if(empty($css)){
        echo'<link rel="stylesheet" href="/resource/style/global.css">';
        echo'<link rel="stylesheet" href="/font/fontawesome-free-6.7.2-web/css/all.min.css">'; 
    }else{
        echo'<link rel="stylesheet" href="/font/fontawesome-free-6.7.2-web/css/all.min.css">'; 
        echo'<link rel="stylesheet" href="/resource/style/global.css">';
        echo'<link rel="stylesheet" href="/resource/style/' . $css . '.css">'; 
    }
echo'</head>
    <body>';
    navbar();

}
function jsallow(string $name){
        echo'<script src="/resource/script/'. $name .'.js"></script>';
}
function showhome(){
  
    print_start('home','home');
echo<<<HTML
<div class="theme-toggle">
    <button id="theme-switch"><i class="fas fa-moon"></i></button>
</div>

<div class="kontainer-hero">
    <div class="kontainer-photo">
        <img src="/resource/images/profile.jpg" alt="Profile Picture">
    </div>
    <div class="kontainer-text">
        <div class="animation-text">
            <span id="autotext1"></span><span id="cursor">|</span>
            <div class="kontainer-subtitle">
            <div class="kontainerbox">
                <span class="subtitle" id="roleText"></span>
</div>
                <span class="subtitle">Just Developer Amatir</span>
            </div>
        </div>
        <div class="kontainer-social">
        <span class="title-social">Connect With Me</span>
        <div class="social-links">
            <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
        </div>
    </div>
</div>
<!-- </div> -->

<section class="about-section">
    <h2 class="section-title">About Me</h2>
    <div class="about-content">
        <p>I am a passionate web developer with expertise in PHP, JavaScript, and modern web technologies. With a strong background in cybersecurity, I create secure and efficient web applications.</p>
    </div>
</section>

<section class="skills-section">
    <h2 class="section-title">My Skills</h2>
    <div class="skills-container">
        <div class="skill-item">
            <div class="skill-name">PHP</div>
            <div class="skill-bar"><div class="skill-progress" style="width: 90%"></div></div>
        </div>
        <div class="skill-item">
            <div class="skill-name">JavaScript</div>
            <div class="skill-bar"><div class="skill-progress" style="width: 85%"></div></div>
        </div>
        <div class="skill-item">
            <div class="skill-name">HTML/CSS</div>
            <div class="skill-bar"><div class="skill-progress" style="width: 95%"></div></div>
        </div>
        <div class="skill-item">
            <div class="skill-name">Cybersecurity</div>
            <div class="skill-bar"><div class="skill-progress" style="width: 80%"></div></div>
        </div>
    </div>
</section>

<section class="projects-section">
    <h2 class="section-title">Featured Projects</h2>
    <div class="projects-container">
        <div class="project-card">
            <div class="project-image">
                <img src="/resource/images/project1.jpg" alt="Project 1">
            </div>
            <div class="project-info">
                <h3>E-Commerce Platform</h3>
                <p>A secure online shopping platform built with PHP and MySQL</p>
                <div class="project-tags">
                    <span class="tag">PHP</span>
                    <span class="tag">MySQL</span>
                    <span class="tag">JavaScript</span>
                </div>
                <a href="#" class="project-link">View Project</a>
            </div>
        </div>
        <div class="project-card">
            <div class="project-image">
                <img src="/resource/images/project2.jpg" alt="Project 2">
            </div>
            <div class="project-info">
                <h3>Security Audit Tool</h3>
                <p>Web application vulnerability scanner with detailed reporting</p>
                <div class="project-tags">
                    <span class="tag">PHP</span>
                    <span class="tag">Security</span>
                    <span class="tag">API</span>
                </div>
                <a href="#" class="project-link">View Project</a>
            </div>
        </div>
    </div>
</section>

<section class="contact-section">
    <h2 class="section-title">Get In Touch</h2>
    <div class="contact-form">
        <form id="contact-form">
            <div class="form-group">
                <input type="text" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <textarea placeholder="Your Message" rows="5" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</section>
HTML;
    jsallow('home');

    endhtml();
}

function endhtml(){
    echo'</body></html>';
}
