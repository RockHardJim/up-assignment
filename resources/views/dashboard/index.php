<?php
$user = $_SESSION['user'];
$api = $_SESSION['api_key'];
?>
<section class="hero hero-profile" style="background-image: url('https://wallpapercave.com/wp/wp2605477.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="hero-block">
            <h5><?php echo ucfirst($user->name) .' ' . ucfirst($user->surname) ?></h5>
        </div>
    </div>
</section>


<section class="toolbar toolbar-profile" data-fixed="true">
    <div class="container">
        <div class="profile-avatar">
            <a href="#"><img src="<?php echo 'https://www.gravatar.com/avatar/"' . md5( strtolower( trim( $user->email ) ) ); ?>" alt=""></a>
            <div class="sticky">
                <a href="#"><img src="<?php echo 'https://www.gravatar.com/avatar/"' . md5( strtolower( trim( $user->email ) ) ); ?>" alt=""></a>
                <div class="profile-info">
                    <h5><?php echo ucfirst($user->name) .' ' . ucfirst($user->surname) ?></h5>
                </div>
            </div>
        </div>
        <ul class="toolbar-nav hidden-md-down">
            <li><a href="#">Games Reviewed</a></li>
            <li><a href="#">Games Saved</a></li>
            <li><a href="#">Friends</a></li>
            <li><a href="#">Forums</a></li>
        </ul>
    </div>
</section>

<section class="p-y-30">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <!-- post -->
                <div class="post post-card post-profile">
                    <div class="post-header">
                        <div>
                            <h2 class="post-title">
                                <a href="#">Your API Key</a>
                            </h2>
                            <div class="post-meta">
                                <span> Requests Available: <strong><?php echo $api->api_limit; ?></strong></span>
                                <span> Key: <strong><?php echo $api->token; ?></span>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>