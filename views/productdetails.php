<?php 
$pageTitle = "Product Detail - WayGo Travel";
session_start();

include '../cart/getcartcount.php';
include '../views/includes/conn.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a query for just this specific product
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if product exists
if ($result->num_rows === 0) {
    // No product found with this ID
    header("Location: products.php");
    exit;
}

// Get the product data
$product = $result->fetch_assoc();

// Create dummy data for missing database fields
// (You should update your database to include these fields properly)
$dummyColors = [
    ['name' => 'Black', 'code' => '#000000', 'selected' => true],
    ['name' => 'Brown', 'code' => '#8B4513', 'selected' => false],
    ['name' => 'Gray', 'code' => '#708090', 'selected' => false]
];

$dummySizes = [
    ['name' => 'Small', 'selected' => false],
    ['name' => 'Medium', 'selected' => true],
    ['name' => 'Large', 'selected' => false]
];

$dummyFeatures = [
    'Durable material',
    'Multiple compartments',
    'Water-resistant exterior',
    'Adjustable straps',
    'Front pocket',
    'Side pockets',
    'Interior zipper pocket'
];

$dummySpecs = [
    'Dimensions' => '16.5" × 11.8" × 5.1"',
    'Weight' => '2.1 lbs (0.95 kg)',
    'Materials' => 'Nylon, polyester lining',
    'Capacity' => '24L'
];

// Extract the image path and create a dummy array of images
$imageArray = [$product['image']];
// Add some dummy additional images
for ($i = 2; $i <= 4; $i++) {
    $imageArray[] = $product['image']; // Just duplicate the main image
}

// Display success or error messages if set
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';

