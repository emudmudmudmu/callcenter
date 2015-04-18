		<section class="search-box">
				<div id="details2">
				{{ Form::open(['route' => 'home.job', 'method' => 'GET']) }}
					<div class="inner">
                    	<img  src="home/assets/img/top/subhead_search.png" width="323" height="27" alt="希望条件の求人があるかどうか調べよう">
                        <div class="right">
                        @if(!empty($jobs))
                        	<p class="jobs-count">{{str_pad($jobs->count(), 6, "0", STR_PAD_LEFT)}}</p>
	                    @else
	                    	0
	                    @endif
                        </div>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_area.png', '地域から検索', ['width' => '132', 'height' => '30']) }}</th>
									<td>
									{{ Form::select('prefecture_id', ['' => '都道府県を選択してください'] + JapanesePrefectures::prefectures()) }}
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_type.png', '雇用形態で選ぶ（複数選択可）', ['width' => '132', 'height' => '30']) }}</th>
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
								<th>{{ HTML::image('home/assets/img/top/tab2_cat.png', '職種を選ぶ（複数選択可）', ['width' => '132', 'height' => '30']) }}</th>
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
								<th>{{ HTML::image('home/assets/img/top/tab2_condition.png', '希望条件を選ぶ（複数選択可）', ['width' => '132', 'height' => '30']) }}</th>
								<td>
									<div class="check-box">
									@foreach(JobCondition::job_conditions() as $condition_id => $condition_name)
										@if ($condition_id % 5 == 0)
											<br>
										@endif
										{{ Form::checkbox('condition_ids[]', $condition_id) }}{{ $condition_name }}
									@endforeach
									</div>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<th>{{ HTML::image('home/assets/img/top/tab2_freeword.png', 'フリーワード', ['width' => '132', 'height' => '30']) }}</th>
								<td><input type="text" name="q" value=""><img src="home/assets/img/top/search_word.png" width="189" height="13" alt="知りたいワードから探せます" class="word"></td>
							</tr>
						</table>
						<ul>
							<li>{{ Form::reset( ' ', ['class' => 'search-reset', 'width' => '166', 'height' => '22']) }}</li>
							<li>{{ Form::image('home/assets/img/top/tab2_btn_search.png', 'この条件で検索する', ['class' => 'search', 'width' => '214', 'height' => '44']) }}</li>
						</ul>
					</div>
				{{ Form::close() }}
				</div><!-- /#details -->
		</section><!-- /.search-box -->