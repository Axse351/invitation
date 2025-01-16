<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Kehadiran Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Data Kehadiran Event</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <h3>Total Kehadiran: <span id="total-hadir">{{ $totalHadir }}</span></h3>
            <h3>Total Registrasi: <span id="total-regist">{{ count($events) }}</span></h3>
        </div>
        <div class="mb-3">
            <a href="{{ url('/event/export') }}" class="btn btn-success">Ekspor ke Excel</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nomor Antrian</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Sales</th>
                    <th>SH</th>
                    <th>Brand</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr id="row-{{ $event->id_event }}">
                        <td>{{ $event->id_event }}</td>
                        <td>{{ $event->nama }}</td>
                        <td>{{ $event->alamat }}</td>
                        <td>{{ $event->nohp }}</td>
                        <td>{{ $event->sales }}</td>
                        <td>{{ $event->sh }}</td>
                        <td>{{ $event->brand }}</td>
                        <td>
                            @if ($event->hadir)
                                <button class="btn btn-secondary" disabled>Hadir (Terkonfirmasi)</button>
                            @else
                                <button class="btn btn-success btn-hadir" data-id="{{ $event->id_event }}">Konfirmasi
                                    Hadir</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.btn-hadir');
            const totalHadirElement = document.getElementById('total-hadir');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const eventId = this.getAttribute('data-id');
                    const row = document.getElementById(`row-${eventId}`);

                    fetch(`/event/hadir/${eventId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                totalHadirElement.textContent = data.totalHadir;
                                button.disabled = true;
                                button.textContent = 'Hadir (Terkonfirmasi)';
                                button.classList.remove('btn-success');
                                button.classList.add('btn-secondary');
                            } else {
                                alert('Gagal mengonfirmasi kehadiran.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan.');
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Count the number of rows in the table
            const totalRegistrations = document.querySelectorAll('table tbody tr').length;
            document.getElementById('total-regist').textContent = totalRegistrations;
        });
    </script>

</body>

</html>
