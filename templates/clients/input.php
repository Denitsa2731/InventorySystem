<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> New Client</h3>
                    <form action="" class="justify-content-center" method="POST">
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

