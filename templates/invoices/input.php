<?php
?>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> New Invoice</h3>
                    <form action="" class="justify-content-center" method="POST">


                        <?php
                        if ($arguments['button_label'] == 'create') {
                            ?>
                            <div class="form-group">
                                <select name="client_id" class="form-control">
                                    <?php foreach ($arguments['clients'] as $client) { ?>
                                        <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <input type="number"
                                   name="number"
                                   class="form-control"
                                   placeholder="Въведете номер"
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
                            <button class="btn btn-primary btn-lg">
                                <?php echo $arguments['button_label'] ?>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
