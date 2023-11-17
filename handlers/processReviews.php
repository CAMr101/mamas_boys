<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_review"])) {

    $email = $_POST["email"];
    $name = $_POST["name"];
    $review = $_POST["review"];
    $rating = $_POST["rating"];

    createReview($email, $name, $review, $rating);

    header("location:../pages/reviews.php");

}


function getReviews()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM `reviews` WHERE 1;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function createReview($email, $name, $review, $rating)
{
    include "../config/dbh.inc.php";

    try {

        $query = "INSERT INTO `reviews`(`name`, `email`, `review`, `rating`) VALUES (?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $email, $review, $rating]);

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
