<!DOCTYPE html>
<html dir="ltr" lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>貸款 &raquo; 放款處理</title>
<!--[if lt IE 9]>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/ui/css/bw/jquery-ui-1.10.4.custom.min.css?ver=1.10.4" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/css/jquery-ui-custom.css" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/morphext/morphext.css?ver=2.4.4" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/morphext/animate.css?ver=2.4.4" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/select2/css/select2.css?ver=4.0.13" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/bootstrap/css/bootstrap.css?ver=2.3.2" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/js/bootstrap/plugins/combobox/css/bootstrap-combobox.css?ver=" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/css/bootstrap-custom.css" />
<link rel="stylesheet" type="text/css" media="all" href="https://loan23.softmediahk.com:443/nobility_asset_limited/css/main.css" />
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/core/jquery-1.11.1.js?ver=1.11.1"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/ui/js/jquery-ui-1.10.4.custom.min.js?ver=1.10.4"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/ajaxupload/ajaxupload.js?ver="></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/browser/jquery.mb.browser.min.js?ver="></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/validate/jquery.validate.js?ver=1.13.0"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/autosize/jquery.autosize.min.js?ver=1.18.9"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/morphext/morphext.js?ver=2.4.4"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/select2/js/select2.full.js?ver=4.0.13"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/cookie/jquery.cookie.js?ver="></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/bootstrap/js/bootstrap.min.js?ver=2.3.2"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/bootstrap/plugins/combobox/js/bootstrap-combobox.js?ver="></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/bootstrap/plugins/misc.js"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jquery/plugins/misc.js"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/phpjs.js"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/md5.js"></script>
<script type="text/javascript" src="https://loan23.softmediahk.com:443/nobility_asset_limited/js/jscolor/jscolor.js"></script>
<script type="text/javascript">
/*------------------------------
 |	global variables
 |------------------------------*/
var base_url = 'https://loan23.softmediahk.com:443/nobility_asset_limited/';
var system_time = 1713999280;
var default_dp = 2;
var default_dp_interest_rate = 3;
var default_dp_flat_rate = 4;
var active_period = '2000-01-01';
var accounting_period = '0000-00-00';
var form_init = '';
var no_submit = false;
var force_submit = false;
var individual_msg = global_msg = '';
var individual_msg_visibility = global_msg_visibility = false;


