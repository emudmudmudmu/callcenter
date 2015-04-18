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

            {{ Form::open(['route' => 'employer.delete_account.confirm']) }}
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
                            {{ Form::text('pic_department', '', ['class' => 'form-control']) }}
                            <div class="text-danger">{{ $errors->first('pic_department') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">担当者名</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Form::text('pic_name', '', ['class' => 'form-control']) }}
                            <div class="text-danger">{{ $errors->first('pic_name') }}</div>
                        </td>
                    </tr>              
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">解約・退会理由</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('reason', '', ['rows' => '8', 'class' => 'form-control']) }}
                            <div class="text-danger">{{ $errors->first('reason') }}</div>
                        </td>
                    </tr>               
                  
                </table>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary send-btn">確認する</button>
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