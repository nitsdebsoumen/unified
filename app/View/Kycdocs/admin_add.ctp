<?php echo $this->Form->create('Kycdoc', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add KYC'); ?></legend>
        <?php
        echo $this->Form->input('image',array( 'type' => 'file'));
        echo $this->Form->input('user_id', array('options' => $users));
        $option = array('Proof of identity' => 'Proof of identity','CAC Registration Certificate'=>'CAC Registration Certificate','Memorandum  and Articles of Association (Memart)'=>'Memorandum  and Articles of Association (Memart)','Professional Accreditation'=>'Professional Accreditation');
        echo $this->Form->input('type', array('options' => $option));
     	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>




<!-- <div class="modalwindow" style="width: 780px; top: 30px; left: 212px; display: block;"> <a class="closemodal" onclick="closeModal('#modal_edit');"><i class="fa fa-times-circle"></i> close</a> <div class="modalcontents"><form class="form" id="mainform" action="/dashboard/organisation/1106/accreditations/update" method="post"> <input type="hidden" name="accreditation_id" value="0"> <h2>Add Accreditation</h2> <div class="fieldrow"> <div class="fieldtitle">Accreditation Type</div> <div class="fieldinput checkboxes"> <label class="radio"><input type="radio" class="accreditation_type" name="accreditation_type" value="preset" checked="checked"> <span>Select from library</span></label> <label class="radio"><input type="radio" class="accreditation_type" name="accreditation_type" value="addnew"> <span>Add a different accreditation</span></label> </div> </div> <div class="fieldrow input_row input_preset" style="display: none;"> <div class="fieldtitle">Select Accreditation</div> <div class="fieldinput"> <select id="base_accreditation_id" name="base_accreditation_id"> <option value=""> - Select -</option> <option value="4">Beacon Status</option><option value="18">Chartered Management Institute</option><option value="13">City &amp; Guilds</option><option value="16">CPD Standards</option><option value="6">CQC Accreditation</option><option value="5">Customer Service Excellence</option><option value="19">Edexcel</option><option value="22">Education Funding Agency</option><option value="24">Federation of Small Businesses (FSB)</option><option value="17">Highfields Awarding Body for Compliance</option><option value="1">Investors in People (IIP)</option><option value="2">ISO 9001</option><option value="25">ISO/IEC 27001:2013</option><option value="3">Matrix Standard</option><option value="20">OCR</option><option value="7">Ofsted</option><option value="8">Pharmaceutical Council (GPhC) Accreditation</option><option value="11">PQASSO Quality Mark</option><option value="14">Royal College of Nursing</option><option value="12">Skills for Health Quality Mark</option><option value="23">Skills Funding Agency (SFA)</option><option value="15">Social Enterprise Mark</option><option value="21">The Chartered Institute of Environmental Health (CIEH)</option><option value="10">The Training Quality Standard (TQS)</option><option value="9">Work Experience Quality Standard</option> </select> </div> </div> <div class="fieldrow input_row input_preset_info" style="display: none;"> <div class="fieldtitle">Title</div> <div class="fieldinput info" id="preset_title"></div> </div> <div class="fieldrow input_row input_preset_info" style="display: none;"> <div class="fieldtitle">Website</div> <div class="fieldinput info" id="preset_website"></div> </div> <div class="fieldrow input_row input_addnew" style="display: block;"> <div class="fieldtitle">Title</div> <div class="fieldinput"><input type="text" name="title" value=""></div> </div> <div class="fieldrow"> <div class="fieldtitle">Description</div> <div class="fieldinput"><div class="redactor-box" role="application"><ul class="redactor-toolbar" id="redactor-toolbar-1" role="toolbar" style="position: relative; width: auto; top: 0px; left: 0px; visibility: visible;"><li><a href="#" class="re-icon re-html" rel="html" role="button" aria-label="HTML" tabindex="-1"></a></li><li><a href="#" class="re-icon re-formatting redactor-toolbar-link-dropdown" rel="formatting" role="button" aria-label="Formatting" tabindex="-1" aria-haspopup="true"></a></li><li><a href="#" class="re-icon re-bold" rel="bold" role="button" aria-label="Bold" tabindex="-1"></a></li><li><a href="#" class="re-icon re-italic" rel="italic" role="button" aria-label="Italic" tabindex="-1"></a></li><li><a href="#" class="re-icon re-deleted" rel="deleted" role="button" aria-label="Deleted" tabindex="-1"></a></li><li><a href="#" class="re-icon re-unorderedlist" rel="unorderedlist" role="button" aria-label="&amp;bull; Unordered List" tabindex="-1"></a></li><li><a href="#" class="re-icon re-orderedlist" rel="orderedlist" role="button" aria-label="1. Ordered List" tabindex="-1"></a></li><li><a href="#" class="re-icon re-outdent" rel="outdent" role="button" aria-label="< Outdent" tabindex="-1"></a></li><li><a href="#" class="re-icon re-indent" rel="indent" role="button" aria-label="> Indent" tabindex="-1"></a></li><li><a href="#" class="re-icon re-link redactor-toolbar-link-dropdown" rel="link" role="button" aria-label="Link" tabindex="-1" aria-haspopup="true"></a></li><li><a href="#" class="re-icon re-alignment redactor-toolbar-link-dropdown" rel="alignment" role="button" aria-label="Alignment" tabindex="-1" aria-haspopup="true"></a></li><li><a href="#" class="re-icon re-horizontalrule" rel="horizontalrule" role="button" aria-label="Insert Horizontal Rule" tabindex="-1"></a></li></ul><div class="redactor-editor" contenteditable="true" dir="ltr"><p>&#8203;</p></div><textarea name="description" id="description_input" dir="ltr" style="display: none;"></textarea></div></div> </div> <div class="fieldrow"> <div class="fieldtitle">Image</div> <div class="fieldinput"> <p>You'll be able to upload an image once the accreditation has been saved.</p> </div> </div> <div class="fieldrow"> <div class="fieldtitle">Applied to:</div> <div class="fieldinput checkboxes"> <label class="checkbox"><input type="checkbox" name="applied_to_org" value="1" checked="checked"><span>Us as a provider</span></label> <label class="checkbox"><input type="checkbox" name="applied_to_course" value="1" checked="checked"><span>Specific training courses</span></label> </div> </div> <div class="buttons"> <span class="button large" id="cancelbutton">Cancel</span> <span class="button large green" id="submitform">Save Details</span> </div> </form> </div> </div> -->


 <script>
// 	$('#cancelbutton').click(function(){
// 		closeModal('#modal_edit');
// 	});
// 	function checkShowRows(){
// 		$('.input_row').hide();
// 		$('.input_row.input_'+$('.accreditation_type:checked').val()).show();
// 		if ($('.accreditation_type:checked').val()=='preset')
// 			$('.input_preset_info').show();
// 		else
// 			$('.input_preset_info').hide();
// 	}
// 	$('.accreditation_type').change(function(){
// 		checkShowRows();
// 	});
// 	checkShowRows();

// 	$('#base_accreditation_id').change(function(){
// 		$('.input_preset_info').slideUp(200);
// 		$.post('/dashboard/organisation/1106/accreditations/load/'+$('#base_accreditation_id').val(),function(data){
// 			var result = JSON.parse(data)
// 			if (result.description)
// 			{
// 				$('#description_input').val(result.description);
// 				$('#description_input').redactor('code.set', result.description);
// 			}
// 			if (result.title)
// 				$('#preset_title').text(result.title).closest('.input_preset_info').slideDown(200);
// 			if (result.website)
// 				$('#preset_website').text(result.website).closest('.input_preset_info').slideDown(200);

// 		});
// 	});

// 	$('#accimageupload').fileupload({
// 		url: '/dashboard/organisation/1106/accreditations//image-upload',
// 		dataType: 'json',
// 		disableImageResize: /Android(?!.*Chrome)|Opera/
// 		.test(window.navigator && navigator.userAgent),
// 		formData: { imagetype: 'image' },
// 		imageMaxWidth: 800,
// 		imageMaxHeight: 800,
// 		progressall: function (e, data) {
// 			var progress = parseInt(data.loaded / data.total * 100, 10);
// 			$('#accimage_uploadprogress .progress').css('width',progress + '%');
// 		},
// 		start: function (e) {
// 			$('#accimage_details').slideUp(100);
// 			$('#accimage_uploadprogress').slideDown(100);
// 			$('#accimage_uploadprogress .progress').css('width','0%');
// 		},
// 		done: function (e, data) {
// 			if (data.result.result)
// 			{
// 				$('#accimage_uploadprogress').slideUp(200);
// 				$('#accimage_image_preview').attr('src','/images/accreditations/120x80/'+data.result.filename);
// 				$('#accimage_details').slideDown(200);
// 			}
// 			else
// 			{
// 				alert(data.result.message+" - please try a different image");
// 				$('#accimage_details').slideUp(100);
// 				$('#accimage_uploadprogress').slideDown(100);
// 				$('#accimage_uploadprogress .progress').css('width','0%');
// 			}
// 		},
// 	});
// 	$('#removeaccimage').click(function(){
// 		$.post('/dashboard/organisation/1106/accreditations//image-delete',{ imagetype: 'image' },function(data){
// 			var result = JSON.parse(data);
// 			if (result.result)
// 				$('#accimage_image_preview').attr('src','/images/accreditations/120x80/default.png');
// 		});
// 	});
// 	$('#accimage_uploadprogress').hide();
	
// 	$('#mainform .required').change(function(){
// 		$(this).errorCheck();
// 	});
	
// 	$('#submitform').click(function(){
// 		var formCheck = true;
// 		$('#mainform .required').each(function(){
// 			if (!$(this).errorCheck())
// 				formCheck = false;
// 		});
// 		if (!formCheck)
// 			$('html, body').animate({
// 				scrollTop: parseInt($(".input_error_highlight:first").offset().top)-20
// 			}, 500);
// 		if (formCheck) $('#mainform').submit();
// 	});

// 	$('#description_input').redactor();
// </script>