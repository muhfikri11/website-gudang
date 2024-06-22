<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gudang Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Barang</h1>
    <a href="add_item.html">Tambah Barang</a>
    
    <!-- Search Form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari Barang" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Cari</button>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'database.php';

            // Get the search term from the form input
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

            // Modify the SQL query to filter based on the search term
            if ($searchTerm) {
                $sql = "SELECT * FROM barang WHERE nama LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
            } else {
                $sql = "SELECT * FROM barang";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["jumlah"] . "</td>";
                    echo "<td>" . $row["harga"] . "</td>";
                    echo "<td> <a href='edit_item.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_item.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
