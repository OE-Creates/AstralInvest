//========== GLOBAL VARIABLES ======================================================
var investrate = 0.06;
var total_quarters = 4;

var ke_vat = 0.16;
var init_amount_100 = 1458.23;
var init_amount_75 = 1083.65;
var init_amount_50 = 729.10;
var init_amount_25 = 364.54;

var farm_uplimit = 20;
var farm_lolimit = 1;
//==================================================================================

//Sign Up >> Validate Password
function validate_password() {

	var pass = document.getElementById('pass').value;
	var confirm_pass = document.getElementById('confirm_pass').value;
	if (pass != confirm_pass) {
		document.getElementById('wrong_pass_alert').style.color = 'red';
		document.getElementById('wrong_pass_alert').innerHTML = '☒ Passwords do not match';
		document.getElementById('confirm_button').disabled = true;
		document.getElementById('confirm_button').style.opacity = (0.4);
	}
	else {
		document.getElementById('wrong_pass_alert').style.color = 'green';
		document.getElementById('wrong_pass_alert').innerHTML = '🗹 Passwords Matched';
		document.getElementById('confirm_button').disabled = false;
		document.getElementById('confirm_button').style.opacity = (1);
	}
}

//Management Page >> Update User >> Validate Password
function validate_updpassword() {

	var pass = document.getElementById('updpass').value;
	var confirm_pass = document.getElementById('confirm_updpass').value;
	if (pass != confirm_pass) {
		document.getElementById('wrong_pass_alert_upd').style.color = 'red';
		document.getElementById('wrong_pass_alert_upd').innerHTML = '☒ Passwords do not match';
		document.getElementById('confirm_updbutton').disabled = true;
		document.getElementById('confirm_updbutton').style.opacity = (0.4);
	}
	else {
		document.getElementById('wrong_pass_alert_upd').style.color = 'green';
		document.getElementById('wrong_pass_alert_upd').innerHTML = '🗹 Passwords Matched';
		document.getElementById('confirm_updbutton').disabled = false;
		document.getElementById('confirm_updbutton').style.opacity = (1);
	}
}

//Profile Page >> Validate Profile Image
function FilevalidationProfileImg() {
	const fi = document.getElementById('check_profileimg');
	// Check if any file is selected.
	
	var filePath = fi.value;
			 
	// Allowing file type
	var allowedExtensions = /(\.jpg|\.jpeg)$/i;
	 
	if (!allowedExtensions.exec(filePath)) {
		alert('Invalid file type. Only .jpg/.jpeg allowed');
		fi.value = '';
	}
	else
	{
		if (fi.files.length > 0) {
			for (const i = 0; i <= fi.files.length - 1; i++) {

				const fsize = fi.files.item(i).size;
				const file = Math.round((fsize / 1024));
				// The size of the file.
				if (file >= 2048) {
					alert("File too Big, please select a file less than 2mb");
					fi.value = '';
				}
			}
		}
	}
}

//Community Service Page >> Fill in Community Service Type
function FillCommServiceTypeA() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Community Service - Build Church";
}

function FillCommServiceTypeB() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Community Service - Support Education";
}

function FillCommServiceTypeC() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Community Service - Support Health Facilities";
}

function FillCommServiceTypeD() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Community Service - Support the Community";
}

function roundUp(num, precision) {
	precision = Math.pow(10, precision);
	return Math.round(num * precision) / precision;
}

