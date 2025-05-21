<?php 
use Dom\HTMLCollection;


// config db
define("DBHOST","localhost");
define("DBNAME","porto");
define("DBPASS","180406");
define("DBUSER","root");
// autoload config
require_once __DIR__ . '/autoload.php';
route();
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
<link rel="icon" href="resource/src/logo/logo.svg">        
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
// function show list 

function showtable(){
global $db;
// fetch databaseLl
$dbarray = "SELECT * FROM project";
$stmt = $db->prepare($dbarray);
$stmt->execute();
  $ron = $stmt->fetchAll(PDO::FETCH_OBJ);
          echo<<<HTML
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>action</th>
    </tr>
  HTML;

  $id = 0;
foreach($ron as $row) {
    $id++;
    echo '<tr>';
      echo '<td>' . $id . '</td>';
      echo '<td>' . htmlspecialchars($row->title) . '</td>';
      echo '<td>';
        echo '<form action="index.php" method="GET">';
          echo '<input type="hidden" name="action" value="edit">';
          echo '<input type="hidden" name="id"     value="' . $row->id . '">';
          echo '<button type="submit">Edit</button>';
        echo '</form> ';
        
        echo '<form action="" method="POST">';
          echo '<input type="hidden" name="action" value="delete">';
          echo '<input type="hidden" name="id"     value="' . $row->id . '">';
          echo '<button type="submit">Delete</button>';
        echo '</form>';
      echo '</td>';
    echo '</tr>';
}
};
function showdonate(){
  print_start('donate','donate');
  
  // Fetch cryptocurrency data from database
  global $db;
  $crypto_query = "SELECT * FROM cry ORDER BY name ASC";
  $stmt = $db->prepare($crypto_query);
  $stmt->execute();
  $cryptocurrencies = $stmt->fetchAll(PDO::FETCH_OBJ);
  
  jsallow('donate'); // Assuming jsallow function exists to include JS files
  
echo<<<HTML
  <section class="kontainer-donate">
    <div class="donate-header">
      <h1>Support Our Project</h1>
      <p class="donate-subtitle">Your contribution helps us continue building amazing features</p>
    </div>
    
    <div class="donate-options">
      <div class="donate-tabs">
        <button class="tab-btn active" data-target="crypto">Cryptocurrency</button>
        <button class="tab-btn" data-target="bank">Bank Transfer</button>
        <button class="tab-btn" data-target="other">Other Methods</button>
      </div>
      
      <div class="tab-content active" id="crypto-tab">
        <div class="crypto-explanation">
          <h3>Donate with Cryptocurrency</h3>
          <p>Cryptocurrency donations are secure, fast, and have lower transaction fees.</p>
        </div>
        
        <div class="kontainer-coin">
HTML;

  // Display cryptocurrency options
  foreach($cryptocurrencies as $crypto) {
    echo<<<HTML
          <div class="coin-card">
            <div class="coin-icon">
              <i class="fa {$crypto->icon}" aria-hidden="true"></i>
            </div>
            <div class="coin-details">
              <h4>{$crypto->name}</h4>
              <div class="address-container">
                <input type="text" class="crypto-address" value="{$crypto->addre}" readonly>
                <button class="copy-btn" data-address="{$crypto->addre}">
                  <i class="fa fa-copy"></i>
                </button>
              </div>
              <div class="qr-container" id="qr-{$crypto->id}"></div>
            </div>
          </div>
HTML;
  }

echo<<<HTML
        </div>
      </div>
      
      <div class="tab-content" id="bank-tab">
        <div class="bank-details">
          <h3>Bank Transfer Details</h3>
          <div class="bank-info">
            <p><strong>Bank Name:</strong> Example Bank</p>
            <p><strong>Account Name:</strong> Project Fund</p>
            <p><strong>Account Number:</strong> 1234-5678-9012-3456</p>
            <p><strong>SWIFT/BIC:</strong> EXAMPLEXXX</p>
            <p><strong>Reference:</strong> Please include "Donation" in the reference</p>
          </div>
        </div>
      </div>
      
      <div class="tab-content" id="other-tab">
        <div class="other-methods">
          <h3>Other Donation Methods</h3>
          <div class="method-cards">
            <div class="method-card">
              <i class="fa fa-credit-card"></i>
              <h4>Credit Card</h4>
              <p>Coming soon</p>
            </div>
            <div class="method-card">
              <i class="fa fa-paypal"></i>
              <h4>PayPal</h4>
              <p>Coming soon</p>
            </div>
            <div class="method-card">
              <i class="fa fa-gift"></i>
              <h4>Gift Cards</h4>
              <p>Coming soon</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="donation-faq">
      <h3>Frequently Asked Questions</h3>
      <div class="faq-item">
        <div class="faq-question">How are donations used?</div>
        <div class="faq-answer">Your donations directly support server costs, development, and new features.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Are donations tax-deductible?</div>
        <div class="faq-answer">Please consult with your tax advisor regarding the tax deductibility of your donation.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Can I donate anonymously?</div>
        <div class="faq-answer">Yes, cryptocurrency donations can be made anonymously.</div>
      </div>
    </div>
    
    <div class="donation-thankyou">
      <h2>Thank You For Your Support!</h2>
      <p>Every donation, no matter the size, makes a difference to our project.</p>
    </div>
  </section>
HTML;
  endhtml();
}
