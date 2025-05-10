<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo $modal_titulo ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $modal_mensagem ?>
            </div>
            <div class="modal-footer">
                <a href="<?php echo $link ?>"><button type="button" class="btn-block"><?php echo $btn ?></button></a>
            </div>
        </div>
    </div>
</div>