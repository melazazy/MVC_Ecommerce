<?php
// app/models/Review.php

class Review {
    private $id;
    private $productId;
    private $userId;
    private $rating;
    private $comment;

    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getRating() {
        return $this->rating;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
?>
