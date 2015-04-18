<ul class="detail-icon">
    @foreach(JobCondition::job_conditions() as $condition_id => $condition_name)
        @if(is_array($condition_ids) && in_array($condition_id, $condition_ids))
        <li>{{ HTML::image('home/assets/img/search/ic_detail_'. str_pad($condition_id, 2, '0', STR_PAD_LEFT) .'_on.png', $condition_name, ['width' => '134', 'height' => '24']) }}</li>
        @endif
    @endforeach
</ul>