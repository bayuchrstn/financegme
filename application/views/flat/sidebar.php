<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="sidebar-user-material">
                <div class="category-content">
                    <div class="sidebar-user-material-content">
                        <h6><?php echo my_name(); ?></h6>
                        <span class="text-size-small"><?php //echo $this->customer_group->sidebar_logged_info(); ?></span>
                    </div>

                    <div class="sidebar-user-material-menu">
                        <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                    </div>
                </div>

                <div class="navigation-wrapper collapse" id="user-nav">
                    <ul class="navigation">
                        <li><a href="<?php echo base_url(); ?>my_profile"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                        <li><a href="<?php echo base_url(); ?>logout"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="category-content no-padding">

                <ul class="navigation navigation-main navigation-accordion">

                    <?php
                    // pre($arr_menu);
                        if(!empty($arr_menu)):
                            foreach($arr_menu as $row):
                                $active_menu = ($active_root_menu==$row['label']) ? 'active' : '';

                    ?>
                    <li class="<?php echo $active_menu; ?>">
                        <a href="<?php echo $row['url']; ?>"><i class="<?php echo $row['icon']; ?>"></i> <span><?php echo $row['label']; ?></span></a>
                        <?php if($row['child'] !=''): ?>
                        <ul>
                            <?php
                                foreach($row['child'] as $sub):
                                    // pre($sub);
                            ?>
                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['label']; ?></a></li>
                            <?php
                                endforeach;
                            ?>
                        </ul>
                        <?php endif; ?>
                    </li>

                    <?php
                            endforeach;
                        endif;
                    ?>
                </ul>


            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
