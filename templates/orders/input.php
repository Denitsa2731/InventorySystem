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
                            <tr id="row_1">
                                <td>
                                    <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                                        <?php foreach ($arguments['products'] as $product): ?>
                                            <option  value="<?php echo $product['id'] ?>"><?php echo $product['productName'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1, this.value)"></td>
                                <td>
                                    <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off">
                                    <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" name="amount[]" id="amount_1" class="form-control" style="width: 90px;" disabled autocomplete="off">
                                    <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                </td>
                                <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-6 col-xs-12 pull pull-right">
                            <div class="form-group">
                                <label for="discount" class="col-sm-5 control-label" style="color: black; float: left;">Отстъпка</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" value="0.00" id="discount" name="discount"  onkeyup="subAmount()" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gross_amount" class="col-sm-5 control-label" style="color: black; float: left;">Брутна сума</label>
                                <div class="col-sm-7">
                                <input type="text"  name="grossAmount" id="gross_amount" class="form-control"
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
                                <input type="text" id="vat_charge" name="vat" class="form-control" autocomplete="off"
                                       value="<?php echo isset($arguments['order']) ? $arguments['order']->getVat() : ''; ?>">
                                <!-- required-->
                                </div></div>

                            <div class="form-group">
                                <label for="net_amount" class="col-sm-5 control-label" style="color: black; float: left;">Нетна сума</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="net_amount" name="netAmount"  autocomplete="off">
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

<script type="text/javascript">
    $(document).ready(function() {
        // Add new row in the table
        $("#add_row").unbind('click').bind('click', function() {
            var count_table_tbody_tr = $("#product_info_table tbody tr").length;
            var row_id = count_table_tbody_tr + 1;

            $.ajax({
                url:  'api/get-all-products',
                type: 'get',
                dataType: 'json',
                success:function(response) {

                    var html = '<tr id="row_'+row_id+'">'+
                        '<td>'+
                        '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                    $.each(response, function(index, value) {
                        html += '<option value="'+value.id+'">'+value.productName+'</option>';
                    });

                    html += '</select>'+
                        '</td>'+
                        '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+', this.value)"></td>'+
                        '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                        '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" style="width: 90px;" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                        '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                        '</tr>';

                    if(count_table_tbody_tr >= 1) {
                        $("#product_info_table tbody tr:last").after(html);
                    }
                    else {
                        $("#product_info_table tbody").html(html);
                    }
                }
            });

            return false;
        });
    });
    function getProductData(row_id)
    {
        var product_id = $("#product_"+row_id).val();
        if(product_id == "") {
            $("#rate_"+row_id).val("");
            $("#rate_value_"+row_id).val("");

            $("#qty_"+row_id).val("");

            $("#amount_"+row_id).val("");
            $("#amount_value_"+row_id).val("");

        } else {
            $.ajax({
                url:  'api/get-product-by-id',
                type: 'get',
                data: {product_id : product_id},
                dataType: 'json',
                success:function(response) {
                    // setting the rate value into the rate input field

                    $("#rate_"+row_id).val(response.productQty);
                    $("#rate_value_"+row_id).val(response.productQty);

                    $("#qty_"+row_id).val(1);
                    $("#qty_value_"+row_id).val(1);

                    var total = Number(response.productPrice) * 1;
                    total = total.toFixed(2);
                    $("#amount_"+row_id).val(total);
                    $("#amount_value_"+row_id).val(total);

                    subAmount();
                } // /success
            }); // /ajax function to fetch the product data
        }
    }
    function getTotal(row = null, selectedQty) {
        let totalQty=$("#rate_value_"+row).val();
        if((parseInt(selectedQty) > parseInt(totalQty))) {
            alert("Въвели сте количество по-голямо от наличното!");

        return false
        }

        if(row) {
            var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
            total = total.toFixed(2);
            $("#amount_"+row).val(total);
            $("#amount_value_"+row).val(total);

            subAmount();
        } else {
            alert('no row !! please refresh the page');
        }
    }



    function subAmount() {
        var vat_charge = 20;

        var tableProductLength = $("#product_info_table tbody tr").length;
        var totalSubAmount = 0;
        for(x = 0; x < tableProductLength; x++) {
            var tr = $("#product_info_table tbody tr")[x];
            var count = $(tr).attr('id');
            count = count.substring(4);

            totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
        } // /for

        totalSubAmount = totalSubAmount.toFixed(2);

        // sub total
        $("#gross_amount").val(totalSubAmount);
        $("#gross_amount_value").val(totalSubAmount);

        // vat
        var vat = (Number($("#gross_amount").val())/100) * vat_charge;
        vat = vat.toFixed(2);
        $("#vat_charge").val(vat);
        $("#vat_charge_value").val(vat);

        // total amount
        var totalAmount = (Number(totalSubAmount) + Number(vat) );
        totalAmount = totalAmount.toFixed(2);
        // $("#net_amount").val(totalAmount);
        // $("#totalAmountValue").val(totalAmount);

        var discount = $("#discount").val();
        if(discount) {
            var grandTotal = Number(totalAmount) - Number(discount);
            grandTotal = grandTotal.toFixed(2);
            $("#net_amount").val(grandTotal);
            $("#net_amount_value").val(grandTotal);
        } else {
            $("#net_amount").val(totalAmount);
            $("#net_amount_value").val(totalAmount);

        } // /else discount

    } // /sub total amount

    function removeRow(tr_id)
    {
        $("#product_info_table tbody tr#row_"+tr_id).remove();
        subAmount();
    }
</script>

