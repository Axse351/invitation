<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling tambahan untuk gambar agar pas dengan kolom */
        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* Styling untuk nomor antrian agar lebih besar */
        .nomor-antrian {
            font-size: 2rem;
            /* Ukuran font lebih besar */
            font-weight: bold;
            /* Membuat font tebal */
            color: #007bff;
            /* Warna biru untuk nomor antrian */
            text-align: center;
            /* Tengah-kan teks */
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <!-- Kolom Form -->
            <div class="col-12 col-md-6 mb-5">
                <h1>Form Kehadiran</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    {{-- Menghapus session 'success' setelah ditampilkan --}}
                    @php
                        session()->forget('success');
                    @endphp
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('event.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No HP:</label>
                        <input type="text" id="nohp" name="nohp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="sales" class="form-label">Sales:</label>
                        <input type="text" id="sales" name="sales" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="sh" class="form-label">SH:</label>
                        <input type="text" id="sh" name="sh" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand:</label>
                        <select id="brand" name="brand" class="form-control" required>
                            <option value="suzuki">Suzuki</option>
                            <option value="honda eiyu">Honda Eiyu</option>
                            <option value="hyundai kalijaga">Hyundai Kalijaga</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>

            <!-- Kolom Gambar -->
            <div class="col-12 col-md-6">
                <div class="image-container">
                    <img src="img/caro1.jpg" alt="Image Placeholder">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Nomor Antrian -->
    <div class="modal fade" id="nomorAntrianModal" tabindex="-1" aria-labelledby="nomorAntrianModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nomorAntrianModalLabel">Nomor Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Menambahkan styling untuk nomor antrian -->
                    <div class="card nomor-antrian">
                        Nomor Registrasi: {{ session('nomorAntrian') }}
                    </div>
                    <p>Nama: {{ session('nama') }}</p>
                    <p>Alamat: {{ session('alamat') }}</p>
                    <p>No HP: {{ session('nohp') }}</p>
                    <p>Sales: {{ session('sales') }}</p>
                    <p>SH: {{ session('sh') }}</p>
                    <p>Brand: {{ session('brand') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tambahkan JavaScript untuk langsung membuka modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('nomorAntrian'))
                var myModal = new bootstrap.Modal(document.getElementById('nomorAntrianModal'));
                myModal.show();
                // Menghapus session setelah modal ditampilkan
                @php
                    session()->forget('nomorAntrian');
                    session()->forget('nama');
                    session()->forget('alamat');
                    session()->forget('nohp');
                    session()->forget('sales');
                    session()->forget('sh');
                    session()->forget('brand');
                @endphp
            @endif
        });
    </script>

</body>

</html>
