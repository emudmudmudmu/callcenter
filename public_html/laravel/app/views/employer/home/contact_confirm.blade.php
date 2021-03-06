@extends('layouts.employer', [
	'page_title' => '管理会社へのお問い合せ'
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

          {{ Form::open(['route' => 'employer.contact.complete']) }}
          
            <div class="col-md-12">
              <div class="row">
                <h2 class="page-title"><span class="glyphicon glyphicon-envelope "></span><img src="./images/h2_contact.png" alt="管理会社へのお問い合わせ" /></h2>
                <table class="contact-table">
                    <tr>
                        <td colspan="2" class="contact-title"><span class="glyphicon glyphicon-envelope "></span>お問い合わせ</td>
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
                            <label for="inputContact3" class="control-label">担当者メールアドレス</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ Input::get('pic_email') }}
                           {{ Form::hidden('pic_email', Input::get('pic_email')) }}
                        </td>
                    </tr>               
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">お問い合わせ内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                            {{ nl2br(Input::get('comment')) }}
                           {{ Form::hidden('comment', Input::get('comment')) }}
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