<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();

$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);

?>
<div class="container">
    <!-- Content will go here -->
</div>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="text-center">Welcome to the Online Store</h1>
            <p class="text-center">Your one-stop shop for all your needs!</p>
        </div>
    </div>
    <div class="row">
        <h2>Products</h2>
        <?php foreach($products->getAll() as $product): ?>
        <div class="col-md-4">
            <div class="card">
                <!-- Ensure an image exists before displaying it, or provide a default image -->
                <img src="<?php echo !empty($product['image_path']) ? $product['image_path'] : 'uploads/default-image.jpg'; ?>" 
                     class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">
                        <?php echo $pesoFormatter->formatCurrency((float)$product['price'], 'PHP'); ?>
                    </h6>
                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Product</a>
                    <a href="#" class="btn btn-success add-to-cart" data-productid="<?php echo $product['id']; ?>" data-quantity="1">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php template('footer.php'); ?>
