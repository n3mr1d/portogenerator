<?php 


// config db
define("DBHOST","localhost");
define("DBNAME","porto");
define("DBPASS","180406");
define("DBUSER","root");

// config history school
$school = 
["TK"=>['name'=>'Taman Kanak-Kanak',
        'schoolname'=>'KARTIKA IV & VI',
        'Tahun/ajaran'=>'2011/2013',
        'deskrip'=>'loremipsum'],
"SD"=>['name'=>'Sekolah Dasar',
        'schoolname'=>'SDN Polehan 4 Malang',
        'Tahun/ajaran'=>'2013/2019',
        'deskrip'=>'lorem ipsum'],
"SMP"=>['name'=>'Sekolah Menengah Pertama',
        'schoolname'=>'SMP AL-Amin Malang',
        'Tahun/ajaran'=>'2019/2022',
        'deskrip'=>'lorem ipsum'],
"SMA"=>['name'=>'Sekolah Menengah Atas',
        'schoolname'=>'SMAN 1 Kota Malang',
        'Tahun/ajaran'=>'2022/2025',
        'deskrip'=>'lorem ipsum'] ];
// autoload config function
require_once __DIR__ . '/autoload.php';
route();
/**
 * print start function
 * 
 * @param string $css,$title,$js
 */


$error= '';

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
}function showhome() {
  global $school;

  print_start('home', 'home');
  shownotification();

  echo <<<HTML
  <div class="kontainer-hero">
      <div class="kontainer-photo">
          <img src="/resource/src/nameraid.png" alt="Profile Picture">
      </div>
      <div class="kontainer-text">
          <div class="animation-text">
              <div id="text"><span>|</span></div>
              <span id="autotext1"></span><span id="cursor">|</span>
              <div class="kontainer-subtitle">
                  <div class="kontainerbox">
                      <span class="subtitle" id="roleText"></span>
                  </div>
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

  <section class="about-section">
      <h2 class="section-title">About</h2>
      <div class="kontainer-isitext">
          <div class="border-img">
              <img src="https://placehold.co/200x200" alt="Placeholder Image">
              <span id="role">Noob</span>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto voluptatibus maxime debitis rerum sunt ex error numquam nisi minus, ipsa reiciendis corporis? Laboriosam odio vel quod saepe maiores explicabo recusandae, praesentium vero sed tenetur laborum iusto, amet voluptates deserunt.</p>
      </div>
  </section>
  <section class="github-section">
      <h2 class="section-title">GitHub Profile</h2>
      <div class="kontainer-github">
          <img src="https://placehold.co/200x200" alt="GitHub Avatar" id="github-avatar">

          <div id="info-git">
              <div class="user-flex">
                  <span class="label">Name:</span>
                  <div id="username" class="info-value"></div>
              </div>
              
              <div class="kontainer-git">
                  <div class="block-git">
                      <span class="label">Followers</span>
                      <div id="followers" class="info-count"></div>
                  </div>
                  <div class="block-git">
                      <span class="label">Following</span>
                      <div id="following" class="info-count"></div>
                  </div>
                  <div class="block-git">
                      <span class="label">Repos</span>
                      <div id="repo" class="info-count"></div>
                  </div>
              </div>
              
              <div class="user-flex">
                  <span class="label">Bio:</span>
                  <div id="bio" class="info-value"></div>
              </div>
              
              <div class="button-git">
                  <a id="urlgit" class="button-github" href="" target="_blank">
                      <i class="fab fa-github"></i> View Profile <i class="fas fa-external-link-alt"></i>
                  </a>
              </div>
          </div>
      </div>
      
      <h3>Contribution Activity</h3>
      <div id="kontainer-contributions">
        <span>Total Contributions</span>
        <span id="total-contributions"></span>
      </div>
      <div id="contribution-calendar" class="contribution-calendar"></div>
  </section>
  <section class="section-history">
      <h2 class="section-title">Graduate</h2>
      <div class="history-container">
          <div class="timeline" id="education-timeline">
HTML;

  foreach ($school as $key => $isi) {
      echo '<div class="timeline-item">
              <div class="timeline-dot"></div>
              <div class="timeline-content">
                  <h3 class="timeline-title">' . $isi['name'] . '</h3>
                  <h4 class="timeline-institution">' . $isi['schoolname'] . '</h4>
                  <p class="timeline-date">' . $isi['Tahun/ajaran'] . '</p>
                  <p class="timeline-description">'. $isi['deskrip'] .'</p>
              </div>
          </div>';
  }

  echo '
          </div>
      </div>
  </section>

  <section class="skills-section">
      <h2 class="section-title">My Skills</h2>
      <div class="skills-container">
          <img src="https://placehold.co/90x90" alt="Skill Icon">
          <div class="skill-item">
              <div class="skill-name"><span class="title-skill">PHP</span> <span class="title-present">90%</span></div>
              <div class="skill-bar">
                  <div class="skill-progress" style="width: 90%"></div>
              </div>
          </div>
      </div>
  </section>

  <section class="section-certification">
      <h2 class="section-title">Certification</h2>
      <div class="box-serifikat">
          <img src="https://placehold.co/300x200" alt="Certification Image">
          <h3 class="title-sertif">example</h3>
          <div class="linkhref">
              <a href="https://google.com">view more <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
  </section>

  <section class="projects-section">
      <h2 class="section-title">Featured Projects</h2>
      <div class="projects-container">
          <div class="project-card">
              <div class="project-image">
                  <div class="showlink">
                      <a href="#"><i class="fab fa-github"></i> Github</a>
                      <a href="#"><i class="fas fa-external-link-alt"></i> Demo</a>
                  </div>
                  <img src="https://placehold.co/400x400" alt="Project 1">
              </div>
              <div class="project-info">
                  <h3>E-Commerce Platform</h3>
                  <p>A secure online shopping platform built with PHP and MySQL</p>
                  <div class="project-tags">
                      <span class="tag">PHP</span>
                      <span class="tag">MySQL</span>
                      <span class="tag">JavaScript</span>
                  </div>
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
  </section>';

  jsallow('home');
  footerku();
  endhtml();
}


