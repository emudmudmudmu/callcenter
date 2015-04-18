@if(!empty($category_ids))
    @foreach($category_ids as $category_id)
        ■ {{ JobCategory::job_category_name($category_id) }}　
    @endforeach
@endif