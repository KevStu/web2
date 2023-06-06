<h3><?php echo $products->get_prod_name($id)?> Details</h3>
<br/>

    <form method="POST" action="process/process_prod.php?action=updateproduct">
    <div id="form-block-half">
            <label for="fname">Product Name</label>
            <input type="text" id="pname" class="input" name="pname"  value="<?php echo $products->get_prod_name($id);?>" readonly>

            <label for="lname">Received</label>
            <input type="text" id="rec" class="input" name="rec" value="<?php echo $inventory->get_receive_amount($id);?>">
          
            <label for="lname">Released</label>
            <input type="text" id="rel" class="input" name="rel" value="<?php echo $inventory->get_product_release_inv($id);?>">
            <br>
            <input type="hidden" id="prodid" name="prodid" value="<?php echo $id;?>"/>
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>

