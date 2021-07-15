<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> продукт</h3>
                    <form action="" class="justify-content-center" method="POST">

                        <div class="form-group"><label style="color:black;">Въведете име:</label>
                            <input  type="text" name="productName" class="form-control" placeholder="Въведете име"
                                   value="<?php echo isset($arguments['product']) ? $arguments['product']->getProductName() : ''; ?>">

                        </div>
                        <div class="form-group"><label style="color:black;">Въведете количество:</label>
                            <input type="number" name="productQty" class="form-control" <?php echo isset($arguments['product']) ? "disabled" : ''; ?> placeholder="Въведете колочество"
                                   value="<?php echo isset($arguments['product']) ? $arguments['product']->getProductQty() : ''; ?>">
                            <!--required-->
                        </div>
                        <div class="form-group"><label style="color:black;">Въведете цена:</label>
                            <input type="number" name="productPrice" class="form-control" placeholder="Въведете цена"
                                   value="<?php echo isset($arguments['product']) ? $arguments['product']->getProductPrice() : ''; ?>">
                            <!-- required-->
                        </div>
                        <div class="form-group"><label style="color:black;">Въведете баркод:</label>
                            <input type="number" name="productBarCode" class="form-control" placeholder="Въведете баркод"
                                   value="<?php echo isset($arguments['product']) ? $arguments['product']->getProductBarCode() : ''; ?>">
                            <!--required--> <?die('test');?>
                        </div>
                        <label style="color:black;">Избери категория:</label>
                            <select class="form-control select_group product" name="category_id"  required>
                                <option> </option>
                                <?php foreach ($arguments['categories'] as $category): ?>
                                    <option <?= isset($arguments['product']) && $arguments['product']->getProductCategory() == $category['id']?'selected':''?> value="<?php echo $category['id'] ?>"><?php echo $category['categoryName'] ?></option>
                                <?php endforeach ?>
                            </select>


                        <div class="form-group">
                            <br>

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