$(function() {
	/*------------------------------
	 |	live form (for calculations)
	 |------------------------------*/
	// auto add brackets to HKID
	$('#passport_no').on('keyup', function(e) {
		if (!$(this).prop('readonly')) {
			// do only when letter / number key is press
			if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode > 64 && e.keyCode < 91) || (e.keyCode > 95 && e.keyCode < 112)) {
				hkid_bracekets();
			}
		}
	}).on('blur', function() {
		if (!$(this).prop('readonly')) {
			// trim all spaces
			$(this).val($(this).val().replace(/\s/g, ''));
		}
		
		if (!$(this).prop('readonly') && $(this).val() != $(this).data('previousValue')) {
			hkid_bracekets();
			$(this).change();
		}
	});
	
	
	// cal year from date
	$('#birth_date').change(function() {
		$('#age').val(year_till_date($(this).val())).blur();
	});
	$('#age').change(function() {
		$('#birth_date').val(date('Y-01-01', strtotime('-' + num($(this).val()) + ' years')));
	});
	
	
	$('#occupy_from').change(function() {
		$('#occupy_duration_year').val(year_till_date($(this).val()));
	});
	$('#occupy_duration_year').change(function() {
		$('#occupy_from').val(date_duration_year($(this).val()));
	});
	
	
	$('#work_from').change(function() {
		$('#work_duration_year').val(year_till_date($(this).val()));
	});
	$('#work_duration_year').change(function() {
		$('#work_from').val(date_duration_year($(this).val()));
	});
	
	
	// auto fill mailing address
	$('#mailing_address_as_flat').click(function() {
		if ($(this).prop('checked')) {
			$('#mailing_address').val($('#flat_address').val()).prop('readonly', true);
			$('#mailing_address_region_id').val($('#flat_address_region_id').val()).change().prop('disabled', true);
			$('#mailing_address_district_id').val($('#flat_address_district_id').val()).prop('disabled', true);
		}
		else {
			$('#mailing_address').prop('readonly', false);
			$('#mailing_address_district_id, #mailing_address_region_id').prop('disabled', false);
		}
	});
	
	$('#flat_address, #flat_address_district_id, #flat_address_region_id').change(function() {
		if ($('#mailing_address_as_flat').prop('checked')) {
			var target = $(this).attr('id').replace('flat_', 'mailing_');
			$('#' + target).val($(this).val()).change();
		}
	});
	
	
	// cal first repay amount
	$('#extended_interest').change(function() {
		var difference = (num($(this).val()) - (num($('#first_repay_amount').val()) - num($('#installment_amount').val())));
		$('#total_interest').val(num(num($('#total_interest').val()) + difference, default_dp));
		$('#total_repay_amount').val(num(num($('#total_repay_amount').val()) + difference, default_dp));
		$('#approval_maxint_total_interest').val(num(num($('#approval_maxint_total_interest').val()) + difference, default_dp));
		$('#approval_maxint_extra_interest_remain').val(num(num($('#approval_maxint_max_total_interest').val()) - num($('#approval_maxint_total_interest').val()) - num($('#approval_handling_fee').val()), default_dp));
		
		var first_repay_amount = num(num($('#installment_amount').val()) + num($(this).val()), default_dp);
		$('#first_repay_amount').val(first_repay_amount);
	});
	
	
	// last day of month
	$('#approval_repayment_cycle_day_month_end').change(function() {
		if ($(this).prop('checked')) {
			$('#approval_repayment_cycle_day').val(31).change();
		}
		else {
			$('#approval_repayment_cycle_day').val(0);
			$('#loan_date').change();
		}
	});
	
	
	// cal first repay date
	$('#approval_repayment_cycle, #approval_repayment_cycle_day, #loan_date').change(function() {
		var first_repay_date = '';
		var loan_date = $('#loan_date').val();
		
		if (loan_date != '') {
			var due_day = date('d', strtotime(loan_date));
			var this_month = date('Y-m-01', strtotime(loan_date));
			
			switch ($('#approval_repayment_cycle').val()) {
				case 'month':
					// if next month no this day, set to next 2 month and date 01
					var next_month = strtotime(date('Y-m-01', strtotime('+1 month', strtotime(this_month))));
					var next_month_max_day = date('t', next_month);
					
					if ($('#approval_repayment_cycle_day_month_end').prop('checked')) {
						first_repay_date = date('Y-m-t', next_month);
					}
					else {
						var first_repay_day = (due_day > next_month_max_day ? 1 : due_day);
						first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (due_day > next_month_max_day ? 1 : 0) + ' month', next_month));	
					}
					break;
				
				case 'month_twice':
					var cycle_day = num(due_day);
					var cycle_day2 = (cycle_day <= 15 ? cycle_day + 15 : cycle_day - 15);
					if (num(date('m', strtotime(loan_date))) == 2 && cycle_day2 > num(date('t', strtotime(loan_date)))) {
						first_repay_day = date('t', strtotime(loan_date));
					}
					else {
						first_repay_day = cycle_day2;
					}
					first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (cycle_day <= 15 ? 0 : 1) + ' month', strtotime(this_month)));
					break;
				
				case 'biweekly':
					first_repay_date = date('Y-m-d', strtotime('+14 day', strtotime(loan_date)));
					break;
				
				case 'day':
					first_repay_date = date('Y-m-d', strtotime('+' + $('#approval_repayment_cycle_day').val() + ' day', strtotime(loan_date)));
					break;
				
				case '':
					return;
					break;
			}
			$('#first_repay_date').val(first_repay_date);
			
			if ($(this).attr('id') == 'loan_date') {
				$('#first_repay_date').change();
			}
		}
	});
	
	
	// maxint
	$('.maxint_rate[id$="interest_rate"], .maxint[id$="handling_fee"], .maxint[id$="maxint_max_total_interest"], .maxint[id$="maxint_total_interest"]').on('blur', function() {
		check_maxint();
	});
	$('.maxint_rate[id$="interest_rate"]').on('keypress', function(e) {
		if (e.keyCode == 13) {
			$(this).blur();
		}
	});
	
	
	// date range pick
	$('.date-range-pick button').click(function() {
		var _target = $(this).closest('.date-range-pick').data('target');
		var _start_date = $('#' + _target + '_from').val();
		var _end_date = $('#' + _target + '_to').val();
		var _date_from = _date_to = '';
		
		switch ($(this).data('pick-type')) {
			case 'year':
				if (_start_date != '') {
					_start_date = date('Y-01-01', strtotime(_start_date));
				}
				else if (_end_date != '') {
					_start_date = date('Y-01-01', strtotime('-1 year +1 day', strtotime(_end_date)));
				}
				else if (_start_date == '' && _end_date == '') {
					_start_date = date('Y-01-01');
				}
				
				switch ($(this).data('pick-action')) {
					case 'prev':
						_date_from = date('Y-m-d', strtotime('-1 year', strtotime(_start_date)));
						break;
					
					case 'this':
						_date_from = date(date('Y')+'-m-d', strtotime(_start_date));
						break;
					
					case 'next':
						_date_from = date('Y-m-d', strtotime('+1 year', strtotime(_start_date)));
						break;
				}
				_date_to = date('Y-m-d', strtotime('+1 year -1 day', strtotime(_date_from)));
				
				break;
			
			case 'month':
				if (_start_date != '') {
					_start_date = date('Y-m-01', strtotime(_start_date));
				}
				else if (_end_date != '') {
					_start_date = date('Y-m-01', strtotime('-1 month +1 day', strtotime(_end_date)));
				}
				else if (_start_date == '' && _end_date == '') {
					_start_date = date('Y-m-01');
				}
				
				switch ($(this).data('pick-action')) {
					case 'prev':
						_date_from = date('Y-m-d', strtotime('-1 month', strtotime(_start_date)));
						break;
					
					case 'this':
						_date_from = date(date('Y-m')+'-d', strtotime(_start_date));
						break;
					
					case 'next':
						_date_from = date('Y-m-d', strtotime('+1 month', strtotime(_start_date)));
						break;
				}
				_date_to = date('Y-m-d', strtotime('+1 month -1 day', strtotime(_date_from)));
				
				break;
			
			case 'day':
				if (_start_date != '') {
					//do nothing
				}
				else if (_end_date != '') {
					_start_date = _end_date;
				}
				else if (_start_date == '' && _end_date == '') {
					_start_date = date('Y-m-d');
				}
				
				switch ($(this).data('pick-action')) {
					case 'prev':
						_date_from = date('Y-m-d', strtotime('-1 day', strtotime(_start_date)));
						break;
					
					case 'this':
						_date_from = date('Y-m-d');
						break;
					
					case 'next':
						_date_from = date('Y-m-d', strtotime('+1 day', strtotime(_start_date)));
						break;
				}
				_date_to = _date_from;
				
				break;
			
			case 'week':
				if (_start_date != '') {
					_start_date = date('Y-m-d', strtotime('-' + date('w', strtotime(_start_date)) + ' day', strtotime(_start_date)));
				}
				else if (_end_date != '') {
					_start_date = date('Y-m-d', strtotime('-' + date('w', strtotime(_end_date)) + ' day', strtotime(_end_date)));
				}
				else if (_start_date == '' && _end_date == '') {
					_start_date = date('Y-m-d', strtotime('-' + date('w') + ' day'));
				}
				
				switch ($(this).data('pick-action')) {
					case 'prev':
						_date_from = date('Y-m-d', strtotime('-1 week', strtotime(_start_date)));
						break;
					
					case 'this':
						_date_from = date('Y-m-d', strtotime('-' + date('w') + ' day'));
						break;
					
					case 'next':
						_date_from = date('Y-m-d', strtotime('+1 week', strtotime(_start_date)));
						break;
				}
				_date_to = date('Y-m-d', strtotime('+1 week -1 day', strtotime(_date_from)));
				
				break;
		}
		
		var _target = $(this).closest('.date-range-pick').data('target');
		$('#' + _target + '_from').val(_date_from);
		$('#' + _target + '_to').val(_date_to).change();
	});
	
	
	// period range pick
	$('.period-range-pick button').click(function() {
		var _target = $(this).closest('.period-range-pick').data('target');
		var _period_date = $('#' + _target).val();
		var _period = '';
		
		switch ($(this).data('pick-type')) {
			case 'month':
				if (_period_date != '') {
					_period_date = date('Y-m', strtotime(_period_date + '-01'));
				}
				else {
					_period_date = date('Y-m');
				}
				
				switch ($(this).data('pick-action')) {
					case 'prev':
						_period = date('Y-m', strtotime('-1 month', strtotime(_period_date)));
						break;
					
					case 'this':
						_period = date(date('Y-m'), strtotime(_period_date));
						break;
					
					case 'next':
						_period = date('Y-m', strtotime('+1 month', strtotime(_period_date)));
						break;
				}
				
				break;
		}
		
		var _target = $(this).closest('.period-range-pick').data('target');
		$('#' + _target).val(_period);
	});
	
	
	// rate type
	$('select[id*="rate_type"]').change(function() {
		switch ($(this).val()) {
			case 'fixed':
				$('div[id*="rate_type_vary"]').hide();
				$('input[id$="prime_rate"], input[id$="prime_rate_vary"]').val(rate(0, default_dp_interest_rate));
				$('#prime_rate_log_id').val(0);
				$('#flat_rate, #interest_rate, #approval_flat_rate, #approval_interest_rate').each(function() {
					$(this).prop('readonly', $(this).data('originalReadonly'));
				});
				break;
			
			case 'vary':
				$('div[id*="rate_type_vary"]').show();
				$('select[id*="prime_rate_id"]').change();
				$('#flat_rate, #interest_rate, #approval_flat_rate, #approval_interest_rate').each(function() {
					$(this).prop('readonly', true);
				});
				break;
		}
	});
	
	
	// prime rate
	$('[id$="prime_rate"], [id$="prime_rate_vary"]').change(function() {
		var interest_rate = 0;
		$('[id$="prime_rate"], [id$="prime_rate_vary"]').each(function() {
			if ($(this).valid()) {
				interest_rate += rate($(this).val());
			}
		});
		
		$('#interest_rate, #approval_interest_rate, #revise_interest_rate').val(rate(interest_rate, default_dp_interest_rate)).change();
	});
	
	
	
	/*------------------------------
	 |	auto rendering
	 |------------------------------*/
	// number
	$(document).on('change', '.number', function() {
		var value = $(this).val();
		var is_valid = /^[\-\+]?[0-9\,]*\.?[0-9]*$/i.test(value);
		
		if (is_valid) {
			if ($(this).hasClass('rate')) {
				if (typeof $(this).data('decimalPlace') != 'undefined') {
					$(this).val(rate(value, $(this).data('decimalPlace')));
				}
				else {
					$(this).val(rate(value, default_dp));
				}
			} else {
				if ($(this).hasClass('2dp')) {
					$(this).val(num2dp(value, 2));
				}
				else if (typeof $(this).data('decimalPlace') != 'undefined') {
					$(this).val(num(value, $(this).data('decimalPlace')));
				}
				else {
					$(this).val(num(value, default_dp));
				}
			}
		}
	});
	$(document).on('mouseup', '.number:not([readonly])', function() {
		$(this).select();
	});
	
	
	// address
	$(document).on('blur', 'textarea[id*="address"]', function() {
		var lines = $(this).val().split("\n");
		var address = '';
		for (var i = 0; i < lines.length; i++) {
			address += (address == '' ? '' : "\n") + $.trim(lines[i]);
		}
		$(this).val(address);
	});
	
	
	// interest method affect interest rate label
	$('select[id*="interest_method"]').change(function() {
		if ($(this).val() == 'rule78') {
			$('select[id*=repayment_cycle]').val('month');
			
			$('span[id$="repayment_cycle_day_placeholder"]').hide();
			$('input[id$="repayment_cycle_day"]').val(0).valid();
			
			$('span[id$="repayment_cycle_day_month_end_placeholder"]').show();
			$('input[id$="repayment_cycle_day_month_end"]').prop('checked', false);
		}
		
		$('select[id*=repayment_cycle] > option[value!="month"]').prop('disabled', ($(this).val() == 'rule78'));
		
		render_rate_label();
	});
	$('select[id*=repayment_cycle] > option[value!="month"]').prop('disabled', ($('select[id*="interest_method"]').val() == 'rule78'));
	
	
	// repayment cycle
	$('select[id*="repayment_cycle"]').change(function() {
		switch ($(this).val()) {
			case 'month':
				$('span[id$="repayment_cycle_day_placeholder"]').hide();
				$('input[id$="repayment_cycle_day"]').val(0).valid();
				
				$('span[id$="repayment_cycle_day_month_end_placeholder"]').show();
				$('input[id$="repayment_cycle_day_month_end"]').prop('checked', false);
				break;
				
			default:
			case 'month_twice':
			case 'biweekly':
				$('span[id$="repayment_cycle_day_placeholder"]').hide();
				$('input[id$="repayment_cycle_day"]').val(0).valid();
				
				$('span[id$="repayment_cycle_day_month_end_placeholder"]').hide();
				$('input[id$="repayment_cycle_day_month_end"]').prop('checked', false);
				break;
				
			case 'day':
				$('span[id$="repayment_cycle_day_placeholder"]').show();
				$('input[id$="repayment_cycle_day"]').val(0).valid();
				
				$('span[id$="repayment_cycle_day_month_end_placeholder"]').hide();
				$('input[id$="repayment_cycle_day_month_end"]').prop('checked', false);
				break;
		}
		
		render_rate_label();
	});
	
	
	// insert ordering
	$(document).on('change', '.unique_ordering', function() {
		if ($(this).val() == '') return;
		
		var ordering = num($(this).val());
		var is_not_unique = ($(this).closest('tbody').find('input[id*="_ordering"][id!="' + $(this).attr('id') + '"]').filter(function() { return (num($(this).val()) == ordering); }).length == 1);
		
		if (is_not_unique) {
			$(this).closest('tbody').find('input[id*="_ordering"][id!="' + $(this).attr('id') + '"]').filter(function() {
				return (num($(this).val()) >= ordering);
			}).each(function() {
				$(this).val(num($(this).val()) + 1);
			});
		}
	});
	
	
	
	
	/*------------------------------
	 |	ajax request
	 |------------------------------*/
	// ajax tabs
	$('a[data-toggle="ajaxtab"]').click(function(e) {
		var _tab = $(this);
		var loaded = _tab.data('loaded');
		var loadurl = _tab.attr('href');
		var target = _tab.data('target');
		var getheader = _tab.data('get-header');
		
		if (!loaded) {
					}
		
		if (loaded != 'yes') {
			$.ajax({
				async: false,
				type: 'GET',
				url: loadurl + '&' + $(getheader).serialize(),
				dataType: 'html',
				success: function(response) {
					$(target).html(response);
					
					var history_count = $(target).find('.loan_row').length;
					_tab.data('loaded', 'no').find('.badge').html(history_count);
				}
			});
			_tab.data('loaded', 'yes');
		}
		
		_tab.tab('show');
		
		return false;
	});
	
	
	// get saved customer data
	$('#passport_no').change(function() {
		$(this).trigger('customChange');
	}).on('customChange', function() {
		if ($(this).val() == '') return;
		
		$('#passport_no').each(function() {
			$(this).data('previousValue', $(this).val());
		});
		
		$.ajax({
			async: false,
			type: 'POST',
			url: 'ajax_handler.php?inquire=get_cust_info',
			data: {
					passport_no: $(this).val(),
					reloan_loan_id: $('#reloan_loan_id').val()
				},
			dataType: 'json',
			success: function(response) {
					if (!jQuery.isEmptyObject(response)) {
						$('#is_blacklist').val(response.is_blacklist);
						if (response.is_blacklist == '1') {
							$('#is-blacklist-button').show();
						}
						else {
							$('#is-blacklist-button').hide();
						}
						
						$('#auth_letter_signed').val(response.signed).change();
						
						if (typeof response.passport_no != 'undefined') {
							if (!force_submit) {
								if (!confirm('是否匯入舊客戶資料？')) return;
							}
							
							$('#copy').val(response.id);
							
							$('#passport_no').val(response.passport_no);
							$('#passport_type_id').val(response.passport_type_id);
							
							$('input[name=customer_type_id]').val([response.customer_type_id]).filter(':checked').change();
							$('#name').val(response.name);
							$('#director_name').val(response.director_name);
							$('input[name=gender]').val([response.gender]);
							$('#birth_date').val(response.birth_date != '0000-00-00' ? response.birth_date : '').change();
							$('#mobile_no').val(response.mobile_no);
							$('#mobile_no2').val(response.mobile_no2);
							$('#mobile_no3').val(response.mobile_no3);
							$('#home_no').val(response.home_no);
							$('#email').val(response.email);
							$('#marital_status').val(response.marital_status);
							$('#education').val(response.education);
							
							$('#flat_address').val(response.flat_address);
							$('#flat_address_region_id').val(response.flat_address_region_id).change();
							$('#flat_address_district_id').val(response.flat_address_district_id);
							$('#mailing_address_as_flat').val([response.mailing_address_as_flat]);
							$('#mailing_address').val(response.mailing_address);
							$('#mailing_address_region_id').val(response.mailing_address_region_id).change();
							$('#mailing_address_district_id').val(response.mailing_address_district_id);
							$('#flat_type_id').val(response.flat_type_id);
							$('#occupy_from').val(response.occupy_from != '0000-00-00' ? response.occupy_from : '').change();
							$('#occupy_with_parent').val([response.occupy_with_parent]);
							$('#occupy_with_spouse').val([response.occupy_with_spouse]);
							$('#occupy_with_child').val([response.occupy_with_child]);
							$('#occupy_with_sibling').val([response.occupy_with_sibling]);
							$('#occupy_with_self').val([response.occupy_with_self]);
							$('#occupy_with_other').val([response.occupy_with_other]);
							$('#occupy_with_remark').val(response.occupy_with_remark);
							
							$('#company_name').val(response.company_name);
							$('#company_address').val(response.company_address);
							$('#company_address_region_id').val(response.company_address_region_id).change();
							$('#company_address_district_id').val(response.company_address_district_id);
							$('#office_no').val(response.office_no);
							$('#direct_line_no').val(response.direct_line_no);
							$('#fax_no').val(response.fax_no);
							$('#industry').val(response.industry);
							$('#department').val(response.department);
							$('#position').val(response.position);
							$('#employment_type').val(response.employment_type);
							$('#work_from').val(response.work_from != '0000-00-00' ? response.work_from : '').change();
							$('#salary').val(response.salary).change();
							$('#income_proof').val([response.income_proof]);
							
							$('#source_id').val(response.source_id);
							$('#source_remark').val(response.source_remark);
							$('#remark').val(response.remark);
							
							$('#passport_no').each(function() {
								$(this).data('previousValue', $(this).val());
							}).valid();
							
							if ('view' == 'add') {
								$('#passport_no').off('customChange');
							}
						}
					}
				}
		});
	});
	
	
	
	// convert interest & flat rate
	$('#interest_method, #repayment_cycle, #repayment_cycle_day, #loan_amount, #installment, #interest_rate, #flat_rate').change(function() {
		var _field_changed = '';
		$('#interest_method, #repayment_cycle, #repayment_cycle_day').each(function() {
			if ($(this).val() != $(this).data('previousValue')) {
				_field_changed = $(this).attr('id');
				return false;
			}
		});
		if (_field_changed == '') {
			$('#loan_amount, #installment').each(function() {
				if (num($(this).val()) != num($(this).data('previousValue'))) {
					_field_changed = $(this).attr('id');
					return false;
				}
			});
			$('#interest_rate, #flat_rate').each(function() {
				if (rate($(this).val()) != rate($(this).data('previousValue'))) {
					_field_changed = $(this).attr('id');
					return false;
				}
			});
		}
		$('#interest_method, #repayment_cycle, #repayment_cycle_day, #loan_amount, #installment').each(function() {
			$(this).data('previousValue', $(this).val());
		});
		
		if ($('#interest_method').val() == '') return;
		if ($('#repayment_cycle').val() == '') return;
		if ($('#repayment_cycle').val() == 'day' && num($('#repayment_cycle_day').val()) == 0) return;
		if (num($('#loan_amount').val()) == 0) return;
		if (num($('#installment').val()) == 0) return;
		
		if (rate($('#interest_rate').val()) == 0 && rate($('#flat_rate').val()) == 0) {
			return;
		}
		else {
			$.ajax({
				async: false,
				type: 'POST',
				url: 'ajax_handler.php?inquire=convert_interest_flat_rate',
				data: {
						interest_method: $('#interest_method').val(),
						repayment_cycle: $('#repayment_cycle').val(),
						repayment_cycle_day: $('#repayment_cycle_day').val(),
						loan_amount: $('#loan_amount').val(),
						installment: $('#installment').val(),
						interest_rate: $('#interest_rate').val(),
						flat_rate: $('#flat_rate').val(),
						rate_recal: _field_changed
					},
				dataType: 'json',
				success: function(response) {
						if (!jQuery.isEmptyObject(response)) {
							$('#installment_amount').val(response.installment_amount);
							$('#interest_rate').val(response.interest_rate);
							check_maxint();
							$('#flat_rate').val(response.flat_rate);
							$('#penalty_rate').val(response.interest_rate);
							
							$('#interest_rate, #flat_rate').each(function() {
								$(this).data('previousValue', $(this).val());
							});
						}
					}
			});
			
			
			// max interest
			var first_repay_date = '';
			var loan_date = ($('#apply_date').val() != '' ? $('#apply_date').val() : date('Y-m-d'));
			if (loan_date != '') {
				var due_day = date('d', strtotime(loan_date));
				var this_month = date('Y-m-01', strtotime(loan_date));
				
				switch ($('#repayment_cycle').val()) {
					case 'month':
						// if next month no this day, set to next 2 month and date 01
						var next_month = strtotime(date('Y-m-01', strtotime('+1 month', strtotime(this_month))));
						var next_month_max_day = date('t', next_month);
						
						var first_repay_day = (due_day > next_month_max_day ? 1 : due_day);
						first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (due_day > next_month_max_day ? 1 : 0) + ' month', next_month));
						break;
					
					case 'month_twice':
						var cycle_day = num(due_day);
						var cycle_day2 = (cycle_day <= 15 ? cycle_day + 15 : cycle_day - 15);
						if (num(date('m', strtotime(loan_date))) == 2 && cycle_day2 > num(date('t', strtotime(loan_date)))) {
							first_repay_day = date('t', strtotime(loan_date));
						}
						else {
							first_repay_day = cycle_day2;
						}
						first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (cycle_day <= 15 ? 0 : 1) + ' month', strtotime(this_month)));
						break;
					
					case 'biweekly':
						first_repay_date = date('Y-m-d', strtotime('+14 day', strtotime(loan_date)));
						break;
					
					case 'day':
						first_repay_date = date('Y-m-d', strtotime('+' + $('#repayment_cycle_day').val() + ' day', strtotime(loan_date)));
						break;
					
					case '':
						return;
						break;
				}
			}
			$.ajax({
				async: false,
				type: 'POST',
				url: 'ajax_handler.php?inquire=get_max_interest',
				data: {
						interest_method: $('#interest_method').val(),
						repayment_cycle: $('#repayment_cycle').val(),
						repayment_cycle_day: $('#repayment_cycle_day').val(),
						loan_amount: $('#loan_amount').val(),
						installment: $('#installment').val(),
						interest_rate: $('#interest_rate').val(),
						flat_rate: $('#flat_rate').val(),
						loan_date: loan_date,
						first_repay_date: first_repay_date,
						first_repay_interest: 0
					},
				dataType: 'json',
				success: function(response) {
						if (!jQuery.isEmptyObject(response)) {
							$('#maxint_total_interest').val(response.total_interest);
							$('#maxint_max_total_interest').val(response.max_total_interest);
							check_maxint();
						}
					}
			});
		}
	});
	
	
	// cal repay detail
	$('#approval_interest_method, #approval_repayment_cycle, #approval_repayment_cycle_day, #approval_loan_amount, #approval_installment, #approval_interest_rate, #approval_flat_rate, #first_repay_date').change(function() {
		var _field_changed = '';
		$('#approval_interest_method, #approval_repayment_cycle, #approval_repayment_cycle_day').each(function() {
			if ($(this).val() != $(this).data('previousValue')) {
				_field_changed = $(this).attr('id').replace('approval_', '');
				return false;
			}
		});
		if (_field_changed == '') {
			$('#approval_loan_amount, #approval_installment').each(function() {
				if (num($(this).val()) != num($(this).data('previousValue'))) {
					_field_changed = $(this).attr('id').replace('approval_', '');
					return false;
				}
			});
			$('#approval_interest_rate, #approval_flat_rate').each(function() {
				if (rate($(this).val()) != rate($(this).data('previousValue'))) {
					_field_changed = $(this).attr('id').replace('approval_', '');
					return false;
				}
			});
		}
		$('#approval_interest_method, #approval_repayment_cycle, #approval_repayment_cycle_day, #approval_loan_amount, #approval_installment').each(function() {
			$(this).data('previousValue', $(this).val());
		});
		
		if ($('#approval_interest_method').val() == '') return;
		if ($('#approval_repayment_cycle').val() == '') return;
		if ($('#approval_repayment_cycle').val() == 'day' && num($('#approval_repayment_cycle_day').val()) == 0) return;
		if (num($('#approval_loan_amount').val()) == 0) return;
		if (num($('#approval_installment').val()) == 0) return;
		
		if ($('#loan_date').val() == '' || $('#first_repay_date').val() == '') {
			// cal rate
			if (rate($('#approval_interest_rate').val()) == 0 && rate($('#approval_flat_rate').val()) == 0) {
				return;
			}
			else {
				$.ajax({
					async: false,
					type: 'POST',
					url: 'ajax_handler.php?inquire=convert_interest_flat_rate',
					data: {
							interest_method: $('#approval_interest_method').val(),
							repayment_cycle: $('#approval_repayment_cycle').val(),
							repayment_cycle_day: $('#approval_repayment_cycle_day').val(),
							loan_amount: $('#approval_loan_amount').val(),
							installment: $('#approval_installment').val(),
							interest_rate: $('#approval_interest_rate').val(),
							flat_rate: $('#approval_flat_rate').val(),
							rate_recal: _field_changed
						},
					dataType: 'json',
					success: function(response) {
							if (!jQuery.isEmptyObject(response)) {
								$('#approval_interest_rate').val(response.interest_rate);
								check_maxint();
								$('#approval_flat_rate').val(response.flat_rate);
								$('#approval_penalty_rate').val(response.interest_rate);
								
								$('#approval_interest_rate, #approval_flat_rate').each(function() {
									$(this).data('previousValue', $(this).val());
								});
							}
						}
				});
			}
		}
		else {
			if (!$('#approval_interest_rate, #approval_flat_rate').valid()) {
				$('#repay-schedule').html('');
				return;
			}
			
			if ($('#approval_repayment_cycle').val() == 'month' && $('#approval_repayment_cycle_day').val() == 31) {
				$('#first_repay_date').val(date('Y-m-t', strtotime($('#first_repay_date').val()))).valid();
			}
			
			$.ajax({
				async: false,
				type: 'POST',
				url: 'ajax_handler.php?inquire=cal_repay_detail',
				data: {
						interest_method: $('#approval_interest_method').val(),
						repayment_cycle: $('#approval_repayment_cycle').val(),
						repayment_cycle_day: $('#approval_repayment_cycle_day').val(),
						loan_amount: $('#approval_loan_amount').val(),
						installment: $('#approval_installment').val(),
						interest_rate: $('#approval_interest_rate').val(),
						flat_rate: $('#approval_flat_rate').val(),
						rate_recal: _field_changed,
						loan_date: $('#loan_date').val(),
						first_repay_date: $('#first_repay_date').val()
					},
				dataType: 'json',
				success: function(response) {
						if (!jQuery.isEmptyObject(response)) {
							$('#approval_interest_rate').val(response.interest_rate);
							check_maxint();
							$('#approval_flat_rate').val(response.flat_rate);
							$('#installment_amount').val(response.installment_amount);
							$('#dsr').change();
							$('#extended_interest_day').val(response.first_repay_interest_day);
							$('#extended_interest').val(response.first_repay_interest).change();
							$('#last_repay_date').val(response.last_repay_date);
							if (_field_changed != '') {
								$('#approval_penalty_rate').val(response.interest_rate);
							}
							
							$('#approval_interest_method, #approval_repayment_cycle, #approval_repayment_cycle_day, #approval_loan_amount, #approval_installment, #approval_interest_rate, #approval_flat_rate').each(function() {
								$(this).data('previousValue', $(this).val());
							});
							
							var total_interest = total_repay_amount = 0;
							for (var i = 0; i < response.installments.length; i++) {
								total_interest = total_interest + num(response.installments[i].interest);
							}
							total_repay_amount = total_interest + num($('#approval_loan_amount').val());
							$('#total_interest').val(num(total_interest, default_dp));
							$('#total_repay_amount').val(num(total_repay_amount, default_dp));
							
							//print to installment schedule
							//response.installments
							var html = '';
							for (var i = 0; i < response.installments.length; i++) {
								var installment = response.installments[i];
								html += '<tr class="installment">';
								html += '	<td style="text-align: center;">' + installment.no + '</td>';
								html += '	<td style="text-align: center;">' + installment.due_date + '</td>';
								html += '	<td style="text-align: center;">' + num(installment.principal, default_dp) + '</td>';
								html += '	<td style="text-align: center;">' + num(installment.interest, default_dp) + '</td>';
								html += '	<td style="text-align: center;">' + num(num(installment.principal) + num(installment.interest), default_dp) + '</td>';
								html += '	<td style="text-align: center;">' + num(installment.principal_balance, default_dp) + '</td>';
								html += '</tr>';
							}
							$('#repay-schedule').html(html);
							
							$('#actual_loan_amount').change();
						}
					}
			});
		}
		
		
		// max interest
		var first_repay_date = ($('#first_repay_date').val() != '' ? $('#first_repay_date').val() : '');
		var loan_date = ($('#loan_date').val() != '' ? $('#loan_date').val() : date('Y-m-d'));
		if (first_repay_date == '' && loan_date != '') {
			var due_day = date('d', strtotime(loan_date));
			var this_month = date('Y-m-01', strtotime(loan_date));
			
			switch ($('#approval_repayment_cycle').val()) {
				case 'month':
					// if next month no this day, set to next 2 month and date 01
					var next_month = strtotime(date('Y-m-01', strtotime('+1 month', strtotime(this_month))));
					var next_month_max_day = date('t', next_month);
					
					var first_repay_day = (due_day > next_month_max_day ? 1 : due_day);
					first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (due_day > next_month_max_day ? 1 : 0) + ' month', next_month));
					break;
				
				case 'month_twice':
					var cycle_day = num(due_day);
					var cycle_day2 = (cycle_day <= 15 ? cycle_day + 15 : cycle_day - 15);
					if (num(date('m', strtotime(loan_date))) == 2 && cycle_day2 > num(date('t', strtotime(loan_date)))) {
						first_repay_day = date('t', strtotime(loan_date));
					}
					else {
						first_repay_day = cycle_day2;
					}
					first_repay_date = date('Y-m-' + pad(first_repay_day, 2, '0'), strtotime('+' + (cycle_day <= 15 ? 0 : 1) + ' month', strtotime(this_month)));
					break;
				
				case 'biweekly':
					first_repay_date = date('Y-m-d', strtotime('+14 day', strtotime(loan_date)));
					break;
				
				case 'day':
					first_repay_date = date('Y-m-d', strtotime('+' + $('#repayment_cycle_day').val() + ' day', strtotime(loan_date)));
					break;
				
				case '':
					return;
					break;
			}
		}
		
		$.ajax({
			async: true,
			type: 'POST',
			url: 'ajax_handler.php?inquire=get_max_interest',
			data: {
					interest_method: $('#approval_interest_method').val(),
					repayment_cycle: $('#approval_repayment_cycle').val(),
					repayment_cycle_day: $('#approval_repayment_cycle_day').val(),
					loan_amount: $('#approval_loan_amount').val(),
					installment: $('#approval_installment').val(),
					interest_rate: $('#approval_interest_rate').val(),
					flat_rate: $('#approval_flat_rate').val(),
					loan_date: loan_date,
					first_repay_date: first_repay_date,
					first_repay_interest: $('#extended_interest').val(),
					maximum_interest_rate: $('#approval_maximum_interest_rate').val()
				},
			dataType: 'json',
			success: function(response) {
					if (!jQuery.isEmptyObject(response)) {
						$('#approval_maxint_total_interest').val(response.total_interest);
						$('#approval_maxint_max_total_interest').val(response.max_total_interest);
						$('#approval_maxint_extra_interest_remain').val(num(num($('#approval_maxint_max_total_interest').val()) - num($('#approval_maxint_total_interest').val()) - num($('#approval_handling_fee').val()), default_dp));
						check_maxint();
					}
				}
		});
		
		
		// cal approval_handling_fee_interest_rate
		$('#approval_handling_fee_interest_rate').change();
	});
	
	
	// get updated prime rate
	$('select[id$="prime_rate_id"], #apply_date, #loan_date').change(function() {
		if ($('select[id*="rate_type"]').val() != 'vary') return;
		
		var start_date = date('Y-m-d');
		if (typeof $('#loan_date').val() != 'undefined' && $('#loan_date').val() != '') {
			start_date = $('#loan_date').val();
		}
		else if (typeof $('#apply_date').val() != 'undefined' && $('#apply_date').val() != '') {
			start_date = $('#apply_date').val();
		}
		
		$.ajax({
			async: false,
			type: 'POST',
			url: 'ajax_handler.php?inquire=get_prime_rate',
			data: {
					prime_rate_id: $('select[id$="prime_rate_id"]').val(),
					start_date: start_date
				},
			dataType: 'json',
			success: function(response) {
					if (!jQuery.isEmptyObject(response)) {
						$('input[id$="prime_rate"]').val(response.prime_rate).change();
						$('#prime_rate_log_id').val(response.prime_rate_log_id);
					}
				}
		});
	});
	
	
	
	/*------------------------------
	 |	general
	 |------------------------------*/
	// default .calendar as jquery-ui-datepicker
	$('.calendar').not('[readonly]').datepicker({
		onSelect: function() {
			$(this).blur().change().datepicker('hide');
		},
		yearRange: '-80:+20',
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		dateFormat: 'yy-mm-dd'
		, closeText: '關閉', prevText: '&#x3c;上月', nextText: '下月&#x3e;', currentText: '今天', monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'], monthNamesShort: ['一','二','三','四','五','六', '七','八','九','十','十一','十二'], dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'], dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'], dayNamesMin: ['日','一','二','三','四','五','六'], weekHeader: '周', firstDay: 0, isRTL: false, showMonthAfterYear: true, yearSuffix: '年'	}).change(function() {
		var _input = $(this).val();
		var is_valid = /^(\d{4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])$/i.test(_input);
		if (is_valid) {
			var formatted_date = sprintf('%s-%s-%s', _input.substring(0, 4), _input.substring(4, 6), _input.substring(6, 8));
			$(this).val(formatted_date).change();
		}
	}).off('keydown');
	
	
	// tooltip
	$('a[rel=tooltip], span[rel=tooltip]').tooltip({ animation: false, html: true });
	$('input[rel=tooltip]').tooltip({ animation: false, placement: 'bottom', trigger: 'focus' });
	$('span.masked').tooltip({ animation: false, title: '對不起，你無權限查看此項資料。' });
	$('input.masked, textarea.masked').tooltip({ animation: false, title: '對不起，你無權限查看此項資料。', trigger: 'focus' });
	
	
	// search-box
	$('.search-box').click(function() {
		if ($(this).attr('href')) {
			new_window($(this).attr('href'), ($(this).data('width') ? $(this).data('width') : 1260), ($(this).data('height') ? $(this).data('height') : 650), 'advance_search');
		}
		return false;
	});
	
	
	// make all ajax as local for ajax-loading to catch
	$.ajaxSetup({
		cache: false,
		global: false,
		beforeSend: function(jqXHR, settings) {
				settings.data += '&isAjax=true';
			},
		complete: function(jqXHR) {
			if (jqXHR.status == 203) {
				refresh();
			}
		}
	});
	
	
	// display message on ajax
	$('#message-holder').ajaxStart(function() {
		show_message('ajax_loading');
		$(this).html('<div class="alert fade in"><a class="close" data-dismiss="alert">&times;</a><i class="icon loading"></i> 載入中...</div>');
	}).ajaxSuccess(function() {
	}).ajaxError(function() {
		show_message('error');
		$(this).html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a><i class="icon cross"></i> Error...</div>');
	});
	
	
	
	/*------------------------------
	 |	page loaded action
	 |------------------------------*/
		
		// set global variables from parent
	if (window.frameElement) {
		var frame_parent = window.parent.window;
		
		individual_msg = frame_parent.individual_msg;
		individual_msg_visibility = frame_parent.individual_msg_visibility;
		$('#individual_msg .container').html(individual_msg);
		
		global_msg = frame_parent.global_msg;
		global_msg_visibility = frame_parent.global_msg_visibility;
		$('#global_msg .container').html(global_msg);
		
				// keep alert when switching between page
		individual_msg_visibility = (individual_msg != '');
		global_msg_visibility = (global_msg != '');
				
		toggle_individual_msg(individual_msg_visibility ? 'show' : 'hide');
		toggle_global_msg(global_msg_visibility ? 'show' : 'hide');
	}
	
	// display notification
	try {
		NotificationService();
		get_notification();
	} catch (e) {}
		
		
		
	
	});


