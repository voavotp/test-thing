<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sortorder = isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'ASC' : 'DESC';


$toggleSortOrder = $sortorder == 'ASC' ? 'desc' : 'asc';
$buttonLabel = $sortorder == 'ASC' ? 'Sort Descending Name' : 'Sort Ascending Name';

$sql = "SELECT carID, Model, Engine, Owner, DoM FROM `car model` ORDER BY Owner $sortorder";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Car ID</th><th>Model</th><th>Engine</th><th>Owner</th><th>Date of Manufacture</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["carID"] . "</td>";
        echo "<td>" . $row["Model"] . "</td>";
        echo "<td>" . $row["Engine"] . "</td>";
        echo "<td>" . $row["Owner"] . "</td>";
        echo "<td>" . $row["DoM"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "<br><a href='?sort=$toggleSortOrder'><button>$buttonLabel</button></a>";

$conn->close();
?>
