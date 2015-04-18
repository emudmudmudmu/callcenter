		<section class="search-box">
			<h2>{{ HTML::image('home/assets/img/top/subhead_search.png', '希望条件の求人があるかどうか調べよう！', ['width' => '750', 'height' => '27']) }}</h2>
 			<article class="tab-box" id="tabs">
				<ul class="tab-nav">
					<li class="tab1"><a href="#area"><img src="home/assets/img/top/tab_nav_area.png" width="139" height="35" alt="地域から探す" class="sbtn-area"></a></li>
					<li class="tab2"><a href="#details"><img src="home/assets/img/top/tab_nav_details.png" width="165" height="35" alt="詳細条件から探す" class="sbtn-details"></a></li>
				</ul>
				<div id="area">
					<p class="map">{{ HTML::image('home/assets/img/top/areasearch_main_bg.png', '地域から探す　コールセンターお仕事検索', ['width' => '750', 'height' => '360']) }}</p>
					<div class="area tohoku">
						<p>{{ HTML::image('home/assets/img/top/area_tohoku.png', '北海道・東北', ['width' => '85', 'height' => '25']) }}</p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '北海道', ['prefecture_id=1']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '青森', ['prefecture_id=2']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '岩手', ['prefecture_id=3']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '宮城', ['prefecture_id=4']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '秋田', ['prefecture_id=5']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '山形', ['prefecture_id=6']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '福島', ['prefecture_id=7']) }}</li>
						</ul>
					</div><!-- /.tohoku -->
					<div class="area kanto">
						<p><img src="home/assets/img/top/area_kanto.png" width="85" height="25" alt="関東"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '東京', ['prefecture_id=13']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '神奈川', ['prefecture_id=14']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '千葉', ['prefecture_id=12']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '埼玉', ['prefecture_id=11']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '茨城', ['prefecture_id=8']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '栃木', ['prefecture_id=9']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '群馬', ['prefecture_id=10']) }}</li>
						</ul>
					</div><!-- /.kanto -->
					<div class="area hokuriku">
						<p><img src="home/assets/img/top/area_hokuriku.png" width="85" height="25" alt="甲信越・北陸"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '山梨', ['prefecture_id=19']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '新潟', ['prefecture_id=15']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '長野', ['prefecture_id=20']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '富山', ['prefecture_id=16']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '石川', ['prefecture_id=17']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '福井', ['prefecture_id=18']) }}</li>
						</ul>
					</div><!-- /.hokuriku -->
					<div class="area tokai">
						<p><img src="home/assets/img/top/area_tokai.png" width="85" height="25" alt="東海"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '愛知', ['prefecture_id=23']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '岐阜', ['prefecture_id=21']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '静岡', ['prefecture_id=22']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '三重', ['prefecture_id=24']) }}</li>
						</ul>
					</div><!-- /.tokai -->
					<div class="area kansai">
						<p><img src="home/assets/img/top/area_kansai.png" width="85" height="25" alt="関西"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '大阪', ['prefecture_id=27']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '兵庫', ['prefecture_id=28']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '京都', ['prefecture_id=26']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '滋賀', ['prefecture_id=25']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '奈良', ['prefecture_id=29']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '和歌山', ['prefecture_id=30']) }}</li>
						</ul>
					</div><!-- /.kansai -->
					<div class="area chugoku">
						<p><img src="home/assets/img/top/area_chugoku.png" width="85" height="25" alt="中国・四国"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '鳥取', ['prefecture_id=31']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '島根', ['prefecture_id=32']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '岡山', ['prefecture_id=33']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '広島', ['prefecture_id=34']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '山口', ['prefecture_id=35']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '徳島', ['prefecture_id=36']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '香川', ['prefecture_id=37']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '愛媛', ['prefecture_id=38']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '高知', ['prefecture_id=39']) }}</li>
						</ul>
					</div><!-- /.chugoku -->
					<div class="area kyushu">
						<p><img src="home/assets/img/top/area_kyushu.png" width="85" height="25" alt="九州・沖縄"></p>
						<ul>
							<li>{{ HTML::linkRoute('home.job', '福岡', ['prefecture_id=40']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '佐賀', ['prefecture_id=41']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '長崎', ['prefecture_id=42']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '熊本', ['prefecture_id=43']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '大分', ['prefecture_id=44']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '宮崎', ['prefecture_id=45']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '鹿児島', ['prefecture_id=46']) }}</li>
							<li>{{ HTML::linkRoute('home.job', '沖縄', ['prefecture_id=47']) }}</li>
						</ul>
					</div><!-- /.kyushu -->
				</div><!-- /#area -->

				<div id="details">
				{{ Form::open(['route' => 'home.job', 'method' => 'GET']) }}
		
	                    <div class="inner">
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_area.png', '地域から検索', ['width' => '180', 'height' => '24']) }}</th>
									<td>
									{{ Form::select('prefecture_id', ['' => '都道府県を選択してください'] + JapanesePrefectures::prefectures()) }}
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_type.png', '雇用形態で選ぶ（複数選択可）', ['width' => '180', 'height' => '26']) }}</th>
								<td>
									<div class="check-box">
									@foreach(JobType::job_types() as $type_id => $type_name)
										{{ Form::checkbox('type_ids[]', $type_id) }}{{ $type_name }}
									@endforeach
									</div>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_cat.png', '業種を選ぶ（複数選択可）', ['width' => '180', 'height' => '32']) }}</th>
								<td>
									<div class="check-box">
									@foreach(JobCategory::job_categories() as $category_id => $category_name)
										{{ Form::checkbox('category_ids[]', $category_id) }}{{ $category_name }}
									@endforeach
									</div>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_condition.png', '希望条件を選ぶ（複数選択可）', ['width' => '180', 'height' => '27']) }}</th>
								<td>
									<div class="check-box">
									@foreach(JobCondition::job_conditions() as $condition_id => $condition_name)
										{{ Form::checkbox('condition_ids[]', $condition_id) }}{{ $condition_name }}
									@endforeach
									</div>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_freeword.png', 'フリーワード', ['width' => '180', 'height' => '22']) }}</th>
								<td><input type="text" name="q" value=""></td>
							</tr>
						</table>
						<ul>
							<li>{{ Form::reset( ' ', ['class' => 'search-reset', 'width' => '166', 'height' => '22']) }}</li>
							<li>{{ Form::image('home/assets/img/top/tab2_btn_search.png', 'この条件で検索する', ['class' => 'search', 'width' => '214', 'height' => '34']) }}</li>
						</ul>
					</div>
				{{ Form::close() }}
				</div><!-- /#details -->
			</article><!-- /.tabbox -->
		</section><!-- /.search-box -->