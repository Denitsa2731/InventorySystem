<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?>  допълнително
                        количество от продукта</h3>
                    <form action="" class="justify-content-center" method="POST">
                        <div class="form-group"><label style="color: black">Веведете количество</label>
                            <input type="number" name="productQty" class="form-control"
                                   placeholder="Въведете колочество"
                                   value="1">
                        </div>
                        <div class="form-group"><label style="color: black">Въведете цена</label>
                            <input type="number" name="productPrice" class="form-control" placeholder="Въведете цена"
                                   value="<?php echo isset($arguments['product']) ? $arguments['product']->getProductPrice() : ''; ?>">
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