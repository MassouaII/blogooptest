<?php
include("includes/header.php");
include("includes/sidebar.php");
?>

<?php
/*include("includes/content-top.php");*/

//$photos = Photo::find_all();
//$photosoftdeletes = Photo::find_all_soft_deletes();
if(!$session->is_signed_in()){
    header("Location:login.php");
}
if(empty($_GET['id'])){
    header("Location:photos.php");
}else{
    $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['update'])){
        if($photo){
            /* ctl:1 is er een foto aanwezig op de server?
            2 verwijderen van die oude foto op de server.
            */
            if($_FILES['file']['name']){
                $photo->update_photo();
            }else{
                echo "nok";
            }

            /* updaten in de database en uploaden nieuwe foto */
            $photo->title = $_POST['title'];
            $photo->description = $_POST['description'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->set_file($_FILES['file']);
            $photo->save();
        }
    }
}

?>
    <div id="main">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h1 class="page-header">Edit Photo</h1>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Photo upload</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="edit_photo.php?id=<?php echo $photo->id; ?>" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="title">Title</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo $photo->title; ?>">
                                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea placeholder="description" name="description" id="editor" class="form-control" cols="100%">
                                                <?php echo $photo->description; ?>
                                            </textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="alternate_text">Alt</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="alternate_text" class="form-control"
                                                   placeholder="alternate text" name="alternate_text"
                                                   value="<?php echo $photo->alternate_text; ?>">

                                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="file">File</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <img src="<?php echo $photo->picture_path();?>" alt="<?php echo $photo->title;?>" class="img-fluid img-thumbnail">
                                            <p>Uploaded on: 1 April 2024</p>
                                            <p>Filename: <?php echo $photo->filename; ?></p>
                                            <p>Filetype: <?php echo $photo->type; ?></p>
                                            <p>Filesize: <?php echo ($photo->size)/1000; ?> Kb</p>
                                            <input type="file" name="file" class="form-control">
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="update" class="btn btn-primary me-1 mb-1">Update</button>
                                            <a href="photos.php" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php
include("includes/footer.php");
?>