//Dashboard >> Fill Dashboard Calculator
function CalculatePayAmount_Dash() {
	var vatval100 = roundUp(init_amount_100 * ke_vat, 2);
	var vatval75 = roundUp(init_amount_75 * ke_vat, 2);
	var vatval50 = roundUp(init_amount_50 * ke_vat, 2);
	var vatval25 = roundUp(init_amount_25 * ke_vat, 2);

	var totalval100 = roundUp(init_amount_100 + vatval100, 2);
	var totalval75 = roundUp(init_amount_75 + vatval75, 2);
	var totalval50 = roundUp(init_amount_50 + vatval50, 2);
	var totalval25 = roundUp(init_amount_25 + vatval25, 2);

	var valtoearn100 = roundUp((totalval100 * (investrate * total_quarters)), 2);
	var valtoearn75 = roundUp((totalval75 * (investrate * total_quarters)), 2);
	var valtoearn50 = roundUp((totalval50 * (investrate * total_quarters)), 2);
	var valtoearn25 = roundUp((totalval25 * (investrate * total_quarters)), 2);
	
	var totalvaltoearn100 = roundUp((totalval100 * (1 + (investrate * total_quarters))), 2);
	var totalvaltoearn75 = roundUp((totalval75 * (1 + (investrate * total_quarters))), 2);
	var totalvaltoearn50 = roundUp((totalval50 * (1 + (investrate * total_quarters))), 2);
	var totalvaltoearn25 = roundUp((totalval25 * (1 + (investrate * total_quarters))), 2);

	var farms = document.getElementById('cardholder-nooffarms').value;

	var newval100 = roundUp(init_amount_100 * farms, 2);
	var newval75 = roundUp(init_amount_75 * farms, 2);
	var newval50 = roundUp(init_amount_50 * farms, 2);
	var newval25 = roundUp(init_amount_25 * farms, 2);
	document.getElementById('amount-payable-100').innerHTML = '$'.concat(newval100);
	document.getElementById('amount-payable-75').innerHTML = '$'.concat(newval75);
	document.getElementById('amount-payable-50').innerHTML = '$'.concat(newval50);
	document.getElementById('amount-payable-25').innerHTML = '$'.concat(newval25);

	var newvatval100 = roundUp(vatval100 * farms, 2);
	var newvatval75 = roundUp(vatval75 * farms, 2);
	var newvatval50 = roundUp(vatval50 * farms, 2);
	var newvatval25 = roundUp(vatval25 * farms, 2);
	document.getElementById('vat-payable-100').innerHTML = '$'.concat(newvatval100);
	document.getElementById('vat-payable-75').innerHTML = '$'.concat(newvatval75);
	document.getElementById('vat-payable-50').innerHTML = '$'.concat(newvatval50);
	document.getElementById('vat-payable-25').innerHTML = '$'.concat(newvatval25);

	var newtotval100 = roundUp(totalval100 * farms, 2);
	var newtotval75 = roundUp(totalval75 * farms, 2);
	var newtotval50 = roundUp(totalval50 * farms, 2);
	var newtotval25 = roundUp(totalval25 * farms, 2);
	document.getElementById('total-payable-100').innerHTML = '$'.concat(newtotval100);
	document.getElementById('total-payable-75').innerHTML = '$'.concat(newtotval75);
	document.getElementById('total-payable-50').innerHTML = '$'.concat(newtotval50);
	document.getElementById('total-payable-25').innerHTML = '$'.concat(newtotval25);

	var newvaltoearn100 = roundUp(valtoearn100 * farms, 2);
	var newvaltoearn75 = roundUp(valtoearn75 * farms, 2);
	var newvaltoearn50 = roundUp(valtoearn50 * farms, 2);
	var newvaltoearn25 = roundUp(valtoearn25 * farms, 2);
	document.getElementById('amount-earned-100').innerHTML = '$'.concat(newvaltoearn100);
	document.getElementById('amount-earned-75').innerHTML = '$'.concat(newvaltoearn75);
	document.getElementById('amount-earned-50').innerHTML = '$'.concat(newvaltoearn50);
	document.getElementById('amount-earned-25').innerHTML = '$'.concat(newvaltoearn25);

	var newtotvaltoearn100 = roundUp(totalvaltoearn100 * farms, 2);
	var newtotvaltoearn75 = roundUp(totalvaltoearn75 * farms, 2);
	var newtotvaltoearn50 = roundUp(totalvaltoearn50 * farms, 2);
	var newtotvaltoearn25 = roundUp(totalvaltoearn25 * farms, 2);
	document.getElementById('total-earned-100').innerHTML = '$'.concat(newtotvaltoearn100);
	document.getElementById('total-earned-75').innerHTML = '$'.concat(newtotvaltoearn75);
	document.getElementById('total-earned-50').innerHTML = '$'.concat(newtotvaltoearn50);
	document.getElementById('total-earned-25').innerHTML = '$'.concat(newtotvaltoearn25);
}

function AddFarms_Dash() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval += 1;
	if (newval > farm_uplimit) {
		document.getElementById('cardholder-nooffarms').value = farm_uplimit;
		CalculatePayAmount_Dash();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		CalculatePayAmount_Dash();
	}
}

function SubtractFarms_Dash() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval -= 1;
	if (newval < farm_lolimit) {
		document.getElementById('cardholder-nooffarms').value = farm_lolimit;
		CalculatePayAmount_Dash();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		CalculatePayAmount_Dash();
	}
	
}

//Investment Page >> Fill in Investment Type
function FillInvestmentType025() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Contribution Plan - Starter Plan";

	CalculatePayAmount025();
}

function FillInvestmentType050() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Contribution Plan - Standard Plan";

	CalculatePayAmount050();
}

