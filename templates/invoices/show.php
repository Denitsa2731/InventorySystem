
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default invoice" id="invoice">
                <div class="panel-body">


                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-10 from">
                            <h3 class="margin right">Number: </h3>
                            <?php echo isset($arguments['invoice']) ? $arguments['invoice']->getNumber() : ''; ?><br>
                        </div>


                        <div class="col-xs-4 text-right payment-details">
                            <h3 class="margin right">Client: </h3>
                            <?php echo isset($arguments['client']) ? $arguments['client']->getClientName() : ''; ?><br>
                            <?php echo isset($arguments['client']) ? $arguments['client']->getClientEmail() : ''; ?><br>
                            <?php echo isset($arguments['client']) ? $arguments['client']->getClientAddress() : ''; ?>
                        </div>

                    </div>

                    <div class="row table-row">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center" style="width:5%">#</th>
                                <th style="width:50%">Name</th>
                                <th class="text-right" style="width:15%">Quantity</th>
                                <th class="text-right" style="width:15%">Description</th>
                                <th class="text-right" style="width:15%">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($arguments['invoice'] as $row) { ?>
                                <tr>
                                    <td><?php echo $row['number']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['price']; ?></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="row">
                        <div class="col-5 margin top">


                            <a href="invoices/add_service?invoice_id=<?php echo $arguments['invoice']->getId() ?>"
                               class="btn btn-primary" >Add Service</a>

                        </div>
                        <div class="col-6 text-right invoice-total">
                            <div class="float-right">
                                <p>TAXES : </p>
                                <p>TOTAL :  </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



