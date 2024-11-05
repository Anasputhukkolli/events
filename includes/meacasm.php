   <!-- Main Content -->
<section id="mecasm" class="black_bg  text-white">
    <div class=" fadeInRight section_title text-center mb-80">
                        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" >MECASM</h3>
    </div>
   <main class="container   text-white wow fadeInRight">
        <!-- Live Scores Section -->
        <section id="live-scores" class="mb-5">
            <h2 class="text-primary">Live Scores</h2>
            <div id="scores-container" class="row">
                <?php
                    // Database Connection
                    $servername = "localhost";
                    $username = "root";       // replace with your database username
                    $password = "";           // replace with your database password
                    $dbname = "event";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch data from database
                    $sql = "SELECT team1, team2, score FROM matches";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='col-md-6 mb-3'>
                                    <div class='card bg-secondary text-white'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>{$row['team1']} vs {$row['team2']}</h5>
                                            <p class='card-text'>Score: {$row['score']}</p>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<p class='text-muted'>No live scores available.</p>";
                    }

                    $conn->close();
                ?>
            </div>
        </section>

        <!-- Upcoming Matches Section -->
         
        <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s" >About Program</h3>
        <section id="upcoming-matches" class="mb-5">
            <h2 class="text-primary">Upcoming Matches</h2>
            <ul class="list-group bg-dark">
                <li class="list-group-item bg-secondary text-white">Match 1: Team A vs Team B - Date: Tomorrow</li>
                <li class="list-group-item bg-secondary text-white">Match 2: Team C vs Team D - Date: Next Week</li>
            </ul>
        </section>

        <!-- News Section -->
        <section id="news">
            <h2 class="text-primary">Latest Sports News</h2>
            <p>Stay tuned for the latest sports news updates!</p>
        </section>
    </main>
</section>
