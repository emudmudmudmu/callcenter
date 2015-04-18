@extends('layouts.home', [
	'page_title' => 'お問い合わせ'
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            @if(!Input::has('done'))
            <div class="contact">
                @if(FormStrap::hasAlert(['danger']))
                    <br>
                    <a href="{{ route('home') }}">{{ HTML::image('home/assets/img/form/taikai.png', '退会完了', ['width' => '750', 'height' => '140']) }}</a>
                @else
                <h2 class="h"><img src="{{ url('/home/assets/img/contact/h_contact.png') }}" width="750" height="95" alt="お問い合わせ"></h2>
                <div class="formbox">
                    {{ Form::open(['route' => 'home.contact_confirm']) }}
                        <table class="apply-table">
                            <tr>
                                <th>お問合わせ内容<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::select('subject', ['' => '選択してください'] + ContactSubject::subjects()) }}
                                    <div class="text-danger">{{ $errors->first('subject') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>会社名</th>
                                <td>
                                    {{ Form::text('company') }}
                                    <div class="text-danger">{{ $errors->first('company') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>お名前<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('name') }}
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>メールアドレス<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('email') }}
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>確認のためもう一度<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::text('confirm_email') }}
                                    <div class="text-danger">{{ $errors->first('confirm_email') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>ご用件<span class="required">[必須]</span></th>
                                <td>
                                    {{ Form::textarea('comment', '', ['cols' => '70', 'rows' => '6']) }}
                                    <div class="text-danger">{{ $errors->first('comment') }}</div>
                                </td>
                            </tr>
                        </table>
                        <p class="btn"><input type="image" src="{{ url('/home/assets/img/contact/btn_confirm.png') }}" alt="確認画面へ"></p>
                    </form>
                </div>
                @endif
            </div>
            @else
                <br>
                {{ HTML::image('home/assets/img/contact/contact.png', 'お問い合わせ完了', ['width' => '750', 'height' => '120']) }}
            @endif
        </section><!-- /.l-main -->

@stop