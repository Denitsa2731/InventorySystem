<?php ?>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info">Adding Service to Invoice</h3>
                    <form action="" class="justify-content-center" method="POST">
                        <div class="form-group">

                            <input type="text" name="number" class="form-control" readonly
                                   value="<?php echo isset($arguments['invoice']) ? $arguments['invoice']->getNumber() : ''; ?>" />
                            <!-- required-->
                        </div>

                        <div class="form-group">
                            <select name="service_id" class="form-control">
                                <?php foreach ($arguments['service'] as $service) { ?>
                                    <option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="number"
                                   name="qty"
                                   class="form-control"
                                   placeholder="Въведете количество ">
                            <!--required-->
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-lg" type="submit">
                                Add
                            </button>
                            <a href="invoice_show" class="btn btn-secondary btn-lg" >Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>