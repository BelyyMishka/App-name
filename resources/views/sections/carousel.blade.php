<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach($popularPosts as $popularPost)
                <div class="item">
                    <img src="{{ asset("storage/{$popularPost->image}") }}" alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                                <span>{{ $popularPost->category->title }}</span>
                            </div>
                            <a href="{{ route('posts.show', $popularPost->slug) }}"><h4>{{ $popularPost->title }}</h4></a>
                            <ul class="post-info">
                                <li style="color: white">{{ $popularPost->user->name }}</li>
                                <li style="color: white">{{ $popularPost->getDate() }}</li>
                                <li style="color: white">{{ views($popularPost)->remember(3600)->count() }} Views</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
