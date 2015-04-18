@extends('layouts.home', [
	'page_title' => '登録済み求人情報の一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => '登録済み求人情報の一覧'
	]
])

@section('content')

	<table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
		<tbody>
			<tr>
				<td colspan="2" class="bold bg-warning font-size-lg">{{ $application->job->title }}への応募</td>
			</tr>
			<tr>
				<th>名前</th>
				<td>{{ $application->name }}</td>
			</tr>
			<tr>
				<th>ふりがな</th>
				<td>{{ $application->kana }}</td>
			</tr>
			<tr>
				<th>住所</th>
				<td>
					〒{{ $application->zip_code_1 }}-{{ $application->zip_code_2 }}<br>
					{{ $application->address->prefecture_name }}{{ $application->address->city_name }}{{ $application->other_address }}
				</td>
			</tr>
			<tr>
				<th>生年月日</th>
				<td>{{ $application->birthday_text }}</td>
			</tr>
			<tr>
				<th>性別</th>
				<td>{{ $application->gender_text }}</td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td>{{ $application->tel }}</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>{{ $application->email }}</td>
			</tr>
			<tr>
				<th>現在の職業</th>
				<td>{{ $application->current_job }}</td>
			</tr>
			<tr>
				<th>最終学歴</th>
				<td>{{ $application->education }}</td>
			</tr>
			<tr>
				<th>保有資格</th>
				<td>{{ $application->qualification }}</td>
			</tr>
			<tr>
				<th>職務経歴</th>
				<td>{{ $application->career }}</td>
			</tr>
			<tr>
				<th>自己PR</th>
				<td>{{ $application->introduction }}</td>
			</tr>
		</tbody>
	</table>

@stop