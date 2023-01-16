<?php
$pagename = 'forgot password';
require_once 'include/header.php'; ?>

<div class="container-fluid">
    <div class="container">
        <div class="row py-5 justify-content-center">
            <div class="bg-light col-lg-6 p-3 rounded">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll send a password reset link to your email.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>