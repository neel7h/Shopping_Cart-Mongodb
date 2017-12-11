<?php
if (isset($_POST["register"])) {
    try {
        require_once 'db.php';


        // a new products collection object
        $collection = $db->user;

        // Create an array of values to insert
        $username = (isset($_POST["username"]) ? $_POST["username"] : $username = null);
        $password = (isset($_POST["password"]) ? md5($_POST["password"]) : $password = null);

        $email = (isset($_POST["email"]) ? $_POST["email"] : $email = null);
        $address = (isset($_POST["address"]) ? $_POST["address"] : $address = null);


        $product = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'address' => $address
        );

        // insert the array
        $collection->insertOne($product);


        // close connection to MongoDB

    } catch (MongoConnectionException $e) {
        // if there was an error, we catch and display the problem here
        echo $e->getMessage();
    } catch (MongoException $e) {
        echo $e->getMessage();
    }
}



if (isset($_POST["login"])) {

    try {
        require_once 'db.php';
        $username = (isset($_POST["username"]) ? $_POST["username"] : $username = null);
        $password = (isset($_POST["password"]) ? md5($_POST["password"]) : $password = null);

        $collection = $db->user;
        $login = $collection->findOne(array("username" => $username, "password" => $password));
        if ($login) {
            $_SESSION["account"]= $login['_id'];
			            $_SESSION["name"]= $login['username'];

        } else {
            $_SESSION["account"] = null;
        }

    } catch (MongoConnectionException $e) {
        // if there was an error, we catch and display the problem here
        echo $e->getMessage();
    } catch (MongoException $e) {
        echo $e->getMessage();
    }
}



?><div style="margin-top:20px; margin-right:100px">
		<?php if(isset($_SESSION['account'])):
echo "<BOLD>WELCOME</BOLD> &nbsp;".	$_SESSION["name"];	?>
<?php else: ?></div>
<a class="btn btn-primary"  style="margin-top:15px;" href="#" data-toggle="modal" data-target=".login-register-form">
                           Login - Registration Model
                        </a><?php endif ?>
                        <!-- Signin & Signup -->
                        

                        <!-- Login / Register Modal-->
                        <div class="modal fade login-register-form" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#login-form"> Login <span class="glyphicon glyphicon-user"></span></a></li>
                                            <li><a data-toggle="tab" href="#registration-form"> Register <span class="glyphicon glyphicon-pencil"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div id="login-form" class="tab-pane fade in active">
                                                <form role="form" method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input required name="username" type="text" class="form-control" id="email" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="email">Password:</label>
                <input required name="password" type="password" class="form-control" id="email"
                       placeholder="Password"></input>
            </div>
            <input type="hidden" name="login" value="login">
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
                                            </div>
                                            <div id="registration-form" class="tab-pane fade">
                                                <form role="form" method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input required name="username" type="text" class="form-control" id="email" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="email">Password:</label>
                <input required name="password" type="password" class="form-control" id="email"
                       placeholder="Password"></input>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input required name="email" type="email" class="form-control" id="email"
                       placeholder="E-mail address"></input>
            </div>
            <div class="form-group">
                <label for="email">Delivery Address:</label>
                <textarea required name="address" type="text" class="form-control" id="email"
                          placeholder="Address"></textarea>
            </div>
            <input type="hidden" name="register" value="register">
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
                                            </div>

                                        </div>
                                    </div>
<!--                                    <div class="modal-footer">-->
<!--                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
