<?php
include('../koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $error = '';
 
    $cek = mysqli_query($db, "SELECT * FROM tbl_user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = 'Username sudah terdaftar!';
    } else {
        $insert = mysqli_query($db, "INSERT INTO tbl_user (username, password, role) VALUES ('$username', '$password', 'Viewer')");
        if ($insert) {
            header('Location: login.php?register=success');
            exit;
        } else {
            $error = 'Registrasi gagal!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-[#E8F1F2] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h1 class="text-2xl md:text-3xl font-black text-[#1B4965] mb-6 text-center">Registrasi Admin</h1>
        <?php if (!empty($error)) { echo '<div class="mb-4 text-red-600 font-bold text-center">'.$error.'</div>'; } ?>
        <form method="post" class="space-y-6">
            <div>
                <label for="username" class="block text-lg font-bold text-[#1B4965] mb-2">Username</label>
                <input type="text" id="username" name="username" required class="w-full p-3 border-4 border-black focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            </div>
            <div>
                <label for="password" class="block text-lg font-bold text-[#1B4965] mb-2">Password</label>
                <input type="password" id="password" name="password" required class="w-full p-3 border-4 border-black focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            </div>
            <button type="submit" class="w-full bg-[#5FA8A3] text-white font-bold py-3 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Daftar</button>
        </form>
        <div class="mt-4 text-center">
            <a href="login.php" class="text-[#1B4965] font-bold hover:underline">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html> 