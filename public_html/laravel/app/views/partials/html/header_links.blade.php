<?php

    $link_data = [
        '1' => ['route' => 'home', 'alt' => 'トップ', 'size' => [167, 41]],
        '2' => ['route' => 'home.job', 'alt' => 'お仕事を探す', 'size' => [167, 41]],
        '3' => ['route' => 'home.new_job', 'alt' => '新着求人', 'size' => [166, 41]],
        '4' => ['route' => 'home.first', 'alt' => 'はじめてのコールセンター', 'size' => [167, 41]],
        '5' => ['route' => 'applicant.consideration', 'alt' => '検討中リスト', 'size' => [166, 41]],
        '6' => ['route' => 'auth.signup', 'alt' => '新規会員登録', 'size' => [167, 41]],
        '7' => ['route' => 'applicant.settings', 'alt' => '会員登録情報', 'size' => [167, 41]],
    ];

    if(!empty($user) && $user->hasPermission('applicant')) {

        unset($link_data[6]);

    } else {

        unset($link_data[7]);

    }

?>
<nav>
    <section class="l-navi">
        <ul class="cf">
            @foreach($link_data as $link_id => $link_values)
                <?php

                    $link_url = route($link_values['route']);
                    $link_id_string = str_pad($link_id, 2, '0', STR_PAD_LEFT);
                    $alt = $link_values['alt'];
                    $width = $link_values['size'][0];
                    $height = $link_values['size'][1];
                    $class = '';
                    $image_url = '';
                    $image_version = 'off';

                    if(Request::url() == $link_url) {

                        $class = 'currentPage';
                        $image_version = 'on';

                    }

                    $image_url = 'home/assets/img/layout/navi/navi_'. $link_id_string .'_'. $image_version .'.png';

                ?>
                <li><a href="{{ $link_url }}">{{ HTML::image($image_url, $alt, ['width' => $width, 'height' => $height, 'class' => $class]) }}</a></li>
            @endforeach
        </ul>
    </section>
</nav>