 @extends('layouts.employer', [
	'page_title' => '企業情報の変更', 
	'bakery_params' => [
		'employer.dashboard' => 'ホーム', 
		'*' => '企業情報の変更'
	]
])

@section('content')
 
    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

          	{{ Form::open(['route' => 'employer.settings.complete']) }}
          
            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-home"></span><img src="./images/h2_company_edit.png" alt="企業情報の変更" /></h2>
                <table class="company-edit-table">
                    <tr>
                        <td colspan="2" class="company-edit-title"><span class="glyphicon glyphicon-file"></span>基本情報</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact1" class="control-label">企業名</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('last_name') }}
                            {{ Form::hidden('last_name', Input::get('last_name')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">設立年月</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('foundation_year') }} 年 {{ Input::get('foundation_month') }} 月
                            {{ Form::hidden('foundation_year', Input::get('foundation_year')) }}
                            {{ Form::hidden('foundation_month', Input::get('foundation_month')) }}
                        </td>
                    </tr>                  
                    <tr>
                        <th>
                            <label for="inputContact3" class="control-label">代表者</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('representative') }}
                            {{ Form::hidden('representative', Input::get('representative')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">資本金</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('capital_stock') }} 円
                            {{ Form::hidden('capital_stock', Input::get('capital_stock')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact5" class="control-label">従業員数</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('employees') }} 人
                            {{ Form::hidden('employees', Input::get('employees')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact5" class="control-label">事業内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ nl2br(Input::get('business_content')) }}
                            {{ Form::hidden('business_content', Input::get('business_content')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact6" class="control-label">本社所在地</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            〒 {{ Input::get('zip_code_1') }} - {{ Input::get('zip_code_2') }}<br />
                            <p>【都道府県・市区町村】</p>
                            {{ $address->prefecture_name }}　{{ $address->city_name }}
                            <p>【番地】</p>
                            {{ Input::get('other_address') }}
                            <p>【マンション・ビル名等】</p>
                            {{ Input::get('building') }}
                            {{ Form::hidden('zip_code_1', Input::get('zip_code_1')) }}
                            {{ Form::hidden('zip_code_2', Input::get('zip_code_2')) }}
                            {{ Form::hidden('prefecture_id', Input::get('prefecture_id')) }}
                            {{ Form::hidden('city_id', Input::get('city_id')) }}
                            {{ Form::hidden('other_address', Input::get('other_address')) }}
                            {{ Form::hidden('building', Input::get('building')) }}
                        </td>
                    </tr>

                </table>

                <table class="company-edit-table">
                    <tr>
                        <td colspan="2" class="company-edit-title"><span class="glyphicon glyphicon-user"></span>担当者の設定</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact7" class="control-label">担当部署名</label>
                        </th>
                        <td>
                            {{ Input::get('pic_department') }}
                            {{ Form::hidden('pic_department', Input::get('pic_department')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact8" class="control-label">担当者名</label>
                        </th>
                        <td>
                            {{ Input::get('pic_name') }}
                            {{ Form::hidden('pic_name', Input::get('pic_name')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact9" class="control-label">電話番号</label>
                        </th>
                        <td>
                            {{ Input::get('tel') }}
                            {{ Form::hidden('tel', Input::get('tel')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact10" class="control-label">FAX番号</label>
                        </th>
                        <td>
                            {{ Input::get('fax') }}
                            {{ Form::hidden('fax', Input::get('fax')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact11" class="control-label">メールアドレス</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('email') }}
                            {{ Form::hidden('email', Input::get('email')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact12" class="control-label">パスワード</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ str_repeat('*', strlen(Input::get('password'))) }}
                            {{ Form::hidden('password', Input::get('password')) }}
                            {{ Form::hidden('confirm_password', Input::get('confirm_password')) }}
                        </td>
                    </tr>
                </table>                  
                  
                  
                <div class="text-center">
                    <button name="submit_revert" type="submit" class="btn btn-default send-btn">修正する</button>　
                    <button name="submit_post" type="submit" class="btn btn-primary send-btn">送信する</button>
                </div>
              </div><!--/row-->

 
            </div><!--/.col-xs-12.col-sm-9-->

            {{ Form::close() }}
            
          </div><!--/row-->
        </div>
    </div>
    <div class="pagetop">
        <div class="container">
            <p class="text-right"><a href="#header"><span class="glyphicon glyphicon-chevron-up"></span>ページの先頭へ</a></p>      
        </div>
    </div>
    
@stop