function endhtml(){
    echo'</body></html>';
}
// function show list 

function showNotification() {
    if (!empty($_SESSION['error'])) {
        $error = htmlspecialchars($_SESSION['error']); // Mencegah XSS

        echo <<<HTML
        <div class="kontainer-notif">
            <div class="kontainer-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div class="kontainer-isi">
                <span class='item-isi'>{$error}</span>
            </div>
        </div>
        HTML;

        unset($_SESSION['error']); // Hapus hanya error, bukan seluruh session
    }
}


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

    <div class="donate-options">

      <div class="tab-content active" id="crypto-tab">
        <div class="crypto-explanation">
          <h1 class="section-title">Donate</h1>
          <p>Cryptocurrency donations are secure, fast, and have lower transaction fees.</p>
        </div>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

        <div class="kontainer-coin">
HTML;

  // Display cryptocurrency options
foreach($cryptocurrencies as $crypto) {
  $inputId = "address-" . md5($crypto->addre); 

  echo <<<HTML
    <div class="coin-card">
      <div class="coin-icon">
        <i class="fa {$crypto->icon}" aria-hidden="true"></i>
      </div>
      <div class="coin-details">
        <h4>{$crypto->name}</h4>
        <div class="address-container">
          <input type="text" class="crypto-address" id="$inputId" value="{$crypto->addre}" readonly>
     <button class="copy-btn" data-address="{$crypto->addre}">
  <i class="fa fa-copy"></i>
</button>
        </div>

      </div>
    </div>
HTML;
  }

echo<<<HTML
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
function getsetting($setting){
  global $db;
  $query = "SELECT * FROM settings WHERE settings = ?";
  $stmt = $db->prepare($query);
  $stmt->execute([$setting]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
// footer function to show up
function footerku() {
  echo<<<HTML
  <footer class="kontainer-footer">
    <div class="kontainermain">
    <div class="kontainer-box">
     <h3 class="title-footer">About Me</h3>
       <span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi dolor cum cumque maxime doloremque quidem error recusandae. Dolorum, ab quae?</span>  
     </div> 
     <i class="sparator"></i>
       <div class="kontiner-social">
       <h3 class="title-footer">Connect with Me</h3>
            <a href=""><i class="fab fa-github"></i>Github</a>
            <a href=""><i class="fab fa-instagram"></i>Instagram</a>
            <a href=""><i class="fab fa-twitter"></i>Twitter</a>
            <a href=""><i class="fab fa-linkedin-in"></i>LinkID</a>
       </div>

    </div>
   <div class="credit-github">
  <span class="credit-text"><i class="fab fa-github"></i> Made With <i class="fa fa-heart"></i> By <a href="#">Nameraid</a></span>
 </div>
  </footer>

 HTML;


}
function logout(){
  session_destroy();
  showhome();
}
// function untuk memenengement semuanya
function showManage(){
  print_start('dashboard','admin');
  
}