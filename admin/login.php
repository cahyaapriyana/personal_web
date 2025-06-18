<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:beranda_admin.php');
}
require_once("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" href="../src/favico.png">
</head>
<body class="bg-[#E8F1F2] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white border-4 border-black p-4 md:p-8 w-full max-w-md shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h2 class="text-2xl md:text-3xl font-black text-center mb-6 md:mb-8 text-[#1B4965]">// LOGIN ADMIN //</h2>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border-2 border-black text-red-700 px-3 md:px-4 py-2 md:py-3 mb-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="block sm:inline font-bold text-sm md:text-base"><?php echo $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_GET['register']) && $_GET['register'] === 'success') { ?>
            <div class="mb-4 text-green-600 font-bold text-center">Registrasi berhasil! Silakan login.</div>
        <?php } ?>

        <form action="cek_login.php" method="post" class="space-y-4 md:space-y-6">
            <div>
                <label for="username" class="block text-base md:text-lg font-bold text-[#1B4965] mb-2">USERNAME</label>
                <input type="text" 
                       name="username" 
                       id="username" 
                       required
                       class="w-full border-4 border-black p-2 md:p-3 text-base md:text-lg focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white">
            </div>
            
            <div>
                <label for="password" class="block text-base md:text-lg font-bold text-[#1B4965] mb-2">PASSWORD</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required
                       class="w-full border-4 border-black p-2 md:p-3 text-base md:text-lg focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                <button type="submit" 
                        name="login"
                        class="w-full sm:flex-1 bg-[#5FA8A3] text-white font-bold py-2 md:py-3 px-4 md:px-6 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all text-sm md:text-base">
                    LOGIN
                </button>
                <button type="reset" 
                        name="cancel"
                        class="w-full sm:flex-1 bg-[#1B4965] text-white font-bold py-2 md:py-3 px-4 md:px-6 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all text-sm md:text-base">
                    RESET
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="register.php" class="text-[#1B4965] font-bold hover:underline">Belum punya akun? Daftar di sini</a>
        </div>

        <div class="text-center text-xs md:text-sm text-[#1B4965] mt-6 md:mt-8 font-bold">
            &copy; <?php echo date('Y'); ?> - Cahya Apriyana
        </div>
    </div>
</body>
</html>
