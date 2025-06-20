<!-- Navbar -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" 
                     src="<?= $_SESSION['login']['foto_user'] ?? '../amanah_assets/img/logo amanah 5.jpg' ?>" 
                     class="rounded-circle mr-1" 
                     width="30">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['login']['nama_user'] ?? 'User' ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="../_profil/index.php" class="dropdown-item has-icon">
                    <i class="fas fa-user"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="../logout.php" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>