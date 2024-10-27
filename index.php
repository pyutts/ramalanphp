<?php
function getRamalanSifat($hurufPertama) {
    $sifatAwal = [
        'a' => ['Ambisius', 'Antusias', 'Aktif'],
        'b' => ['Bijaksana', 'Baik hati', 'Berani'],
        'c' => ['Cerdas', 'Ceria', 'Cermat'],
        'd' => ['Dinamis', 'Dewasa', 'Disiplin'],
        'e' => ['Energik', 'Empati', 'Elegan'],
        'f' => ['Fantastis', 'Fleksibel', 'Friendly'],
        'g' => ['Gigih', 'Gembira', 'Gesit'],
        'h' => ['Harmonis', 'Humoris', 'Hangat'],
        'i' => ['Inovatif', 'Inspiratif', 'Intelek'],
        'j' => ['Jujur', 'Jenius', 'Jenaka'],
    ];
    $hurufPertama = strtolower($hurufPertama);
    return isset($sifatAwal[$hurufPertama]) ? $sifatAwal[$hurufPertama] : ['Misterius', 'Unik', 'Spesial'];
}

function getPeruntungan($panjangNama) {
    $peruntungan = [
        "Anda akan mendapat keberuntungan dalam waktu dekat",
        "Peluang karir yang bagus menanti Anda",
        "Akan bertemu seseorang yang spesial",
        "Kesuksesan finansial ada di depan mata",
        "Perjalanan menyenangkan akan segera datang",
        "Ide kreatif Anda akan membawa kesuksesan",
        "Kesehatan dan kebahagiaan akan menyertai Anda",
        "Hubungan dengan keluarga akan semakin harmonis"
    ];
    
    $index = $panjangNama % count($peruntungan);
    return isset($peruntungan[$index]) ? $peruntungan[$index] : $peruntungan[0];
}


// Inisialisasi variabel
$nama = '';
$hasil_ramalan = [];


// Cek submit form
if(isset($_POST['submit']) && isset($_POST['nama'])) {
    $nama = trim($_POST['nama']);
    
    if(!empty($nama)) {
        $hurufPertama = substr($nama, 0, 1);
        $hasil_ramalan = [
            'sifat' => getRamalanSifat($hurufPertama),
            'peruntungan' => getPeruntungan(strlen($nama)),
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramalkamudong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .result-box {
            transition: all 0.3s ease;
        }
        .result-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .loading {
            display: none;
        }
        form.loading .loading {
            display: block;
        }
        form.loading button[type="submit"] {
            display: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0 text-center">Cek Ramlan</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="ramalanForm" class="mb-4">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Masukkan Nama Anda</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" required >
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">Lihat Ramalan</button>
                        </form>

                        <?php if(isset($_POST['submit']) && !empty($nama) && !empty($hasil_ramalan)): ?>
                            <div class="results mt-4">
                                <h2 class="h5 text-center mb-4">Hasil Ramalan untuk "<?= htmlspecialchars($nama) ?>"</h2>
                                
                                <!-- Sifat-sifat -->
                                <div class="result-box card mb-3 border-primary">
                                    <div class="card-body">
                                        <h3 class="h6 card-title">✨ Sifat-sifat Utama</h3>
                                        <ul class="list-group list-group-flush">
                                            <?php foreach($hasil_ramalan['sifat'] as $sifat): ?>
                                                <li class="list-group-item"><?= htmlspecialchars($sifat) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Peruntungan -->
                                <div class="result-box card mb-3 border-success">
                                    <div class="card-body">
                                        <h3 class="h6 card-title">🍀 Peruntungan</h3>
                                        <p class="card-text"><?= htmlspecialchars($hasil_ramalan['peruntungan']) ?></p>
                                    </div>
                                </div>

                                <!-- Tombol Reset -->
                                <div class="text-center mt-4">
                                    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"class="btn btn-outline-primary">Ramalan Baru</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>