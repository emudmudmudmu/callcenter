@extends('layouts.employer', [
	'page_title' => 'サービスの解約・退会',
	'bakery_params' => [
		'*' => 'ホーム'
	]
])

@section('content')

	<div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

            {{ Form::open(['route' => 'employer.delete_account.complete']) }}
            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-envelope"></span><img src="./images/h2_cancellation.png" alt="サービスの解約・退会" /></h2>
                <table class="contact-table">
                    <tr>
                        <td colspan="2" class="contact-title"><span class="glyphicon glyphicon-envelope "></span>解約・退会申請</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact1" class="control-label">担当部署</label><span class="required">[必須]</span>
                        </th>
                        <td>
                           {{ Input::get('pic_department') }}
                           {{ Form::hidden('pic_department', Input::get('pic_department')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">担当者名</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('pic_name') }}
                           {{ Form::hidden('pic_name', Input::get('pic_name')) }}
                        </td>
                    </tr>                          
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">お問い合わせ内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ nl2br(Input::get('reason')) }}
                           {{ Form::hidden('reason', Input::get('reason')) }}
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