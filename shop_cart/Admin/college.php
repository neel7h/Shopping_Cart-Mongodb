<?php include 'header.php' ?>

<?php

if (isset($_POST["title"]) && isset($_FILES["fileToUpload"])) {
    try {
		require '../../vendor/autoload.php';
$conn = new MongoDB\Client("mongodb://localhost:27017");

$db = $conn->shopping;


        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../uploads/" . $newfilename);
        }


        // a new products collection object
        $collection = $db->products;

        // Create an array of values to insert
        $category = (isset($_POST["category"]) ? $_POST["category"] : $title = '0');
        $title = (isset($_POST["title"]) ? $_POST["title"] : $title = '0');
        $description = (isset($_POST["description"]) ? $_POST["description"] : $description = '0');
        $price = (isset($_POST["price"]) ? $_POST["price"] : $price = '0');

        $product = array(
			'category'=> $category,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'image' => $newfilename
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
?>
  
<body>
   <div class="header-main .col-lg-">
   <!--/content-inner-->
<div class="left-content">
	   

				     <div class="clearfix"> </div>	
				</div>

<div class="agile-grids">	
				<!-- tables -->
	<div class="validation-form">
 	<!---->
  	    
              <form role="form" method="post" enctype="multipart/form-data">
			   <div class="form-group">
                <label for="email">Category:</label>
				<select class="form-control" required name="category" placeholder="select category">
				<option   value=""></option>
				<option   value="laptop">Laptop</option>
				<option   value="mobile">mobile</option>
            
			</select>
			</div>
            <div class="form-group">
                <label for="email">Title:</label>
                <input required name="title" type="text" class="form-control" id="email" placeholder="Product name">
            </div>
            <div class="form-group">
                <label for="email">Description:</label>
            <textarea required name="description" type="text" class="form-control" id="email"
                      placeholder="Product description"></textarea>
            </div>
            <div class="form-group">
                <label for="email">Prod price:</label>
                <input required name="price" type="number" class="form-control" id="email" placeholder="Product price">
            </div>
           
		   <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="fileToUpload"/>
                        <!-- rename it -->
                    </div>

            <div class="form-group">
                <!-- image-preview-filename input [CUT FROM HERE]-->
                <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                    <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                    </button>
                    <!-- image-preview-input --><br>
                    
                </span>
                </div><!-- /input-group image-preview [TO HERE]-->
            </div>

    </div>
    <button type="submit" class="btn btn-default">Save product</button>
    </form>
    
 	<!---->
 </div>
				
</div>
</div>
 
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">
<?php include 'footer.php'?>

</div>
<!--inner block end here-->
<!--copy rights start here-->

<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
		<script>
    $(document).on('click', '#close-preview', function () {
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
        );
    });

    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class", "close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger: 'manual',
            html: true,
            title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
            content: "There's no image",
            placement: 'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function () {
            $('.image-preview').attr("data-content", "").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function () {
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
            }
            reader.readAsDataURL(file);
        });
    });
</script>		
<?php include 'menu.php'?>
