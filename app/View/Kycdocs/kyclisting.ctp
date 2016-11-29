<?php
//pr($kyclist);
?>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <?php 
                        if(!empty($kyclist)){
                    ?>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                        <th style="width:33%;">Sl.No.</th>    
                        <th style="width:50%;">Document</th>
                        <th style="width:100%;">Type</th>
                        <th style="width:100%;">Status</th>
                        <th>Refused Reason</th>    
                        </tr>
                        <?php $count=1; foreach ($kyclist as $kyclist) {  ?>
                                          
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td style="width:33.33%;"><img src="<?php echo $this->webroot; ?>/kycdoc/<?php echo $kyclist['Kycdoc']['doc']; ?>" style="height:80px;"></td>
                            <td style="width:33.33%;"><?php echo $kyclist['Kycdoc']['type']; ?></td>
                            <td style="width:33.33%;"><?php if($kyclist['Kycdoc']['varification_status']==1){ 
                                echo "Approved"; } else { echo "Not Approved"; }
                             ?>&nbsp;</td>
                            <td><?php echo $kyclist['Kycdoc']['refused_reason']; ?></td> 
                        </tr>
                        <?php 
                            $count=$count+1;
                          } ?>    
                    </table> 
                    <?php
                     }
                    else{
                        echo "There is no KYC Details";
                    }

                    ?>


                </div>
            </div>
        </div>
    </div>
    <div id="div1"></div>
</section>