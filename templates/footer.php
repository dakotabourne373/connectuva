<?php
//Dakota Bourne and Matthew Reid
    $authtenticated = isset($_SESSION["email"]);
    $html = $authtenticated ? "<footer class='primary-footer'>
    <nav class='bottom-nav navbar-light'>
        <div class='ft-group'>
            <h2>Projects</h2>
            <ul class='navbar-nav'>
                <li><a class='nav-link' href='{$this->url}research/'>Faculty Research</a></li>
                <li><a class='nav-link' href='{$this->url}proposals/'>Student Proposals</a></li>
            </ul>
        </div>
        <div class='ft-group'>
            <h2>Profile</h2>
            <ul class='navbar-nav'>
                <li><a class='nav-link' href='{$this->url}profile/'>My Profile</a></li>
                <li><a class='nav-link' href='{$this->url}myProposals/'>Your Proposals</a></li>
                <li><a class='nav-link' href='{$this->url}savedProposals/'>Your Bookmarked Proposals</a></li>
            </ul>
        </div>
        <h2><a class='nav-link' href='{$this->url}index/'>About Us!</a></h2>
    </nav><small class='copyright'>Copyright &copy; 2021 - Dakota Bourne and Matthew Reid</small>
</footer>" : "<footer class='primary-footer'>
<nav class='bottom-nav'>
    <h2><a class='nav-link' href='{$this->url}login/'>Login to Connect UVA</a></h2>
    <h2><a class='nav-link' href='{$this->url}index/'>About Us!</a></h2>
</nav>
<small class='copyright'>
    Copyright &copy; 2021 - Dakota Bourne and Matthew Reid
</small>
</footer>";
echo $html;