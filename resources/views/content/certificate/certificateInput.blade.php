<table border="0" class="table table-light" id="tableCertificate">
    <tr>
        <td>Nama</td>
        <td><input type="text" style="width: 100%" class="input-group-text" placeholder="Nama" type="text" id="name"></td>
    </tr>
    <tr>
        <td>Tipe Training</td>
        <td><input type="text" style="width: 100%" class="input-group-text" placeholder="Tipe Trainig" type="text" id="type">
        </td>
    </tr>
    <tr>
        <td>Title</td>
        <td><input type="text" style="width: 100%" class="input-group-text" placeholder="Title" type="text" id="title">
        </td>
    </tr>
    <tr>
        <td>Nomor Sertifikat</td>
        <td><input type="text" style="width: 100%" class="input-group-text" placeholder="Nomor Sertifikat" type="text" id="number">
        </td>
    </tr>
    <tr>
        <td>Trining Mulai</td>
        <td><input type="date" style="width: 100%" class="input-group-text" type="text" id="start">
        </td>
    </tr>
    <tr>
        <td>Trining Selesai</td>
        <td><input type="date" style="width: 100%" class="input-group-text" type="text" id="end">
        </td>
    </tr>
    <tr>
        <td>Tanggal Sertifikat</td>
        <td><input type="date" style="width: 100%" class="input-group-text" type="text" id="date">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <button class="btn btn-secondary" type="reset" id="close"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-success" id="send"><i class="fa fa-floppy-o"></i> Simpan</button>
        </td>
    </tr>
</table>

<script>
    $('#send').click(function() {
        const name = $('#name').val();
        const type = $('#type').val();
        const title = $('#title').val();
        const number = $('#number').val();
        const start = $('#start').val();
        const end = $('#end').val();
        const date = $('#date').val();

        axios.post('/certificate/send', {
            name,
            type,
            title,
            number,
            start,
            end,
            date
        }).then((response) => {
            Swal.fire({
                title: 'Success...',
                position: 'top-end',
                icon: 'success',
                text: 'Sukses Menambahkan Data!',
                showConfirmButton: false,
                width: '400px',
                timer: 1500
            }).then((response) => {
                location.reload();
            })
        }).catch((err) => {
            Swal.fire({
                title: 'Error',
                position: 'top-end',
                icon: 'error',
                text: err,
                showConfirmButton: false,
                width: '400px',
                timer: 1500
            })
        })
    })
</script>