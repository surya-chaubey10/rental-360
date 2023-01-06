<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<style>
			.form-group{
			margin-bottom: 1rem !important;
			}
			#header_background{
			border:1px solid #4c4c4c;
			color:#fff;font-size:14px;background:#ec2d2f;margin:0;padding: 22px;
			}
			#footer_background{
			border:1px solid #4c4c4c;margin: 0; font-size:12px; color:#fff;padding: 34px 20px 70px 34px;background: #ec2d2f;
			}
			.btn.btn-danger {
			color: #ffffff;
			background-color: #eb0d23;
			border-color: #eb0d23;
			cursor:pointer !important;
			padding:10px 20px;
			border-radius:5px
			}
		</style>
	</head>
	<body>
		<div style="width: 600px; margin:0px auto">
            <p  style="padding: 15px;border:1px solid #ddd;background-color:black !important; text-color:white  !important;font-size: 14px;margin: 0;padding: 22px;">
            <img src="{{ asset('images/portrait/small/logo.png') }}" alt="avatar" style="width:80px">
		   </p>
			
			<div style="font-size:14px; line-height:30px; padding:5px 5px; border-top:1px solid transparent;border:1px solid #ddd;">
				<p style="margin: 0px auto;font-size:16px;font-style:italic;color:#ec2d2f;font-weight:bold;">
                Dear {{$data->fullname}}
			    </p>
                <p>
                Your account has been successfully registered on <a href="http://159.223.107.48/login" >rental360.com</a>.<br>
                You will be receiving confirmation email within 48 hours.
                </p> 
                <p>
                Regards,<br>
				Team Rental 360
                </p> 
		   
			</div>

			<p id="footer_background" style="border: 1px solid #4c4c4c;margin: 0;font-size: 12px;color: #fff;padding: 34px 20px 70px 34px;position:relative;background-color: black !important">
  
				<img src="{{ asset('images/portrait/small/logo.png') }}" style="width:80px"/>
				  
					<!-- logo img section end -->
					<!-- logo social section -->
							<a style="color: #fff; float:right;margin-right: 10px;" href="" target="_blank" id="instagram_image" class="">
								<!-- insta -->
								<img src='https://imgur.com/9xgeHuU.png'>
								<!-- insta -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="" target="_blank" id="linkedin_image" class="">
								<!-- linkedin -->
								<img src='https://imgur.com/EwDwfmZ.png'>
								<!-- linkedin -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="" target="_blank" id="youtube_image" class="">
								<!-- youtube -->
								<img src='https://imgur.com/YxQziYb.png'>
								<!-- youtube -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px; " href="" target="_blank" id="twitter_image" class="">
								<!-- twitter -->
								<img src='https://imgur.com/y4ySuwH.png'>
								<!-- twitter -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="" target="_blank" id="facebook_image" class="">
								<!-- facebook -->
								<img src='https://imgur.com/BvLdT4n.png'>
								<!-- facebook -->
							</a>
							<span style="float:right;text-align:right;width: 100%;margin-top: 5px;">

                                <span id="email_span" style="border-right: 1px solid #fff;padding-right: 8px;color:#fff;" class="">
                                info@rental360.com
                                </span>

                                <span id="phone_span" style="margin-left: 10px;">
                                800-Rental360
                                </span>

                                <span id="address_span" style="display: block"> 
                                Cluster X, JLT, Dubai
                                </span>

							</span>

                    <p class='footermenu' style="margin:0;font-size: 12px;color: #fff;padding:20px!important;position:relative;background-color:black !important; color:white !important">
					<span style="display:block;text-align: center;"><span style="display: inline-block;text-align: center;margin: 0 auto;"><a style="color:white !important; border-right: 1px solid #fff; padding-right: 8px;" href="" target="_blank" class="" id="terms_anchor">Terms & Conditions </a>
					<a style="color:white !important; border-right: 1px solid #fff; padding-right: 8px; padding-left: 8px;" href="" target="_blank" class="" id="privacy_anchor">Privacy Policy</a>
					<a style="color:white !important;margin-left: 10px;display:inline-block" href="" target="_blank" id="google_biz">Google My Business</a></span></span>
				</p></p>
				 
		</div>
	</body>
</html>

