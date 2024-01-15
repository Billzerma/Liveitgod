<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                   <div class="card-body">
                    <form action="<?=base_url('pembayaran/proses'); ?>" method="POST">
                        <div class="md-3">
                            <label for="">Nama Depan</label>
                            <input type="text" name="depan" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="">Nama Belakang</label>
                            <input type="text" name="belakang" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="md-3">
                            <label for="">Nomor ponsel</label>
                            <input type="text" name="ponsel" class="form-control">
                        </div>

                        <div class="md-3">
                            <label for="">Nominal</label>
                            <input type="text" name="nominal" class="form-control">
                        </div>

                        <button type="submit" class="btn-primary">Bayar tagihan</button>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama depan</th>
                                <th>Nama Belakang</th>
                                <th>emai</th>
                                <th>ponsel</th>
                                <th>nominal</th>
                                <th>bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $no=1;

                            foreach ($tagihan as $data):?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?= $data->nama_depan; ?></td>
                                <td><?= $data->nama_belakang; ?></td>
                                <td><?= $data->email; ?></td>
                                <td><?= $data->ponsel; ?></td>
                                <td><?= $data->nominal; ?></td>
                                <td>
                                <a  href="https://app.midtrans.com/snap/v2/vtweb/<?=$data->token;?>">Pilih Paket</a>
                                
                   
                                </td>
                            </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                                
                        </tbody>

                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>