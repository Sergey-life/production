<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url('assets/template/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/template/')?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <?php foreach($accessiblePages as $group_name => $group_data) :?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo $group_name; ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <?php foreach($group_data as $page_name => $page_data) :?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php $url = 'https://test.alser.ua/production/'; echo $url . rtrim($page_data->method_name, '/'); ?>" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo $page_data->permission_description; ?></p>
                            </a>
                        </li>
                    </ul>
                    <?php endforeach; ?>
                </li>
            </ul>
        </nav>
        <?php endforeach; ?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php //echo '<pre>'; print_r($accessiblePages);?>
<?php //echo '<pre>'; print_r($_SERVER['REQUEST_URI']);?>

<?php //foreach ($accessiblePages as $group_name => $group_data){
//    echo '<pre>' . $group_name;
//    foreach ($group_data as $page_name => $page_data){
//        echo '<pre>' . $page_data->permission_description;
//    }
//} ?>
