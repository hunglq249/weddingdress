<?php
//if($this->ion_auth->logged_in()) {
//?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo site_url('assets/img/admin/userss.png') ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Ciel de Gia</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form hidden">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="<?php echo base_url('admin') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li> 
              <!--   <li class="treeview">
                    <a href="">
                        <i class="fa fa-home"></i>
                        <span>Homepage</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/homepage') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li><a href="<?php echo base_url('admin/homepage/slider') ?>"><i class="fa fa-picture-o"></i> Slider</a></li>
                        <li><a href="<?php echo base_url('admin/homepage/featured') ?>"><i class="fa fa-star-o"></i> Featured</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="<?php echo base_url('admin/templates') ?>">
                        <i class="fa fa-cubes"></i> <span>Templates</span>
                    </a>
                </li> -->

                <li class="active hidden">
                    <a href="<?php echo base_url('admin/config_contact') ?>">
                        <i class="fa fa-inbox"></i> <span>Contact</span>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url('admin/contact') ?>">
                        <i class="fa fa-inbox"></i> <span>Contact</span>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url('admin/banner') ?>">
                        <i class="fa fa-inbox"></i> <span>Banner</span>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url('admin/collection') ?>">
                        <i class="fa fa-inbox"></i> <span>Bộ sưu tập</span>
                    </a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'product' || $this->uri->segment(2) == 'product_category')? 'active' : 'treeview' ?>">
                    <a href="">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Sản phẩm</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="padding-left: 20px;">
                        <li class="<?php echo ($this->uri->segment(2) == 'product_category')? 'active' : '' ?>">
                            <a href="<?php echo base_url('admin/product_category') ?>"><i class="fa fa-filter"></i> Danh mục sản phẩm</a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'product')? 'active' : '' ?>">
                            <a href="<?php echo base_url('admin/product') ?>"><i class="fa fa-list"></i> Danh sách sản phẩm</a>
                        </li>
                    </ul>
                </li>
                <li class="active hidden">
                    <a href="<?php echo base_url('admin/color') ?>">
                        <i class="fa fa-cubes"></i> <span>Color</span>
                    </a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'post' || $this->uri->segment(2) == 'post_category')? 'active' : 'treeview' ?>">
                    <a href="">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Bài viết</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="padding-left: 20px;">
                        <li class="<?php echo ($this->uri->segment(2) == 'post_category')? 'active' : '' ?>">
                            <a href="<?php echo base_url('admin/post_category') ?>"><i class="fa fa-filter"></i> Danh mục bài viết</a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'post')? 'active' : '' ?>">
                            <a href="<?php echo base_url('admin/post') ?>"><i class="fa fa-list"></i> Danh sách bài viết</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="active">
                    <a href="<?php echo base_url('admin/menu') ?>">
                        <i class="fa fa-align-left"></i> <span>Menu</span>
                    </a>
                </li> -->
                <li class="header hidden">DOCUMENTATION</li>
                <li class="hidden">
                    <a href="<?php echo base_url('admin/user/change_password') ?>">
                        <i class="fa fa-refresh" aria-hidden="true"></i> <span>Đổi Mật Khẩu</span>
                    </a>
                </li>
                <?php if ($this->ion_auth->is_admin()===TRUE): ?>
                    <li class="hidden">
                        <a href="<?php echo base_url('admin/user/register') ?>">
                            <i class="fa fa-registered" aria-hidden="true"></i> <span>Tạo tài khoản</span>
                        </a>
                    </li>
                <?php endif ?>










                <!-- <li class="treeview">
                    <a href="">
                        <i class="fa fa-user-circle-o"></i>
                        <span>About us</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/about') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li><a href="<?php echo base_url('admin/about/description') ?>"><i class="fa fa-comment-o"></i> Description</a></li>
                        <li><a href="<?php echo base_url('admin/about/services') ?>"><i class="fa fa-gears"></i> Services</a></li>
                        <li><a href="<?php echo base_url('admin/about/team') ?>"><i class="fa fa-group"></i> Team</a></li>
                        <li><a href="<?php echo base_url('admin/about/testinomials') ?>"><i class="fa fa-comments-o"></i> Testinomials</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="">
                        <i class="fa fa-drivers-license-o"></i>
                        <span>Works/ Portfolio</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/works') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li><a href="<?php echo base_url('admin/works/field') ?>"><i class="fa fa-filter"></i> Field of Works</a></li>
                        <li><a href="<?php echo base_url('admin/works/works') ?>"><i class="fa fa-list"></i> List of Works</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-cubes"></i>
                        <span>Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/products') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li class="treeview">
                            <a href=""><i class="fa fa-filter"></i> Category</a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('admin/products/category_1') ?>"><i class="fa fa-circle-o"></i> Category I</a></li>
                                <li><a href="<?php echo base_url('admin/products/category_2') ?>"><i class="fa fa-circle-o"></i> Category II</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('admin/products/products') ?>"><i class="fa fa-list"></i> List of Products</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-file-text-o"></i>
                        <span>Order</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/orders/') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li><a href="<?php echo base_url('admin/orders/pending') ?>"><i class="fa fa-refresh"></i> Pending Orders</a></li>
                        <li><a href="<?php echo base_url('admin/orders/completed') ?>"><i class="fa fa-check-square-o"></i> Completed Orders</a></li>
                        <li><a href="<?php echo base_url('admin/orders/cancelled') ?>"><i class="fa fa-window-close-o"></i>Cancelled Orders </a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Blogs</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('admin/blogs') ?>"><i class="fa fa-desktop"></i> Overview</a></li>
                        <li class="treeview">
                            <a href=""><i class="fa fa-filter"></i> Category</a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('admin/blogs/category_1') ?>"><i class="fa fa-circle-o"></i> Category I</a></li>
                                <li><a href="<?php echo base_url('admin/blogs/category_2') ?>"><i class="fa fa-circle-o"></i> Category II</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('admin/blogs/blogs') ?>"><i class="fa fa-list"></i> List of blogs</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/messages') ?>">
                        <i class="fa fa-inbox"></i> <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/subscribe') ?>">
                        <i class="fa fa-envelope-o"></i> <span>Subscribe</span>
                    </a>
                </li>
                <li class="header">DOCUMENTATION</li>
                <li>
                    <a href="<?php echo base_url('admin/documentation') ?>">
                        <i class="fa fa-book"></i> <span>Documentation</span>
                    </a>
                </li> -->

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php //} ?>



