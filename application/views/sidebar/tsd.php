<!-- sidebar -->




<div class="sidebar sidebar-default sidebar-separate">
    <div class="sidebar-content">
        <form id="statistics_task_teknis_control_form" action="<?php echo base_url(); ?>statistics/testing" method="post">


            <div class="sidebar-category sidebar-category-visible">
                <div class="category-title">
                    <span>Jenis Pekerjaan</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content">
                    <div class="checkbox">
                        <label for="">
                            <input type="checkbox" name="jenis_pekerjaan[]" value="installasi" checked>
                            Installasi
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="">
                            <input type="checkbox" name="jenis_pekerjaan[]" value="survey" checked>
                            Survey
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="">
                            <input type="checkbox" name="jenis_pekerjaan[]" value="dismantle" checked>
                            Dismantle
                        </label>
                    </div>
                </div>
            </div>

            <div class="sidebar-category sidebar-category-visible">
                <div class="category-title">
                    <span>Filter Waktu</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content">
                    <?php
                        $dts = array();
                        $dts['uid'] = 'nhk';
                        $dts['mode_name'] = 'tmp_mode';
                        // $dts['mode_selected'] = 'tanggal';
                        // $dts['selected_data'] = '2014-07-02';
                        $this->load->view('timemode_picker/vertical_panel', $dts);
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- sidebar -->
