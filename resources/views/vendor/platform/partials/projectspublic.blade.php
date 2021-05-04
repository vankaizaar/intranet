<div data-controller="hello">
  <input data-target="hello.name" type="text">

  <button data-action="click->hello#greet">
    Greet
  </button>

  <span data-target="hello.output">
  </span>
</div>
    <div class="row admin-wrapper">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
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
                                        <a href="{{ route('project.view', $project->id) }}"
                                            class="linked">{{ $project->title }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

