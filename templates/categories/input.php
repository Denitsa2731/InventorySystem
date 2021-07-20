<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?>  нова категория</h3>
                    <form action="" class="justify-content-center" method="POST">
                        <div class="form-group">
                            <input type="text" name="categoryName" class="form-control" placeholder="Въведете име"
                                   value="<?php echo isset($arguments['category']) ? $arguments['category']->getCategoryName() : ''; ?>">
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
</section>