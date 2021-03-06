<section class="bg-image bg-image-sm" style="background-image: url('https://wallpapercave.com/wp/wp2605477.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Account Login</h4>
                    </div>
                    <div class="card-block">
                        <form action="<?php echo URL; ?>auth/login_user" id="login" method="post">
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="email" class="form-control form-control-secondary" placeholder="email">
                            </div>
                            <div class="form-group input-icon-left m-b-10">
                                <i class="fa fa-lock"></i>
                                <input type="password" name="password" class="form-control form-control-secondary" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary m-t-10 btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>