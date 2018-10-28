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
@php
$ua = $_SERVER['HTTP_USER_AGENT'];
@endphp
                @if (Auth::check())
                

                    @if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false))
                        {{--スマホの場合に読み込むソースを記述--}}
                                <a class="navbar-left" href="/mytime"><img src="{{ secure_asset("images/logo_mini.png") }}" alt="TimeMaster"></a>
                    @elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false))
                        {{--タブレットの場合に読み込むソースを記述--}}
                                <a class="navbar-left" href="/mytime"><img src="{{ secure_asset("images/logo_mini.png") }}" alt="TimeMaster"></a>
                    @else
                        {{--PCの場合に読み込むソースを記述--}}
                                <a class="navbar-left" href="/mytime"><img src="{{ secure_asset("images/logo.png") }}" alt="TimeMaster"></a>
                                <a class="navbar-icons modalBtn" href="/gc"><i class="far fa-calendar-alt fa-2x"></i></a> 
                    @endif                


                   <a class="navbar-icons modalBtn" href="/mymemo"><i class="far fa-comment-alt fa-2x"></i>
                    <a class="navbar-icons" href="/tasks/create"><i class="fas fa-plus-circle fa-2x" style="color:red;"></i></a> 
 
                @else
                
                    @if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false))
                        {{--スマホの場合に読み込むソースを記述--}}
                                <a class="navbar-icons" href="/"><img src="{{ secure_asset("images/logo_mini.png") }}" alt="TimeMaster"></a>
                    @elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false))
                        {{--タブレットの場合に読み込むソースを記述--}}
                                <a class="navbar-icons" href="/"><img src="{{ secure_asset("images/logo_mini.png") }}" alt="TimeMaster"></a>
                    @else
                        {{--PCの場合に読み込むソースを記述--}}
                                <a class="navbar-icons" href="/"><img src="{{ secure_asset("images/logo.png") }}" alt="TimeMaster"></a>
                    @endif                
  
                @endif
                
               <a class="navbar-icons" href="/intro"><i class="fas fa-question-circle fa-2x" style="color:green;"></i></a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                        <li>
                            
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
                                    <a href="/tasks/all">全タスク一覧</a>
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