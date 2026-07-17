<?php
session_start();

$title = "CyberVision - About";
$currentPage = "about";

$groupMembers = [
    [
        "name" => "Joschka Atabelo",
        "image" => "images/joschka.jpg"
    ],
    [
        "name" => "Art Panulde",
        "image" => "images/art.jpg"
    ],
    [
        "name" => "Jose Soriano",
        "image" => "images/jose.jpg"
    ],
    [
        "name" => "Carl Vitalista",
        "image" => "images/carl.jpg"
    ]
];

require("include/header.php");
?>


<div class="cv-about-banner">
    <div class="cv-about-banner-inner">

        <div class="cv-eyebrow-lined">ABOUT CYBERVISION</div>

        <h1>
            Designed for Comfort.<br>
            Built for <span class="cv-accent-text">Productivity.</span>
        </h1>

        <p>CyberVision delivers premium seating solutions that combine ergonomic design, durability, and style to help you work, game, and relax at your best.</p>
    
    </div>
</div>


<section class="container py-5">

    <div class="row g-5 align-items-start">

        <div class="col-lg-6">

            <span class="cv-section-label">ABOUT US</span>

            <h2 class="fw-bold mb-4">
                We Believe Great Work Starts With A <span class="cv-accent-text">Great Chair.</span>
            </h2>

            <p class="text-secondary mb-3">
                CyberVision specializes in ergonomic, executive, gaming,
                visitor, and drafting chairs carefully selected for
                comfort, quality, and long-term durability.
            </p>

            <p class="text-secondary mb-4">
                Our goal is to provide seating solutions that improve
                productivity, support proper posture, and enhance every
                workspace.
            </p>

            <a href="store.php" class="btn-cv">
                Explore Our Chairs <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <div class="col-lg-6">

            <div class="cv-card cv-why-card">

                <h4 class="mb-2">Why Choose CyberVision?</h4>

                <div class="cv-why-grid">

                    <div class="cv-why-item">
                        <div class="cv-stat-item">
                            <div class="cv-stat-icon"><i class="fa-solid fa-chair"></i></div>
                            <div class="cv-stat-text">
                                <h2 class="text-primary fw-bold">3</h2>
                                <p>Chair Categories</p>
                                <small>Ergonomic, Executive, Gaming</small>
                            </div>
                        </div>
                    </div>

                    <div class="cv-why-item">
                        <div class="cv-stat-item">
                            <div class="cv-stat-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <div class="cv-stat-text">
                                <h2 class="text-primary fw-bold">100%</h2>
                                <p>Quality Checked</p>
                                <small>Every chair is inspected for quality and durability.</small>
                            </div>
                        </div>
                    </div>

                    <div class="cv-why-item">
                        <div class="cv-stat-item">
                            <div class="cv-stat-icon"><i class="fa-solid fa-users"></i></div>
                            <div class="cv-stat-text">
                                <h2 class="text-primary fw-bold">4</h2>
                                <p>Team Members</p>
                                <small>Passionate developers working behind the scenes.</small>
                            </div>
                        </div>
                    </div>

                    <div class="cv-why-item">
                        <div class="cv-stat-item">
                            <div class="cv-stat-icon"><i class="fa-solid fa-headset"></i></div>
                            <div class="cv-stat-text">
                                <h2 class="text-primary fw-bold">24/7</h2>
                                <p>Project Support</p>
                                <small>We're here to help whenever you need us.</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="container py-5">

    <div class="text-center mb-5">

        <span class="cv-section-label">OUR TEAM</span>

        <h2 class="fw-bold cv-underline-heading">Meet Our Team</h2>

        <p class="text-secondary">
            The passionate developers behind the CyberVision project.
        </p>

    </div>

    <div class="row g-4 justify-content-center">

        <?php foreach($groupMembers as $member): ?>

        <div class="col-lg-3 col-md-6">

            <div class="cv-card text-center team-card p-4 h-100">

                <div class="team-avatar">
                    <img src="<?= htmlspecialchars($member['image']) ?>" alt="<?= htmlspecialchars($member['name']) ?>">
                </div>

                <h5 class="fw-bold mt-4"><?= htmlspecialchars($member['name']) ?></h5>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>


<section class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="text-center mb-4">
                <span class="cv-section-label">CONTACT US</span>
                <h2 class="fw-bold cv-underline-heading">Get in Touch</h2>
                <p class="text-secondary">We'd love to hear from you. Reach out for inquiries.</p>
            </div>

            <div class="cv-contact-card">
                <div class="cv-contact-list">

                    <div class="cv-contact-row">
                        <div class="cv-contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="cv-contact-text">
                            <h6>Address</h6>
                            <p>123 Rivera St., Office District,<br>Makati City, Philippines</p>
                        </div>
                    </div>

                    <div class="cv-contact-row">
                        <div class="cv-contact-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="cv-contact-text">
                            <h6>Phone</h6>
                            <p>+63 912 345 6789</p>
                        </div>
                    </div>

                    <div class="cv-contact-row">
                        <div class="cv-contact-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="cv-contact-text">
                            <h6>Email</h6>
                            <p>cybervision@gmail.com</p>
                        </div>
                    </div>

                    <div class="cv-contact-row">
                        <div class="cv-contact-icon"><i class="fa-solid fa-clock"></i></div>
                        <div class="cv-contact-text">
                            <h6>Business Hours</h6>
                            <p>Mon - Fri: 8:00 AM - 6:00 PM<br>Sat: 10:00 AM - 2:00 PM</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>

<?php require("include/footer.php"); ?>