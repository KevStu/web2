<?php
include_once '../class/c_product.php';
include_once '../class/c_inventory.php';
//include '../config/config.php';
$product = new Product();
$inventory = new Inventory();

// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint=' <h3>Search Result</h3><table id="data-list">
<tr>
  <th>Product</th>
  <th>Received</th>
  <th>Released</th>
  <th>In stock</th>
  <th>Retail Price</th>
</tr>';

// Check if the search bar is empty
if (empty($q)) {
    // Fetch all records from the table
    $data = $inventory->list_instock(); // Modify this line based on your implementation

    if ($data != false) {
        foreach ($data as $value) {
            extract($value);
            $hint .= '
            <tr>
                <td>'.$prod_name.'</td>
                <td>'.($inventory->get_receive_amount($prod_id)).'</a></td>
                <td>'.($inventory->get_product_release_inv($prod_id)).'</td>
                <td>'.($inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id)).'</td>
                <td>'.($inventory->get_prod_price($prod_id)).'</td>
            </tr>';
            $count++;
        }
    }
} else {
    // Perform the search based on the entered value
    $data = $inventory->list_product_search($q); // Modify this line based on your implementation

    if ($data != false) {
        foreach ($data as $value) {
            extract($value);
            $hint .= '
            <tr>
                <td>'.$prod_name.'</td>
                <td>'.($inventory->get_receive_amount($prod_id)).'</a></td>
                <td>'.($inventory->get_product_release_inv($prod_id)).'</td>
                <td>'.($inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id)).'</td>
                <td>'.($inventory->get_prod_price($prod_id)).'</td>
            </tr>';
            $count++;
        }
    }
}

$hint .= '</table>';

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No result(s)" : $hint;
?>
