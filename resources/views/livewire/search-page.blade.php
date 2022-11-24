<div class="col-md-6 offset-3">
    <h2>Search for '{{ request()->get('query') }}'</h2>   

    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">People</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Posts</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @if($results_users->isEmpty())
                <h3 class="mt-5 text-center"><i>No results found. </i></h3>
            @else
                @foreach($results_users as $user)
                    @livewire('user-search-view', ['user' => $user], key($user->id))
                @endforeach
            @endif
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @if($results_posts->isEmpty())
                <h3 class="mt-5 text-center"><i>No results found. </i></h3>
            @else
                @foreach($results_posts as $post)
                    @livewire('post', ['post' => $post, 'is_view' => false], key($post->id))
                @endforeach
            @endif
        </div>
    </div>

</div>
