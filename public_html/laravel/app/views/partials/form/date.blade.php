<div class="col-md-2 col-lg-2 col-sm-3 col-xs-3" style="padding-right:5px;">
	{{ FormStrap::select($name .'_year', $years, $year) }}
</div>
<div class="pull-left" style="padding:3px 0;">年</div>
<div class="col-md-2 col-lg-2 col-sm-3 col-xs-3" style="padding-right:5px;padding-left:5px;">
	{{ FormStrap::select($name .'_month', Month::month_numeric_data(), $month) }}
</div>
<div class="pull-left" style="padding:3px 0;">月</div>
<div class="col-md-2 col-lg-2 col-sm-3 col-xs-3" style="padding-right:5px;padding-left:5px;">
	{{ FormStrap::select($name .'_day', Day::day_numeric_data(), $day) }}
</div>
<div class="pull-left" style="padding:3px 0;">日</div>