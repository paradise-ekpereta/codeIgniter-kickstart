<section class="body">
    <div class="join-banner">
        <div class="container">
            <h3>
                Secure Your Car Against, Theft, Unauthorized Sales, Disputes
                .
                <br>
                Registration is less than 30 seconds, See how it works.
        </h3>
        </div>
    </div>
    <div class="container">
        <div class="box-white padded radius-div join-div" style="margin-top: -40px;">
            <?= form_open('join',['class'=>'form-validate form-horizontal']); ?>
            <div class="form-group">
                                <div class="col-md-10">
                                    <label for="email" class="control-label col-sm-2">Account Type:</label>
                                    <label class="radio-inline">
                                      <input type="radio" name="account_type" value="individual" checked="checked"> I am an Individual
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="account_type" value="company"> We are a company
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="account_type" value="agency"> We are an Agency
                                    </label>
                                </div>
                            </div>
             <div class="form-group">
                <label for="email" class="control-label col-sm-2">Firstname:</label>
                <div class="col-md-4">
                    <input type="text" value="<?= set_value('firstname') ?>" class="input form-control validate[required]" name="firstname" placeholder="First Name">
                </div>
                <label for="lastname" class="control-label col-sm-2">Lastname:</label>
                <div class="col-md-4">
                    <input type="text" class="input form-control validate[required]" name="lastname" value="<?= set_value('lastname'); ?>" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('email') ?>" class="input form-control validate[required]" name="email" placeholder="Email Address">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Password:</label>
                <div class="col-md-4">
                    <input type="password" class="input form-control validate[required]" name="password" placeholder="Enter Password">
                </div>
                <label for="lastname" class="control-label col-sm-2">Confirm Password:</label>
                <div class="col-md-4">
                    <input type="password" class="input form-control validate[required]" name="confirm_password" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Phone:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('phone') ?>" class="input form-control validate[required]" name="phone" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Address:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('address') ?>" class="input form-control validate[required]" name="address" placeholder="Street Address">
                </div>
            </div>
            <div class="form-group">
                <label for="country" class="control-label col-sm-2">Country:</label>
                <div class="col-md-4">
                    <select name="country" id="country" class="input form-control  validate[required]" onchange="print_state('states', this.selectedIndex);">

                    </select>
                </div>
                <label for="stateoforigin" class="control-label col-sm-2">State:</label>
                <div class="col-md-4">
                    <select name="state" class="input form-control  validate[required]" id="states">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">City:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('city') ?>" class="input form-control validate[required]" name="city" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Referrer:</label>
                <div class="col-md-10">
                    <input type="text" value="<?= set_value('referrer') ?>" class="input form-control" name="referrer" placeholder="Enter Your referral Email or Phone Number (Optional)">
                </div>
            </div>
            <div class="form-group">
                <label for="action" class="control-label col-sm-2"></label>
                <div class="col-md-10">
                    <button class="ibutton button2 btn-block" type="submit"><span class="glyphicon glyphicon-pencil"></span> Sign Up</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</section>