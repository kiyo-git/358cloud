<div class="header">
    <div class="wrap">
        <div class="header-title">
            <span>Admin</span>
        </div>
        <div id="profileMenu" class="profile-menu">
            <a href="#"><span class="material-symbols-outlined large-size">account_circle</span><div class="arrow arrow-bottom"></div></a>
            <ul id="profileSubMenu" class="invisible-profile-sub-menu">
                <li>
                    <form action="{{route('admin.logout')}}" method="POST">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>