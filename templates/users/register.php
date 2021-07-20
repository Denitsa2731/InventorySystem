<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h3 class="text-center text-info">Добави но служител</h3>
                    <form action="" class="justify-content-center" method="POST">

                        <div class="form-group">
                            <input type="email" name="userEmail" class="form-control" placeholder="Въведете email:"
                                   value=" ">
                            <!--required-->
                        </div>
                        <div class="form-group">
                            <input type="password" name="userPassword" class="form-control" placeholder="Въведете парола"
                                   value="">
                            <!--required-->
                        </div>
                        <div class="form-group">
                            <input type="text" name="firstName" class="form-control" placeholder="Въведете име"
                                   value="">
                            <!--required-->
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastName" class="form-control" placeholder="Въведете фамилия"
                                   value="">
                            <!--required-->
                        </div>
                        <div class="form-group">
                        <select name="userRole" class="form-control">
                            <option value="admin">админ</option>
                            <option value="employee">служител</option>
                        </select>
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
