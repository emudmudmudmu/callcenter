<?php

    $current_url = Request::url() .'?';

    if(Input::all()) {

        foreach (Input::all() as $key => $value) {

            if($key != 'page') {

                if(is_array($value)) {

                    foreach ($value as $array_value) {

                        $current_url .= urlencode($key .'[]') .'='. $array_value .'&';

                    }

                } else {

                    $current_url .= $key .'='. $value .'&';

                }

            }

        }

    }
?>
<ul>
    @if($jobs->getCurrentPage() > 1)
        <li><a href="{{ $current_url }}page={{ ($jobs->getCurrentPage()-1) }}">前へ</a></li>
    @endif
    @for($i = 1 ; $i <= $jobs->getLastPage() ; $i++)
        @if($i == $jobs->getCurrentPage())
            <li><span class="page-on">{{ $i }}</span></li>
        @else
            <li><a href="{{ $current_url }}page={{ $i }}">{{ $i }}</a></li>
        @endif
    @endfor
    @if($jobs->getCurrentPage() < $jobs->getLastPage())
        <li><a href="{{ $current_url }}page={{ ($jobs->getCurrentPage()+1) }}">次へ</a></li>
    @endif
</ul>