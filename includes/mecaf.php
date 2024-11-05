<section class="black_bg  fadeInRight text-white" id="mecaf">
        <div class="section_title text-center mb-5">
            <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">MECAF</h3>
        </div>
        
        <main class="container  ">
            
            <!-- Arts Events Section -->
            <section id="arts-events" class="mb-5 wow fadeInRight">
                <h2 class="text-primary">Arts Events</h2>
                <div id="events-container" class="row">
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

                        // Fetch data from arts_events table
                        $sql = "SELECT title, artist, description, event_date FROM arts_events";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<div class='col-md-6 mb-3'>
                                        <div class='card bg-secondary text-white'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>{$row['title']}</h5>
                                                <p class='card-text'><strong>Artist:</strong> {$row['artist']}</p>
                                                <p class='card-text'><strong>Description:</strong> {$row['description']}</p>
                                                <p class='card-text'><strong>Date:</strong> {$row['event_date']}</p>
                                            </div>
                                        </div>
                                      </div>";
                            }
                        } else {
                            echo "<p class='text-muted'>No arts events available.</p>";
                        }

                        $conn->close();
                    ?>
                </div>
            </section>

            <!-- About Program Section -->
            <h3 class="wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">About Program</h3>
            <section id="about-program" class="mb-5">
                <p>The MECAF program brings together a wide variety of artists, offering a platform to showcase diverse art forms from around the world.</p>
            </section>

            <!-- Arts News Section -->
            <section id="news">
                <h2 class="text-primary">Latest Arts News</h2>
                <p>Stay tuned for the latest updates from the world of art!</p>
            </section>
        </main>
    </section>