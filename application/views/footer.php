            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

    </body>
</html>

<!--modal stok-->
<div id="modal-stok" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        	<?php echo form_open('Login/logout'); ?>
            <div class="modal-header" id="ModalHeader">
                Apakah Anda Yakin Ingin Log Out ?
            </div>

            <div class="modal-footer" id="ModalFooter">
                <button type="submit" class="btn btn-primary">Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div> 
</div>