function FillInvestmentType075() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Contribution Plan - Premium Plan";

	CalculatePayAmount075();
}

function FillInvestmentType100() {
	document.getElementById('cardholder-reason').defaultValue = "AstralInvest - Contribution Plan - Exclusive Plan";
	
	CalculatePayAmount100();
}

//==================================================================================
function CalculatePayAmount025() {
	var vatval = roundUp(init_amount_25 * ke_vat, 2) ;
	var totalval = roundUp(init_amount_25 + vatval, 2);

	var farms = document.getElementById('cardholder-nooffarms').value;

	var newval = roundUp(init_amount_25 * farms, 2);
	document.getElementById('amount-payable').innerHTML = '$'.concat(newval);

	var newvatval = roundUp(vatval * farms, 2);
	document.getElementById('vat-payable').innerHTML = '$'.concat(newvatval);

	var newtotval = roundUp(totalval * farms, 2);
	document.getElementById('total-payable').innerHTML = '$'.concat(newtotval);

	document.getElementById('display-totalinvest').innerHTML = '$'.concat(totalval);
	document.getElementById('display-descrtotalinvest').innerHTML = '$'.concat(totalval);

	var quartval = roundUp(totalval * investrate, 2);
	document.getElementById('display-quarterearn').innerHTML = '$'.concat(quartval);

	var totearnval = roundUp(totalval * (1 + roundUp(investrate * total_quarters, 2)), 2);
	document.getElementById('display-totalearn').innerHTML = '$'.concat(totearnval);

	document.getElementById('cardholder-amount').value = Math.round(newtotval * 100);
}

function AddFarms025() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval += 1;
	if (newval > farm_uplimit) {
		document.getElementById('cardholder-nooffarms').value = farm_uplimit;
		document.getElementById('cardholder-nofarms').value = farm_uplimit;
		CalculatePayAmount025();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount025();
	}
}

function SubtractFarms025() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval -= 1;
	if (newval < farm_lolimit) {
		document.getElementById('cardholder-nooffarms').value = farm_lolimit;
		document.getElementById('cardholder-nofarms').value = farm_lolimit;
		CalculatePayAmount025();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount025();
	}
	
}
//==================================================================================

//==================================================================================
function CalculatePayAmount050() {
	var vatval = roundUp(init_amount_50 * ke_vat, 2) ;
	var totalval = roundUp(init_amount_50 + vatval, 2);

	var farms = document.getElementById('cardholder-nooffarms').value;

	var newval = roundUp(init_amount_50 * farms, 2);
	document.getElementById('amount-payable').innerHTML = '$'.concat(newval);

	var newvatval = roundUp(vatval * farms, 2);
	document.getElementById('vat-payable').innerHTML = '$'.concat(newvatval);

	var newtotval = roundUp(totalval * farms, 2);
	document.getElementById('total-payable').innerHTML = '$'.concat(newtotval);

	document.getElementById('display-totalinvest').innerHTML = '$'.concat(totalval);
	document.getElementById('display-descrtotalinvest').innerHTML = '$'.concat(totalval);

	var quartval = roundUp(totalval * investrate, 2);
	document.getElementById('display-quarterearn').innerHTML = '$'.concat(quartval);

	var totearnval = roundUp(totalval * (1 + roundUp(investrate * total_quarters, 2)), 2);
	document.getElementById('display-totalearn').innerHTML = '$'.concat(totearnval);

	document.getElementById('cardholder-amount').value = Math.round(newtotval * 100);
}

function AddFarms050() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval += 1;
	if (newval > farm_uplimit) {
		document.getElementById('cardholder-nooffarms').value = farm_uplimit;
		document.getElementById('cardholder-nofarms').value = farm_uplimit;
		CalculatePayAmount050();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount050();
	}
}

function SubtractFarms050() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval -= 1;
	if (newval < farm_lolimit) {
		document.getElementById('cardholder-nooffarms').value = farm_lolimit;
		document.getElementById('cardholder-nofarms').value = farm_lolimit;
		CalculatePayAmount050();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount050();
	}
	
}
//==================================================================================

