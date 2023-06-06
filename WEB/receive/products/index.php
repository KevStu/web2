<script>
function showResults(str) {
  if (str.length == 0) {
    document.getElementById("search-result").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("search-result").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "inventory/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
<div id="third-submenu">
<a href = "index.php?page=products&subpage=products&action=create">Create Products</a> 
<a href = "index.php?page=products&subpage=products&action=receive">Receive</a>
<a href = "index.php?page=products&subpage=products&action=release">Release</a>
<a href = "index.php?page=products&subpage=products&action=inventory">Inventory</a>
Search <input type="text" id="search" name="search" onkeyup="showResults(this.value)">
</div>

<div id = "content">
    <?php 
        switch($action){
            case 'create':
                require_once 'products/create_prod.php';
            break;
            case 'inventory':
                require_once 'inventory/main.php';
            break;
            case 'receive':
                require_once 'receive/create_transac.php';
            break;
            case 'release':
                require_once 'release/create_trans.php';
            break;
            case 'view':
              require_once 'products/view.php';
          break;
        }
    ?>
</div>

    