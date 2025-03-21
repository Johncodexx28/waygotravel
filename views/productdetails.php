<?php 
$pageTitle = "Product Detail - WayGo Travel";
session_start();

// Assuming you'll get product ID from URL parameter
$product_id = isset($_GET['id']);


echo $product_id;

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
<body class="d-flex flex-column min-vh-100">
    <?php include '../views/includes/navbar.php'; ?>
    <main class="main flex-grow-1">
        <?php include '../modal/logmodal.php' ?>
        <?php include '../modal/signmodal.php' ?>  
        
        <!-- Breadcrumb -->
        <div class="container py-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="products.php">Bags</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
                </ol>
            </nav>
        </div>
        
        <!-- Product Detail Section -->
        <div class="container pb-4">
            <div class="row g-4">
                <!-- Product Images -->
                <div class="col-lg-7 mb-3">
                    <div class="row g-2">
                        <div class="col-2">
                            <!-- Thumbnails -->
                            <div class="d-flex flex-column">
                                <?php foreach($product['images'] as $index => $image): ?>
                                <div class="mb-2 thumbnail-container">
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
                <div class="col-lg-5">
                    <h1 class="h3 mb-2"><?php echo $product['name']; ?></h1>
                    
                    <!-- Price -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <span class="h4 mb-0 text-danger">₱<?php echo number_format($product['sale_price'], 2); ?></span>
                            <?php if(isset($product['regular_price']) && $product['regular_price'] > $product['sale_price']): ?>
                            <span class="ms-2 text-decoration-line-through text-muted small">₱<?php echo number_format($product['regular_price'], 2); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-1">
                            <small>Or 6 months for ₱1,799 with <strong>billease 0%</strong>. <a href="#">Learn More</a></small>
                        </div>
                    </div>
                    
                    <!-- Color and Quantity in a Row -->
                    <div class="row mb-3">
                        <!-- Color Selection -->
                        <div class="col-sm-7 mb-2">
                            <div class="mb-1 small">
                                <span class="selected-color">Color - 
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
                                        style="background-color: <?php echo $color['code']; ?>; width: 25px; height: 25px; border-radius: 50%; cursor: pointer; border: 2px solid #ddd;"
                                        data-color="<?php echo $color['name']; ?>"></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="col-sm-5 mb-2">
                            <label for="quantity" class="form-label small mb-1">Quantity</label>
                            <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm py-0" onclick="decrementQuantity()">-</button>
                                <input type="text" id="quantity" class="form-control form-control-sm text-center mx-1" value="1" min="1" style="width: 40px;">
                                <button class="btn btn-outline-secondary btn-sm py-0" onclick="incrementQuantity()">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add to Cart Button -->
                    <div class="mb-3">
                        <button class="btn btn-dark w-100 py-2">ADD TO CART</button>
                    </div>
                    
                    <!-- Product Description in Tabs -->
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">Specifications</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="productTabsContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p class="small"><?php echo $product['description']; ?></p>
                                <ul class="ps-3 small">
                                    <?php foreach(array_slice($product['features'], 0, 5) as $feature): ?>
                                    <li class="mb-1"><?php echo $feature; ?></li>
                                    <?php endforeach; ?>
                                    <?php if(count($product['features']) > 5): ?>
                                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#moreFeatures">See more features</a></li>
                                    <div id="moreFeatures" class="collapse">
                                        <?php foreach(array_slice($product['features'], 5) as $feature): ?>
                                        <li class="mb-1"><?php echo $feature; ?></li>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                                <dl class="row mb-0 small">
                                    <?php foreach($product['specifications'] as $key => $value): ?>
                                    <dt class="col-sm-4"><?php echo $key; ?></dt>
                                    <dd class="col-sm-8"><?php echo $value; ?></dd>
                                    <?php endforeach; ?>
                                </dl>
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
        // Function to change main image
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
                if(thumb.src === src) {
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
            } else {
                quantityInput.value = 1;
            }
        }

        // Function to decrement quantity
        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (!isNaN(quantity) && quantity > 1) {
                quantityInput.value = quantity - 1;
            } else {
                quantityInput.value = 1;
            }
        }

        // Prevent non-numeric input in quantity field
        document.getElementById('quantity').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value === '' || parseInt(this.value) < 1) {
                this.value = 1;
            }
        });
        
        // Color option selection
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.style.border = '2px solid #ddd';
                });
                
                this.classList.add('selected');
                this.style.border = '2px solid #000';
                
                const colorName = this.getAttribute('data-color');
                const colorDisplay = document.querySelector('.selected-color');
                if (colorDisplay) {
                    colorDisplay.innerText = 'Color - ' + colorName;
                }
            });
        });
        
        // Initialize selected color option with border
        document.querySelectorAll('.color-option.selected').forEach(option => {
            option.style.border = '2px solid #000';
        });
    </script>
    
    <!-- Additional CSS to make the page more compact -->
    <style>
        html, body {
            min-height: 100%;
            height: auto;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .thumbnail {
            cursor: pointer;
            border: 1px solid #dee2e6;
            max-width: 100%;
            height: auto;
        }
        
        .thumbnail.active {
            border-color: #0d6efd;
        }
        
        .sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.25rem;
        }
        
        .color-option {
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }
        
        .color-option.selected {
            border: 2px solid #000;
        }
        
        .form-control-sm {
            height: 31px;
        }
       
        body {
            font-size: 0.9rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        /* Responsive image gallery */
        @media (max-width: 767.98px) {
            .thumbnail-container {
                display: inline-block;
                margin-right: 5px;
                margin-bottom: 5px;
                width: auto;
            }
            
            .col-2 .d-flex {
                flex-direction: row;
                flex-wrap: wrap;
                margin-bottom: 10px;
            }
        }
        
        /* Fix for smaller screens */
        @media (max-width: 575.98px) {
            .row.g-2 {
                display: flex;
                flex-direction: column;
            }
            
            .col-2, .col-10 {
                width: 100%;
                max-width: 100%;
                flex: 0 0 100%;
            }
            
            .col-2 .d-flex {
                flex-direction: row;
            }
            
            .thumbnail-container {
                width: 60px;
                height: auto;
                margin-right: 10px;
            }
        }
    </style>
</body>
</html>