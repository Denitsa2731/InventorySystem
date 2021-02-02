<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> New Client</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Въведете име"
                           value="<?php echo isset($arguments['client']) ? $arguments['client']->getClientName() : ''; ?>">
                    <!--required-->
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Въведете email"
                           value="<?php echo isset($arguments['client']) ? $arguments['client']->getClientEmail() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="Въведете адрес"
                           value="<?php echo isset($arguments['client']) ? $arguments['client']->getClientAddress() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="date" name="date" class="form-control" placeholder="Въведете дата"
                           value="<?php echo isset($arguments['client']) ? $arguments['client']->getCreationDate() : ''; ?>">
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