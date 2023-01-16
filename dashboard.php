<?php
$pagename='dashboard';
require_once 'include/header.php';
require_once 'include/auth_check.php';
require_once 'include/db.php';
$vaults = new Vaults($conn);
$vcount = $vaults -> getVaultCount();
$vtotal = $vaults -> getTotalSavings();
$vprofit = $vaults -> getProfitEstimate();
$allVault = $vaults -> getEachVault();
$allcount = $vaults -> getAllColumns('count_no');
?>

<div class="container-fluid bg-light py-5">
  <div class="container">
    <div class="row">
      
      <div class="col-12 col-sm-4 col-lg-4">
        <div class="p-4 bg-white border my-1">
          <p class="card-text text-muted">Active Vaults</p>
          <h4 class="card-title"><?php echo $vcount['count'] ?></h4>
        </div>
      </div>

      <div class="col-12 col-sm-4 col-lg-4">
        <div class="p-4 bg-white border my-1">
          <p class="card-text text-muted">Savings</p>
          <h4 class="card-title"><?php echo '₦'. round($vtotal['total'],1) ?></h4>
        </div>
      </div>

      <div class="col-12 col-sm-4 col-lg-4">
        <div class="p-4 bg-white border my-1">
          <p class="card-text text-muted">Est. Profit</p>
          <h4 class="card-title"><?php echo '₦'. floor($vprofit['profit']) ?></h4>
        </div>
      </div>
      
    </div>

    <div class="row my-2">

      <div class="col-12 col-sm-6">
        <div class="d-grid my-1">
          <a href="create_vault.php" class="btn btn-outline-primary">Create Vault</a>
        </div>
      </div>


      <div class="col-12 col-sm-6">
        <div class="d-grid my-1">
          <a href="create_customer.php" class="btn btn-outline-primary">Add Customer</a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container-fluid py-5">
  <div class="container">
    <table class="table table-hover">
      <thead class="bg-primary text-white">
        <tr>
          <th>Username</th>
          <th class="d-none d-sm-block">Count</th>
          <th>Conributed</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php
      foreach ($allVault as $vault) {?>
      <tr>
        <td><?php echo $vault['username']?></td>
        <td class="d-none d-sm-block"><?php echo round($vault['count_no'],1)?></td>
        <td><?php echo '₦ ' . strval($vault['grand'])?></td>
        <td>
          <a href="vaultdisplay.php?vault=<?php echo $vault['vault_id']?>" class=" btn btn-primary btn-sm">View</a>
          <a onclick="return confirm('Are you sure you want to delete this vault?')" href="remove_vault.php?vault=<?php echo $vault['vault_id']?>" class="d-none d-sm-inline btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>
    <a class="btn btn-primary" href="logout.php">Logout</a>
  </div>
</div>
</body>
</html>

