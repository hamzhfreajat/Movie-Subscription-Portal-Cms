<?php include 'header_browse.php';?>
<style>
table{
	background-color: rgb(243, 243, 243);
}
.isDisabled {
	color: currentColor;
	cursor: not-allowed;
	opacity: 0.5;
	text-decoration: none;
}
</style>
<div class="container" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="black_text">شراء عضوية</h3>
			<hr>
		</div>
		<div class="col-lg-8">
			<h4 class="black_text">قم بشراء أي باقة عضوية من الأسفل.</h4>
			<ul class="black_text">
				<li>
                    حدد أي باقة عضوية مفضلة لديك وقم بالدفع
				</li>
				<li>
                    يمكنك إلغاء اشتراكك في أي وقت
                </li>
			</ul>
			<table class="table table-striped table-hover" style="color: #000;">
				<tbody>
					<tr>
                    <tr>
                        <td></td>
                        <?php
                        $plans = $this->crud_model->get_active_plans();
                        foreach ($plans as $row):
                            ?>
                            <td align="center">
                                <h5 style="text-transform: uppercase;"><?php echo $row['name'];?></h5>
                            </td>
                        <?php endforeach;?>
                    </tr>

                    <tr>
                        <td align="center">السعر الاجمالي بدالدولار</td>
                        <td align="center">USD 4.53</td>
                        <td align="center">USD 10.39</td>
                        <td align="center">USD 26.37</td>
                    </tr>
                    <tr>
                        <td align="center">السعر الاجمالي بالريال السعودي</td>
                        <td align="center">17 ريال سعودي</td>
                        <td align="center">39 ريال سعودي</td>
                        <td align="center">99 ريال سعودي</td>
                    </tr>
                    <tr>
                        <td align="center">سعر الشهر والفرق بالأشهر</td>
                        <td align="center">17 ريال سعودي</td>
                        <td align="center">13 ريال سعودي</td>
                        <td align="center">8.25 ريال سعودي</td>
                    </tr>
				</tbody>
			</table>
			<div class="pull-right">
				<a href="<?php echo base_url();?>index.php?browse/youraccount" class="btn btn-default">Go Back</a>
				<a href="javascript:" class="btn btn-primary" id="checkoutButton" onclick="checkPlan()">Checkout</a>
			</div>
		</div>
		<script>
		function checkPlan() {
			var selectedPlanId = $('input[name=plan_id]:checked').val();
			if (selectedPlanId > 0) {
				var redirectionUrl = "<?php echo base_url('index.php?browse/checkout/');?>" + selectedPlanId;
				window.location = redirectionUrl;
			}else{
				alert('<?php echo get_phrase('you_have_to_select_at_least_one_plan'); ?>');
			}
		}
		</script>
	</div>
	<hr>
	<?php include 'footer.php';?>
</div>
