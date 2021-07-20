<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info"><?php echo ucfirst($arguments['button_label']) ?> поръчка</h3>
                    <form action="" class="justify-content-center" method="POST">
                        <div class="form-group">
                            <input type="text" name="customerName" class="form-control" placeholder="Въведете име"
                                   value="<?php echo isset($arguments['order']) ? $arguments['order']->getCustomerName() : ''; ?>">
                            <!--required-->
                        </div>
                        <div class="form-group">
                            <input type="text" name="customerAddress" class="form-control" placeholder="Въведете адрес"
                                   value="<?php echo isset($arguments['order']) ? $arguments['order']->getCustomerAddress() : ''; ?>">
                            <!-- required-->
                        </div>
                        <div class="form-group">
                            <input type="number" name="customerPhone" class="form-control" placeholder="Въведете телефон"
                                   value="<?php echo isset($arguments['order']) ? $arguments['order']->getCustomerPhone() : ''; ?>">
                            <!-- required-->
                        </div>

                        <div class="col-md-12 col-xs-12 pull pull-right">
                        <table class="table table-bordered" id="product_info_table">
                            <thead>
                            <tr>
                                <th style="width:50%; color:black">Име на продукти</th>
                                <th style="width:10%; color:black">Избрано количество</th>
                                <th style="width:10%; color:black">Общо количество</th>
                                <th style="width:20%; color:black">Цена</th>
                                <th style="width:10%; color:black"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($arguments['order_products'] as $product){
                            ?>
                                <tr id="row_1">
                                    <td>
                                        <input type="text" name="produtName" value="<?php echo $product['productName'] ?>" class="form-control" style="width: 90px;" disabled autocomplete="off">
                                    </td>
                                    <td><input type="text" name="qty[]" id="qty_1" disabled value="<?php echo $product['soldQty'] ?>" class="form-control" required onkeyup="getTotal(1, this.value)"></td>
                                    <td>
                                        <input type="text" name="rate[]" value="<?php echo $product['productQty'] ?>" id="rate_1" class="form-control" disabled autocomplete="off">
                                        <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                                    </td>
                                    <td>
                                        <input type="text" name="amount[]" id="amount_1" value="<?php echo $product['productPrice'] ?>" class="form-control" style="width: 90px;" disabled autocomplete="off">
                                        <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                    </td>
                                    <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                                </tr>
                            <?php
                            }
                                ?>

                            </tbody>
                        </table></div>
                        <div class="col-md-12 col-xs-12 pull pull-right">
                            <div class="form-group">
                                <label for="discount" class="col-sm-5 control-label" style="color: black; float: left;">Отстъпка</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="discount" name="discount"  onkeyup="subAmount()" disabled autocomplete="off"
                                           value="<?php echo isset($arguments['order']) ? $arguments['order']->getDiscount() : ''; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gross_amount" class="col-sm-5 control-label" style="color: black; float: left;">Брутна сума</label>
                                <div class="col-sm-7">
                                    <input type="text"  name="grossAmount" id="gross_amount" disabled class="form-control"
                                           value="<?php echo isset($arguments['order']) ? $arguments['order']->getGrossAmount() : ''; ?>">
                                    <!-- required-->
                                </div></div>
                            <!--                            <div class="form-group">-->
                            <!--                                <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>-->
                            <!--                                <div class="col-sm-7">-->
                            <!--                                    <input type="text" class="form-control" id="gross_amount" name="grossAmount" disabled autocomplete="off">-->
                            <!--                                    <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="form-group">
                                <label for="gross_amount" class="col-sm-5 control-label" style="color: black; float: left;">ДДС 20%</label>
                                <div class="col-sm-7">
                                    <input type="text" id="vat_charge" name="vat" class="form-control" disabled autocomplete="off"
                                           value="<?php echo isset($arguments['order']) ? $arguments['order']->getVat() : ''; ?>">
                                    <!-- required-->
                                </div></div>

                            <div class="form-group">
                                <label for="net_amount" class="col-sm-5 control-label" style="color: black; float: left;">Нетна сума</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" disabled value="<?php echo $arguments['order']->getNetAmount(); ?>" id="net_amount" name="netAmount"  autocomplete="off">
                                    <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                                </div>
                            </div>

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
    </div>

</section>