//==================================================================================
function CalculatePayAmount075() {
	var vatval = roundUp(init_amount_75 * ke_vat, 2) ;
	var totalval = roundUp(init_amount_75 + vatval, 2);

	var farms = document.getElementById('cardholder-nooffarms').value;

	var newval = roundUp(init_amount_75 * farms, 2);
	document.getElementById('amount-payable').innerHTML = '$'.concat(newval);

	var newvatval = roundUp(vatval * farms, 2);
	document.getElementById('vat-payable').innerHTML = '$'.concat(newvatval);

	var newtotval = roundUp(totalval * farms, 2);
	document.getElementById('total-payable').innerHTML = '$'.concat(newtotval);

	document.getElementById('display-totalinvest').innerHTML = '$'.concat(totalval);
	document.getElementById('display-descrtotalinvest').innerHTML = '$'.concat(totalval);

	var quartval = roundUp(totalval * investrate, 2);
	document.getElementById('display-quarterearn').innerHTML = '$'.concat(quartval);

	var totearnval = roundUp(totalval * (1 + roundUp(investrate * total_quarters, 2)), 2);
	document.getElementById('display-totalearn').innerHTML = '$'.concat(totearnval);

	document.getElementById('cardholder-amount').value = Math.round(newtotval * 100);
}

function AddFarms075() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval += 1;
	if (newval > farm_uplimit) {
		document.getElementById('cardholder-nooffarms').value = farm_uplimit;
		document.getElementById('cardholder-nofarms').value = farm_uplimit;
		CalculatePayAmount075();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount075();
	}
}

function SubtractFarms075() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval -= 1;
	if (newval < farm_lolimit) {
		document.getElementById('cardholder-nooffarms').value = farm_lolimit;
		document.getElementById('cardholder-nofarms').value = farm_lolimit;
		CalculatePayAmount075();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount075();
	}
	
}
//==================================================================================

//==================================================================================
function CalculatePayAmount100() {
	var vatval = roundUp(init_amount_100 * ke_vat, 2) ;
	var totalval = roundUp(init_amount_100 + vatval, 2);

	var farms = document.getElementById('cardholder-nooffarms').value;

	var newval = roundUp(init_amount_100 * farms, 2);
	document.getElementById('amount-payable').innerHTML = '$'.concat(newval);

	var newvatval = roundUp(vatval * farms, 2);
	document.getElementById('vat-payable').innerHTML = '$'.concat(newvatval);

	var newtotval = roundUp(totalval * farms, 2);
	document.getElementById('total-payable').innerHTML = '$'.concat(newtotval);

	document.getElementById('display-totalinvest').innerHTML = '$'.concat(totalval);
	document.getElementById('display-descrtotalinvest').innerHTML = '$'.concat(totalval);

	var quartval = roundUp(totalval * investrate, 2);
	document.getElementById('display-quarterearn').innerHTML = '$'.concat(quartval);

	var totearnval = roundUp(totalval * (1 + roundUp(investrate * total_quarters, 2)), 2);
	document.getElementById('display-totalearn').innerHTML = '$'.concat(totearnval);

	document.getElementById('cardholder-amount').value = Math.round(newtotval * 100);
}

function AddFarms100() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval += 1;
	if (newval > farm_uplimit) {
		document.getElementById('cardholder-nooffarms').value = farm_uplimit;
		document.getElementById('cardholder-nofarms').value = farm_uplimit;
		CalculatePayAmount100();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount100();
	}
}

function SubtractFarms100() {
	var currval = document.getElementById('cardholder-nooffarms').value;
	var newval = parseInt(currval);
	newval -= 1;
	if (newval < farm_lolimit) {
		document.getElementById('cardholder-nooffarms').value = farm_lolimit;
		document.getElementById('cardholder-nofarms').value = farm_lolimit;
		CalculatePayAmount100();
	}
	else {
		document.getElementById('cardholder-nooffarms').value = newval;
		document.getElementById('cardholder-nofarms').value = newval;
		CalculatePayAmount100();
	}
	
}
//==================================================================================

function CopyToClipBoard() {
	var copyText = document.getElementById("referrer-link");

	// Select the text field
	copyText.select();
	copyText.setSelectionRange(0, 99999); // For mobile devices

	// Copy the text inside the text field
	navigator.clipboard.writeText(copyText.value);
}

//Management Referral Page >> Grey Out Submit Button
function ManageReferralFullPageFunct() {
	document.getElementById('referral-ack-button').disabled = true;
	document.getElementById('referral-ack-button').style.opacity = (0.4);
}

//Management Referral Page >> Enable Submit Button when checked
function CheckRefAckBtn() {
	const checkbox = document.getElementById('referral-ack-check')
	
	if (checkbox.checked) {
		document.getElementById('referral-ack-button').disabled = false;
		document.getElementById('referral-ack-button').style.opacity = (1);
	} else {
		document.getElementById('referral-ack-button').disabled = true;
		document.getElementById('referral-ack-button').style.opacity = (0.4);
	}
}