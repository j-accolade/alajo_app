<?php
$pagename = 'View Vault';
require_once 'include/header.php';
require_once 'include/auth_check.php';
require_once 'include/db.php';

// To the the vault ID from the url query string
$vaultid = $_GET['vault'];

$vaults = new Vaults($conn);
$vault_info = $vaults -> getIndividualVault($vaultid);
$owner = $vaults -> getVaultOwner($vaultid);
$charge = $vaults -> getCharge($vaultid);
$saved = $vaults -> getSavings($vaultid);
$months = $vaults -> getMonthCount($vaultid);
$principal = $vaults -> getPrincipal($vaultid);
$numb = $vaults -> getDaysCount($vaultid);

$cangive = $saved-$charge;
?>

<div class="container-fluid bodpadding2 bg-light py-5">
    <div class="container">
        <h3><span class="text-muted h4">Overview for:</span> <?php echo '  ' .$owner ?></h3>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="p-4 bg-white border my-1">
                    <p class="card-text text-muted">Months Count</p>
                    <h4 class="card-title"><?php echo $months; ?></h4>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="p-4 bg-white border my-1">
                    <p class="card-text text-muted">Total</p>
                    <h4 class="card-title"><?php echo '₦'. strval($saved) ?></h4>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="p-4 bg-white border my-1">
                    <p class="card-text text-muted">Charges</p>
                    <h4 class="card-title"><?php echo '₦'. strval($charge) ?></h4>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="p-4 bg-white border my-1">
                    <p class="card-text text-muted">Customer get</p>
                    <h4 class="card-title"><?php echo '₦'. strval($cangive) ?></h4>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid bg-light py-5">
    <div class="container">
        <h5>Pay into Vault</h5>
        <form method="post" action="payvault.php">
            <div class="mb-3">
                <input name="vault_id" type="hidden" value="<?php echo $vaultid?>">
                <input name="principal" type="hidden" value="<?php echo $principal?>">
                <input name="dbdays" type="hidden" value="<?php echo $numb?>">
                <label for="samount" class="form-label">Amount</label>
                <input name="samount" type="number" class="form-control" id="samount" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Customer is to to pay in multiples of ₦<?php echo strval($principal). ' e.g ₦' .strval($principal*2). ' or ₦' .strval($principal*10) ?></div>
            </div>
           <button name="submit" type="submit" class="btn btn-outline-success">Pay Now</button>
        </form>
    </div>
</div>

<div class="container-fluid py-5">
    <!-- Hidden withdrawal section -->
    <div class="container">
        <h5>Withdraw Fund</h5>
        <form method="post" action="withdraw.php">
            <div class="mb-3">
                <!-- PHP code to detect if user has money saved in the vault -->
                <?php if ($numb < 2) {?>
                    <input class="form-control" id="disabledInput" type="text" placeholder="Sorry! Nothing to withdraw" disabled>
                    <?php }else {?>
                        <?php if ($principal > 1000) {?>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Please contact Accolade for withdrawal" disabled>
                            <?php } else {?>
                                <label for="wamount" class="form-label">Amount</label>
                                <input class="form-control" type="text" value="<?php echo $cangive ?>" aria-label="readonly input example" readonly>
                                <div id="emailHelp" class="form-text">You can only withdraw multiples of <?php echo '₦' .strval($principal). '. Your maximum is ₦'.strval($cangive)?></div>
                                <input name="cangive" type="hidden" value="<?php echo $cangive?>">
                                <input name="v_id" type="hidden" value="<?php echo $vaultid?>">
                                <button name="submit" type="submit" class="btn btn-outline-danger">Withdraw</button>
                                <?php }
                            } ?> 
            </div>
        </form>
    </div>
</div>