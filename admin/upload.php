<?php
//include: error op de pagina,php genereert een waarschuwing,
//maar: de pagina zal wel verder uitgevoerd worden.
//require: hetzelfde als include: php genereert een fatale fout
//en stop de pagina van uitvoering
//include_once
//require_once
    include("includes/header.php");
    if(!$session->is_signed_in()){
        header("location:login.php");
    }
    $message = "";
    $photo = new Photo();
    if(isset($_POST['submit'])){
        $photo->title = $_POST['title'];
        $photo->description = $_POST['description'];
        $photo->set_file($_FILES['file']);
    }
    if($photo->save()){
        $message = "Foto succesvol opgeladen!";
    }else{
        $message = join("<br>", $photo->errors);
    }

    include("includes/sidebar.php");
    include("includes/content-top.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="content">
                <h1 class="page-header">Upload</h1>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Photo upload</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="upload.php" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="title">Title</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="title" class="form-control" name="title" placeholder="Title">
                                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea placeholder="description" name="description" id="description" class="form-control" cols="100%"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="file">File</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" name="file" class="form-control">
                                            <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Upload</button>
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





