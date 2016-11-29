<?php ?>                                                        
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                    <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9">
                <div class="paymnt-wrapper">
					<div class="row">
                   		<div class="col-md-8 trans-left">
                   			<h3>Transaction History <span><select class="form-control"><option> Current Activity</option></select></span>
                   			<div class="clearfix"></div>
                   			</h3>
                   			<div class="row">
                   				<div class="col-lg-12" style="margin-top: 20px;">
                   					<form class="form-inline" style="padding: 5px 15px;">
									  <div class="form-group">
									    <label for="exampleInputName2">From</label>
									    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
									  </div>
									  <div class="form-group">
									    <label for="exampleInputEmail2">To</label>
									    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
									  </div>
									</form>
                   				</div>
                   				
                   			</div>
                   			
                   		</div>
                   		<div class="col-md-3 col-md-offset-1">
                   			<h4 class="text-right">Balance: $1,4587</h4>
                   		
                   		</div>
                   		<div class="col-md-9">
                   			<div class="col-lg-12" >
                   				
                   				 <select class="form-control" id="select_option">
							        <option>All Transacions</option>
							        <option>All Transacions</option>
							        <option>All Transacions</option>
							        <option>All Transacions</option>
							     </select>
							     
							     <select class="form-control" id="select_option">
							        <option>All Freelancers</option>
							        <option>All Freelancers</option>
							        <option>All Freelancers</option>
							        <option>All Freelancers</option>
							     </select>
							     
							     <select class="form-control" id="select_option">
							        <option>All Clients</option>
							        <option>All Clients</option>
							        <option>All Clients</option>
							        <option>All Clients</option>
							     </select>
							     <button type="button" class="btn btn-default btn-md green" style="margin-bottom: 2px;">Go</button>
                   				
                   				</div>
                   		</div>
                   		<div class="col-md-3">
                   		 <div class="row">
                   			<div class="col-md-6" style="padding: 0px; margin: 0px;">
                   			<a style="font-weight: 700;color:#8ba000;" href="#"><span><img src="http://107.170.152.166/team2/ServiceMarketplace/app/webroot/images/pdf.png" >
                   			 Get PDF</span></a>
                   			</div>
                   			<div class="col-md-6" style="padding: 2px 0px; margin: 0px;">
                   			<a style="font-weight: 700;color:#8ba000;" href="#"><span><img src="http://107.170.152.166/team2/ServiceMarketplace/app/webroot/images/csv.png" >
                   			 Get CSV</span></a>
                   			</div>
                   		 </div>	
                   		</div>
                   		
					</div>
					<div class="row">
						<div class="col-lg-12" style="margin-top: 20px;">
							<div class="table-responsive">
								<table class="table table-striped">
									
									<thead>
										<tr>
											<th>Date</th>
											<th>Type</th>
											<th>Description</th>
											<th>Freelancer</th>
											<th>Client</th>
											<th>Amount / Balance</th>
											<th>Ref ID</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
										
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
										
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
										
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
										
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
										
										<tr>
											<td>Feb 23,2016</td>
											<td>Service Fee</td>
											<td>Service Fee - Fixed Price - Ref ID 77836639</td>
											<td>Arpita Bose</td>
											<td>Tuhi Consulting</td>
											<td>($30.00) Pending</td>
											<td class="green">77836639</td>

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
.user{
cursor: pointer;
color: #2281b1;
background-repeat: no-repeat;
background-size: 16px;
}
.activity-feed{padding: 18px 0;}
.activity-feed .time {
bottom: 2px;
right: 5px;
color: #9c9c9c;
width:20%;
float:right;
}
.activity-feed .text{width:80%;float:left;}
</style>


