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
                    <select name="client_id" class="form-control">
                        <?php foreach ($arguments['clients'] as $client) { ?>
                            <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="number" name="number" class="form-control" placeholder="Въведете номер"
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getNumber() : ''; ?>">
                    <!-- required-->
                </div>

                <div class="form-group">
                    <input type="date"
                           name="date"
                           class="form-control"
                           placeholder="Въведете дата на издаване "
                           value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getDate() : ''; ?>">
                    <!--required-->
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        <?php echo $arguments['button_label'] ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>