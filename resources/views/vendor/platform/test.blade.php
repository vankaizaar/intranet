@extends('platform::dashboard')
@php
use App\Project;
$projects = Project::where('archived','=', FALSE)->paginate(100);
@endphp

@section('title',__('Projects'))
@section('description', __('List of all ICPAC Projects'))
@section('controller','hello')

@section('navbar')
<div class="form-group">
    <a class="btn btn-info mr-2" href="{{route('project.create')}}">
        <i class="icon-plus m-r-xs"></i>Create New Project
    </a>
</div>
@stop

@section('content')

<div class="container">
    <div class="admin-wrapper padder-v">
        <div class="row admin-wrapper">
            <div class="container">
                <div class="row m-b-xl text-left">
                    <div class="wrapper w-full">
                        <div class="block mb-4">
                            <div class="input-icon w-auto">
                                <input data-action="keyup->hello#filter" type="text"
                                    class="form-control input-sm bg-light no-border rounded padder"
                                    placeholder="{{__('Search...')}}">
                                <div class="input-icon-addon">
                                    <i class="icon-magnifier"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($projects->isEmpty())
                            <a class="btn btn-block btn-danger">No projects</a>
                            @else
                            @foreach ($projects as $project)
                            <div class="col-sm-6 col-md-4 col-lg-3 mt-2 project-element-item">
                                <div class="card project-element shadow">
                                    <img class="card-img-top" src="{{ asset($project->image) }}">
                                    <div class="card-block b-t" style="padding:1em">
                                        <h6 class="card-title font-bold text-left text-success text-uppercase text-center"
                                            style="margin-bottom:0;">
                                            <a href="{{ route('project.view', $project->id) }}" class="linked">{{
                                                $project->title }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @includeWhen($projects instanceof \Illuminate\Contracts\Pagination\Paginator && $projects->isNotEmpty(),
                    'platform::layouts.pagination',
                    ['paginator' => $projects]
                  )
            </div>
        </div>
    </div>
</div>
@stop
