@extends('layouts.employer', [
	'page_title' => '管理会社へのお問い合せ'
])

@section('content')

    <div id="main">
        <div class="container">
          <div class="row row-offcanvas row-offcanvas-right">

          {{ Form::open(['route' => 'employer.contact.confirm']) }}
          
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
                        	{{ Form::text('pic_department', '', ['id' => 'inputContact1', 'class' => 'form-control']) }}
                        	<div class="text-danger">{{ $errors->first('pic_department') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="inputContact2" class="control-label">担当者名</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::text('pic_name', '', ['id' => 'inputContact2', 'class' => 'form-control']) }}
                        	<div class="text-danger">{{ $errors->first('pic_name') }}</div>
                        </td>
                    </tr>                  
                    <tr>
                        <th>
                            <label for="inputContact3" class="control-label">担当者メールアドレス</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::text('pic_email', '', ['id' => 'inputContact3', 'class' => 'form-control']) }}
                        	<div class="text-danger">{{ $errors->first('pic_email') }}</div>
                        </td>
                    </tr>               
                    <tr>
                        <th>
                            <label for="inputContact4" class="control-label">お問い合わせ内容</label><span class="required">[必須]</span>
                        </th>
                        <td>
                        	{{ Form::textarea('comment', '', ['id' => 'inputContact4', 'class' => 'form-control', 'rows' => '8']) }}
                        	<div class="text-danger">{{ $errors->first('comment') }}</div>
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