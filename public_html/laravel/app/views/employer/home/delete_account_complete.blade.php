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

            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-envelope"></span><img src="./images/h2_cancellation.png" alt="サービスの解約・退会" /></h2>
                <table class="contact-table">
                    <tr>
                        <td class="contact-title"><span class="glyphicon glyphicon-envelope "></span>解約・退会申請</td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-center">お問い合わせを送信いたしました。</p>
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