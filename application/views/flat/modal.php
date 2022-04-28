<?php
    $warna = array('modal-success', 'modal-info', 'modal-warning', 'modal-danger', 'modal-default');
    // pre($warna);
    $ukuran = array('modal-lg', 'modal-sedang', 'modal-sm');

?>

<?php
    foreach($warna as $color):
        foreach($ukuran as $size):
?>
<div id="<?php echo $color; ?>-<?php echo $size; ?>" class="modal <?php echo $color; ?>" >
    <div class="modal-dialog <?php echo $size; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title modal-title-custom">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<?php
        endforeach;
    endforeach;
?>


<div id="hapusModal" class="modal modal-default" >
    <div class="modal-dialog modal-sedang">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Hapus data</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin akan menghapus data ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <a class="btn btn-danger" id="yes_hapus">Iya</a>
            </div>
        </div>
    </div>
</div>
