<?php 
$pageTitle = "Product Detail - WayGo Travel";
session_start();

// Assuming you'll get product ID from URL parameter
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// In a real application, you would fetch product details from database
// This is a simple mock implementation
$products = [
    1 => [
        'name' => 'Herschel Little America™ Backpack | Premium Classics - 30L',
        'regular_price' => 11990.00,
        'sale_price' => 10791.00,
        'discount' => '10% off',
        'colors' => [
            ['name' => 'Black', 'code' => '#000000', 'selected' => true],
            ['name' => 'Dark Blue', 'code' => '#1a237e', 'selected' => false],
            ['name' => 'Light Pink', 'code' => '#f8bbd0', 'selected' => false],
            ['name' => 'Brown', 'code' => '#8B4513', 'selected' => false]
        ],
        'images' => [
            '../assets/img/bags/bag1.webp',
            '../assets/img/bags/bag1_alt1.webp',
            '../assets/img/bags/bag1_alt2.webp',
            '../assets/img/bags/bag1_alt3.webp',
        ],
        'description' => 'Our signature backpack. Reimagined with premium EcoSystem™ Twill Fabric and vegetable tanned leather details, this iconic mountain style is built to carry everything you need for a full day.',
        'features' => [
            'EcoSystem™ Twill Fabric made from 100% recycled post-consumer water bottles',
            'EcoSystem™ Liner made from 100% recycled post-consumer water bottles',
            'Vegetable tanned genuine leather details',
            'Padded and fleece lined floating sleeve fits a 15"/16" laptop',
            'Easy U-pull drawcord closure',
            'Carry comfortably with adjustable EVA-padded shoulder straps',
            'Compatible with a sternum strap for added support',
            'Magnet fastened straps with metal pin buckles',
            'Side entry zipper offers easy access',
            'Dual water bottle pockets expand to fit different sizes',
            'Top lid pocket with key clip',
            'Zippered front pocket',
            'Put Yourself Out There™ internal label',
            'Internal Herschel Supply stripe DNA tab'
        ],
        'specifications' => [
            'Volume' => '30L',
            'Dimensions' => 'H: 19.5" x W: 11.25" x D: 7"',
            'Material' => 'EcoSystem™ Twill Fabric',
            'Weight' => '2.4 lb / 1.09 kg'
        ]
    ],
    // Add more products as needed
];

// Get the current product
$product = isset($products[$product_id]) ? $products[$product_id] : $products[1];
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../views/includes/head.php"; ?>
<body>
    <?php include '../views/includes/navbar.php'; ?>
    <main class="main">
        <?php include '../modal/logmodal.php' ?>
        <?php include '../modal/signmodal.php' ?>  
        
        <!-- Breadcrumb -->
        <div class="container py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="products.php">Bags</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
                </ol>
            </nav>
        </div>
        
        <!-- Product Detail Section -->
        <div class="container pb-5">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-8 mb-4">
                    <div class="row">
                        <div class="col-2">
                            <!-- Thumbnails -->
                            <div class="d-flex flex-column">
                                <?php foreach($product['images'] as $index => $image): ?>
                                <div class="mb-3 thumbnail-container">
                                    <img src="<?php echo $image; ?>" alt="Product thumbnail" class="img-fluid thumbnail <?php echo ($index === 0) ? 'active' : ''; ?>" 
                                         onclick="changeMainImage(this.src)">
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-10">
                            <!-- Main Image -->
                            <div class="position-relative">
                                <?php if(isset($product['discount'])): ?>
                                <div class="sale-badge"><?php echo $product['discount']; ?></div>
                                <?php endif; ?>
                                <img id="mainImage" src="<?php echo $product['images'][0]; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="col-lg-4">
                    <h1 class="h2 mb-3"><?php echo $product['name']; ?></h1>
                    
                    <!-- Price -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="h3 mb-0 text-danger">₱<?php echo number_format($product['sale_price'], 2); ?></span>
                            <?php if(isset($product['regular_price']) && $product['regular_price'] > $product['sale_price']): ?>
                            <span class="ms-3 text-decoration-line-through text-muted">₱<?php echo number_format($product['regular_price'], 2); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <small>Or 6 months for only ₱1,799 with <strong>billease 0%</strong>. <a href="#">Learn More</a></small>
                        </div>
                    </div>
                    
                    <!-- Color Selection -->
                    <div class="mb-4">
                        <div class="d-flex mb-2">
                            <span>Color - 
                                <?php 
                                foreach($product['colors'] as $color) {
                                    if($color['selected']) {
                                        echo $color['name'];
                                        break;
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <div class="d-flex">
                            <?php foreach($product['colors'] as $color): ?>
                            <div class="me-2">
                                <div class="color-option <?php echo $color['selected'] ? 'selected' : ''; ?>" 
                                     style="background-color: <?php echo $color['code']; ?>;"
                                     data-color="<?php echo $color['name']; ?>"></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="mb-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <div class="d-flex w-25">
                            <button class="btn btn-outline-secondary" onclick="decrementQuantity()">-</button>
                            <input type="text" id="quantity" class="form-control text-center mx-2" value="1" min="1">
                            <button class="btn btn-outline-secondary" onclick="incrementQuantity()">+</button>
                        </div>
                    </div>
                    
                    <!-- Add to Cart Button -->
                    <div class="mb-3">
                        <button class="btn btn-dark btn-lg w-100 py-1 fs-6">ADD TO CART</button>
                    </div>
                    
                    <!-- Product Description -->
                    <div class="mb-4">
                        <p><?php echo $product['description']; ?></p>
                        <ul class="ps-3">
                            <?php foreach($product['features'] as $feature): ?>
                            <li class="mb-2"><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Specifications Accordion -->
                    <div class="mb-4">
                        <div class="accordion" id="specificationsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSpecifications">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecifications" aria-expanded="false" aria-controls="collapseSpecifications">
                                        Specifications
                                    </button>
                                </h2>
                                <div id="collapseSpecifications" class="accordion-collapse collapse" aria-labelledby="headingSpecifications" data-bs-parent="#specificationsAccordion">
                                    <div class="accordion-body">
                                        <dl class="row">
                                            <?php foreach($product['specifications'] as $key => $value): ?>
                                            <dt class="col-sm-3"><?php echo $key; ?></dt>
                                            <dd class="col-sm-9"><?php echo $value; ?></dd>
                                            <?php endforeach; ?>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include '../views/includes/footer.php'; ?>
    
    <!-- JavaScript for Image Switching and Quantity Controls -->
    <script>
        // Function to change main image when thumbnail is clicked
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
            
            // Update active thumbnail
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.classList.remove('active');
                if (thumb.src === src) {
                    thumb.classList.add('active');
                }
            });
        }
        
        // Function to increment quantity
        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity)) {
                quantityInput.value = quantity + 1;
            }
        }
        
        // Function to decrement quantity
        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity) && quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        }
        
        // Color option selection
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.color-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Update color name display
                const colorName = this.getAttribute('data-color');
                document.querySelector('span:contains("Color -")').innerText = 'Color - ' + colorName;
            });
        });
    </script>
</body>
</html>