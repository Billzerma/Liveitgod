<?= $this->extend('template/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Transaksi</h1>

    <div class="container">
        <div class="card mb-3">
            <img src="/img/IMG1.png" class="img-fluid" style="max-width: 100%;  max-height: 400px; height: auto; display: block; margin: 0 auto; object-fit: cover; display: flex;">
            <div class="card-body">
                <h5 class="card-title"><?= esc($transaksi['nama_layanan']); ?></h5>
                <p class="card-text">Kelas Layanan: <?= esc($transaksi['kelas_paket']); ?></p>
                <p class="card-text">Ruangan: <?= esc($transaksi['nomor_ruangan']); ?></p>
                <p class="card-text">Tanggal dan Jam Reservasi: <?= esc($transaksi['tanggal_booking']); ?></p>
                <p class="card-text">Tanggal dan Jam Selesai: <?= esc($transaksi['tanggal_checkout']); ?></p>
                <p class="card-text">Total Waktu Yang Dimiliki: <?= esc($durasiSewaJam); ?> jam</p>
                <p class="card-text">Sisa Waktu: <span id="countdown"></span></p>
                <p class="card-text">Total Harga: Rp<?= esc(number_format($transaksi['total'], 0, ',', '.')); ?></p>
                <p class="card-text">Status: <?= esc($transaksi['status']); ?></p>
                <p class="card-text">Deskripsi Layanan: <?= esc($transaksi['deskripsi']); ?></p>
                <a type="button" href="" class="btn btn-primary" style="margin-right: 50px; width: 100px;">Bayar</a>
                <a type="button" href="" class="btn btn-primary" style="margin-right: 50px; width: 100px;">Bayar</a>
                <a type="button" href="" class="btn btn-primary" style="margin-right: 50px; width: 100px;">Bayar</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdownElement = document.getElementById('countdown');
        const checkInTime = <?= json_encode($checkInTime) ?>;
        const checkOutTime = <?= json_encode($checkOutTime) ?>;
        const waktuSekarang = <?= json_encode($waktuSekarang) ?>;
        console.log('Waktu Sekarang:', new Date(waktuSekarang * 1000));
        console.log('Check In Time:', new Date(checkInTime * 1000));
        console.log('Check Out Time:', new Date(checkOutTime * 1000));


        // Fungsi untuk memperbarui hitungan mundur
        function updateCountdown() {
            const now = new Date().getTime() / 1000; // Waktu saat ini dalam detik
            const timeLeft = checkOutTime - now; // Waktu tersisa dalam detik

            if (timeLeft > 0) {
                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = Math.floor(timeLeft % 60);
                countdownElement.textContent = `${hours} jam ${minutes} menit ${seconds} detik`;
            } else {
                countdownElement.textContent = 'Waktu sewa telah berakhir';
            }
        }

        // Periksa apakah waktu sewa belum dimulai
        if (waktuSekarang < checkInTime) {
            countdownElement.textContent = 'Waktu belum dimulai';
        } else if (waktuSekarang >= checkInTime && waktuSekarang < checkOutTime) {
            updateCountdown();
            setInterval(updateCountdown, 1000);
        } else {
            countdownElement.textContent = 'Waktu sewa telah berakhir';
        }
    });
</script>
<?= $this->endSection(); ?>