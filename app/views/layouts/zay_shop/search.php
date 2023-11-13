<?= $this->view("zay_shop/header",$data);?>
    <?php
        if (count($data['result']) > 0) {
            // Output the search results
            echo '<div class="container search-result">';
            echo "<h2>Search Results:</h2>";
            foreach ( $data['result'] as $row) {
                echo "Product Name: " . $row->name . "<br>";
                echo "Description: " . $row->description . "<br>";
                echo "Price: $" . $row->price. "<br><br>";
            }
            echo '</div>';
        } else {
            echo '<div class="container search-result">';
            echo "No products found matching your search.";
            echo '</div>';
        }
    ?>

<?= $this->view("zay_shop/footer",$data);?>