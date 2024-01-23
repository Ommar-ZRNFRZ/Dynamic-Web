<?php 
include "pisahadmin.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <style>
    .mx-auto {
      width: 900px;
    }

    .card {
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="mx-auto">
    <!----untuk memasukan data---->
    <div class="card">
      <div class="card-header">
        Create / edit data <?$_SESSION['username']?>
      </div>
      <div class="card-body">
        <?php
        if ($error) {
          ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
          </div>
          <?php
          header("refresh:3;url=admin.php"); //5 : detik
        }
        ?>
        <?php
        if ($sukses) {
          ?>
          <div class="alert alert-success" role="alert">
            <?php echo $sukses ?>
          </div>
          <?php
          header("refresh:3;url=admin.php"); //5 : detik
        }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
           
          
          <div class="mb-3 row">
            <label for="game_name" class="col-sm-2 col-form-label">Nama Game</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="game_name" name="game_name" value="<?php echo $game_name ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="date_released" class="col-sm-2 col-form-label">Release date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="date_released" name="date_released" value="<?php echo $date_released ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="developer" class="col-sm-2 col-form-label">Developer</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="developer" id="developer" value="<?php echo $developer ?>">
              </div>
            </div>
          <div class="mb-3 row">
            <label for="publisher" class="col-sm-2 col-form-label">publisher</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="publisher" id="publisher" value="<?php echo $publisher ?>">
              </div>
            </div>
          <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="price" id="price" value="<?php echo $price ?>">
              </div>
            </div>
          <div class="mb-3 row">
            <label for="produk" class="col-sm-2 col-form-label">foto</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="foto" id="foto" value="<?php echo $foto ?>">
                
                
              </div>
            </div>
            <div class="col-12">
              <input type="submit" name="simpan" value="Simpan data" class="btn btn-primary">
            </div>
          </form>
          <!--untuk mengeluarkan data-->

        </div>
      </div>
      <div class="card">
        <div class="card-header text-white bg-secondary">
          data mahasiswa
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>

                <th scope="col">Nama</th>
                <th scope="col">Release date</th>
                <th scope="col">Developer</th>
                <th scope="col">Publisher</th>
                <th scope="col">Harga</th>
                <th scope="col">Foto</th>
              </tr>
            <tbody>
              <?php
                $sql2 = "select * from item_data order by gameid";
                $q2 = mysqli_query($koneksi, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                  $id = $r2['gameid'];
                  $game_name = $r2['game_name'];
                  $date_released = $r2['date_released'];
                  $developer = $r2['developer'];
                  $publisher = $r2['publisher'];
                  $price = $r2['price'];
                  $foto = $r2['foto'];

                  ?>
              <tr>
                <th scope="row">
                  <?php echo $urut++ ?>
                </th>
                
                <td scope="row">
                  <?php echo $game_name ?>
                </td>
                <td scope="row">
                  <?php echo $date_released ?>
                </td>
                <td scope="row">
                  <?php echo $developer ?>
                </td>
                <td scope="row">
                  <?php echo $publisher ?>
                </td>
                <td scope="row">
                  <?php echo $price ?>
                </td>
                <td scope="row"><img src="img/<?= $foto?>" class="img-thumbnail" width="100px" height="100px">
                </td>
                <td scope="row">
                  <a href="admin.php?op=edit&id=<?php echo $id ?>"><button type="button"
                      class="btn btn-warning">Edit</button></a>
                  <a href="admin.php?op=delete&id=<?php echo $id ?>"> <button type="button" class="btn btn-danger"
                      onclick="return confirm('Yakin ingin delete data?')">Delete</button></a>
                </td>
              </tr>
              <?php
                }
                ?>
          </tbody>
          </thead>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>
</body>

</html>