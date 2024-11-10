<?php
include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['action']) && $_POST['action'] == 'load_data') {
    $query = "
    SELECT 
        ROUND(AVG(user_rating), 2) as average_rating, 
        COUNT(*) as total_review, 
        SUM(CASE WHEN user_rating = 5 THEN 1 ELSE 0 END) as five_star_review, 
        SUM(CASE WHEN user_rating = 4 THEN 1 ELSE 0 END) as four_star_review, 
        SUM(CASE WHEN user_rating = 3 THEN 1 ELSE 0 END) as three_star_review, 
        SUM(CASE WHEN user_rating = 2 THEN 1 ELSE 0 END) as two_star_review, 
        SUM(CASE WHEN user_rating = 1 THEN 1 ELSE 0 END) as one_star_review 
    FROM reviews
    WHERE status = 'approved'
    ";

    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    $data['average_rating'] = number_format((float)$data['average_rating'], 2, '.', '');

    $query = "SELECT * FROM reviews WHERE status = 'approved' ORDER BY datetime DESC";
    $result = $conn->query($query);
    $reviews = array();

    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    $data['review_data'] = $reviews;
    echo json_encode($data);
} else {

    if (isset($_POST['user_rating']) && is_numeric($_POST['user_rating'])) {
        $rating_data = intval($_POST['user_rating']);
    } else {
        die();
    }

    $user_review = isset($_POST['user_review']) ? $_POST['user_review'] : '';
    $datetime = date('Y-m-d H:i:s');

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $stmt = $conn->prepare("INSERT INTO reviews (username, user_rating, user_review, datetime) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $username, $rating_data, $user_review, $datetime);

        if ($stmt->execute()) {
            echo "Review submitted successfully! It will be visible once approved.";
        } else {
            echo "Error submitting review: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "You must be logged in to submit a review.";
    }
}

$conn->close();
?>

