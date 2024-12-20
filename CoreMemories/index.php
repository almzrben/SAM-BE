<?php
include("connect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>A05</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .col .position-relative {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 5px;
        overflow: hidden;
    }

    .col .position-relative:hover {
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
        transform: translateY(-10px);
    }
</style>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#home">Island of Personalities</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="d-flex align-items-center justify-content-center bg-dark text-white"
        style="height: 800px; background: url('assets/background.jpg') no-repeat center center/cover;" id="home">
    </header>

    <!-- Page Content -->
    <div class="container py-5" style="max-width: 1564px;">

        <!-- Projects Section -->
        <section id="projects">
            <h3 class="border-bottom pb-3">My Islands</h3>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php

                $query = "SELECT * FROM islandsofpersonality";
                $results = mysqli_query($conn, $query);
                if ($results) {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $image = $row['image'];
                        $name = $row['name'];
                        ?>
                        <div class="col">
                            <div class="position-relative" style="height:350px; overflow:hidden;">
                                <div class="position-absolute top-0 start-0 bg-dark text-white p-2"><?php echo $name; ?></div>
                                <img src="<?php echo $image ?> " class="img-fluid w-100 h-100" style="object-fit: cover;"alt="Island">
                            </div>
                        </div>
                    <?php }
                }
                ?>
            </div>
        </section>

        <!-- About Section -->
        <div id="aboutCarousel" class="carousel slide mt-4" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner" >
                <?php
                $islandsQuery = "SELECT * FROM islandsOfPersonality WHERE status='active'";
                $islandsResult = mysqli_query($conn, $islandsQuery);
                $isFirstSlide = true;

                while ($island = mysqli_fetch_assoc($islandsResult)) {
                    $islandId = $island['islandOfPersonalityID'];
                    $islandName = $island['name'];
                    $islandImage = $island['image'];
                    $islandColor = $island['color'];
                    $islandShort = $island['shortDescription'];
                    $islandLong = $island['longDescription'];
                    $contentstatus = $island['status'];
                    ?>
                    <div class="carousel-item <?php echo $isFirstSlide ? 'active' : ''; ?>"
                        data-name="<?php echo htmlspecialchars($islandName, ENT_QUOTES); ?>"
                        data-longdesc="<?php echo htmlspecialchars($islandLong, ENT_QUOTES); ?>">
                        <div class="row row-cols-1 row-cols-md-3 g-4" >
                            <?php
                            $contentsQuery = "SELECT * FROM islandContents WHERE islandOfPersonalityID = $islandId";
                            $contentsResult = mysqli_query($conn, $contentsQuery);

                            while ($content = mysqli_fetch_assoc($contentsResult)) {
                                $contentImage = $content['image'];
                                $contentText = $content['content'];
                                $contentColor = $content['color'];
                                
                                ?>
                                <div class="col text-center" >
                                    <div style="background-color:#e1e8f0;" class="d-flex flex-column align-items-center border rounded p-3 h-100"  >
                                        <img src="<?php echo $contentImage; ?>" class="img-fluid w-100 h-100 mb-3" style="object-fit: cover;"
                                            alt="Image">
                                        <h5><?php echo $islandName; ?></h5>
                                        <p class="text-muted"><?php echo $contentstatus ?></p>
                                        <div class="flex-grow-1 text-center">
                                            <p class="mb-3" style="min-height: 60px; overflow: hidden;">
                                                <?php echo $contentText; ?>
                                            </p>
                                        </div>
                                        <button class="btn btn-secondary disabled not-allowed w-100 mt-auto" style="background-color:#4681f4;">
                                            <?php echo $islandShort; ?>
                                        </button>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <?php
                    $isFirstSlide = false;
                }
                ?>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <h3 class="border-bottom pb-3">Contact</h3>
            <p>Let's get in touch and talk about your next project.</p>
            <form action="/action_page.php" target="_blank">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Name" required name="Name">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required name="Email">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Subject" required name="Subject">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Comment" required name="Comment"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Send Message</button>
            </form>
        </section>

        <!-- mpas to -->
        <div class="my-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.4010140413498!2d121.16517989999999!3d14.2114396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6266cb2e5375%3A0x891a88237a3dbe84!2sCalamba%2C%20Laguna%2C%20Philippines!5e0!3m2!1sen!2sph!4v1697796471759!5m2!1sen!2sph"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>Powered by <a href="https://getbootstrap.com" class="text-light text-decoration-none">Bootstrap</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const dynamicHeader = document.querySelector("#dynamicHeader h3");
        const dynamicParagraph = document.querySelector("#dynamicHeader p");


        const aboutCarousel = document.querySelector("#aboutCarousel");
        aboutCarousel.addEventListener("slid.bs.carousel", function () {

            const activeSlide = aboutCarousel.querySelector(".carousel-item.active");
            const islandName = activeSlide.getAttribute("data-name");
            const islandLongDesc = activeSlide.getAttribute("data-longdesc");


            dynamicHeader.textContent = islandName;
            dynamicParagraph.textContent = islandLongDesc;
        });
    </script>
</body>

</html>