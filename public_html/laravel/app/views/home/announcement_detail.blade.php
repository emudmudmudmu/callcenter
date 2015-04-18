@extends('layouts.home', [
	'page_title' => $announcement->title
])

@section('content')

    <section class="l-contents cf">
        <section class="l-main">
            <div class="info">
                <h2 class="h">{{ HTML::image('home/assets/img/info/info_h.png', 'お知らせ', ['width' => '750', 'height' => '95']) }}</h2>
                <article>
                    <dl>
                        <dt>{{ $announcement->created_at->format('Y.m.d') }}</dt>
                        <dd>{{ nl2br($announcement->description) }}</dd>
                    </dl>
                </article>
            </div>
        </section><!-- /.l-main -->

@stop