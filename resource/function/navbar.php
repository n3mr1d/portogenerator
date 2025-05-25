<?php

function navbar() {
    global $db;
    $currentPath = $_SERVER["REQUEST_URI"];
    
    // Define menu items with their properties
    $menuItems = [
        'Home'=>[
            'label'=>'Home',
            'class'=>'donate',
            'link'=>'/index.php',
            'icon'=> 'fa-home'
        ],
        'About' => [
            'label' => 'About', 
            'class' => 'iniclasicon', 
            'link' => '/about',
            'icon' => 'fa-user'
        ],
        'Project' => [
            'label' => 'Projects', 
            'class' => 'iniclasicon', 
            'link' => '/project',
            'icon' => 'fa-code'
        ],
        'Donate' => [
            'label' => 'Donate', 
            'class' => 'donate', 
            'link' => '/donate',
            'icon' => 'fa-heart'
        ]
    ];
    
    $isLoggedIn = isset($_SESSION['user_id']);
    
    // Generate desktop navigation
    echo '<nav class="desktop-nav normal" id="desktop-nav">';
    echo '<div class="kontainer-nav">';
    echo '<a href="/" class="logo-container">';
    echo '<div class="logo-kontainer"><img class="imglogo" src="resource/src/logo/logo.svg"><span class="titlelogo">N3mr1d.dev</span></div>';
    echo '</a>';
    echo '</div>';
    
    echo '<div class="kontainer-menu">';
    
    // Generate menu items
    foreach ($menuItems as $menu => $details) {
        $name = explode('/', $currentPath);
        $links = explode('/',$details['link']);
        $activeClass = (strpos($name[1], $links[1]) === 0) ? 'active' : '';
        echo '<a class="' . $details['class'] . ' ' . $activeClass . '" href="' . $details['link'] . '" data-navitem="' . strtolower($menu) . '">';
        echo '<i class="fas ' . $details['icon'] . '"></i> ';
        echo $details['label'];
        echo '</a>';
    }
    
    // Authentication links
    if ($isLoggedIn) {
        echo '<div class="user-dropdown" id="userDropdown">';
        echo '<button class="dropbtn" onclick="toggleUserDropdown()">';
        echo ' <i class="fas fa-caret-down"></i>';
        echo '</button>';
        echo '<div class="dropdown-content" id="dropdownContent">';
        echo '<a href="/dashboard"><i class="fas fa-cog"></i> Dashboard</a>';
        echo '<a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<a class="auth-button login-btn" href="/login" id="loginBtn">';
        echo '<i class="fas fa-sign-in-alt"></i> Login';
        echo '</a>';
    }

    echo '</div>';
    echo '</nav>';
    
    // Mobile navigation
    echo '<nav class="mobile-nav" id="mobileNav">';
    echo '<div class="mobile-menu-container">';
    
    // Mobile menu items
    foreach ($menuItems as $menu => $details) {
        $activeClass = (strpos($currentPath, $details['link']) === 0) ? 'active' : '';
        echo '<a class="mobile-menu-item ' . $activeClass . '" href="' . $details['link'] . '" data-navitem="' . strtolower($menu) . '">';
        echo '<i class="fas ' . $details['icon'] . '"></i> ';
        echo $details['label'];
        echo '</a>';
    }
    
    // Mobile authentication links
    if ($isLoggedIn) {
        echo '<div class="mobile-user-section">';
        echo '<a href="/dashboard" class="mobile-menu-item"><i class="fas fa-cog"></i> Dashboard</a>';
        echo '<a href="/logout" class="mobile-menu-item"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        echo '</div>';
    } else {
        echo '<div class="mobile-auth-buttons">';
        echo '<a class="mobile-menu-item" href="/login" id="mobileLoginBtn"><i class="fas fa-sign-in-alt"></i> Login</a>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</nav>';

    // Add complex JavaScript functionality
    echo"
      <script>
      // Enhanced dropdown functionality
      function toggleUserDropdown() {
          const dropdown = document.getElementById('dropdownContent');
          dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
          if (!e.target.closest('#userDropdown')) {
              document.getElementById('dropdownContent').style.display = 'none';
          }
      });

      // Smooth scroll and active state management
      document.querySelectorAll('[data-navitem]').forEach(item => {
          item.addEventListener('click', function(e) {
              // Add animation class
              this.classList.add('nav-click-animation');
              setTimeout(() => {
                  this.classList.remove('nav-click-animation');
              }, 300);

              // Update active states
              document.querySelectorAll('[data-navitem]').forEach(navItem => {
                  navItem.classList.remove('active');
              });
              this.classList.add('active');
          });
      });

      // Mobile menu interactions
      const mobileNav = document.getElementById('mobileNav');
      document.addEventListener('scroll', function() {
          if (window.scrollY > 100) {
              mobileNav.style.transform = 'translateY(0)';
          } else {
              mobileNav.style.transform = 'translateY(-100%)';
          }
      });";
    echo<<<JS
      // Login button hover effects
      const loginBtn = document.getElementById('loginBtn');
      if (loginBtn) {
          loginBtn.addEventListener('mouseleave', () => {
              loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Login';
          });
      }
      </script>
    JS;
}