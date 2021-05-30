<section class="bg-inverse p-y-0">
    <div class="owl-carousel owl-slide full-height">
        <div class="carousel-item" style="background-image: url('https://wallpapercave.com/wp/wp2605477.jpg');">
            <div class="carousel-overlay"></div>
            <div class="carousel-caption">
                <div>
                    <h3 class="carousel-title">UP-GAMERZ</h3>
                    <p>Welcome to the world of epic gaming and fun.</p>
                </div>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('https://wallpaperaccess.com/full/7445.jpg');">
            <div class="carousel-overlay"></div>
            <div class="carousel-caption">
                <div>
                    <h3 class="carousel-title">Home Of The Brave</h3>
                    <p>Our gaming catalogue allows users to register an account and be able to have gaming conversations on the website.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="p-y-80">
    <div class="container">
        <div class="heading">
            <i class="fa fa-steam"></i>
            <h2>Games</h2>
            <p>Some of the games stored in our system.</p>
        </div>

        <div class="row">
            <?php
            foreach($data['games'] as $game){
            ?>
            <div class="col-12 col-sm-8 col-md-4">
                <div class="card card-lg">
                    <div class="card-img">
                        <a href="<?php echo URL; ?>default/game/<?php echo $game['id']; ?>"><img src="<?php echo $game['background_image']; ?>" class="card-img-top" alt="<?php echo $game['name']; ?>"></a>
                        <?php
                            foreach($game['platforms'] as $platform) {
                                echo $platform['platform']['name'] .', ';
                            }?>
                    </div>
                    <div class="card-block">
                        <h4 class="card-title"><a href="<?php echo URL; ?>default/game/<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a></h4>

                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>

        <div class="text-center"><a class="btn btn-primary btn-shadow btn-rounded btn-effect btn-lg m-t-10" href="<?php echo URL; ?>default/games">Show More</a></div>
    </div>
</section>



