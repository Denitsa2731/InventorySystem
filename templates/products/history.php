<!--<div class="row">-->
<!--    <div class="col-md-12 stretch-card">-->
<!--        <div class="card">-->
<!--            <div class="card-body">-->
<!--                <p class="card-title">Recent Purchases</p>-->
<!--                <div class="table-responsive">-->
<!--                    <table id="recent-purchases-listing" class="table">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Qty</th>-->
<!--                            <th>Price</th>-->
<!--                            <th>Date</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!---->
<!--                        --><?php //foreach ($arguments['oder_history'] as $row) { ?>
<!--                            <tr>-->
<!--                                <td>--><?//= $row['soldQty']; ?><!--</td>-->
<!--                                <td>--><?//= $row['price']; ?><!--</td>-->
<!--                                <td>--><?//= $row['date']; ?><!--</td>-->
<!---->
<!--                            </tr>-->
<!--                        --><?php //} ?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->
<div class="row">
    <div class="col-md-6 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">История на изписаните продукти</p>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                        <thead>
                        <tr>
                            <th>Продадено количество</th>
                            <th>Цена</th>
                            <th>Дата на добавяне</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($arguments['order_history'] as $row) { ?>
                            <tr>
                                <td><?= $row['soldQty']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['date']; ?></td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">История на зареждане на продукт</p>
                <div class="table-responsive">
                    <table id="recent-purchases-listing2" class="table">
                        <thead>
                        <tr>
                            <th>Заредено количество</th>
                            <th>Цена</th>
                            <th>Дата на добавяне</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($arguments['refill_history'] as $row) { ?>
                            <tr>

                                <td><?= $row['qty']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['date']; ?></td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






