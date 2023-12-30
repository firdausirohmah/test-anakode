<?php
$url = "https://jendelatani.tech/apitest";
$data = file_get_contents($url);
$data = json_decode($data, true);

// echo '<pre>';
// print_r($data);
// echo '</pre>';

if ($data && isset($data) && is_array($data)) {
    echo "<h2>Data on jendelatani API</h2>";
    echo "<table id='dataTable'>";
    echo "<thead>";
    echo "<tr><th>ID</th><th>Desa</th><th>Produksi</th></tr>";
    echo "</thead>";
    // Iterate through each item in the array
    echo "<tbody>";
    foreach ($data as $item) {
        echo "<tr>";
        echo "<td>{$item['id']}</td>";
        echo "<td>{$item['desa']}</td>";
        echo "<td>{$item['produksi']}</td>";
        echo "</tr>";
    }
    echo "</tbody>";

    echo "</table>";
} else {
    echo "Failed to fetch data from the API.";
}
?>

<?php
$apiKey = 'e049d10db2bd7fc4d5ec3cb4035633be';
$provinceEndpoint = 'https://api.rajaongkir.com/starter/province';

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $provinceEndpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'key: ' . $apiKey,
    ],
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
}

curl_close($curl);

$provinces = json_decode($response, true);
?>

<?php
    if (isset($_GET['province'])) {
        $selectedProvinceId = $_GET['province'];
        $cityEndpoint = 'https://api.rajaongkir.com/starter/city?province=' . $selectedProvinceId;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $cityEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'key: ' . $apiKey,
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        }

        curl_close($curl);

        $cities = json_decode($response, true);

        if ($cities && isset($cities['rajaongkir']['results']) && is_array($cities['rajaongkir']['results'])) {
            echo '<h2>Cities in the selected province on rajaongkir API</h2>';
            echo '<ul>';
            foreach ($cities['rajaongkir']['results'] as $city) {
                echo '<li>' . $city['city_name'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo 'Failed to fetch cities from RajaOngkir API.';
        }
    }
    ?>
