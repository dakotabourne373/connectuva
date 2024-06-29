<?php
//Dakota Bourne and Matthew Reid
    $authtenticated = isset($_SESSION["email"]);
    $html = $authtenticated ? 
    "<nav class='navbar fixed-top navbar-expand-xl navbar-light bg-light'>
        <a class='navbar-brand uvaTitle'
        href='{$this->url}index' style='color: #232d4b'>Connect UVA</a><button class='navbar-toggler'
        type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent'
        aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span
            class='navbar-toggler-icon'></span></button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav ml-auto'>
            <li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='projectDropdown'
                    role='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Projects</a>
                <div class='dropdown-menu' id='projectDropdown' aria-labelledby='projectDropdown'><a class='dropdown-item'
                        href='{$this->url}research/'>Faculty Research</a>
                    <div class='dropdown-divider'></div><a class='dropdown-item'
                        href='{$this->url}proposals/'>Student Proposals</a>
                </div>
            </li>
            <div class='separate-nav-item'></div>
            <li class='nav-item'><a class='nav-link' href='{$this->url}index/'>About<span class='sr-only'></span></a></li>
            <div class='separate-nav-item'></div>
            <li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='{$this->url}profile/'
                    id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-haspopup='true'
                    aria-expanded='false'>Profile</a>
                <div class='dropdown-menu' id='navbarDropdown' aria-labelledby='navbarDropdown'><a class='dropdown-item'
                        href='{$this->url}profile/'>My Profile</a>
                    <div class='dropdown-divider'></div><a class='dropdown-item'
                        href='{$this->url}myProposals/'>My Proposals</a>
                    <div class='dropdown-divider'></div><a class='dropdown-item'
                        href='{$this->url}savedProposals/'>Saved Proposals</a>
                </div>
            </li>
            <div class='separate-nav-item'></div>
            <li class='nav-item' style='margin-right: 20px;'><a class='nav-link' href='{$this->url}logout/'>Logout</a></li>
        </ul>
    </div>
</nav>" : "<nav class='navbar fixed-top navbar-expand-sm navbar-light bg-light'><a class='navbar-brand uvaTitle'
href='{$this->url}index/' style='color: #232d4b'>Connect UVA</a><button class='navbar-toggler' type='button'
data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
<div class='collapse navbar-collapse' id='navbarSupportedContent'>
<ul class='navbar-nav mr-auto'>
    <li class='nav-item active'><a class='nav-link' href='{$this->url}index/'>About<span class='sr-only'></span></a>
    </li>
    <div class='separate-nav-item'></div>
    <li class='nav-item' style='margin-right: 20px;'><a class='nav-link' href='{$this->url}login/'
            data-theme='dark'>Login</a></li>
</ul>
</div>
</nav>";
echo "<script type='text/javascript' src='{$this->url}js/HFText.js'></script>";
echo $html;