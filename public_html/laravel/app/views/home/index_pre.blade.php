<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>コールセンターの窓口</title>
	<meta name="robots" content="noindex,nofollow"><!-- 公開時に必ず外す -->
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" media="all" href="home/style_pre.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="home/assets/js/jquery.vertical.middle.js"></script>

	<script type="text/javascript">
	$(function() {
	//要素を中央に配置
	$('.main div').verticalMiddle();
	});
	</script>
</head>
<body>
<section class="main">
	<div>
		<h1><img src="home/assets/img/logo.png" width="600" height="168" alt="コールセンターの窓口"></h1>
		<h2>平成27年5月オープン予定</h2>
	</div>
    @if(App::isLocal())
        {{ HTML::link('top', 'トップへ') }}
    @endif
</section>
<footer>
copyright &copy;stramedia inc. all rights reserved.
</footer>

</body>
</html>