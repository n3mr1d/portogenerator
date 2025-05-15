<?php
/**
 * Navigation bar function
 * Generates responsive navigation bar for desktop and mobile views
 * Highlights current page and handles user authentication state
 * 
 * @return void
 */
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
    
    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['user_id']);
    

    // Generate desktop navigation
    // echo'<div id="main-kontainer">';
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
        echo '<a class="' . $details['class'] . ' ' . $activeClass . '" href="' . $details['link'] . '">';
        echo '<i class="fas ' . $details['icon'] . '"></i> ';
        echo $details['label'];
        echo '</a>';
    }
    
    // Authentication links
    if ($isLoggedIn) {
        echo '<div class="user-dropdown">';
        echo '<button class="dropbtn">';
        echo ' <i class="fas fa-caret-down"></i>';
        echo '</button>';
        echo '<div class="dropdown-content">';
        echo '<a href="/profile"><i class="fas fa-id-card"></i> Profile</a>';
        echo '<a href="/settings"><i class="fas fa-cog"></i> Settings</a>';
        echo '<a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<a class="auth-button login-btn" href="/login">';
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
        echo '<a class="mobile-menu-item ' . $activeClass . '" href="' . $details['link'] . '">';
        echo '<i class="fas ' . $details['icon'] . '"></i> ';
        echo $details['label'];
        echo '</a>';
    }
    
    // Mobile authentication links
    if ($isLoggedIn) {
        echo '<div class="mobile-user-section">';
        echo '<a href="/profile" class="mobile-menu-item">';
        echo '<i class="fas fa-id-card"></i> Profile';
        echo '</a>';
        echo '<a href="/settings" class="mobile-menu-item">';
        echo '<i class="fas fa-cog"></i> Settings';
        echo '</a>';
        echo '<a href="/logout" class="mobile-menu-item">';
        echo '<i class="fas fa-sign-out-alt"></i> Logout';
        echo '</a>';
        echo '</div>';
    } else {
        echo '<div class="mobile-auth-buttons">';
        echo '<a class="mobile-menu-item" href="/login">';
        echo '<i class="fas fa-sign-in-alt"></i> Login';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</nav>';
    

}