

    <!-- Login Modal -->
            <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content splash-panel">
                  <div class="modal-body header-less-modal">
                    <div class="col-md-6 col-sm-12">
                        <h4 class="modal-title" id="myModalLabel">Sign in to with..</h4>
                        <a class="btn btn-block btn-social btn-facebook btn-lg">
                            <span class="fa fa-facebook"></span> Sign in with Facebook
                        </a>
                        <a class="btn btn-block btn-social btn-google btn-lg">
                            <span class="fa fa-google-plus"></span> Sign in with Google+
                        </a>
                        <a class="btn btn-block btn-social btn-linkedin btn-lg">
                            <span class="fa fa-linkedin"></span> Sign in with Linkedin
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-12 login-column">
                    <h4 class="modal-title" id="myModalLabel" style="margin-bottom: 5px;">Sign in with email</h4>
                        <?= form_open('/auth/login',array('class' => 'form-validate form-horizontal')); ?>
                    <div class="form-group">
                        <input type="email" class="input form-control validate[required]" name="email" value="<?= set_value('email'); ?>" placeholder="Email Address">
                    </div>

                    <div class="form-group">
                        <input type="password" class="input form-control validate[required]" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="">
                            <div class="checkbox">
                                <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-success"><span class="fa fa-key"></span> Login</button>

                                <a class="btn btn-link" href="/password/email">Forgot Your Password?</a>
                            </div>
                        </div>
                    <?= form_close(); ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>
            <!-- end login -->
            <!-- Sign up Modal -->
            <div class="modal fade" id="mySignup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content splash-panel">
                  <div class="modal-body header-less-modal">

                    <div class="col-md-12 col-sm-12 login-column">
                    <h4 class="modal-title" id="myModalLabel" style="margin-bottom: 10px;">Sign up with email</h4>
                        <?= form_open('/join',array('class' => 'form-horizontal form-validate')); ?>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-12">
                          <input type="text" class="input form-control validate[required]" name="firstname" value="<?= set_value('firstname'); ?>" placeholder="Firstname">
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <input type="text" class="input form-control validate[required]" name="lastname" value="<?= set_value('lastname'); ?>" placeholder="Lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-12">
                          <select name="country" id="country" class="input form-control validate[required]" onchange="print_state('state', this.selectedIndex);">
                          <option value="">Choose country</option>
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <select name="state" class="input form-control  validate[required]" id="state">
                              <option value="">Choose State</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                          <input type="text" class="input form-control validate[required]" name="phone" placeholder="Mobile Number" value="<?= set_value('phone') ?>" maxlength="15">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-12">
                          <input type="email" class="input form-control validate[required]" name="email" value="<?= set_value('email') ?>" placeholder="E-Mail Address" maxlength="120">
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <input type="email" class="input form-control validate[required]" name="email_confirmation" value="<?= set_value('email_confirmation') ?>" placeholder="Confirm Email Address" maxlength="120">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-12">
                          <input type="password" class="input form-control validate[required]" name="password" placeholder="Password" maxlength="15">
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <input type="password" class="input form-control validate[required]" name="password_confirmation" placeholder="Re-type Password">
                        </div>
                    </div>

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-user"></span> Sign Up</button>
                            </div>
                        </div>
                    <?= form_close(); ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>
            <!-- end login -->




    </div>
    <!-- Scripts -->
    <script src="/public/js/jquery.min.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/public/js/jquery.validationEngine-en.js" type="text/javascript"></script>
    <script src="/public/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="/public/js/countries.js" type="text/javascript"></script>
    <script src="/public/js/jquery.form.js" type="text/javascript"></script>
    <script src="/public/js/app.js" type="text/javascript"></script>
    <script language="javascript">print_country("country");</script>

</body>
</html>