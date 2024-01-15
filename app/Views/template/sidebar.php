<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
        <img src="Asset\liveit\landing\logo2.png" alt="" class="logo">
        </div>
        <div class="sidebar-brand-text mx-3">LIVEit</div>
    </a>

    <?php if (in_groups('admin')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Menu
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link font-side" href="<?= base_url('/adm'); ?>">
                
                <span class="logo-side-bar"> <i class="fa-solid fa-person"></i> List Pelanggan</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link font-side" href="<?= base_url('/adm/ruangan'); ?>">
                
                <span> <i class="fa-solid fa-house"></i> Daftar Ruangan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link font-side" href="<?= base_url('/adm/daftar_transaksi'); ?>">
               
                <span> <i class="fa-solid fa-money-check-dollar"></i> Daftar Transaksi</span></a>
        </li>
        
    <?php endif ?>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Charts -->
   

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link font-side" href="/user/rencana">
           
            <span> <i class="fa-solid fa-table-list"></i> Rencana</span></a>
    </li>

    <li class="nav-item">
            <a class="nav-link font-side" href="<?= base_url('/catalog'); ?>">
                
                <span><i class="fa-solid fa-book"></i> Catalog</span></a>
        </li>

    <li class="nav-item">
        <a class="nav-link font-side" href="<?= base_url('logout'); ?>">
           
            <span> <i class="fa-solid fa-right-from-bracket"></i> Keluar</span></a>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>