<?php

include 'get_all_trips.php';
include 'get_trip_images.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?> 



<header class="main-header">
    <div class="fullscreen-video-container">
        <video src="videos/longonot.mp4" autoplay loop muted></video>
    </div>
    <div class="header-content">
        <div class="top-banner">
            <span id="logo">REDO WILD SAFARIS</span>
            <div class="top-banner-text">
                <span id="top-banner-phone"> <img class="top-banner-icon" src="icons/phone.svg" alt="phone">+254 702 954 954</span>
                <span id="top-banner-mail"> <img class="top-banner-icon" src="icons/email.svg" alt="email">info@redowildsafaris.co.ke</span>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="#">SAFARIS</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#">CONTACT</a></li>
                <li id="login-link"> <img class="top-banner-icon" src="icons/profile.svg" alt="">MY ACCOUNT</li>
            </ul>
                
        </nav>

        

        <div class="headline">
            <p id="headline-company-name">redo wild safaris</p>
            <p id="headline-main-text">a reliable safari partner</p>
            <p id="headline-secondary-text">explore kenya's landscape and nature with us</p>
        </div>

        <div class="headline-button-container">
            <a class="headline-button headline-button-1" href="#">view safaris</a>
            <a class="headline-button" id="headline-button-2" href="#">sign up</a>
        </div>
    </div>
</header>

<section class="trips blue-background">

    <div class="trips-title-container align-center">
        <h1 class="section-title">Upcoming trips</h1>
        <p>A Quick Breakdown of Some of Our Most Popular Destinations</p>
    </div>

    <div class="trips-container">

    
    <?php foreach($trips as $trip): ?>

        <?php 
            
            $tripId = $trip['id']; 
            $tripImage = array_values(array_filter($tripImages, function($array) {
                global $tripId;
                return $array['tripId'] == $tripId;
    
            }));
                
        
        ?>


    <div class="trip-card">
        <img src="images/<?php echo $tripImage[0]['image_name']; ?>" alt="<?php echo $trip['tripname']; ?>">
        <h3 class="trip-title"><?php echo $trip['tripname']; ?></h3>
        <p class="trip-description"><?php echo $trip['description']; ?></p>
    </div>
   
    <?php endforeach; ?>
    </div>
    

</section>

<section class="trips">
    
    <div class="trips-title-container">
            <h1 id="coast-trips-title" class="section-title">Some coastal magic...</h1>
    </div>

    <div class="trips-container">

            <?php 

            $i = 0; 
            
            foreach($trips as $trip) : 
            
                if($i == 3) {
                break;
                }

                $tripId = $trip['id'];
                $coastTripImage = array_values(array_filter($tripImages, function($array) {
                    global $tripId;
                    return $array['tripId'] == $tripId;
                    
                }));
        
            ?> 

            <div class="trip-card" id="coast-trips-card">
                <img src="images/<?php echo $coastTripImage[0]['image_name']; ?>" alt="<?php echo $trip['tripname']; ?>">
                <h3 class="trip-title"><?php echo $trip['tripname']; ?></h3>
                <p class="trip-description"><?php echo $trip['description']; ?></p>
            </div>

            
            <?php $i++; ?>
        
            <?php endforeach; ?>


                
    
    </div>
    
</section>


<!-- <?php include "footer.php"; ?> -->


</html>

