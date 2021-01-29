<?php
?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> New Invoice</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Въведете име"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getInvoiceName() : ''; ?>">
                    <!--required-->
                </div>
                <div class="form-group">
                    <input type="number" name="number" class="form-control" placeholder="Въведете номер"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getNumber() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="date" name="date" class="form-control" placeholder="Въведете дата"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getDate() : ''; ?>">
                    <!--required-->
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Въведете email"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getInvoiceEmail() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="Въведете адрес"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getInvoiceAddress() : ''; ?>">
                    <!-- required-->
                </div>
                <div class="form-group">
                    <input type="date" name="creation_date" class="form-control" placeholder="Въведете дата"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getCreationDate() : ''; ?>">
                    <!--required-->
                </div>


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