<?php
include("includes/header.php");
include("includes/sidebar.php");
?>

<?php
/*include("includes/content-top.php");*/

$photos = Photo::find_all();
$photosoftdeletes = Photo::find_all_soft_deletes();

?>
    <div id="main">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h1 class="page-header">All Photos</h1>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="weergave1-tab" data-bs-toggle="tab"
                                    data-bs-target="#weergave1-tab-pane" type="button" role="tab"
                                    aria-controls="weergave1-tab-pane" aria-selected="true"><i
                                        class="bi bi-grid-3x2-gap-fill"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="weergave2-tab" data-bs-toggle="tab"
                                    data-bs-target="#weergave2-tab-pane" type="button" role="tab"
                                    aria-controls="weergave2-tab-pane" aria-selected="false"><i
                                        class="bi bi-justify"></i></button>
                        </li>
                    </ul>
                </div>

                <hr>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="weergave1-tab-pane" role="tabpanel"
                         aria-labelledby="weergave1-tab" tabindex="0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="photos-tab" data-bs-toggle="tab"
                                        data-bs-target="#photos-tab-pane" type="button" role="tab"
                                        aria-controls="photos-tab-pane" aria-selected="true">Photos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="deleted-tab" data-bs-toggle="tab"
                                        data-bs-target="#deleted-tab-pane" type="button" role="tab"
                                        aria-controls="deleted-tab-pane" aria-selected="false">Deleted
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="photos-tab-pane" role="tabpanel"
                                 aria-labelledby="photos-tab" tabindex="0">
                                <div class="mt-5 d-flex flex-wrap">
                                    <?php foreach ($photos as $photo): ?>
                                        <div class="m-1 position-relative">
                                            <img class="img-fluid img-thumbnail" width="300"
                                                 src="<?php echo $photo->picture_path() ?>"
                                                 alt="<?php echo $photo->title ?>">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>">
                                                <i class="bi bi-trash-fill position-absolute" style="top: 5px; right: 10px; cursor: pointer; color:red;"></i>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="deleted-tab-pane" role="tabpanel"
                                 aria-labelledby="deleted-tab" tabindex="0">
                                <div class="mt-5 d-flex flex-wrap">
                                    <?php foreach ($photosoftdeletes as $photosoftdelete): ?>
                                        <div class="m-1 position-relative">
                                            <img class="img-fluid img-thumbnail" width="300"
                                                 src="<?php echo $photosoftdelete->picture_path() ?>"
                                                 alt="<?php echo $photosoftdelete->title ?>">
                                            <a href="">
                                                <i class="bi bi-arrow-counterclockwise position-absolute" style="top: 5px; right: 10px; cursor: pointer; color:green;"></i>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="weergave2-tab-pane" role="tabpanel" aria-labelledby="weergave2-tab"
                         tabindex="0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="photoslist-tab" data-bs-toggle="tab"
                                        data-bs-target="#photoslist-tab-pane" type="button" role="tab"
                                        aria-controls="photoslist-tab-pane" aria-selected="true">Photos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="deletedlist-tab" data-bs-toggle="tab"
                                        data-bs-target="#deletedlist-tab-pane" type="button" role="tab"
                                        aria-controls="deletedlist-tab-pane" aria-selected="false">Deleted
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="photoslist-tab-pane" role="tabpanel"
                                 aria-labelledby="photoslist-tab" tabindex="0">
                                <table class="table mb-0">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>DESCRIPTION</th>
                                        <th>FILENAME</th>
                                        <th>TYPE</th>
                                        <th>SIZE</th>
                                        <th>ALT</th>
                                        <th>DELETED_AT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($photos as $photo): ?>
                                        <tr>
                                            <td class="text-bold-500 align-items-center d-flex">
                                                <?php echo $photo->id; ?>
                                                <img class="img-fluid img-thumbnail ms-2" width="62"
                                                     src="<?php echo $photo->picture_path() ?>"
                                                     alt="<?php echo $photo->title ?>">
                                            </td>
                                            <td><?php echo $photo->title; ?></td>
                                            <td class="text-bold-500"><?php echo $photo->description; ?></td>
                                            <td><?php echo $photo->filename; ?></td>
                                            <td><?php echo $photo->type; ?></td>
                                            <td><?php echo $photo->size; ?></td>
                                            <td>
                                                <?php echo $photo->alternate_text ? $photo->alternate_text : "blanco"; ?>
                                            </td>
                                            <td><?php echo $photo->deleted_at; ?></td>
                                            <td>
                                                <a href="delete_photo.php?id=<?php echo $photo->id; ?>">
                                                    <i class="bi bi-trash-fill" style="cursor: pointer; color:red;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="deletedlist-tab-pane" role="tabpanel"
                                 aria-labelledby="deletedlist-tab" tabindex="0">
                                <div class="mt-5 d-flex flex-wrap">
                                    <table class="table mb-0">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>TITLE</th>
                                            <th>DESCRIPTION</th>
                                            <th>FILENAME</th>
                                            <th>TYPE</th>
                                            <th>SIZE</th>
                                            <th>ALT</th>
                                            <th>DELETED_AT</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($photosoftdeletes as $photosoftdelete): ?>
                                            <tr>
                                                <td class="text-bold-500 align-items-center d-flex">
                                                    <?php echo $photosoftdelete->id; ?>
                                                    <img class="img-fluid img-thumbnail ms-2" width="62"
                                                         src="<?php echo $photosoftdelete->picture_path() ?>"
                                                         alt="<?php echo $photosoftdelete->title ?>">
                                                </td>
                                                <td><?php echo $photosoftdelete->title; ?></td>
                                                <td class="text-bold-500"><?php echo $photosoftdelete->description; ?></td>
                                                <td><?php echo $photosoftdelete->filename; ?></td>
                                                <td><?php echo $photosoftdelete->type; ?></td>
                                                <td><?php echo $photosoftdelete->size; ?></td>
                                                <td><?php echo $photosoftdelete->alternate_text; ?></td>
                                                <td><?php echo $photosoftdelete->deleted_at; ?></td>
                                                <td>
                                                    <i class="bi bi-arrow-counterclockwise" style="cursor: pointer; color:green;">

                                                    </i>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
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