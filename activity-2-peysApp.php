<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Peys App</title>
</head>
<body>
    <header>
        <h1>Peys Application</h1>
    </header>
    <section class="main-container">
        <div class="image-area">
            <h2>Preview your Image</h2>
            <img id="imgPreview" src="images/profile_aimer.jpg" alt="Image Preview" 
                 style="width: <?php echo isset($_POST['sizeRange']) ? intval($_POST['sizeRange']) . 'px' : '160px'; ?>; border: 5px solid <?php echo isset($_POST['slcBorderColor']) ? htmlspecialchars($_POST['slcBorderColor']) : '#000'; ?>;">
        </div>

        <form method="POST" action="" class="controls">
            <div class="input-group">
                <label for="sizeRange">Select Size:</label>
                <input type="range" id="sizeRange" name="sizeRange" min="100" max="200" 
                       value="<?php echo isset($_POST['sizeRange']) ? $_POST['sizeRange'] : '160'; ?>" step="10">
            </div>

            <div class="input-group">
                <label for="slcBorderColor">Border Color:</label>
                <input type="color" id="slcBorderColor" name="slcBorderColor" 
                       value="<?php echo isset($_POST['slcBorderColor']) ? $_POST['slcBorderColor'] : '#000000'; ?>">
            </div>

            <button type="submit" name="process">Change</button>
        </form>
    </section>

    <?php
        $sizeRange = isset($_POST['sizeRange']) ? intval($_POST['sizeRange']) : 160;
        $borderColor = isset($_POST['slcBorderColor']) ? htmlspecialchars($_POST['slcBorderColor']) : '#000000';
    ?>
</body>
</html>
