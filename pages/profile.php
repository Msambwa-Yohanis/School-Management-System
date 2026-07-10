<?php
require_once 'config/database.php';
require_once 'config/regions_districts.php';

// Get current user profile
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? trim($_POST['date_of_birth']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $region = isset($_POST['region']) ? trim($_POST['region']) : '';
    $district = isset($_POST['district']) ? trim($_POST['district']) : '';
    $profile_picture = $user['profile_picture'] ?? '';

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_size = $_FILES['profile_picture']['size'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_type, $allowed_types)) {
            $error = 'Invalid file type. Only JPEG, PNG, and GIF are allowed.';
        } elseif ($file_size > $max_size) {
            $error = 'File size exceeds 5MB limit.';
        } else {
            // Create uploads directory if it doesn't exist
            $upload_dir = 'assets/uploads/profile_pictures/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique filename
            $file_ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $profile_picture = 'user_' . $_SESSION['user_id'] . '_' . time() . '.' . $file_ext;
            $file_path = $upload_dir . $profile_picture;

            // Delete old profile picture if exists
            if ($user['profile_picture'] && file_exists($upload_dir . $user['profile_picture'])) {
                unlink($upload_dir . $user['profile_picture']);
            }

            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $file_path)) {
                $error = 'Failed to upload profile picture.';
                $profile_picture = $user['profile_picture'] ?? '';
            }
        }
    }

    // For students, don't save phone number
    if ($user['role'] === 'student') {
        $phone = NULL;
    }

    if (empty($error)) {
        $stmt = $pdo->prepare('UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, gender = ?, date_of_birth = ?, address = ?, region = ?, district = ?, profile_picture = ? WHERE id = ?');
        
        try {
            $stmt->execute([$first_name, $last_name, $email, $phone, $gender, $date_of_birth, $address, $region, $district, $profile_picture, $_SESSION['user_id']]);
            $success = 'Profile updated successfully!';
            // Refresh user data
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = 'Failed to update profile. Please try again.';
        }
    }
}

// Get available regions
$regions = array_keys($regions_districts);
sort($regions);

// Get districts for current region if set
$current_districts = [];
if (!empty($user['region']) && isset($regions_districts[$user['region']])) {
    $current_districts = $regions_districts[$user['region']];
}
?>

<div class="profile-header">
    <h2>My Profile</h2>
</div>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST" class="form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <div class="profile-picture-section">
                        <?php if ($user['profile_picture'] && file_exists('assets/uploads/profile_pictures/' . $user['profile_picture'])): ?>
                            <div class="current-picture">
                                <img src="assets/uploads/profile_pictures/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" style="max-width: 100px; max-height: 100px; border-radius: 50%; margin-bottom: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <small>Allowed: JPEG, PNG, GIF (Max 5MB)</small>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" <?php echo ($user['gender'] ?? '') === 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] ?? '') === 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($user['gender'] ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" id="role" value="<?php echo ucfirst($user['role']); ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <?php if ($user['role'] !== 'student'): ?>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="region">Region</label>
                    <select id="region" name="region" required>
                        <option value="">Select Region</option>
                        <?php foreach ($regions as $reg): ?>
                            <option value="<?php echo htmlspecialchars($reg); ?>" <?php echo ($user['region'] ?? '') === $reg ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($reg); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district" required>
                        <option value="">Select District</option>
                        <?php foreach ($current_districts as $dist): ?>
                            <option value="<?php echo htmlspecialchars($dist); ?>" <?php echo ($user['district'] ?? '') === $dist ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($dist); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<script>
// Handle region change - populate districts dynamically
document.getElementById('region').addEventListener('change', function() {
    const region = this.value;
    const districtSelect = document.getElementById('district');
    
    // Clear current districts
    districtSelect.innerHTML = '<option value="">Select District</option>';
    
    if (region === '') {
        return;
    }
    
    // Fetch districts for the selected region
    fetch('api/get_districts.php?region=' + encodeURIComponent(region))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Error fetching districts:', error));
});
</script>
