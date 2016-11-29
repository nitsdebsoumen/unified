<?php //pr($RequestQuotes); exit;?>
<style>
th,td {
  text-align: center;
       width: 20%;
}
th{
  color:#23527c;
}
</style>
<section class="listing_result">
  <div class="container">
    <div class="row">
        <?php echo($this->element('leftpanel'))?>
        <div class="col-md-8">
            <div class="right_bar">

              <h3><?php echo 'Quotes Listing'; ?></h3>
                <table cellpadding="0" cellspacing="0">
                  <tr>
                      <th><?php echo $this->Paginator->sort('id'); ?></th>
                      <th><?php echo $this->Paginator->sort('quotes'); ?></th>
                      <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                      <th><?php echo $this->Paginator->sort('post_id'); ?></th>
                      <th><?php echo $this->Paginator->sort('status'); ?></th>
                      <!-- <th class="actions" ><?php echo __('Actions'); ?></th> -->
                  </tr>
                  <?php
            if (!empty($RequestQuotes)) :
                foreach ($RequestQuotes as $key => $RequestQuote) :
                  // if($RequestQuote['Post']['id']!=''){
                    ?>
                    <tr>
                        
                        <td>
                            <?php
                            echo ++$key;
                            ?>
                        </td>
                        
                        <td>
                          <?php 
                            $arr=explode('.',$RequestQuote['RequestQuote']['quotes']);
                            $extention = end($arr);
                            if ($extention=='jpeg' || $extention=='jpg' || $extention=='png' ) { ?>
                                <img src="<?php echo $this->webroot.'quote/'.$RequestQuote['RequestQuote']['quotes'] ?>" style="width: 30%;" />
                           <?php }

                           elseif($extention=='pdf' || $extention=='doc' || $extention== 'docx') { ?>
                            <a href='<?php echo $this->webroot.'quote/'.$RequestQuote['RequestQuote']['quotes'] ?>' download="" class="btn btn-primary">
                              Download
                            </a>                
                          <?php  }
                          ?>
                        </td>    
                        
                        <td>
                        <?php echo $RequestQuote['User']['first_name'].' '.$RequestQuote['User']['last_name']; ?>
                        </td>
                         <td>
                            <?php
                            echo h(strip_tags($RequestQuote['Post']['post_title']));
                            ?>
                        </td>
                                       
                        
                        <td><?php if($RequestQuote['RequestQuote']['status']==1){ ?> <img src="<?php echo $this->webroot; ?>/img/success-01-128.png" style="height:30px;" /><?php }else{ ?><img src="<?php echo $this->webroot; ?>/img/cross-512.png" style="height:30px;" /><?php } ?>&nbsp;
                       </td>

                      <!--   <td >
                           <?php
                        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), array("controller" => "RequestQuotes",'action' =>'edit', $RequestQuote['RequestQuote']['id']), array('class' => 'btn btn-info btn-xs', 'escape' => false));?>

                             <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')),
                        array('action' => 'view', $RequestQuote['RequestQuote']['id']),
                        array('class' => 'btn btn-success btn-xs', 'escape'=>false)); ?>

                        <?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-times')),
                        array('action' => 'delete', $RequestQuote['RequestQuote']['id']),
                        array('class' => 'btn btn-danger btn-xs', 'escape'=>false),
                        __('Are you sure you want to delete # %s?', $RequestQuote['RequestQuote']['id'])); ?>
                        
                        </td> -->
                                       
                    </tr>
                    <?php 
                
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="5"><?php echo __('No Quotes found'); ?></td>
                </tr>
            <?php
            endif;
            ?>
                </table>  

          
           </div>
        </div>
    </div>
  </div>
</section>
