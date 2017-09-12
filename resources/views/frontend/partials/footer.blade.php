@inject('config', '\App\Config')
@inject('article', '\App\Article')
<?php $footer = $article::findByKey('footer')->first(); ?>
<footer id="footer">
	<div class="fpart-first">
		<div class="container">
			<div class="row">
				{!! $footer->content !!}
			</div>
		</div>
	</div>
	<div class="fpart-second">
		<div class="container">
			<div id="powered" class="clearfix">
				<div class="powered_text pull-left flip">
					<p>{{ $config->getValueByKey('site_name') }} &copy; 2016 | Designed By <a href="http://ketnoimoi.com" target="_blank">Kết Nối Mới</a></p>
				</div>
				<div class="social pull-right flip"> 
					<a href="{{ $config->getValueByKey('facebook_page') }}" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/socialicons/facebook.png" alt="Facebook" title="Facebook"></a> 
					<a href="{{ $config->getValueByKey('twitter_page') }}" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/socialicons/twitter.png" alt="Twitter" title="Twitter"> </a> 
					<a href="{{ $config->getValueByKey('plus_google') }}" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/socialicons/google_plus.png" alt="Google+" title="Google+"> </a> 
					<a href="{{ $config->getValueByKey('pinterest_page') }}" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/socialicons/pinterest.png" alt="Pinterest" title="Pinterest"> </a> 
					<a href="{{ $config->getValueByKey('rss') }}" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/socialicons/rss.png" alt="RSS" title="RSS"> </a> 
				</div>
			</div>
			<!-- <div class="bottom-row">
				<div class="custom-text text-center"> <img alt="" src="/frontend/image/logo-small.png">
					<p>This is a CMS block. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
				</div>
				<div class="payments_types"> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_paypal.png" alt="paypal" title="PayPal"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_american.png" alt="american-express" title="American Express"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_2checkout.png" alt="2checkout" title="2checkout"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_maestro.png" alt="maestro" title="Maestro"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_discover.png" alt="discover" title="Discover"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="/frontend/image/payment/payment_mastercard.png" alt="mastercard" title="MasterCard"></a> </div>
			</div> -->
		</div>
	</div>
	<div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
</footer>