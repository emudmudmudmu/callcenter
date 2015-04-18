@extends('layouts.admin', [
	'page_title' => '応募の一覧',
	'bakery_params' => [
		'admin.dashboard' => 'ホーム', 
		'*' => '応募の一覧'
	]
])

@section('content')

    <div class="clearfix">
        <div class="col-md-6 col-lg-6 no-padding">
            {{ $search_strap->filters([
                'title' => '求人タイトル',
                'status' => '状態',
            ])
            ->dropdown('status', ApplicationStatus::application_statuses()) }}
        </div>
    </div>

    @if($applications->count() > 0)
        <table class="table table-hover table-bordered table-striped bg-white footable font-size-sm" style="margin-top:15px;">
            <thead>
            <tr class="bg-gray text-white font-size-sm">
                <th>
                    <nobr>求人タイトル</nobr>
                </th>
                <th data-hide="phone,tablet">
                    <nobr>企業名</nobr>
                </th>
                <th data-hide="phone,tablet">
                    <nobr>応募日時</nobr>
                </th>
                <th data-hide="phone,tablet">
                    <nobr>応募者名</nobr>
                </th>
                <th data-hide="phone,tablet">
                    <nobr>状態</nobr>
                </th>
                <th>操作</th>
                <th class="text-center">
                    @include('partials.form.all_checked', ['selector' => '.delete_ids'])
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $index => $application)
                <tr>
                    <td>
                        <span>{{ HTML::linkRoute('home.job_detail', $application->job->title, [$application->job->id], ['target' => '_blank']) }}</span>
                        <br>（{{ AccountId::text('job', $application->job->id) }}）
                    </td>
                    <td data-hide="phone,tablet">{{ $application->job->user->last_name }}</td>
                    <td data-hide="phone,tablet">{{ $application->created_at }}</td>
                    <td data-hide="phone,tablet">
                        {{ $application->name }}
                    </td>
                    <td data-hide="phone,tablet">
                        <div class="
                        @if($application->status == 0)
                            text-warning
                        @elseif($application->status == 1)
                            text-primary
                        @elseif($application->status == 2)
                            text-success
                        @elseif($application->status == 3)
                            text-danger
                        @endif
                        ">
                        {{ $application->status_text }}
                        </div>
                    </td>
                    <td class="text-right">
                        <nobr>
                            {{ Menco::get([
                                'method' => 'DELETE',
                                '_method' => 'DELETE',
                                'label' => Camon::GL('remove'),
                                'url' => route('admin.application.destroy', [$application->id]),
                                'class' => 'btn btn-default btn-flat btn-sm bubbletip',
                                'title' => '削除',
                                'message' => trans('versatile.destroy_confirm')
                            ]) }}
                        </nobr>
                    </td>
                    <td class="text-center vertical-middle">
                        {{ Form::checkbox('delete_ids[]', $application->id, false, ['class' => 'delete_ids']) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            {{ Form::open(['route' => 'admin.application.multi_delete', 'class' => 'multi_delete', 'data-selector' => '.delete_ids']) }}
            {{ FormStrap::submit('一括削除', ['class' => 'btn btn-danger btn-xs']) }}
            {{ FormStrap::hidden(['joined_delete_ids' => '']) }}
            {{ Form::close() }}
        </div>
        <div class="text-right">
            {{ $applications->appends([
                'orderby' => Input::get('orderby'),
                'direction' => Input::get('direction')
            ])->links() }}
        </div>
    @endif

@stop

@section('script')

    <script type="text/javascript">
        <!--

        $(document).ready(function(e){

            @include('js/footable')
            @include('js/icheck')
            @include('js/all_checked')
            @include('js/multi_delete')
            {{ SearchStrap::js() }}

        });

        //-->
    </script>

@stop