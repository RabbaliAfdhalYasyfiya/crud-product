<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Data Product</title>
  <script>
    async function addProduct() {
      const nama = document.getElementById('nama').value;
      const stok = document.getElementById('stok').value;
      const id_category = document.getElementById('category').value;

      const response = await fetch('./api/create_product.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nama, stok, id_category })
      });

      const result = await response.json();
      if (result.status === 'success') {
            alert(result.message);
        } else {
            alert(result.message);
        }
    }

    async function searchProduct() {
      event.preventDefault();
      const nama_search = document.getElementById('nama_search').value;

      const response = await fetch('./api/search_product.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ nama_search })
      });

      const products = await response.json();
      const resultsDiv = document.getElementById('searchResults');
      if (products.length > 0) {
        resultsDiv.innerHTML = `
          <h4>Hasil Pencarian:</h4>
          <table cellpadding="10" cellspacing="5">
            <thead>
              <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>ID Kategori</th>
              </tr>
            </thead>
            <tbody>
              ${products.map(product => `
                <tr>
                  <td>${product.id_product}</td>
                  <td>${product.nama}</td>
                  <td>${product.stok}</td>
                  <td>${product.id_category}</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        `;
      } else {
        resultsDiv.innerHTML = '<h4>Tidak ada hasil yang ditemukan.</h4>';
      }
    }

    async function deleteProduct() {
      event.preventDefault();
      const nama_delete = document.getElementById('nama_delete').value;

      const response = await fetch('./api/delete_product.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nama_delete })
      });

      const result = await response.json();
      if (result.status === 'success') {
          alert(result.message);
        } else {
          alert(result.message);
        }
    }

    async function updateProduct() {
      const id_product = document.getElementById('id_product').value;
      const nama = document.getElementById('nama_update').value;
      const stok = document.getElementById('stok_update').value;
      const id_category = document.getElementById('category').value;

      const data = {
        id_product: id_product,
        nama: nama,
        stok: stok,
        id_category: id_category
      };

      const response = await fetch('./api/update_product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify( data )
      });

      const result = await response.json();
      if (result.status === 'success') {
          alert(result.message);
        } else {
          alert(result.message);
        }
    }
  </script>
</head>
<body>

  <?php 
  require ('./connection/koneksi.php');
  $category = "SELECT * FROM category_product";
  $hasil_category = koneksi()->query($category);
  ?> <br>

  <div>
    <h2>CRUD Product dengan REST API</h2>
  </div>
  <div>
    <h3>Tambah Data Product</h3><br>
    <form id="addProductForm">
      <input type="text" id="nama" name="nama" size="35" maxlength="100" placeholder="Nama Product" required> 
      <input type="number" id="stok" name="stok" size="35" maxlength="15" placeholder="Stok Product" required> <br> 
      <label for="category">Category Product </label>
      <select id="category" name="category">
        <?php foreach($hasil_category as $row) {?>
        <option value="<?php echo $row["id_category"]?>">
          <?php echo $row["id_category"] . "." . " " .  $row["nama_category"]?>
        </option>
        <?php }?>
      </select><br>
      <button type="button" onclick="addProduct()">Tambah Data Product</button>
    </form>
  </div>

  <div>
    <h3>Pencarian Data Product</h3><br>
    <form id="searchProductForm" onsubmit="searchProduct()">
      <input type="text" id="nama_search" name="nama_search" size="35" maxlength="100" placeholder="Nama Product">
      <button type="submit">Cari Data Product</button>
    </form> <br>
    <div id="searchResults" class="searchResult"></div>
  </div>

  <div>
    <h3>Hapus Data Product</h3><br>
    <form id="deleteProductForm" onsubmit="deleteProduct()">
      <input type="text" id="nama_delete" name="nama_delete" size="35" maxlength="100" placeholder="Nama Product" required>
      <button type="submit">Hapus Data Product</button>
    </form>
  </div>

  <div>
    <form id="updateProductForm">
      <input type="number" id="id_product" name="id_product" size="35" maxlength="15" placeholder="ID Product" required> <br> 
      <h3>Update Data Product</h3><br>
      <input type="text" id="nama_update" name="nama_update" size="35" maxlength="100" placeholder="Nama Product Baru" required> 
      <input type="number" id="stok_update" name="stok_update" size="35" maxlength="15" placeholder="Stok Product Baru" required> <br> 
      <label for="category">Category Product </label>
      <select id="category" name="category">
        <?php foreach($hasil_category as $row) {?>
        <option value="<?php echo $row["id_category"]?>">
          <?php echo $row["id_category"] . "." . " " .  $row["nama_category"]?>
        </option>
        <?php }?>
      </select><br>
      <button type="button" onclick="updateProduct()">Update Data Product</button>
    </form>
  </div>

</body>
</html>
