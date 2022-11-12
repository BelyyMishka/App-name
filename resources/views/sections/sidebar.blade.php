<div class="sidebar">
    <div class="row">
        <div class="col-lg-12">
            <div class="sidebar-item search">
                <form method="GET" action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="search" id="search" class="searchText" placeholder="Find post">
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                    <h2>Recent Posts</h2>
                </div>
                <div class="content">
                    <ul>
                        @foreach($recentPosts as $recentPost)
                            <li>
                                <a href="{{ route('posts.show', $recentPost->slug) }}"><h5>{{ $recentPost->title }}</h5></a>
                                <span>{{ $recentPost->getDate() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="sidebar-item categories">
                <div class="sidebar-heading">
                    <h2>Categories</h2>
                </div>
                <div class="content">
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('category', $category->slug) }}">- {{ $category->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="sidebar-item tags">
                <div class="sidebar-heading">
                    <h2>Tag Clouds</h2>
                </div>
                <div class="content">
                    <ul>
                        @foreach($tags as $tag)
                            <li><a href="{{ route('tag', $tag->slug) }}">{{ $tag->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
