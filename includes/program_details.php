<?php
// Database connection
$servername = "localhost";
$username = "root";       // replace with your database username
$password = "";           // replace with your database password
$dbname = "event";        // replace with your database name

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Fetch sports events
$sportsQuery = $pdo->prepare("SELECT * FROM events WHERE event_type = 'sports'");
$sportsQuery->execute();
$sportsEvents = $sportsQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch arts events
$artsQuery = $pdo->prepare("SELECT * FROM events WHERE event_type = 'arts'");
$artsQuery->execute();
$artsEvents = $artsQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="blog" class="program_details_area detials_bg_1 overlay2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-80 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                    <h3>College Events</h3>
                </div>
            </div>
        </div>

        <!-- Sports Events Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section_title text-center mb-4 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                    <h4>Sports Events</h4>
                </div>
                <div class="program_detail_wrap">
                    <?php foreach ($sportsEvents as $event): ?>
                    <div class="single_propram">
                        <div class="inner_wrap">
                            <div class="circle_img"></div>
                            <div class="porgram_top">
                                <span class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s"><?= date('g:i A', strtotime($event['event_time'])) ?></span>
                                <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><?= date('d M Y', strtotime($event['event_date'])) ?></h4>
                            </div>
                            <div class="thumb wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                                <img src="<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['event_name']) ?>">
                            </div>
                            <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s"><?= htmlspecialchars($event['event_name']) ?></h4>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Arts Events Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="section_title text-center mb-4 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                    <h4>Arts Events</h4>
                </div>
                <div class="program_detail_wrap">
                    <?php foreach ($artsEvents as $event): ?>
                    <div class="single_propram">
                        <div class="inner_wrap">
                            <div class="circle_img"></div>
                            <div class="porgram_top">
                                <span class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s"><?= date('g:i A', strtotime($event['event_time'])) ?></span>
                                <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><?= date('d M Y', strtotime($event['event_date'])) ?></h4>
                            </div>
                            <div class="thumb wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                                <img src="<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['event_name']) ?>">
                            </div>
                            <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s"><?= htmlspecialchars($event['event_name']) ?></h4>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
