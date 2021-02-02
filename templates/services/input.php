<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> New Service</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Въведете име"
                           value="<?php echo isset($arguments['service']) ? $arguments['service']->getName() : ''; ?>">
                    <!--required-->
                </div>
                <div class="form-group">
                    <input type="number" name="price" class="form-control" placeholder="Въведете цена"
                           value="<?php echo isset($arguments['service']) ? $arguments['service']->getPrice() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="date" name="creation_date" class="form-control" placeholder="Въведете дата"
                           value="<?php echo isset($arguments['service']) ? $arguments['service']->getCreationDate() : ''; ?>">
                    <!--required-->
                    <div class="form-group">
                        <button class="btn btn-primary">
                            <?php echo $arguments['button_label'] ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>