// Clear messages after displaying them
if(isset($_SESSION['success'])) unset($_SESSION['success']);
if(isset($_SESSION['error'])) unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="en">
<?php include "../views/includes/head.php"; ?>
<body class="d-flex flex-column min-vh-100">
    <?php include '../views/includes/navbar.php'; ?>
    <?php include "../assets/components/sweetalert.php"; ?>
    
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
        
        <!-- Alerts for success/error messages -->
        <?php if (!empty($success_message)): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Product Detail Section -->
        <div class="container pb-4">
            <div class="row g-4">
                <!-- Product Images -->
                <div class="col-lg-7 mb-3">
                    <div class="row g-2">
                        <div class="col-2">
                            <!-- Thumbnails -->
                            <div class="d-flex flex-column">
                                <?php foreach($imageArray as $index => $image): ?>
                                <div class="mb-2 thumbnail-container">
                                    <img src="../<?php echo $image; ?>" alt="Product thumbnail" class="img-fluid thumbnail <?php echo ($index === 0) ? 'active' : ''; ?>" 
                                         onclick="changeMainImage(this.src)">
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-10">
                            <!-- Main Image -->
                            <div class="position-relative">
                                <div class="sale-badge">10% OFF</div>
                                <img id="mainImage" src="../<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Info with Form -->
                <div class="col-lg-5">
                    <h1 class="h3 mb-2"><?php echo $product['name']; ?></h1>
                    
                    <!-- Price -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <!-- Calculate sale price (10% off) -->
                            <?php 
                            $sale_price = $product['price'] * 0.9; // 10% off
                            ?>
                            <span class="h4 mb-0 text-danger">₱<?php echo number_format($sale_price, 2); ?></span>
                            <span class="ms-2 text-decoration-line-through text-muted small">₱<?php echo number_format($product['price'], 2); ?></span>
                        </div>
                        <div class="mt-1">
                            <small>Or 6 months for ₱<?php echo number_format($sale_price/6, 2); ?> with <strong>billease 0%</strong>. <a href="#">Learn More</a></small>
                        </div>
                    </div>
                    
                    <!-- Form for Add to Cart -->
                    <form id="addToCartForm" action="../cart/cartprocess.php" method="POST">
                        <!-- Hidden Product ID -->
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $sale_price; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" id="selected_color_input" name="color" value="Black">
                        <input type="hidden" id="selected_size_input" name="size" value="Medium">
                        
                        <!-- Color and Size Section -->
                        <div class="row mb-3">
                            <!-- Color Selection -->
                            <div class="col-sm-6 mb-2">
                                <div class="mb-1 small">
                                    <span class="selected-color">Color - 
                                        <?php 
                                        foreach($dummyColors as $color) {
                                            if($color['selected']) {
                                                echo $color['name'];
                                                break;
                                            }
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <?php foreach($dummyColors as $color): ?>
                                    <div class="me-2">
                                        <div class="color-option <?php echo $color['selected'] ? 'selected' : ''; ?>" 
                                            style="background-color: <?php echo $color['code']; ?>; width: 25px; height: 25px; border-radius: 50%; cursor: pointer; border: 2px solid #ddd;"
                                            data-color="<?php echo $color['name']; ?>"></div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Size Selection -->
                            <div class="col-sm-6 mb-2">
                                <div class="mb-1 small">
                                    <span class="selected-size">Size - 
                                        <?php 
                                        foreach($dummySizes as $size) {
                                            if($size['selected']) {
                                                echo $size['name'];
                                                break;
                                            }
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <?php foreach($dummySizes as $size): ?>
                                    <div class="me-2">
                                        <div class="size-option <?php echo $size['selected'] ? 'selected' : ''; ?>"
                                            style="width: auto; padding: 2px 8px; cursor: pointer; border: 1px solid #ddd; border-radius: 3px; font-size: 0.8rem;"
                                            data-size="<?php echo $size['name']; ?>"><?php echo $size['name']; ?></div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label small mb-1">Quantity</label>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="decrementQuantity()">-</button>
                                <input type="text" id="quantity" name="quantity" class="form-control form-control-sm text-center mx-1" value="1" min="1" style="width: 50px;">
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="incrementQuantity()">+</button>
                            </div>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark w-100 py-2">ADD TO CART</button>
                        </div>
                    </form>
                    
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
                                    <?php foreach(array_slice($dummyFeatures, 0, 5) as $feature): ?>
                                    <li class="mb-1"><?php echo $feature; ?></li>
                                    <?php endforeach; ?>
                                    <?php if(count($dummyFeatures) > 5): ?>
                                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#moreFeatures">See more features</a></li>
                                    <div id="moreFeatures" class="collapse">
                                        <?php foreach(array_slice($dummyFeatures, 5) as $feature): ?>
                                        <li class="mb-1"><?php echo $feature; ?></li>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                                <dl class="row mb-0 small">
                                    <?php foreach($dummySpecs as $key => $value): ?>
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
    <?php include '../cart/fetchcart.php'?>
    <?php include '../cart/cartoff.php' ?>
    
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
                
                // Update hidden input for color
                document.getElementById('selected_color_input').value = colorName;
            });
        });
        
        // Size option selection
        document.querySelectorAll('.size-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.size-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.style.backgroundColor = '';
                    opt.style.color = '';
                    opt.style.border = '1px solid #ddd';
                });
                
                this.classList.add('selected');
                this.style.backgroundColor = '#212529';
                this.style.color = 'white';
                this.style.border = '1px solid #212529';
                
                const sizeName = this.getAttribute('data-size');
                const sizeDisplay = document.querySelector('.selected-size');
                if (sizeDisplay) {
                    sizeDisplay.innerText = 'Size - ' + sizeName;
                }
                
                // Update hidden input for size
                document.getElementById('selected_size_input').value = sizeName;
            });
        });
        
        // Initialize selected color and size options with styling
        document.querySelectorAll('.color-option.selected').forEach(option => {
            option.style.border = '2px solid #000';
        });
        
        document.querySelectorAll('.size-option.selected').forEach(option => {
            option.style.backgroundColor = '#212529';
            option.style.color = 'white';
            option.style.border = '1px solid #212529';
        });
        
        // Form submission handling with validation
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            // Validate form fields before submitting
            const quantity = document.getElementById('quantity').value;
            const color = document.getElementById('selected_color_input').value;
            const size = document.getElementById('selected_size_input').value;
            
            if (quantity < 1) {
                e.preventDefault();
                alert('Please select a valid quantity');
                return false;
            }
            
            if (!color) {
                e.preventDefault();
                alert('Please select a color');
                return false;
            }
            
            if (!size) {
                e.preventDefault();
                alert('Please select a size');
                return false;
            }
            
            // Form is valid, continue with submission
            return true;
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
        
        .size-option {
            cursor: pointer;
            display: inline-block;
            text-align: center;
            min-width: 30px;
        }
        
        .size-option.selected {
            background-color: #212529;
            color: white;
            border-color: #212529;
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