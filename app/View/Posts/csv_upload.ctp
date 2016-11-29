<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel')) ?>
            <div class="col-md-8">
                <div class="right_bar">
                    <h3>Use This Format for Uploading CSV <a download="" href="<?php echo $this->webroot; ?>bulkupload/bulkupload.csv" class="btn btn-info"><i class="fa fa-plus"></i> Download</a></h3>
                    <form class="form-horizontal" action="<?php echo $this->webroot .'posts/csv_upload/'; ?>" method="post" id="change_password" enctype="multipart/form-data">
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Upload CSV here:</label>
                            <div class="col-sm-9">
                                <div class="input file">
                                <input type="file"  name="data[csv]" required >
                            </div>
                            </div>

                        </div>
                        
                        <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default"><?php echo SUBMIT; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>               

        </div>
    </div>
</section>
