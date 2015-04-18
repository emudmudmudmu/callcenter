<?php

    $image_names = [
        'regular' => '正社員',
        'contract' => '契約社員',
        'temp' => '派遣社員',
        'tempto' => '紹介派遣',
        'part' => 'アルバイト・パート'
    ];

?>
<ul class="working-type">
    <?php $type_id = 1; ?>
    @foreach($image_names as $key => $image_name)
        <?php

            $mode = (is_array($type_ids) && in_array($type_id, $type_ids)) ? 'on' : 'off';

        ?>
        <li>{{ HTML::image('home/assets/img/search/ic_type_'. $key .'_'. $mode .'.png', $image_name, ['width' => '62', 'height' => '25']) }}</li>
        <?php $type_id++ ?>
    @endforeach
</ul>