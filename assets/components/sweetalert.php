<?php if (isset($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            icon: '<?php echo isset($_SESSION['type']) ? $_SESSION['type'] : 'info'; ?>',
            title: '<?php echo $_SESSION['message']; ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'small-alert' 
            }
        });
        didOpen: () => {
            document.querySelector('.swal2-popup').style.fontFamily = '"Poppins", sans-serif';
        }
    </script>
    <style>
        .small-alert {
            font-size: 14px; 
            padding: 10px; 
            font-family: system-ui;
            padding-top: 30px;
            padding-bottom: 50px;
            text-align: center;
            font-family: system-ui;
        }
    </style>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
endif;
?>
