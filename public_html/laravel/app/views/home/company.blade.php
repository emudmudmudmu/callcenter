@extends('layouts.home', [
	'page_title' => $employer->last_name
])

@section('content')

	<h1>「{{ $employer->last_name }}」</h1>
	
	{{ $id = $employer->employer_meta->id }}<br>
	{{ $user_id = $employer->employer_meta->user_id }}<br>
	{{ $foundation_date = $employer->employer_meta->foundation_date }}<br>
	{{ $representative = $employer->employer_meta->representative }}<br>
	{{ $capital_stock = $employer->employer_meta->capital_stock }}<br>
	{{ $employees = $employer->employer_meta->employees }}<br>
	{{ $zip_code_1 = $employer->employer_meta->zip_code_1 }}<br>
	{{ $zip_code_2 = $employer->employer_meta->zip_code_2 }}<br>
	{{ $prefecture_id = $employer->employer_meta->prefecture_id }}<br>
	{{ $city_id = $employer->employer_meta->city_id }}<br>
	{{ $other_address = $employer->employer_meta->other_address }}<br>
	{{ $pic_department = $employer->employer_meta->pic_department }}<br>
	{{ $pic_name = $employer->employer_meta->pic_name }}<br>
	{{ $tel = $employer->employer_meta->tel }}<br>
	{{ $fax = $employer->employer_meta->fax }}<br>
	{{ $image_file_id = $employer->employer_meta->image_file_id }}<br>

@stop