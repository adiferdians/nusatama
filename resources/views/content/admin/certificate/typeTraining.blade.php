<table border="0" class="table table-light" id="tableType">
    <tr>
        <td>Type</td>
        <td><input type="text" style="width: 100%" class="input-group-text" placeholder="Type" type="text" id="type"></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <button class="btn btn-secondary" type="reset" id="close"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-success" id="sendType"><i class="fa fa-floppy-o"></i> Simpan</button>
        </td>
    </tr>
</table>

<script>
    console.log("koew");
    $('#sendType').click(function() {
        const type = $('#type').val();
        console.log("type");
        axios.post('/type/send', {
            type,
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