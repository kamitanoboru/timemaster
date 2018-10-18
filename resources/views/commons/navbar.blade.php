<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if (Auth::check())
                <a class="navbar-left" href="/mytime"><img src="{{ secure_asset("images/logo.png") }}" alt="Monolist"></a>
                @else
                <a class="navbar-left" href="/"><img src="{{ secure_asset("images/logo.png") }}" alt="Monolist"></a>
                @endif
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="/tasks/create">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                NEW TASK
                              </a>
                        </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                                {{ Auth::user()->name }}さん
                                <span class="glyphicon glyphicon-cog"></span>
                                
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/mytime">マイタイム</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                                                <li>
                                    <a href="/tasks/future">今後のタスク一覧</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="/users/edit">アカウント管理</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout.get') }}">ログアウト</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('signup.get') }}">新規登録</a></li>
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>