@extends($layout)

@section('title', 'Show Freelancer Profile')

@section('styles')
    <link rel="stylesheet" href="{{asset($styles)}}">
@endsection

@section('content')

<div class="profile-container">
    <div class="profile">
        <div class="profile-left">
            @if ($user->avatar)
                <img src="{{$user->avatar}}" alt="user id {{$user->id}}" class="profile-icon">
            @else
                <i class="fa-solid fa-user-circle profile-icon"></i>
            @endif
            <div class="rank">
                <span class="stars">
                    @for($i = 1; $i <= $user->freelancer->rank; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </span>
            </div>
        </div>
        <div class="profile-right">
            <div class="profile-card">
                <div class="profile-header">
                    <h3>Profile</h3>
                    @if (Auth::check() && Auth::id() === $user->id)
                        <a href="{{route('freelancer.profile.edit', $user->id)}}" class="text-black">
                            <i class="fa-solid fa-pen-to-square edit-icon"></i>
                        </a>
                    @endif
                </div>
                <div class="profile-content mb-3">
                    <table class="detail">
                        <tr>
                            <th class="pe-5">Username</th>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <th class="pe-5">Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>github</th>
                            <td>{{$user->freelancer->github}}</td>
                        </tr>
                        <tr>
                            <th>X</th>
                            <td>{{$user->freelancer->X}}</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>{{$user->freelancer->instagram}}</td>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <td>{{$user->freelancer->facebook}}</td>
                        </tr>
                        <tr>
                            <th>Completed projects</th>
                            <td>{{count($user->transactions)}}</td>
                        </tr>
                    </table>
                </div>

                <h5>Skills</h5>
                <div class="skills">
                    @foreach ($user->freelancer->skills as $skill)
                        <span class="skill-tag">{{$skill->name}}</span>
                    @endforeach
                </div>
            </div>

            <div class="evaluation-container">
                <h4>Evaluation</h4>
                <div class="evaluation-item">
                    <span class="evaluation-title">Quality</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('quality') * 10}}%">{{$evaluations->avg('quality') * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Communication</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('communication') * 10}}%">{{$evaluations->avg('communication') * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Adherence</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('adherence') * 10}}%">{{$evaluations->avg('adherence') * 10}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Total</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('total') * 10}}%">{{$evaluations->avg('total') * 10}}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="Project-container">
    <input type="radio" id="Project-history" name="tab-group" checked>
    <input type="radio" id="ongoing" name="tab-group">
    <input type="radio" id="likes" name="tab-group">

    <div class="tab-menu">
        <label for="Project-history" class="tab-label">Project History</label>
        <label for="ongoing" class="tab-label">On Going</label>
        <label for="likes" class="tab-label">Likes Project</label>
    </div>

    <div class="tab-content">
        @foreach ($completedProjects as $completedProject)
            <div class="tab-pane Project-history">
                <div class="project-box">
                    <div class="Project-date">{{$completedProject->project->deadline}}</div>
                    <div class="Project-details">
                        <a href="{{route('company.project.detail', $completedProject->project->id)}}" class="fs-5 fw-bold">
                            {{$completedProject->project->title}}
                        </a>
                        <br>
                        <p class="fw-bold m-0">{{$completedProject->project->company->user->name}}</p>
                        <p class="m-0">{{$completedProject->project->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $completedProject->project->required_rank; $i++){
                            ?>
                                    <i class="fa-solid fa-star"></i>
                            <?php
                                }
                            ?>
                        </p>
                    </div>
                </div>

                <div class="project-status">
                    <button class="status-label" data-bs-toggle="modal" data-bs-target="#evaluation{{$completedProject->project->id}}">Evaluation</button>
                </div>
                @include('freelancers.profile.modal.evaluation')
            </div>
        @endforeach

        @foreach ($ongoingProjects as $application)
            <div class="tab-pane ongoing">
                <div class="project-box">
                    <div class="Project-date">{{$application->project->deadline}}</div>
                    <div class="Project-details">
                        <a href="{{route('company.project.detail', $application->project->id)}}" class="fs-5 fw-bold">
                            {{$application->project->title}}
                        </a>
                        <br>
                        <a class="fw-bold m-0">{{$application->project->company->user->name}}</a>
                        <p class="m-0">{{$application->project->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $application->project->required_rank; $i++){
                            ?>
                                    <i class="fa-solid fa-star"></i>
                            <?php
                                }
                            ?>
                        </p>
                    </div>
                </div>

                {{-- status --}}
                {{-- requested, accepted, rejected, ongoing, submitted, resulted, completed --}}
                <div class="project-status">
                    <button class="status-label {{ $application->status }}" data-bs-toggle="modal" data-bs-target="#projectStatusModal-{{$application->id}}">{{ ucfirst($application->status) }}</button>
                </div>
            </div>
        @endforeach

        @foreach ($favoriteProjects as $favoriteProject)
            <div class="tab-pane likes">
                <div class="project-box">
                    <div class="Project-date">{{$favoriteProject->deadline}}</div>
                    <div class="Project-details">
                        <a href="{{route('company.project.detail', $favoriteProject->id)}}" class="fw-bold">
                            {{$favoriteProject->title}}
                        </a>
                        <br>
                        <p class="fw-bold m-0">{{$favoriteProject->company->user->name}}</p>
                        <p class="m-0">{{$favoriteProject->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $favoriteProject->required_rank; $i++){
                            ?>
                                <i class="fa-solid fa-star"></i>
                            <?php
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
