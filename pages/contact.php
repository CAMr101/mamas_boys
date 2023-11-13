<?php

session_start();

include "../components/header.php";
include "../components/footer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>
    <title>Contact Us</title>

    <!--link to css-->
    <link rel="stylesheet" href="../assets/css/contactStyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">


    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }
    </style>

</head>

<body>

    <?php
    echo createHeader();
    ?>

    <!---------------------------------------------------- Content Section ------------------------------------------------------------------------------------->
    <div class="contactUs">
        <div class="heading">
            <h2>Get in touch with us!</h2>
        </div>



        <!------------------------------------------------------------------------- the contact form itself------------------------------------------------------------->
        <div class="contactSections">
            <div class="contact form">
                <h3>Leave us a message</h3>

                <form method="post" action="../handlers/contact.php" name="contact-form">
                    <div class="formSection">
                        <div class="sectionInfo">
                            <div class="inputBox">
                                <span>First Name</span>
                                <input type="text" name="firstName" required>
                            </div>

                            <div class="inputBox">
                                <span>Last Name</span>
                                <input type="text" name="lastName" required>
                            </div>
                        </div>

                        <div class="sectionInfo">
                            <div class="inputBox">
                                <span>Email</span>
                                <input type="text" name="email" required>
                            </div>

                            <div class="inputBox">
                                <span>Phone Number</span>
                                <input type="text" name="phoneNumber" required>
                            </div>
                        </div>

                        <div class="sectionMessage">
                            <div class="inputBox">
                                <span>Message</span>
                                <textarea placeholder="Penny for your thoughts..." name="message" required></textarea>
                            </div>
                        </div>

                        <div class="sectionMessage">
                            <div class="inputBox">
                                <input type="submit" value="Send">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!---------------------------------------------------------- The contact details box------------------------------------------------------------------------>
            <div class="contact details">
                <h3>Contact Details</h3>
                <div class="detailsBox">
                    <div>
                        <span><i class="fa-solid fa-location-dot"></i></span>
                        <a href="https://goo.gl/maps/geo5jKh6H9bvQVNc9">Malamulele, Limpopo</a>
                    </div>
                    <div>
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:amasBoys@gmail.com">theonetshik@gmail.com</a>
                    </div>

                    <div>
                        <span><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:064 905 6958">+27 62 112 7909</a>
                    </div>

                    <!--Social media links-->
                    <ul class="socialLinks">
                        <li><a href="https://www.facebook.com/profile.php?id=100046590500835&mibextid=ZbWKwL"><i
                                    class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="www.instagram.com"><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>

                </div>
            </div>

            <!------------------------------------------------------------ The contact map box------------------------------------------------------------------------------>

            <div class="contact map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d772.0967389195683!2d30.696596923201547!3d-22.
         996890017627244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ec5b03103cc342d%3A0xf33dd2e04c0494f2!2sMalamulele%20Hospital!5e0!3m2!1sen!2sza!4v1696608075295!5m2!1sen!2sza"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
    <?php
    echo createFooter();
    ?>

    <!--link to fontawesome icons-->
    <script src="https://kit.fontawesome.com/1cc9d41456.js" crossorigin="anonymous"></script>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/script.js"></script>

</body>

</html>