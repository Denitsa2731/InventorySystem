
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Списък с продукти</p>
                <form action=""  method="GET">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav mr-lg-4 w-100">
                        <li class="nav-item nav-search d-none d-lg-block w-100">
                            <div class="input-group">
                                <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
                                </div>
                                <input type="text" class="form-control" name="keywords" placeholder="Търсене" aria-label="search" aria-describedby="search">
                            </div>
                        </li>
                    </ul>
                </div>
                    <button type="submit" class="btn btn-primary mr-2">Търсене</button>
                </form>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                        <thead>
                        <tr>
                            <th>Име</th>
                            <th>Количество</th>
                            <th>Дата</th>
                            <th>Дата на последна поръчка</th>
                            <th>Дата на последно презареждане</th>
                            <th>Цена</th>
                            <th>Баркод</th>
                            <th>Категория</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($arguments['products'] as $row) { ?>
                            <tr>
                                <td><a href="product_history?product_id=<?= $row['id']?>"> <?= $row['productName']; ?></a></td>
                                <td><?= $row['productQty']; ?></td>
                                <td><?= $row['productDate']; ?></td>
                                <td><?= $row['lastOrderDate']?: "Няма"; ?></td>
                                <td><?= $row['lastRefillDate']?: "Няма"; ?></td>
                                <td><?= $row['productPrice']; ?></td>
                                <td><?= $row['productBarCode']; ?></td>
                                <td><?= $row['categoryName']; ?></td>
                                <td>

                                    <a href="product_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Изтрий</a>
                                    <a href="product_addQty?id=<?= $row['id']; ?>" class="badge badge-primary p-2" >Презареди</a>
                                    <a href="product_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Редактирай</a>

                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="float-right">
            <a href="product_create" class="btn btn-primary">Добави</a>
        </div>
    </div>
</div>






