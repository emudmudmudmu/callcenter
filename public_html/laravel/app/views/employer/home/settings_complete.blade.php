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

            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-home"></span><img src="./images/h2_company_edit.png" alt="企業情報の変更" /></h2>
                <table class="company-edit-table">
                    <tr>
                        <td class="company-edit-title"><span class="glyphicon glyphicon-file"></span>基本情報<br />
                        <span class="glyphicon glyphicon-user"></span>担当者の設定</td>
                    </tr>
                    <tr>
                        <td>
                           <p class="text-center">企業情報を変更いたしました。</p>
                        </td>
                    </tr>

                </table>

                  
                <div class="text-center">
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-default send-btn"><span class="glyphicon glyphicon-chevron-left"></span>TOPに戻る</a>
                </div>
              </div><!--/row-->

 
            </div><!--/.col-xs-12.col-sm-9-->

          </div><!--/row-->
        </div>
    </div>
    <div class="pagetop">
        <div class="container">
            <p class="text-right"><a href="#header"><span class="glyphicon glyphicon-chevron-up"></span>ページの先頭へ</a></p>      
        </div>
    </div>
    
    
@stop