function hkid_bracekets(prefix) {
	if (typeof prefix == 'undefined') prefix = '';
	
	if ($('#' + prefix + 'passport_type_id').val() == 0) {
		var value = $('#' + prefix + 'passport_no').val().replace(/[\(\)]/g, '');
		var result = value.toUpperCase();
		var is_valid = /^[A-Z]{1,2}[0-9]{6}[A-Z0-9]{1}$/i.test(value);
		
		if (is_valid) {
			result = (sprintf('%s(%s)', value.slice(0, value.length - 1), value.slice(-1))).toUpperCase();
		}
		if (result != value) {
			$('#' + prefix + 'passport_no').val(result).valid();
		}
	}
}


function year_till_date(from_date) {
	var is_valid = /^(\d{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/i.test(from_date);
	if (!is_valid) {
		return '';
	}
	
	var from_date = from_date.split('-');
	var today_date = date('Y-m-d').split('-');
	
	var num_years = today_date[0] - from_date[0];
	var num_months = today_date[1] - from_date[1];
	if (num_months < 0 || (num_months === 0 && today_date[2] < from_date[2])) {
        num_years--;
    }
	
	return Math.floor(num_years);
}


function date_duration_year(year) {
	return date('Y-m-d', strtotime('-' + num(year) + ' year', strtotime(date('Y-m-d'))));
}


function date_diff(from_date, to_date) {
	var is_valid = /^(\d{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/i.test(from_date) && /^(\d{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/i.test(to_date);
	if (!is_valid) {
		return 0;
	}
	
	return Math.round((strtotime(to_date) - strtotime(from_date)) / 86400);
}


function form_response() {
	$('body').scrollTop(0);
	
	var json = arguments[0];
	var button = arguments[1];
	
	//setTimeout(function() {
		if (typeof json != 'undefined') {
			with (json) {
				// do callback
				if (typeof callback != 'undefined' && callback != '') {
					eval(callback);
				}
				
				// redirect client uri
				if (error.length == 0) {
					if (url != '') {
						refresh(url);
						return true;
					}
				}
				
				// reset control-group state
				$('.control-group.error, .control-group.warning').removeClass('error warning').find('.help-inline').html('');
				
				// set error label
				for (var i = 0; i < error.length; i++) {
					$('#' + error[i].target).addClass(error[i].type).find('.help-inline').html(error[i].message).css('display', 'block');
				}
				if (error.length > 0) {
					show_message('form_error');
				}
			}
		}
		
		if (typeof button != 'undefined') {
			button.button('reset');
		}
		
		return true;
	//}, 500);
}


function show_message(type, message, msg_type) {
	switch (type) {
		// form message
		case 'ajax_loading':
			$('#message-holder').html('<div class="alert fade in"><a class="close" data-dismiss="alert">&times;</a><i class="icon loading"></i> 載入中...</div>');
			break;
		
		case 'ajax_error':
			$('#message-holder').html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a><i class="icon cross"></i> Error...</div>');
			break;
		
		case 'form_error':
			$('#message-holder').html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a>無法送出，請檢查填寫資料是否正確。</div>');
			break;
		
		case 'custom_error':
			$('#message-holder').html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a>' + message + '</div>');
			break;
		
		case 'custom':
			switch (msg_type) {
				case 'success':
					msg_icon = '<i class="icon tick"></i>';
					break;
				case 'error':
					msg_icon = '<i class="icon cross"></i>';
					break;
				case 'info':
					msg_icon = '<i class="icon information"></i>';
					break;
				case '':
				default:
					msg_icon = '<i class="icon error"></i>';
					break;
			}
			$('#message-holder').html('<div class="alert alert-' + msg_type + ' fade in"><a class="close" data-dismiss="alert">&times;</a>' + msg_icon + ' &nbsp; ' + message + '</div>');
			break;
		
		case 'reset':
			$('#message-holder').html('');
			break;
		
		// upload message
		case 'ajax_upload':
			$('#upload-message-holder').html('<div class="alert fade in"><a class="close" data-dismiss="alert">&times;</a><i class="icon loading"></i> 上傳中...</div>');
			break;
		
		case 'upload_custom_error':
			$('#upload-message-holder').html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a>' + message + '</div>');
			break;
		
		case 'upload_reset':
			$('#upload-message-holder').html('');
			break;
	}
}


function pad(number, length, character) {
	var str = '' + number;
	character = (typeof character == 'undefined' ? '0' : character)
	while (str.length < length) {
		str = character + str;
	}
	return str;
}


function num(str, decimal) {
	if (typeof str == 'undefined') return 0;
	
	var m = Math.pow(10, 0);
	var value = Math.floor((Number(str.toString().replace(/,/g, '')) * m).toPrecision(14)) / m;
	
	if (typeof decimal != 'undefined') {
		return number_format(value, decimal, '.', ',');
	}
	else {
		return value;
	}
}


function num2dp(str, decimal) {
	if (typeof str == 'undefined') return 0;
	
	var m = Math.pow(10, 2);
	var value = Math.floor((Number(str.toString().replace(/,/g, '')) * m).toPrecision(14)) / m;
	
	if (typeof decimal != 'undefined') {
		return number_format(value, 2, '.', ',');
	}
	else {
		return value;
	}
}


function rate(str, decimal) {
	if (typeof str == 'undefined') return 0;
	
	var value = Number(str.toString().replace(/,/g, ''));
	
	if (typeof decimal != 'undefined') {
		return number_format(value, decimal, '.', ',');
	}
	else {
		return value;
	}
}


function _ceil(value, decimal) {
	return round(Math.ceil(value * Math.pow(10, decimal)) / Math.pow(10, decimal), decimal);
}


function _floor(value, decimal) {
	// general case floor(-1.6) = -2
	// make negative floor(-1.6) = -1
	var sign = (value < 0 ? -1 : 1);
	var value = Math.abs(value);
	
	return round(Math.floor(value * Math.pow(10, decimal)) * sign / Math.pow(10, decimal), decimal);
}


function _round(value, decimal) {
	var round_method = 'NORMAL';
	switch (round_method) {
		case 'UP':
			return _ceil(value, decimal);
			break;
		
		case 'DOWN':
			return _floor(value, decimal);
			break;
		
		case 'NORMAL':
		default:
			return round(value, decimal);
			break;
	}
}


function discard(param) {
	if ($('#main-form').serialize() != form_init) {
		if (confirm('資料尚未儲存，請確認是否放棄？')) {
			refresh(param);
			return true;
		}
	}
	else {
		refresh(param);
		return true;
	}
	
	return false;
}


function get_notification() {
	$.ajax({
		async: true,
		type: 'POST',
		url: 'ajax_handler.php?inquire=get_notification',
		data: {},
		dataType: 'json',
		success: function(response) {
				if (!jQuery.isEmptyObject(response)) {
					// show message when change applied
					// individual_msg
					if (response.individual_msg != individual_msg) {
						$('#individual_msg .container').html(response.individual_msg);
						
						individual_msg = response.individual_msg;
						individual_msg_visibility = (individual_msg != '');
					}
					toggle_individual_msg(individual_msg_visibility ? 'show' : 'hide');
					
					// global_msg
					if (response.global_msg != global_msg) {
						$('#global_msg .container').html(response.global_msg);
						
						global_msg = response.global_msg;
						global_msg_visibility = (global_msg != '');
					}
					toggle_global_msg(global_msg_visibility ? 'show' : 'hide');
					
					// te_indicator
					$('#te_indicator').html(response.te_indicator).data('count', response.te_indicator);
					show_menu_indicator();
					
					// set parent's global variables
					if (window.frameElement) {
						// set messages to parent frame
						var frame_parent = window.parent.window;
						
						frame_parent.individual_msg = individual_msg;
						frame_parent.individual_msg_visibility = individual_msg_visibility;
						
						frame_parent.global_msg = global_msg;
						frame_parent.global_msg_visibility = global_msg_visibility;
					}
				}
			}
	});
}


function show_menu_indicator() {
	// te_indicator
	if ($('#te_indicator').data('count') > 0) {
		$('#te_indicator').fadeIn(500);
	}
	else {
		$('#te_indicator').fadeOut(500);
	}
	
	// app_indicator
	if ($('#app_indicator').data('count')) {
		$('#app_indicator').fadeIn(500);
	}
	else {
		$('#app_indicator').fadeOut(500);
	}
	
	// te_app_indicator
	if ($('#te_indicator').data('count') > 0 || $('#app_indicator').data('count')) {
		$('#te_app_indicator').fadeIn(500);
	}
	else {
		$('#te_app_indicator').fadeOut(500);
	}
}


function toggle_individual_msg() {
	var action = (typeof arguments[0] == 'undefined' ? 'show' : arguments[0]);
	
	switch (action) {
		case 'show':
			$('#individual_msg').show('slide', { direction: 'down' });
			individual_msg_visibility = true;
			break;
		
		case 'hide':
			$('#individual_msg').slideUp();
			if ($('#global_msg').css('display') != 'none') {
				$('#global_msg').animate({ marginBottom: 0 });
			}
			individual_msg_visibility = false;
			break;
	}
	
	if (window.frameElement) {
		window.parent.window.individual_msg_visibility = individual_msg_visibility;
	}
}


function toggle_global_msg() {
	var action = (typeof arguments[0] == 'undefined' ? 'show' : arguments[0]);
	
	switch (action) {
		case 'show':
			$('#global_msg').css('margin-bottom', ($('#individual_msg').css('display') != 'none' ? $('#individual_msg').outerHeight() : 0));
			// do transition if multiple messages are set
			if ($('#global_msg .container .message').text().indexOf('|||') >= 0) {
				$('#global_msg .container .message').Morphext({
					animation: 'fadeInUp',
					separator: '|||',
					speed: 8000
				});
			}
			$('#global_msg').show('slide', { direction: 'down' });
			global_msg_visibility = true;
			
			// do transition if multiple messages are set
			if ($('#global_msg .container .message').text().indexOf('|||') >= 0) {
				$('#global_msg .container .message').Morphext({
					animation: 'fadeInUp',
					separator: '|||',
					speed: 8000
				});
			}
			break;
		
		case 'hide':
			$('#global_msg').slideUp();
			global_msg_visibility = false;
			break;
	}
	
	if (window.frameElement) {
		window.parent.window.global_msg_visibility = global_msg_visibility;
	}
}


function refresh(param) {
	$(window).unbind('beforeunload');
	param = (typeof param == 'undefined' ? '?=' : param);
	$(window.location).attr('href', param);
}


function form_refresh(form, param) {
	$(window).unbind('beforeunload');
	param = (typeof param == 'undefined' ? '?x=' + $(document).scrollLeft() + '&y=' + $(document).scrollTop() : param + '&x=' + $(document).scrollLeft() + '&y=' + $(document).scrollTop());
	form.attr('action', param).unbind('submit').submit();
}


function new_window(url, width, height, obj_name) {
    var left = ((screen.width / 2) - (width / 2));
    var top = ((screen.height / 2) - (height / 2));
	
	eval('window_' + obj_name + ' = window.open("' + url + '", "window_' + obj_name + '", "width=' + width + ', height=' + height + ', left=' + left + ', top=' + top + ', menubar=no, resizable=yes, scrollbars=yes, status=no, toolbar=no");');
	eval('window_' + obj_name + '.focus();');
}


function switch_lang(lang_code) {
	$.get('login.php?type=set_lang&lang=' + lang_code, function(data) {
		refresh("?id=125");
	});
}


function switch_branch(branch_id) {
	$.get('login.php?type=set_branch&branch=' + branch_id, function(data) {
		refresh("?id=125");
	});
}


function logout() {
		
	$('#logout-button').button('loading');
	
	setTimeout(function() {
		$(window.location).attr('href', 'login.php?type=logout');
	}, 400);
}
</script>
<script type="text/javascript">
$(function() {
	/*------------------------------
	 |	form validation
	 |------------------------------*/
	// default settings
	$.validator.setDefaults({
		errorPlacement: function(error, element) {
			$(element).closest('.control-group').addClass('error').find('.help-inline').html(error).css('display', 'block');
		},
		unhighlight: function(element, errorClass) {
			if ($(element).closest('.controls').find('[aria-invalid=true]').length == 0) {
				$(element).closest('.control-group').removeClass('error').find('.help-inline').html('').css('display', 'inline-block');
			}
		}
	});
	
	
	// not equal to
	$.validator.addMethod('notEqualTo', function(value, element, param) {
		var target = $(param);
		if ( this.settings.onfocusout ) {
			target.unbind(".validate-notEqualTo").bind("blur.validate-notEqualTo", function() {
				$(element).valid();
			});
		}
		return value !== target.val();
	}, 'Please specify a different value');
	
	
	// equal to (case insensitive)
	$.validator.addMethod('equalToUpper', function( value, element, param ) {
		var target = $( param );
		if ( this.settings.onfocusout ) {
			target.unbind( ".validate-equalToUpper" ).bind( "blur.validate-equalToUpper", function() {
				$( element ).valid();
			});
		}
		return value.toUpperCase() == target.val().toUpperCase();
	}, 'Please enter the same value');
	
	
	// regular expression
	$.validator.addMethod('regex', function(value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	}, 'Regex mismatch');
	
	
	// overriding min & max (detect thousand separator)
	$.validator.addMethod('min', function(value, element, min_value) {
		return this.optional(element) || num(value) >= num(min_value);
	});
	$.validator.addMethod('max', function(value, element, max_value) {
		return this.optional(element) || num(value) <= num(max_value);
	});
	
	
	// nonzero
	$.validator.addMethod('nonzero', function(value, element) {
		return this.optional(element) || num(value) > 0;
	}, 'Value should be greater than 0');

	// nonzerorate
	$.validator.addMethod('nonzerorate', function(value, element) {
		return this.optional(element) || rate(value, default_dp_interest_rate) > 0;
	}, 'Value should be greater than 0');	
	
	// date
	$.validator.addMethod('mydate', function(value, element) {
		// format
		var is_valid = /^(\d{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/i.test(value);
		
		// check date available
		if (is_valid) {
			var segments = value.toString().split('-');
			if (segments[1] == 2) {
				var is_leap = (segments[0] % 4 == 0 && (segments[0] % 100 != 0 || segments[0] % 400 == 0));
				if (segments[2] > 29 || (segments[2] == 29 && !is_leap)) {
					is_valid = false;
				}
			}
			else if ((segments[1] == 4 || segments[1] == 6 || segments[1] == 9 || segments[1] == 11) && segments[2] > 30) {
				is_valid = false;
			}
		}
		return this.optional(element) || is_valid;
	}, 'Invalid date format');
	
	
	// year
	$.validator.addMethod('year', function(value, element) {
		return this.optional(element) || /^(\d{4})$/i.test(value);
	}, 'Invalid year');
	
	
	// hkid
	$.validator.addMethod('hkid', function(value, element) {
		// format AA123456(1) must have brackets
		var is_valid = /^[A-Z]{1,2}[0-9]{6}\([A-Z0-9]{1}\)$/i.test(value);
		
		// check digit
		if (is_valid) {
			var weight = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			var sum = 0;
			var hkid = value.toString().toUpperCase().split('(');
			var check_digit = hkid[1].charAt(0);
			hkid = pad(hkid[0], 8, ' ');
			var multiplier = hkid.length + 1;
			for (var i = 0; i < hkid.length; i++) {
				var character = hkid.charAt(i);
				var idx = ((character == ' ' && i == 0 && hkid.length == 8) ? 36 : weight.indexOf(character));
				sum = sum + idx * multiplier--;
			}
			var result = ((11 - (sum % 11) == 10) ? 'A' : ((11 - (sum % 11)) % 11));
			is_valid = (result == check_digit);
		}
		return this.optional(element) || is_valid;
	}, 'Invalid HKID');
	
	
	// passport no
	$.validator.addMethod('passport_no', function(value, element) {
		return this.optional(element) || !/[^a-z0-9\-\/\(\)]/i.test(value);
	}, 'Invalid passport no.');
	
	
	// adult
	$.validator.addMethod('adult', function(value, element) {
		return this.optional(element) || num(value) >= 18;
	}, 'Must be adult (age 18 or above)');
	
	
	// date greater than
	$.validator.addMethod('date_greater_than', function(value, element, param) {
		return this.optional(element) || date_diff(param, value) >= 0;
	}, $.validator.format("This date must be or later than {0}"));
	
	
	// cycle day
	$.validator.addMethod('min_cycle_day', function(value, element) {
		return this.optional(element) || num(value) >= 1;
	}, 'Min value is 1');
	
	
	// unique name
	$.validator.addMethod('unique_name', function(value, element) {
		var is_unique = true;
		
		$(element).closest('tbody').find('input[id$="_name"][id!="' + $(element).attr('id') + '"]').each(function() {
			if ($(this).val().replace(/\s/g, '') == value.replace(/\s/g, '')) {
				is_unique = false;
				return false;
			}
		});
		return this.optional(element) || is_unique;
	}, 'This should be unique');
	
	
	// unique passport_no
	$.validator.addMethod('unique_passport_no', function(value, element) {
		var is_unique = true;
		
		$(element).closest('tbody').find('input[id$="_passport_no"][id!="' + $(element).attr('id') + '"]').each(function() {
			if ($(this).val() == value) {
				is_unique = false;
				return false;
			}
		});
		return this.optional(element) || is_unique;
	}, 'Passport no. should be unique');
	
	
	// unique customer_code
	$.validator.addMethod('unique_customer_code', function(value, element) {
		var is_unique = true;
		
		$(element).closest('tbody').find('input[id$="_customer_code"][id!="' + $(element).attr('id') + '"]').each(function() {
			if ($(this).val() == value) {
				is_unique = false;
				return false;
			}
		});
		return this.optional(element) || is_unique;
	}, 'Customer code should be unique');
	

	// additional method
	$.validator.addMethod('require_from_group', function(value, element, options) {
		var validator = this;
		var selector = options[1];
		var validOrNot = $(selector, element.form).filter(function() {
			return validator.elementValue(this);
		}).length >= options[0];
		
		if (validOrNot) {
			$(selector, element.form).closest('.control-group').removeClass('error').find('.help-inline').html('').css('display', 'inline-block');
		}
		
		return validOrNot;
	}, $.validator.format("Please fill at least {0} of these fields."));
	
	
	// default error messages
	$.extend($.validator.messages, {
		required: '此項必須填寫',
		number: '請輸入正確數字',
		digits: '請輸入正確數字',
		min: '請輸入大於 {0} 的數字',
		max: '請輸入小於 {0} 的數字',
		nonzero: '請輸入大於 0 的數字',
		nonzerorate: '請輸入大於 0 的數字',
		minlength: '請輸入最少 {0} 位字元',
		mydate: '請輸入正確日期格式 (YYYY-MM-DD)',
		year: '請輸入正確年份 (YYYY)',
		email: '請輸入正確電郵地址',
		hkid: '這個身分證號碼無效',
		passport_no: '證件號碼只能包含英數及 - / ( )',
		adult: '申請人必須年滿 18 歲',
		min_cycle_day: '還款週期日數必須為 1 或以上',
		unique_name: '重複輸入',
		unique_passport_no: '證件編號重複',
		unique_customer_code: '客戶編號重複',
		require_from_group: '請選填最少 {0} 項'
	});
});


function render_rate_label() {
	var interest_rate_label = handling_fee_interest_rate_label = flat_rate_label = '';
	
	var interest_method = $('select[id*="interest_method"]').val();
	var repayment_cycle = $('select[id*="repayment_cycle"]').val();
	
	// interest rate
	switch (interest_method) {
		default:
		case 'int_prin':
		case 'int_first':
		case 'rule78':
			interest_rate_label = handling_fee_interest_rate_label = '實際年利率';
			break;
			
		case 'fixed_int':
			interest_rate_label = '年利率';
			handling_fee_interest_rate_label = '實際年利率';
			break;
	}
	
	// flat rate
	switch (interest_method) {
		default:
		case 'int_prin':
			switch (repayment_cycle) {
				case 'month':
					flat_rate_label = '月平息';
					break;
					
				default:
				case 'month_twice':
				case 'biweekly':
				case 'day':
					flat_rate_label = '期平息';
					break;
			}
			break;
			
		case 'int_first':
		case 'fixed_int':
			switch (repayment_cycle) {
				case 'month':
					flat_rate_label = '月息';
					break;
					
				default:
				case 'month_twice':
				case 'biweekly':
				case 'day':
					flat_rate_label = '期息';
					break;
			}
			break;
			
		case 'rule78':
			flat_rate_label = '月平息';
			break;
	}
	
	$('div[id*="interest_rate-control"][id!="approval_handling_fee_interest_rate-control"] > label').html(interest_rate_label);
	$('span.interest_rate_label').html(handling_fee_interest_rate_label);
	$('div[id*="flat_rate-control"] > label, span.flat_rate_label').html(flat_rate_label);
}


function check_maxint() {
	var errors = new Array();
	var maxint_rate = ($('#approval_maximum_interest_rate').val() ? $('#approval_maximum_interest_rate').val() : 48.0000);
	
	// maxint rate
	$('.maxint_rate[id$="interest_rate"], .maxint_rate[id$="penalty_rate"]').each(function() {
		if (rate($(this).val()) > maxint_rate) {
			errors[errors.length] = "'" + $(this).attr('name') + "': '" + sprintf('達至利率上限 %s%%', round(maxint_rate, 4)) + "'";
		}
		else {
			$(this).closest('.control-group').removeClass('error').find('.help-inline').html('').css('display', 'inline-block');
		}
	});
	
	// maxint
	if (num($('.maxint[id$="maxint_total_interest"]').val()) + num($('.maxint[id$="handling_fee"]').val()) > num($('.maxint[id$="maxint_max_total_interest"]').val())) {
		
		if ($('.maxint[id$="maxint_extra_interest_remain"]').length == 0) {
			errors[errors.length] = "'" + $('.maxint[id$="maxint_max_total_interest"]').attr('name') + "': '', " + "'" + $('.maxint[id$="maxint_total_interest"]').attr('name') + "': '總利息已超過最高可收利息'";
		}
		else {
			errors[errors.length] = "'" + $('.maxint[id$="maxint_max_total_interest"]').attr('name') + "': '', " + "'" + $('.maxint[id$="maxint_total_interest"]').attr('name') + "': '', " + "'" + $('.maxint[id$="maxint_extra_interest_remain"]').attr('name') + "': '總利息已超過最高可收利息'";
		}
	}
	else {
		$('.maxint[id$="maxint_max_total_interest"], .maxint[id$="maxint_total_interest"], .maxint[id$="maxint_extra_interest_remain"]').closest('.control-group').removeClass('error').find('.help-inline').html('').css('display', 'inline-block');
	}
	
	// show errors
	if (errors.length > 0) {
		eval("main_form_validator.showErrors({ " + errors.join(',') + " });");
	}
	
	return (errors.length > 0);
}


function check_active_period(element, check_date) {
	var is_valid = (check_date == '' || check_date == '0000-00-00' || active_period == '0000-00-00' || strtotime(check_date) >= strtotime(active_period));
	
	if (!is_valid) {
		$(element).attr('title', '操作失敗').popover({
			placement: 'bottom',
			trigger: 'focus',
			content: sprintf('資料日期必須在允許修改範圍內 (%s 及之後)。', active_period)
		}).focus();
	}
	
	return is_valid;
}


function check_accounting_period(element, check_date) {
	var is_valid = (check_date == '' || check_date == '0000-00-00' || accounting_period == '0000-00-00' || strtotime(check_date) > strtotime(accounting_period));
	
	if (!is_valid) {
		$(element).attr('title', '操作失敗').popover({
			placement: 'bottom',
			trigger: 'focus',
			content: sprintf('撇帳日期必須在會計最後入賬日期之後 (%s 之後)。', accounting_period)
		}).focus();
	}
	
	return is_valid;
}
</script><script type="text/javascript">
$(function() {
	/*------------------------------
	 |	live form (for calculations)
	 |------------------------------*/
	$('#payout_status').change(function() {
		switch ($(this).val()) {
			case 'not_payout':
				$('#payout_date').val('');
				break;
			
			case 'payout':
				if ($('#payout_date').val() == '') {
					$('#payout_date').val($('#loan_date').val());
				}
				break;
		}
	});
	
	
	
	/*------------------------------
	 |	quick search
	 |------------------------------*/
	$('#quick-search-form').submit(function() {
		$('#quick_search').val($.trim($('#quick_search').val()));
		if ($('#quick_search').val() == '') return false;
	});
	
	
	
	/*------------------------------
	 |	form validation
	 |------------------------------*/
	$('#main-form').validate({
		rules: {
			'payout_date': {
					required: function() { return ($('#payout_status').val() == 'payout'); },
					dlt_loan_date: $('#loan_date').val()
				},
			'payout_method_id': {
					required: function() { return ($('#payout_status').val() == 'payout'); }
				}
		},
		messages: {
			'payout_date': {
					dlt_loan_date: $.validator.format("日期不能晚於起息日期 ({0})")
				}
		}
	});
	
	
	// date later than (loan date)
	$.validator.addMethod('dlt_loan_date', function(value, element, param) {
		return this.optional(element) || date_diff(param, value) <= 0;
	}, $.validator.format("This date must be or eariler than {0}"));
	
	
	
	/*------------------------------
	 |	main form
	 |------------------------------*/
	$('#main-form').submit(function() {
		// clear error message
		show_message('reset');
		
		// validate
		if (!$(this).validate().form()) {
			return false;
		}
		
		// confirm cancel payout
		if ($('#payout_status').val() == 'not_payout') {
			if ($('#status').val() == 'repaying' && !confirm('請確認是否取消放款？')) {
				return false;
			}
		}
		
		// confirm payout date is not the same as loan date
		if ($('#payout_date').val() != '' && $('#payout_date').val() != $('#loan_date').val()) {
			if (!confirm('放款日期與起息日期不同，請確定是否繼續？')) {
				return false;
			}
		}
		
		// create data string
		var param = $(this).find('input, textarea, select').serialize();
		var data = {
		};
		param += '&' + $.param(data);
		
				
		if (no_submit == true) return;
		no_submit = true;
		
		$('#delete-button').button('loading');
		$.ajax({
			type: 'POST',
			global: true,
			url: $(this).attr('action'),
			data: param,
			dataType: 'json',
			success: function(response) {
					// redirect or display errors
					form_response(response, $('#delete-button'));
					no_submit = false;
				},
			error: function() {
					$('#delete-button').button('reset');
					no_submit = false;
				}
		});
		return false;
	});
	
	
	
	/*------------------------------
	 |	initiate
	 |------------------------------*/
		$('#quick_search').focus();
		
	$('#payout_status').not('[disabled]').focus();
	
	
	
	/*------------------------------
	 |	leave alert if form has data
	 |------------------------------*/
	});
</script>
</head>
<body class="with-buttons">

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<div>
				<ul class="nav menu">
										<li class="dropdown">
						<a href="landing.php"><i class="icon-home icon-white"></i></a>
					</li>
					
					<li class="divider-vertical"></li>
					
					<!--loan menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">貸款</a>
						<ul class="dropdown-menu">
							<li class="nav-header">操作</li>
							<li><a href="loan_info.php">客戶貸款資料</a></li>
							<li><a href="loan_blacklist.php">黑名單資料</a></li>
							<li><a href="loan_send_sms.php">發送短訊</a></li>
														<li class="nav-header">工具</li>
							<li><a href="loan_calculator.php">供款計算機</a></li>
							<li><a class="search-box" href="search_loan_address.php?type=view&do=inquire">地址搜尋比較</a></li>
							<li class="nav-header">客戶申請表</li>
							<li><a href="loan_form_builder.php">申請表格式</a></li>
						</ul>
					</li><!--/loan menu-->
					
					<li class="divider-vertical"></li>
					
					<!--approval menu-->
					<li class="dropdown">
						<a href="loan_approval.php">批核</a>
					</li><!--/approval menu-->
					
					<li class="divider-vertical"></li>
					
					<!--payout menu-->
					<li class="dropdown">
						<a href="loan_payout.php">放款</a>
					</li><!--/payout menu-->
					
					<li class="divider-vertical"></li>
					
					<!--repay menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">還款</a>
						<ul class="dropdown-menu">
							<li class="nav-header">提示</li>
							<li><a href="notice_overdue.php">還款提示</a></li>
							<li class="nav-header">操作</li>
							<li><a href="repay.php">還款處理</a></li>
														<li><a href="repay_revise.php">修改還款表</a></li>
							<li><a href="repay_oca_writeoff.php">OCA追數 / 撇帳</a></li>
						</ul>
					</li><!--/repay menu-->
					
					<li class="divider-vertical"></li>
					
						<!--loan_import & te_alert menu-->
	<li class="dropdown" style="width: 100px;">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">TE / App <span id="te_app_indicator" class="dot" style="display: none;"></span></a>
		<ul class="dropdown-menu">
			<li class="nav-header">提示</li>
			<li><a href="notice_te_alert.php">TE 提示 <span id="te_indicator" class="badge badge-important menu-badge" style="display: none;">0</span></a></li>
			<li class="nav-header">操作</li>
			<li><a href="te_enquiry.php">TE 信貸資料查詢</a></li>
		</ul>
	</li><!--/loan_import & te_alert menu-->
						
					<li class="divider-vertical"></li>
					
					<!--report menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">報表</a>
												<div class="dropdown-menu multi-column" style="width: 370px;">
							<div class="row-fluid">
								<ul class="dropdown-menu" style="float: left; padding-bottom: 0; width: 175px;">
									<li class="nav-header">貸款</li>
									<li><a href="report_loan_apply.php">貸款審批狀態報表</a></li>
									<li><a href="report_loan_record.php">貸款報表</a></li>
									<li><a href="report_loan_detail.php">貸款詳細報表</a></li>
									
									<li class="nav-header">還款</li>
									<li><a href="report_repayment.php">收款報表</a></li>
									<li><a href="report_repayment_schedule.php">還款表明細</a></li>
									<li><a href="report_estimated_repayment.php">每月預計可收報表</a></li>
									<li><a href="report_outstanding_summary.php">欠款總表</a></li>
									<li><a href="report_outstanding_details.php">客戶還款表欠款詳細</a></li>
									<li><a href="report_interest_receivable.php">應收利息報表(以截數計)</a></li>
									<li><a href="report_temp_amount.php">暫存金額報表</a></li>
									<li><a href="report_temp_amount_escrow.php">暫存金額提存報表</a></li>
									<li><a href="report_repay_history.php">客戶還款記錄</a></li>
									
									<li class="nav-header">OCA追數 / 撇帳</li>
									<li><a href="report_currently_oca_loan.php">現時交追數公司客戶表</a></li>
									<li><a href="report_oca_charge.php">需付追數費用報表</a></li>
									<li><a href="report_oca_repay_non_settled.php">追回金額未入帳報表</a></li>
									<li><a href="report_writeoff.php">撇帳報表</a></li>
									<li><a href="report_writeoff_collection.php">撇帳追回金額報表</a></li>
								</ul>
								<ul class="dropdown-menu" style="float: left; width: 195px;">
									<li class="nav-header">總表</li>
									<li><a href="report_statement.php">收支總表</a></li>
									<li><a href="report_staff_performance.php">業務員業績報表</a></li>
									<li><a href="report_agent_performance.php">中介公司業績報表</a></li>
									<li><a href="report_overdue.php">期數過期報表</a></li>
									<li><a href="report_half_repaid.php">已還期數過半報表</a></li>
									<li><a href="report_completed_loan.php">貸款還清報表</a></li>
									<li><a href="report_loan_account_statement.php">貸款帳戶年結供款記錄報表</a></li>
									<li><a href="report_send_sms.php">短訊發送記錄</a></li>
									
										<li class="nav-header">放債人牌照相關</li>
	<li><a href="report_unsecured_personal_loan.php">無抵押個人貸款的資料統計</a></li>
	
	<li class="nav-header">MLS專享類別</li>
	<li><a href="report_aml_financing_audit_report.php">反洗錢資金籌集審計報表</a></li>
	<li><a href="report_abnormal_repayment_monitoring_report.php">異常還款交易監察報告</a></li>
	<li><a href="report_mls_loan_list.php">貸款清單</a></li>
									</ul>
							</div>
						</div>
					</li><!--/report menu-->
					
					<li class="divider-vertical"></li>
					
					<!--master menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">設定</a>
						<ul class="dropdown-menu">
							<li class="nav-header">資料設定</li>
							<li><a href="master_company_info.php">公司資料</a></li>
							
							<li class="nav-header">員工</li>
							<li><a href="master_staff_info.php">員工資料</a></li>
							<li><a href="master_staff_level.php">員工級別及權限</a></li>
							
							<li class="nav-header">基本設定</li>
							<li><a href="master_customer_related.php">客戶相關</a></li>
							<li><a href="master_loan_related.php">貸款相關</a></li>
							<li><a href="master_creditor.php">銀行 / 信貸公司</a></li>
							<li><a href="master_agent.php">中介人公司</a></li>
							<li><a href="master_solicitor.php">律師樓</a></li>
							<li><a href="master_oca_agent.php">追數公司</a></li>
							<li><a href="master_holiday.php">公眾假期</a></li>
							<li><a href="master_sms_content.php">短訊內容</a></li>
							
													</ul>
					</li><!--/master menu-->
					
					<li class="divider-vertical"></li>
					
					<!--system menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">系統</a>
						<ul class="dropdown-menu">
							<li class="nav-header">設定</li>
							<li><a href="system_default.php">系統預設</a></li>
							<li><a href="system_code_format.php">編號格式</a></li>
							<li><a href="system_active_period.php">資料修改範圍</a></li>
							<li><a href="system_visible_tel_no.php">顯示電話號碼</a></li>
							
							<li class="nav-header">管制</li>
							<li><a href="system_access_ip.php">限制登入IP</a></li>
							
							<li class="nav-header">監控</li>
							<li><a href="system_login_list.php">登入列表</a></li>
							<li><a href="system_log.php">系統記錄</a></li>
							
							<li class="nav-header">資料庫</li>
																					<li><a href="system_hosting.php">文件寄存量</a></li>
													</ul>
					</li><!--/system menu-->
					
					<li class="divider-vertical"></li>
					
					<!--support menu-->
					<li class="dropdown">
						<a href="http://www.softmedia.hk/contactus.html" target="_blank">支援</a>
					</li><!--/support menu-->
									</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="icon-user icon-white"></i> <u title="bong" style="display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; margin-bottom: -4px;">bong</u></a>
						<ul class="dropdown-menu">
							<li><a href="user_settings.php"><i class="icon-cog"></i> 設定</a></li>
							<li class="dropdown-submenu">
								<a href="javascript:void(0)"><i class="icon-globe"></i> 介面語言</a>
								<ul class="dropdown-menu">
																		<li><a href="javascript:void(0)" onClick="switch_lang('en-uk');">English</a></li>
																		<li><a href="javascript:void(0)" onClick="switch_lang('zh-tw');">繁體中文</a></li>
																	</ul>
							</li>
							<li><a href="javascript:void(0)" onclick="$('#logout-modal').modal('show');"><i class="custom icon-log-out"></i> 登出</a></li>
						</ul>
					</li>
				</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
												<a class="select_branch dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="custom icon-map-pin icon-white"></i> <u title="佐敦" style="display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px; margin-bottom: -4px;">佐敦</u></a>
						<ul class="dropdown-menu">
																					<li><a href="javascript:void(0)" onClick="switch_branch('1');">佐敦</a></li>
													</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="subnav">
	<div class="subnav-inner">
		<div class="container">
						<!--search buttons-->
			<ul class="nav2">
				<li>
					<div class="btn-group">
						<button class="btn" type="button"  onClick="refresh('?id=3');"  title="最前">&nbsp;<i class="icon-fast-backward"></i>&nbsp;</button>
						<button class="btn" type="button"  onClick="refresh('?id=124');"  title="上一筆">&nbsp;<i class="icon-backward"></i>&nbsp;</button>
						<button class="btn" type="button"  onClick="refresh('?id=126');"  title="下一筆">&nbsp;<i class="icon-forward"></i>&nbsp;</button>
						<button class="btn" type="button"  onClick="refresh('?id=126');"  title="最後">&nbsp;<i class="icon-fast-forward"></i>&nbsp;</button>
					</div>
				</li>
				<li>
					<form class="navbar-form" id="quick-search-form" name="quick-search-form" method="post" style="height: 38px;">
						<div class="input-append">
							<input class="input-small" id="quick_search" name="quick_search" type="text" value="" rel="tooltip" title="請輸入證件編號"  style="border-color: #cccccc;" autocomplete="off" /><button class="btn" id="quick-search-button" type="submit" title="搜尋" >&nbsp;<i class="icon-search"></i>&nbsp;</button>
						</div>
					</form>
				</li>
				<li><button class="btn  search-box " href="search_loan.php?type=view&do=payout" id="search-button" type="button"  onClick="return false;"  title="進階搜尋">進階搜尋</button></li>
			</ul><!--/search buttons-->
						
			<!--action buttons-->
			<ul class="nav2 pull-right">
								<li><button class="btn btn-primary" type="button"  disabled  title="放款處理"><i class="icon-edit icon-white"></i> 放款處理</button></li>
				<li><button class="btn" type="button"  onClick="new_window('print_docs_loan_integrated.php?type=view&id=125&init=payout_receipt', 750, 800, 'print_docs_loan_payout');"  title="列印放款確認書"><i class="icon-print"></i> 列印放款確認書</button></li>
							</ul><!--/action buttons-->
		</div>
	</div>
</div>

<div class="container">
	<div class="page-header" style="position: relative;">
		<h1>貸款 &raquo; 放款處理</h1>
		
				<span style="position: absolute; top: 8px; right: 0;">
			<button class="btn" type="button"  onClick="refresh('loan_info.php?id=125');"  title="申請">申請</button>
			<button class="btn" type="button"  onClick="refresh('loan_approval.php?id=125');"  title="批核">批核</button>
			<button class="btn btn-inverse" type="button"  title="放款">放款</button>
			<button class="btn" type="button"  onClick="refresh('repay.php?id=125');"  title="還款">還款</button>
			<button class="btn" type="button"  onClick="refresh('repay_oca_writeoff.php?id=125');"  title="OCA / 撇帳">OCA / 撇帳</button>
		</span>
			</div>
	
	<div id="message-holder"></div>

		<form class="form-horizontal" id="main-form" name="main-form" method="post">
		<fieldset>
			<div class="row-fluid">
				<div class="span12">
					<div class="row-fluid" style="padding-top: 18px;">
						<div class="span4">
							<div class="control-group" id="loan_status-control">
								<label class="control-label" for="loan_status">現時狀態</label>
								<div class="controls">
									<input class="highlight" id="loan_status" name="loan_status" type="text" value="已完成" style="width: 206px;" readonly />
									<input id="status" name="status" type="hidden" value="complete" />
								</div>
							</div>
							
							<div class="control-group" id="apply_no-control">
								<label class="control-label" for="apply_no">申請編號</label>
								<div class="controls">
									<input class="highlight" id="apply_no" name="apply_no" type="text" value="AF000119" style="width: 206px;" readonly />
								</div>
							</div>
							
							<div class="control-group" id="loan_no-control">
								<label class="control-label" for="loan_no">貸款編號</label>
								<div class="controls">
									<input class="highlight" id="loan_no" name="loan_no" type="text" value="NEW-00099-01" style="width: 206px;" readonly />
								</div>
							</div>
						</div>
						
						<div class="span4">
							<div class="control-group" id="loan_type-control">
								<label class="control-label" for="loan_type">貸款類別</label>
								<div class="controls">
									<input class="highlight" id="loan_type" name="loan_type" type="text" value="NEW NA" style="width: 206px;" readonly />
									<input id="loan_type_id_hd" name="loan_type_id" type="hidden" value="2" />
								</div>
							</div>
							
							<div class="control-group" id="name-control">
								<label class="control-label" for="name">名稱</label>
								<div class="controls">
									<input class="highlight" id="name" name="name" type="text" value="劉思衡" style="width: 206px;" readonly />
									<input id="borrower_name" name="borrower_name" type="hidden" value="劉思衡" />
								</div>
							</div>
							
							<div class="control-group" id="passport-control">
								<label class="control-label" for="passport">證件</label>
								<div class="controls">
																		<input class="highlight" id="passport" name="passport" type="text" value="K824468(5)" style="width: 206px;" readonly />
									<input id="borrower_passport_no" name="borrower_passport_no" type="hidden" value="K824468(5)" />
																	</div>
							</div>
						</div>
						
						<div class="span4">
							<div class="control-group" id="interest_method-control">
								<label class="control-label" for="interest_method">計息方法</label>
								<div class="controls">
									<input class="highlight" id="interest_method" name="interest_method" type="text" value="息隨本減" style="width: 206px;" readonly />
									<input id="approval_interest_method" name="approval_interest_method" type="hidden" value="int_prin" />
								</div>
							</div>
							
							<div class="control-group" id="tel_no-control">
								<label class="control-label" for="tel_no">電話號碼</label>
								<div class="controls">
																		<input class="highlight" id="tel_no" name="tel_no" type="text" value="9" style="width: 206px;" readonly />
									<input id="mobile_no" name="mobile_no" type="hidden" value="9" />
									<input id="home_no" name="home_no" type="hidden" value="" />
																	</div>
							</div>
							
														<div class="row-fluid">
								<div class="span12">
									<div class="control-group">
										<label class="control-label"></label>
										
										<div class="controls">
											<button class="btn" type="button" onClick="new_window('loan_info.php?type=view&id=125&menu=no', 1220, 650, 'loan_info');" title="查看申請資料">查看申請資料</button>
										</div>
									</div>
								</div>
							</div>
													</div>
					</div><br /><br />
					
					
					<div class="row-fluid">
						<div class="span12">
							<fieldset>
								<legend style="margin-bottom: 8px;">放款資料</legend>
								
								<div class="row-fluid">
									<div class="span12">
										<div class="control-group" id="approval_loan_amount-control">
											<label class="control-label" for="approval_loan_amount">貸款金額</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on">$</span><input class="" id="approval_loan_amount" name="approval_loan_amount" type="text" value="10,000.00" style="width: 179px;" readonly />
												</div>
											</div>
										</div>
										
										<div class="control-group" id="actual_loan_amount-control">
											<label class="control-label" for="actual_loan_amount">客戶實收金額</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on">$</span><input class="highlight" id="actual_loan_amount" name="actual_loan_amount" type="text" value="10,000.00" style="width: 179px;" readonly />
												</div>
											</div>
										</div>
										
										<div class="control-group" id="loan_date-control">
											<label class="control-label" for="loan_date">起息日期</label>
											<div class="controls">
												<input class="mydate calendar" id="loan_date" name="loan_date" type="text" maxlength="10" value="2024-01-26" placeholder="YYYY-MM-DD" style="width: 206px;" readonly />
												<span class="help-inline"></span>
											</div>
										</div>
										
										<div class="control-group" id="payout_date-control">
											<label class="control-label" for="payout_date">放款日期</label>
											<div class="controls">
												<input class="mydate calendar" id="payout_date" name="payout_date" type="text" maxlength="10" value="2024-01-26" placeholder="YYYY-MM-DD" style="width: 206px;" readonly />
												<span class="help-inline"></span>
											</div>
										</div>
										
										<div class="control-group" id="payout_status-control">
											<label class="control-label" for="payout_status">放款處理</label>
											<div class="controls">
												<select class="" id="payout_status" name="payout_status" style="width: 220px;" disabled>
																																							<option value="not_payout" >未放款</option>
																										<option value="payout" selected>放款</option>
																									</select>
																								<input id="payout_status_hd" name="payout_status" type="hidden" value="payout" />
																								<span class="help-inline"></span>
											</div>
										</div>
										
										<div class="control-group" id="payout_method-control">
											<label class="control-label" for="payout_method_id">放款方式</label>
											<div class="controls">
												<select class="" id="payout_method_id" name="payout_method_id" style="width: 220px;" disabled>
																																							<option value="" >&nbsp;</option>
																										<option value="1" selected>現金</option>
																										<option value="2" >支票</option>
																									</select>
																								<input id="payout_method_hd" name="payout_method_id" type="hidden" value="1" />
																								<span class="help-inline"></span>
											</div>
										</div>
										
										<div class="control-group" id="payout_remark-control">
											<label class="control-label" for="payout_remark">放款備註</label>
											<div class="controls">
												<textarea class="" id="payout_remark" name="payout_remark" rows="4" style="width: 261px;" readonly></textarea>
												<span class="help-inline"></span>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
			
			<input type="text" value="" style="display: none; visibility: hidden;" />
			<input id="id" name="id" type="hidden" value="125" />
			<input id="staff_id" name="staff_id" type="hidden" value="11" />
			<input id="payout_id" name="payout_id" type="hidden" value="116" />
			<input id="migrate_lock" name="migrate_lock" type="hidden" value="" />
			<input id="approval_date" name="approval_date" type="hidden" value="2024-01-26" />
		</fieldset>
	</form>
	
		
	
	<div class="modal hide" id="delete-modal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>確認刪除</h3>
		</div>
		
		<div class="modal-body">
			<p>被刪除的資料將無法還原，請確認是否刪除？</p>
		</div>
		
		<div class="modal-footer">
			<button class="btn" type="button" data-dismiss="modal">取消</button>
			<button class="btn btn-primary" id="delete-button" type="button" data-loading-text="載入中.." onClick="if (no_submit) return; force_submit = true; $('#main-form').attr('action', '?type=delete').submit();">確定</button>
		</div>
	</div><!--/#delete-modal-->
	
	
	<div class="modal hide" id="logout-modal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>系統登出</h3>
		</div>
		
		<div class="modal-body">
			<p>請確認是否登出？</p>
		</div>
		
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">取消</button>
			<button class="btn btn-primary" id="logout-button" type="button" data-loading-text="登出中.." onClick="logout();">確定</button>
		</div>
	</div><!--/#logout-modal-->
	
	
		
	
			<div style="margin-top: 45px; margin-bottom: -40px;">
			<span class="label" rel="tooltip" title="<span style='white-space: nowrap;'>建立 : CAT @ 2024-01-26 14:58:06</span>" style="font-size: 10.998px;"><i class="icon icon-info-sign icon-white"></i> 檔案建立/更新時間</span>&nbsp;
		</div>
	
	<footer class="footer"><p class="pull-left">&copy; Softmedia Technology Co. Ltd.</p></footer>
	
		<div class="navbar-fixed-bottom alert alert-success text-center" id="global_msg" style="display: none; margin: 0; padding-top: 3px; padding-bottom: 3px; border: none; border-top: 1px solid #cfdbc9; border-radius: 0; font-weight: bold;">
		<div class="container"></div>
	</div>
	
	<div class="navbar-fixed-bottom alert text-center" id="individual_msg" style="display: none; margin: 0; padding-top: 3px; padding-bottom: 3px; background-color: #fff39f; border: none; border-top: 1px solid #e0d59f; border-radius: 0; font-weight: bold;">
		<div class="container"></div>
	</div>
	
</div><!--/.container -->

<div id="screen-overlay"></div>
</body>
</html>

