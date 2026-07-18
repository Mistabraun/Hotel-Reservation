<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room Type</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background: #f8f4ef;
        }

        .card {
            border: none;
            border-radius: 18px;
        }

        .card-header {
            background: #c3922e;
            color: white;
        }

        .form-control {
            border-radius: 12px;
        }

        .btn-warning {
            background: #c3922e;
            border: none;
        }

        .btn-warning:hover {
            background: #a77921;
        }

        .amenity-box {
            transition: all 0.2s ease-in-out;
        }

        .amenity-box:hover {
            border-color: #c3922e !important;
            background-color: #fffaf0 !important;
        }

        .form-check-input:checked {
            background-color: #c3922e;
            border-color: #c3922e;
        }
    </style>
</head>

<body>

<?php
require_once "../config/database.php";

$conn = Database::connect();
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM room_types WHERE id='$id'");
$room = mysqli_fetch_assoc($result);

$available_amenities = ['WiFi', 'Aircon', 'TV', 'Mini Bar', 'Balcony', 'Pool Access', 'Room Service'];

$current_amenities = !empty($room['amenities']) ? array_map('trim', explode(',', $room['amenities'])) : [];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class="m-0 py-1">
                        <i class="fa-solid fa-bed me-2"></i> Edit Room Type
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Room Name</label>
                            <input type="text" name="room_name" class="form-control" value="<?= htmlspecialchars($room['room_name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" rows="4" name="description" required><?= htmlspecialchars($room['description']); ?></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Price</label>
                                <input type="number" name="price" step="0.01" class="form-control" value="<?= $room['price']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="<?= $room['capacity']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block mb-2">Amenities</label>
                            <div class="row g-2 px-1">
                                <?php foreach ($available_amenities as $amenity) { 
                                    $isChecked = in_array($amenity, $current_amenities) ? 'checked' : '';
                                    $safeId = 'amenity_' . strtolower(str_replace(' ', '_', $amenity));
                                ?>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check amenity-box p-2 rounded border bg-light d-flex align-items-center gap-2">
                                            <input class="form-check-input ms-0" type="checkbox" name="amenities[]" value="<?= $amenity; ?>" id="<?= $safeId; ?>" <?= $isChecked; ?>>
                                            <label class="form-check-label w-100 mb-0" style="cursor: pointer;" for="<?= $safeId; ?>">
                                                <?= $amenity; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="rooms-types.php" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-warning text-white px-4" name="update">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $name = mysqli_real_escape_string($conn, $_POST['room_name']);
                        $description = mysqli_real_escape_string($conn, $_POST['description']);
                        $price = $_POST['price'];
                        $capacity = $_POST['capacity'];
                        
                        $selected_amenities = isset($_POST['amenities']) ? $_POST['amenities'] : [];
                        $amenities_string = mysqli_real_escape_string($conn, implode(', ', $selected_amenities));

                        $query = "UPDATE room_types SET 
                            room_name='$name', 
                            description='$description', 
                            price='$price', 
                            capacity='$capacity',
                            amenities='$amenities_string' 
                            WHERE id='$id'";

                        if (mysqli_query($conn, $query)) {
                            echo "<script>window.location.href='rooms-types.php';</script>";
                            exit;
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Error updating room type: " . mysqli_error($conn) . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>