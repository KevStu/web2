<h3>Provide Information</h3>
<div id="form-block">
    <form method="POST" action="process/process_release.php?action=create">
        <div id="form-block-center">
            <label for="sname">Customer Name</label>
            <input type="text" id="sname" class="input" name="sname" placeholder="Customer name..">

            <label for="desc">Description</label>
            <input id="desc" class="input" name="desc" placeholder="Description.."/>
            
            <label for="amount">Amount</label>
            <input type="text"id="amount" class="input" required name="amount" placeholder="Amount.."/>
        
              </div>
        <div id="button-block">
        <input type="submit" value="Create">
        </div>
  </form>
</div>