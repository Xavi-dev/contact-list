<div class="row">
    <div class="col-sm-12">
        <?php if(isset($_GET["missatge"])) : ?>
            <div class="alert alert-ok alert-dismissible fade show p-2" role="alert">
                <strong><?php echo $_GET["missatge"]; ?></strong> 
                <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif; ?>
    </div>  
</div>

